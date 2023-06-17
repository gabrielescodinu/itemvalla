<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'repeatable_fields.*.name' => 'required|max:255',
            'repeatable_fields.*.description' => 'required',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        $post->user_id = Auth::id();
        $post->repeatable_fields = json_encode($request->repeatable_fields);
        $post->save();

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }


    public function show(Post $post)
    {
        // Decodifica i campi ripetibili dal formato JSON
        $post->repeatable_fields = json_decode($post->repeatable_fields, true);

        return view('posts.show', compact('post'));
    }
}
