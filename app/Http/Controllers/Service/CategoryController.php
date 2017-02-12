<?php

namespace App\Http\Controllers\Service;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests;

class CategoryController extends Controller
{
    public function getCategory()
    {
        return Category::all();
    }
}
