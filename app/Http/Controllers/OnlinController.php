<?php

namespace App\Http\Controllers;

use App\Models\onlin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OnlinController extends Controller
{
    public function setTime(Request $request)
    {
        $hour = $request->hour;
        $minute = $request->minute;
        $currentDateTime = Carbon::now();
        $currentDateTime->addHours($hour);
        $currentDateTime->addMinutes($minute);
        $currentTime = now();
        $targetTime = $currentTime->setHour($hour)->setMinute($minute);
        onlin::find(1)->update([
            'time' => $currentDateTime,
            'admin_id' => session()->get('admin'),
            'online' => 0
        ]);
        return redirect()->back();
    }
    public function setOfline()
    {
        $currentTime = now();
        $targetTime = $currentTime->setHour(0)->setMinute(0);
        onlin::find(1)->update([
            'time' => $targetTime,
            'online' => 0
        ]);
        session(['onlin' => onlin::find(1)->online]);
    }
    public function setOnline()
    {
        $currentTime = now();
        $targetTime = $currentTime->setHour(0)->setMinute(0);
        onlin::find(1)->update([
            'time' => $targetTime,
            'online' => 1
        ]);
        session(['onlin' => onlin::find(1)->online]);
    }
}
