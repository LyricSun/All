<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/14
 * Time: 上午10:22
 */
namespace App\Admin\Controllers;

use App\Post;
use App\PostTopic;

class PostController extends Controller{
    public function index()
    {
        $posts = \App\Post::where('status',0)->orderBy('created_at','desc')->paginate(6);

        return view('admin.post.index',[
            'posts' => $posts
        ]);
    }

    public function status(Post $post)
    {
        $this->validate(request(),[
            'status' => 'required|in:-1,1'
        ]);
        $post->status = request('status');
        $post->save();

        return [
            'code' => 1
        ];
    }
}