<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);

        return view('post.index',compact('posts'));
    }

    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function update(Post $post)
    {
        $this->validate(request(),[
            'title' => 'required|min:3|max:20',
            'content' => 'required'
        ]);
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        return redirect('/posts');
    }

    public function store()
    {
        $this->validate(request(),[
            'title' => 'required|min:3',
            'content' => 'required'
        ]);
        $user_id = \Auth::id();
        $param = array_merge(request(['title','content']),compact('user_id'));
        Post::create($param);
        return redirect('/posts');
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/posts');
    }
    public function comment(Post $post)
    {
        $this->validate(request(),[
            'content' => 'required|min:5|max:100'
        ]);
        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
//        Comment::create($comment);
        $post->comments()->save($comment);
        return back();
    }
}