<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\rsetDevice;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RsetDeviceController extends Controller
{
    public function resetPassDvrNvrLoder(Request $request)
    {
        for ($i = 1; $i < 200; $i++) {
            if (File::exists('resetDevice/' . $i)) {
                $maxDevice = rsetDevice::max('id2');
                if ($maxDevice == '') {
                    $maxDevice = 1000000;
                }
                $maxDevice++;
                $maxSort = rsetDevice::max('sort');
                if ($maxSort == '') {
                    $maxSort = 1;
                }
                $maxSort++;
                $folderName = $maxDevice;
                File::copyDirectory('resetDevice/' . $i, 'resetDevice/' . $folderName);
                $data = json_decode(file_get_contents("resetDevice/" . $folderName . "/data.json"), true);
                $imags = [];
                $vedio = null;
                $mp3 = null;
                $apps = [];
                foreach (glob("resetDevice/" . $folderName . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                foreach (glob("resetDevice/" . $folderName . "/apps/*") as $target) {
                    array_push($apps, $target);
                }
                $vedio = glob("resetDevice/" . $folderName . "/vedio/*");

                $mp3 =  glob("resetDevice/" . $folderName . "/audio/*");

                rsetDevice::create([
                    "imags" => json_encode($imags),
                    "mp3" => json_encode($mp3),
                    "vedio" => json_encode($vedio),
                    "apps" => json_encode($apps),
                    "description" => $data['data'][0]['description'],
                    "id2" => $maxDevice,
                    "sort" => $maxSort,
                ]);
                File::deleteDirectory('resetDevice/' . $i);
            }
        }
        return redirect()->back();
    }
    public function resetDeviceUpdate($id)
    {
        $device = rsetDevice::find($id);
        $nameFolder =  $device->id2;
        foreach (glob("resetDevice/*") as $folder) {
            if (strpos($folder, $nameFolder)) {
                $imags = [];
                $vedio = null;
                $mp3 = null;
                $apps = [];
                foreach (glob("resetDevice/" . $nameFolder . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                foreach (glob("resetDevice/" . $nameFolder . "/apps/*") as $target) {
                    array_push($apps, $target);
                }
                $vedio = glob("resetDevice/" . $nameFolder . "/vedio/*");
                $mp3 =  glob("resetDevice/" . $nameFolder . "/audio/*");
                $data = json_decode(file_get_contents("resetDevice/" . $nameFolder . "/data.json"), true);
                $device->update([
                    "imags" => json_encode($imags),
                    "mp3" => json_encode($mp3),
                    "vedio" => json_encode($vedio),
                    "apps" => json_encode($apps),
                    "description" => $data['data'][0]['description'],
                ]);
                return redirect()->back();
            }
        }
        return redirect()->back()->with('updateFlashErr', 1);
    }
    public function resetDevicelist()
    {
        return view('admin.resetDevice.list', ['device' => rsetDevice::all()]);
    }
    public function resetDeviceDelete($id)
    {
        $target = rsetDevice::find($id);
        File::deleteDirectory('resetDevice/' . $target->id2);
        $target->delete();
        return redirect()->back();
    }
    public function resetDeviceUpdatView($id)
    {
        $device = rsetDevice::find($id);
        return view('admin.resetDevice.update', ['device' => $device]);
    }
    public function resetDeviceUpdateM($id, Request $request)
    {
        $device = rsetDevice::find($id);
        $device->update([
            'sort' => $request->sort,
            'description' => $request->description,
        ]);
        return redirect()->route('resetDevicelist');
    }
    public function resetDevicelistAddV(){
        return view('admin.resetDevice.resetDevicelistAddV');
    }
}
