<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Zan;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //首页
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(10);

        return view('post.index',compact('posts'));
    }
    //详情
    public function show(Post $post)
    {
        $zanName = $post->zan(\Auth::id())->exists() ? 'zan' : 'unzan';
        return view('post.show',compact('post', 'zanName'));
    }
    //添加界面
    public function create()
    {
        return view('post.create');
    }
    //添加行为
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
    //编辑界面
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }
    //编辑行为
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
    //删除行为
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/posts');
    }

    public function imageUpload()
    {
        $path = request()->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);
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

    public function zan(Post $post)
    {
        $params = [
            'post_id' => $post->id,
            'user_id' => \Auth::id()
        ];
        Zan::firstOrCreate($params);
//        return back();
        return json_encode([
            'code' => 1
        ]);
    }

    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
//        return back();
        return json_encode([
            'code' => -1
        ]);
    }

    public function search()
    {
        $this->validate(request(),[
            'query' => 'required'
        ]);
        $query = request('query');
        $posts = Post::search($query)->paginate(5);

        return view('post.search',compact('posts','query'));
    }
}
