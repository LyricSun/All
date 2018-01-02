<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/14
 * Time: 上午10:22
 */
namespace App\Admin\Controllers;

use App\Topic;

class TopicController extends Controller{
    public function index()
    {
        $topics = \App\Topic::orderBy('created_at','desc')->get();

        return view('admin.topic.index',compact('topics'));
    }

    public function create()
    {
        return view('admin.topic.create');
    }

    public function store()
    {
        $this->validate(request(),[
            'name' => 'required'
        ]);
        \App\Topic::create(['name' => request('name')]);

        return redirect('/admin/topics');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return [
            'code' => 1
        ];
    }
}