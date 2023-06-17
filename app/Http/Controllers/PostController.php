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
            $imagePath = $request->file('image')->store('public/images');
            $post->image = str_replace('public/', '', $imagePath);
        }
        
        $post->user_id = Auth::id();
    
        // Recupera i campi ripetibili
        $repeatableFields = [];
    
        if ($request->has('repeatable_fields')) {
            foreach ($request->repeatable_fields as $field) {
                $repeatableField = [
                    'name' => $field['name'],
                    'description' => $field['description'],
                ];
    
                if (isset($field['image']) && $field['image']->isValid()) {
                    $imagePath = $field['image']->store('public/images');
                    $repeatableField['image'] = str_replace('public/images/', '', $imagePath);
                }
    
                $repeatableFields[] = $repeatableField;
            }
        }

    
        $post->repeatable_fields = json_encode($repeatableFields);
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
