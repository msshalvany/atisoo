<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rsetCam;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RsetCamController extends Controller
{
    public function resetPassCamLoder(Request $request)
    {
        for ($i = 1; $i < 200; $i++) {
            if (File::exists('resetCam/' . $i)) {
                $maxDevice = rsetCam::max('id2');
                if ($maxDevice == '') {
                    $maxDevice = 3000000;
                }
                $maxDevice++;
                $maxSort = rsetCam::max('sort');
                if ($maxSort == '') {
                    $maxSort = 1;
                }
                $maxSort++;
                $folderName = $maxDevice;
                File::copyDirectory('resetCam/' . $i, 'resetCam/' . $folderName);
                $data = json_decode(file_get_contents("resetCam/" . $folderName . "/data.json"), true);
                $imags = [];
                $vedio = [];
                $mp3 = [];
                $apps = [];
                foreach (glob("resetCam/" . $folderName . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                foreach (glob("resetCam/" . $folderName . "/vedio/*") as $target) {
                    array_push($vedio, $target);
                }
                foreach (glob("resetCam/" . $folderName . "/audio/*") as $target) {
                    array_push($mp3, $target);
                }
                foreach (glob("resetCam/" . $folderName . "/apps/*") as $target) {
                    array_push($apps, $target);
                }
                rsetCam::create([
                    "imags" => json_encode($imags),
                    "mp3" => json_encode($mp3),
                    "vedio" => json_encode($vedio),
                    "apps" => json_encode($apps),
                    "id2" => $maxDevice,
                    "sort" => $maxSort,
                    "description" => $data['data'][0]['description'],
                ]);
                File::deleteDirectory('resetCam/' . $i);
            }
        }
        return redirect()->back();
    }
    public function resetCamUpdate($id)
    {
        $device = rsetCam::find($id);
        $nameFolder =  $device->id2;
        foreach (glob("resetCam/*") as $folder) {
            if (strpos($folder, $nameFolder)) {
                $imags = [];
                $vedio = null;
                $mp3 = null;
                $apps = [];
                foreach (glob("resetCam/" . $nameFolder . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                foreach (glob("resetCam/" . $nameFolder . "/apps/*") as $target) {
                    array_push($apps, $target);
                }
                $vedio = glob("resetCam/" . $nameFolder . "/vedio/*");
                $mp3 =  glob("resetCam/" . $nameFolder . "/audio/*");
                $data = json_decode(file_get_contents("resetCam/" . $nameFolder . "/data.json"), true);
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
    public function resetCamlist()
    {
        return view('admin.resetCam.list',['device'=>rsetCam::all()]);
    }
    public function resetCamDelete($id)
    {
        $target = rsetCam::find($id);
        File::deleteDirectory('resetCam/'.$target->id2);
        $target->delete();
        return redirect()->back();
    }
    
    public function resetCamUpdatView($id)
    {
        $device = rsetCam::find($id);
        return view('admin.resetCam.update',['device'=>$device]);
    }
    public function resetCamUpdateM($id,Request $request)
    {
        $device = rsetCam::find($id);
        $data = json_decode(file_get_contents("resetCam/" . $device->id2 . "/data.json"), true);
        $data['data'][0]['description'] = $request->description;
        File::put("resetCam/" . $device->id2 . "/data.json",json_encode($data));
        $device->update([
            'sort'=>$request->sort,
            'description'=>$request->description,
        ]);
        return redirect()->route('resetCamlist');
    }
    public function resetCamUpdatAddV  (){
        return view('admin.resetCam.resetCamAddV');
    }
}
