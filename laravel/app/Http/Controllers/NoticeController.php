<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/18
 * Time: 下午3:52
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = \Auth::user()->notices;
        return view('notice.index',compact('notices'));
    }
}