<?php

namespace App\Http\Controllers;

use App\Models\byed;
use App\Models\shop;
use App\Models\UpdateFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class UpdateFileController extends Controller

{
    protected function getBet($str, $mark)
    {
        $start  = strpos($str, $mark);
        $end    = strpos($str, $mark, $start + 1);
        $length = $end - $start;
        return substr($str, $start + 1, $length - 1);
    }

    public function fileUpdatehLodear(Request $request)
    {
        for ($i = 1; $i < 10000; $i++) {
            if (File::exists('updatefile/' . $i)) {
                $maxDevice = UpdateFile::max('id2');
                if ($maxDevice == '') {
                    $maxDevice = 4000000;
                }
                $maxDevice++;
                $folderName = $maxDevice;
                $data = json_decode(file_get_contents("updatefile/" . $i . "/data.json"), true);
                $fileUpdate = [];
                $imags = [];
                File::copyDirectory('updatefile/' . $i, 'updatefile/' . $folderName);
                foreach (glob("updatefile/" . $folderName . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                $counter = 0;
                $new_path = '';
                foreach (glob("updatefile/" . $folderName . "/file/*") as $target) {
                    $des = $this->getBet($target, '.');
                    $counter++;
                    $new_path = 'updatefile/' . $folderName . '/file/' . 'file_' . $counter . '_' . $des . '_' . $maxDevice . '.bin';
                    File::move($target, $new_path);
                    array_push($fileUpdate, $new_path);
                }
                UpdateFile::create([
                    "name1" => $data['data'][0]['name1'],
                    "name2" => $data['data'][0]['name2'],
                    "name3" => $data['data'][0]['name3'],
                    "ic" => $data['data'][0]['ic'],
                    "price" => $data['data'][0]['price'],
                    "lable" => $data['data'][0]['lable'],
                    "chanel" => $data['data'][0]['chanel'],
                    "imags" => json_encode($imags),
                    "path" => $new_path,
                    "id2" => $maxDevice,
                    "description" => $data['data'][0]['description'],
                ]);
               File::deleteDirectory('updatefile/' . $i);
            }
        }
        return redirect()->back();
    }


    public function fileUpdateDelete($id)
    {
        $by = byed::where('deviceId', $id)->first();
        if ($by != null) {
            return redirect()->back()->with('byedErr', '1');
        }
        $by = shop::where('deviceId', $id)->first();
        if ($by != null) {
            return redirect()->back()->with('shopErr', '1');
        }
        $device = UpdateFile::find($id);
        File::deleteDirectory($device->path);
        $device->delete();
        return redirect()->back();
    }
    public function fileUpdateUpdate($id)
    {
        $device = UpdateFile::find($id);
        $nameFolder =  $device->id2;
        foreach (glob("updateFile/*") as $folder) {
            if (strpos($folder, $nameFolder)) {
                $fileUpdate = [];
                $imags = [];
                foreach (glob("updateFile/" . $nameFolder . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                $counter = 0;
                foreach (glob("updateFile/" . $nameFolder . "/file/*") as $target) {
                    $des = $this->getBet($target, '.');
                    $counter++;
                    $new_path = 'updateFile/' . $nameFolder . '/file/' . 'file_' . $counter . '_' . $des . '_' . $nameFolder . '.bin';
                    File::move($target, $new_path);
                    array_push($fileUpdate, $target);
                }
                $data = json_decode(file_get_contents("updateFile/" . $nameFolder . "/data.json"), true);
                $device->update([
                    "name1" => $data['data'][0]['name1'],
                    "name2" => $data['data'][0]['name2'],
                    "name3" => $data['data'][0]['name3'],
                    "ic" => $data['data'][0]['ic'],
                    "price" => $data['data'][0]['price'],
                    "lable" => $data['data'][0]['lable'],
                    "chanel" => $data['data'][0]['chanel'],
                    "imags" => json_encode($imags),
                    "path" => json_encode($fileUpdate),
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
        UpdateFile::query()->update([
            'flashPrice' => $request->flash,
            'ipromPrice' => $request->iprom
        ]);
        return redirect()->route('flashList');
    }
    public function loadFileUpdate()
    {
        return view('admin.fileUpdate.loadeFUpdateFile');
    }
    public function fileUpdateUpdateManualV($id)
    {
        $device = UpdateFile::find($id);
        return view('admin.fileUpdate.fileUpdateManualV', ['device' => $device]);
    }
    public function fileUpdateUpdateManual (Request $request,$id)
    { 
        $device = UpdateFile::find($id);
        $device->update([
            "name1" => $request->name1,
            "name2" =>  $request->name2,
            "name3" => $request->name3,
            "ic" => $request->ic,
            "price" => $request->ipromPrice,
            "lable" => $request->lable,
            "chanel" => $request->chanel,
            "description" => $request->description,
        ]);
        return redirect()->back();
    }
}
