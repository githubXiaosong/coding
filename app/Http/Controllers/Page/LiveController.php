<?php

namespace App\Http\Controllers\Page;

use App\Helper\TencentHelper;
use App\Http\Requests;
use App\Live;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;


class LiveController extends Controller
{

    public function index()
    {
        $live_id = rq('live_id');
        if(!$live_id)
            return redirect('/');

	$live=Live::where('id',$live_id)->with(['user','category'])->first();
        if(!$live)
            return redirect('');

        $play_array = TencentHelper::GetPlayUrl(BIZID,$live->user_id);
        return view('page.live.index')->with([
	    'live' => $live,
            'live_id' => rq('live_id'),
            'rtmp' => $play_array[0],
            'flv' => $play_array[1],
            'm3u8' => $play_array[2],
            'islive' => true,
            'coverpic' => $live->frontcover,
            'autoplay' => true,
            ]);
    }

}
