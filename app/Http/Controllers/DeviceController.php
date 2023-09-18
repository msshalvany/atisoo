<?php

namespace App\Http\Controllers;

use App\Models\byed;
use App\Models\device;
use App\Models\shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    protected function getBet($str, $mark)
    {
        $start  = strpos($str, $mark);
        $end    = strpos($str, $mark, $start + 1);
        $length = $end - $start;
        return substr($str, $start + 1, $length - 1);
    }

    public function flashLodear(Request $request)
    {
        for ($i = 1; $i < 100; $i++) {
            if (File::exists('file/' . $i)) {
                $maxDevice = device::max('id2');
                if ($maxDevice == '') {
                    $maxDevice = 6000000;
                }
                $maxDevice++;
                $folderName = $maxDevice;
                $data = json_decode(file_get_contents("file/" . $i . "/data.json"), true);
                $flash = [];
                $imags = [];
                $iprom = [];
                File::copyDirectory('file/' . $i, 'file/' . $folderName);
                foreach (glob("file/" . $folderName . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                $counter = 0;
                foreach (glob("file/" . $folderName . "/flash/*") as $target) {
                    $des = $this->getBet($target, '.');
                    $counter++;
                    $new_path = 'file/' . $folderName . '/flash/' . 'flash_' . $counter . '_' . $des . '_' . $maxDevice . '_' . Str::random(24) . '.bin';
                    File::move($target, $new_path);
                    array_push($flash, $new_path);
                }
                $counter = 0;
                foreach (glob("file/" . $folderName . "/iprom/*") as $target) {
                    $des = $this->getBet($target, '.');
                    $counter++;
                    $new_path = 'file/' . $folderName . '/iprom/' . 'eeprom_' . $counter . '_' . $des . '_' . $maxDevice . '_' . Str::random(24) . '.bin';
                    File::move($target, $new_path);
                    array_push($iprom, $new_path);
                }
                if (count($iprom) == 0) {
                    $iprom = false;
                }
                device::create([
                    "name1" => $data['data'][0]['name1'],
                    "name2" => $data['data'][0]['name2'],
                    "name3" => $data['data'][0]['name3'],
                    "ic" => $data['data'][0]['ic'],
                    "ipromPrice" => $data['data'][0]['ipromPrice'],
                    "flashPrice" => $data['data'][0]['flashPrice'],
                    "flashSize" => $data['data'][0]['flashSize'],
                    "ipromName" => $data['data'][0]['ipromName'],
                    "lable" => $data['data'][0]['lable'],
                    "chanel" => $data['data'][0]['chanel'],
                    "password" => $data['data'][0]['password'],
                    "imags" => json_encode($imags),
                    "flash" => json_encode($flash),
                    "iprom" => json_encode($iprom),
                    "path" => 'file/' . $folderName,
                    "id2" => $maxDevice,
                    "description" => $data['data'][0]['description'],
                ]);
                File::deleteDirectory('file/' . $i);
            }
        }
        return redirect()->back();
    }


    public function flashDelete($id)
    {
        $by = byed::where('deviceId', $id)->first();
        if ($by != null) {
            return redirect()->back()->with('byedErr', '1');
        }
        $by = shop::where('deviceId', $id)->first();
        if ($by != null) {
            return redirect()->back()->with('shopErr', '1');
        }
        $device = device::find($id);
        File::deleteDirectory($device->path);
        $device->delete();
        return redirect()->back();
    }
    public function flashUpdate($id)
    {
        $device = device::find($id);
        $nameFolder =  $device->id2;
        foreach (glob("file/*") as $folder) {
            if (strpos($folder, $nameFolder)) {
                $flash = [];
                $imags = [];
                $iprom = [];
                foreach (glob("file/" . $nameFolder . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                $counter = 0;
                foreach (glob("file/" . $nameFolder . "/flash/*") as $target) {
                    $des = $this->getBet($target, '.');
                    $counter++;
                    $new_path = 'file/' . $nameFolder . '/flash/' . 'flash_' . $counter . '_' . $des . '_' . $nameFolder . '.bin';
                    File::move($target, $new_path);
                    array_push($flash, $target);
                }
                $counter = 0;
                foreach (glob("file/" . $nameFolder . "/iprom/*") as $target) {
                    $des = $this->getBet($target, '.');
                    $counter++;
                    $new_path = 'file/' . $nameFolder . '/iprom/' . 'eeprom_' . $counter . '_' . $des . '_' . $nameFolder . '.bin';
                    File::move($target, $new_path);
                    array_push($flash, $target);
                    array_push($iprom, $target);
                }
                if (count($iprom) == 0) {
                    $iprom = 'false';
                }
                $data = json_decode(file_get_contents("file/" . $nameFolder . "/data.json"), true);
                $device->update([
                    "name1" => $data['data'][0]['name1'],
                    "name2" => $data['data'][0]['name2'],
                    "name3" => $data['data'][0]['name3'],
                    "ic" => $data['data'][0]['ic'],
                    "ipromPrice" => $data['data'][0]['ipromPrice'],
                    "flashPrice" => $data['data'][0]['flashPrice'],
                    "flashSize" => $data['data'][0]['flashSize'],
                    "ipromName" => $data['data'][0]['ipromName'],
                    "lable" => $data['data'][0]['lable'],
                    "chanel" => $data['data'][0]['chanel'],
                    "password" => $data['data'][0]['password'],
                    "imags" => json_encode($imags),
                    "flash" => json_encode($flash),
                    "iprom" => json_encode($iprom),
                    "path" => 'file/' . $nameFolder,
                    "id2" => $nameFolder,
                    "description" => $data['data'][0]['description'],
                ]);
                return redirect()->back();
            }
        }
        return redirect()->back()->with('updateFlashErr', 1);
    }
    public function updatPiceALL(Request $request)
    {
        device::query()->update([
            'flashPrice' => $request->flash,
            'ipromPrice' => $request->iprom
        ]);
        return redirect()->route('flashList');
    }
    public function loadFlash()
    {
        return view('admin.flash.loadeFlash');
    }
    public function flashUpdateManualV($id)
    {
        $device = device::find($id);
        return view('admin.flash.flashUpdateManualV', ['device' => $device]);
    }
    public function flashUpdateManual(Request $request,$id)
    {
        $device = device::find($id);
        $device->update([
            "name1" => $request->name1,
            "name2" =>  $request->name2,
            "name3" => $request->name3,
            "ic" => $request->ic,
            "ipromPrice" => $request->ipromPrice,
            "flashPrice" => $request->flashPrice,
            "flashSize" => $request->flashSize,
            "ipromName" => $request->ipromName,
            "lable" => $request->lable,
            "chanel" => $request->chanel,
            "description" => $request->description,
            "password" => $request->password,
        ]);
        return redirect()->back();
    }
}
