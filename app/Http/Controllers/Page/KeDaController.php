<?php

namespace App\Http\Controllers\Page;

use App\Pet;


use App\Http\Requests;
use App\PetStatus;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Yaml\Exception\ParseException;

class KeDaController extends Controller
{


    public function lists()
    {
        $pets = DB::table('pets')->get();

        return view('page.keda.list')->with(['pets'=>$pets]);
    }

    public function add()
    {
        return view('page.keda.add');
    }

    public function details()
    {

        return view('page.keda.details');
    }

    public function explain()
    {
        return view('page.keda.explain');
    }


}
