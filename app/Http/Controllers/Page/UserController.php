<?php

namespace App\Http\Controllers\Page;

use App\Category;
use App\Http\Requests;
use App\Live;
use App\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{



    public function data()
    {
        $user=User::find(session()->get('user')->id);

        return view('page.user.data')->with('user',$user);
    }

    public function live()
    {
        $categories=null;
        $live=(new Live())->where(['user_id'=>session()->get('user')->id])->with('category')->first();
        if(!$live)
            $categories=Category::all();
        return view('page.user.live')->with([
            'live'=>$live,
            'categories'=>$categories
        ]);
    }

    public function like()
    {
        return view('page.user.like');
    }

    public function question()
    {
        return view('page.user.question');
    }


}