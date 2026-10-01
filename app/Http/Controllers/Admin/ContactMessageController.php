<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('subject', 'like', "%{$s}%")
                  ->orWhere('message', 'like', "%{$s}%");
            });
        }

        $messages = $query->latest()->paginate(15)->withQueryString();

        $counts = [
            'all' => ContactMessage::count(),
            'new' => ContactMessage::where('status', ContactMessage::STATUS_NEW)->count(),
            'read' => ContactMessage::where('status', ContactMessage::STATUS_READ)->count(),
            'replied' => ContactMessage::where('status', ContactMessage::STATUS_REPLIED)->count(),
            'archived' => ContactMessage::where('status', ContactMessage::STATUS_ARCHIVED)->count(),
        ];

        return view('admin.messages.index', compact('messages', 'counts'));
    }

    public function show(ContactMessage $message)
    {
        if ($message->status === ContactMessage::STATUS_NEW) {
            $message->update(['status' => ContactMessage::STATUS_READ]);
        }
        return view('admin.messages.show', compact('message'));
    }

    public function update(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:new,read,replied,archived'],
            'internal_notes' => ['nullable', 'string'],
        ]);

        $message->update($validated);

        return back()->with('success', 'Message updated successfully.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}
