<?php

namespace App\Http\Controllers\Page;

use App\Helper\TencentHelper;
use App\Http\Requests;
use App\Live;
use Illuminate\Routing\Controller;


class LiveController extends Controller
{

    public function index()
    {
        $live_id = rq('live_id');
        if(!$live_id)
            return redirect('home');

        $live=Live::find($live_id);
        if(!$live)
            return redirect('home');

        $play_array = TencentHelper::GetPlayUrl(BIZID,$live_id);
        return view('page.live.index')->with([
            'live_id' => rq('live_id'),
            'rtmp' => $play_array[0],
            'flv' => $play_array[1],
            'm3u8' => $play_array[2],
            'live' => true,
            'coverpic' => $live->frontcover,
            'autoplay' => true,
            ]);
    }

}