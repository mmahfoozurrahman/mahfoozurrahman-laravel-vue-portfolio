<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    /**
     * Generate a simple math captcha (addition/subtraction)
     * and store the expected answer in the session.
     *
     * Reusable across any form that needs human verification.
     */
    public function generate(Request $request): JsonResponse
    {
        $a = random_int(1, 20);
        $b = random_int(1, 20);
        $operator = random_int(0, 1) === 1 ? '+' : '-';

        // Avoid negative results for cleaner UX
        if ($operator === '-' && $b > $a) {
            [$a, $b] = [$b, $a];
        }

        $answer = $operator === '+' ? $a + $b : $a - $b;

        $request->session()->put('captcha_answer', (string) $answer);

        return response()->json([
            'question' => "{$a} {$operator} {$b}",
        ]);
    }
}