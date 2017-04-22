<?php

namespace App\Console;

use App\Helper\GlobalFunction;
use App\Live;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
<<<<<<< HEAD
	 \App\Console\Commands\Inspire::class,
=======
        Commands\Inspire::class,
>>>>>>> origin/master
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
<<<<<<< HEAD

            $lives = DB::table('lives')->where('status', 1)->get(['user_id']);
            foreach ($lives as $item) {
                $addr = 'http://fcgi.video.qcloud.com/common_access?cmd=' . APPID . '&interface=Live_Channel_GetStatus&Param.s.channel_id=' . BIZID . '_' . $item->user_id . '&t=' . time() . '&sign=' . GlobalFunction::GetCallBackSign(time());

		$output=GlobalFunction::getCurlOutput($addr);
=======
            $lives = DB::table('lives')->where('status', 1)->get(['user_id']);
            foreach ($lives as $item) {
                $addr = 'http://fcgi.video.qcloud.com/common_access?cmd=' . APPID . '&interface=Live_Channel_GetStatus&Param.s.channel_id=' . BIZID . '_' . $item->user_id . '&t=' . time() . '&sign=' . GlobalFunction::GetCallBackSign(time());
                $output = GlobalFunction::getCurlOutput($addr);
>>>>>>> origin/master
                if ($output->ret == 0) {
                    if ($output->output[0]->status != 1) {
                        DB::table('lives')->where('user_id', $item->user_id)->update(['status' => 0]);
                    }
                } else {
                    Log::error($output->ret . $output->message);
                }
            }
<<<<<<< HEAD

        })->everyFiveMinutes();

=======
        })->everyFiveMinutes();

        $schedule->call(function () {
            $lives = DB::table('lives')->where('status', 1)->get(['user_id']);
            foreach ($lives as $item) {

            }
        })->everyFiveMinutes();


>>>>>>> origin/master
        $schedule->call(function () {
            $time = time();
            $lives = Live::get();
            foreach ($lives as $item) {
                if (($time - strtotime($item->created_at)) > 36000)
                    $item->delete();
            }
<<<<<<< HEAD
        })->everyFiveMinutes();

	
=======
        })->everyMinute();


>>>>>>> origin/master
    }
}

