<?php

namespace App\Http\Controllers;
use App\Http\Requests\front\StoreMessageRequest;
use App\Http\Requests\messages\UpdateMessageRequest;
use App\Models\location;
use App\Models\message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $message = message::all();
        $locations = location::select('name','phone')->get();
        return view('contact.index', compact('message', 'locations'));
    }
    public function store(StoreMessageRequest $request)
    {
        message::create($request->validated());
        return redirect()->route('contact.index')->with('success', 'message is created');
    }
}
