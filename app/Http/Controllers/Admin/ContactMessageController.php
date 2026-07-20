<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of inquiries.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Messages/Index', [
            'messages' => ContactMessage::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Display details of a specific message.
     */
    public function show(ContactMessage $message): Response
    {
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return Inertia::render('Admin/Messages/Show', [
            'message' => $message,
        ]);
    }

    /**
     * Mark the message as archived.
     */
    public function archive(ContactMessage $message): RedirectResponse
    {
        $message->update(['status' => 'archived']);

        return redirect()->back()->with('success', 'Message archived successfully.');
    }

    /**
     * Mark the message as read.
     */
    public function markRead(ContactMessage $message): RedirectResponse
    {
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}
