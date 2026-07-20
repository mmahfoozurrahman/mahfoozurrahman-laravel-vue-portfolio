<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin(): Response
    {
        return Inertia::render('Admin/Login');
    }

    /**
     * Authenticate administrative user.
     */
    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required',
        ]);

        // Verify the math captcha answer against the session-stored answer
        $expectedAnswer = $request->session()->get('captcha_answer');
        if ($expectedAnswer === null || (string) $request->input('captcha') !== $expectedAnswer) {
            // Regenerate a fresh challenge for the next attempt
            $this->refreshCaptcha($request);

            return back()->withErrors([
                'captcha' => 'The verification answer is incorrect. Please try again.',
            ])->onlyInput('email');
        }

        // Only use email and password as credentials for Auth::attempt.
        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Welcome back, Craftsman!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our database records.',
        ])->onlyInput('email');
    }

    /**
     * Invalidate the administrative session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Logged out successfully.');
    }

    /**
     * Generate a fresh math captcha challenge in the session.
     * Kept here so the login flow can refresh after failures.
     */
    private function refreshCaptcha(Request $request): void
    {
        $a = random_int(1, 20);
        $b = random_int(1, 20);
        $operator = random_int(0, 1) === 1 ? '+' : '-';

        if ($operator === '-' && $b > $a) {
            [$a, $b] = [$b, $a];
        }

        $answer = $operator === '+' ? $a + $b : $a - $b;
        $request->session()->put('captcha_answer', (string) $answer);
    }
}
