<?php

namespace App\Http\Controllers\Page;

use App\Category;
use App\Helper\TencentHelper;
use App\Http\Requests;
use App\Live;
use Illuminate\Routing\Controller;


class HomeController extends Controller
{

    public function index()
    {
        return view('page.home.index');
    }

}