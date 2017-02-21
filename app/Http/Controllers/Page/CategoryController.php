<?php

namespace App\Http\Controllers\Page;

use App\Http\Requests;
use App\Live;
use Illuminate\Routing\Controller;


class CategoryController extends Controller
{

    public function index()
    {

        $lives=Live::where([
            'category_id'=>rq('category_id'),
            'status'=>1
        ])->with(['user','category'])->paginate(16);

        return view('page.category.index')->with(['lives'=>$lives]);
    }

}