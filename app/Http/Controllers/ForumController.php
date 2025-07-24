<?php

namespace App\Http\Controllers;

use App\Models\ForumTopic;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $topics = ForumTopic::with(['user', 'replies'])
            ->latest()
            ->paginate(10);
            
        return view('forum.index', compact('topics'));
    }

    public function show(ForumTopic $topic)
    {
        $topic->incrementViews();
        $replies = $topic->replies()->with('user')->latest()->get();
        
        return view('forum.show', compact('topic', 'replies'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $topic = ForumTopic::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content']
        ]);

        return redirect()->route('forum.show', $topic)
            ->with('success', 'Topik berhasil dibuat!');
    }

    public function reply(Request $request, ForumTopic $topic)
    {
        $validated = $request->validate([
            'content' => 'required'
        ]);

        $reply = ForumReply::create([
            'topic_id' => $topic->id,
            'user_id' => auth()->id(),
            'content' => $validated['content']
        ]);

        return redirect()->route('forum.show', $topic)
            ->with('success', 'Balasan berhasil ditambahkan!');
    }

    public function markAsSolution(ForumReply $reply)
    {
        $this->authorize('markAsSolution', $reply);
        
        $reply->markAsSolution();
        
        return redirect()->route('forum.show', $reply->topic)
            ->with('success', 'Balasan ditandai sebagai solusi!');
    }
}
