<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\messages\UpdateMessageRequest;
use App\Models\message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact_messages = message::latest()->paginate(10);
        return view('dashboard.message.index', compact('contact_messages'));
    }
    public function update(UpdateMessageRequest $request, message $message)
    {
        $this->authorize('update', $message);
        $validated = $request->validated();
        $message->is_read = $validated['is_read'];
        $message->save();
        return redirect()->route('message.index')->with('success', 'message is updated');
    }
    public function delete(message $message)
    {
        $this->authorize('delete', $message);
        $message->delete();
        return redirect()->route('message.index')->with('success', 'message is deleted');
    }
}
