<?php

namespace App\Http\Controllers;

use App\Models\katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\user;
class KatalogController extends Controller
{
    public function katalogLoder(Request $request)
    {
        for ($i = 1; $i < 1000; $i++) {
            if (File::exists('katalog/' . $i)) {
                $maxDevice = katalog::max('id2');
                if ($maxDevice == '') {
                    $maxDevice = 5000000;
                }
                $maxDevice++;
                $maxSort = katalog::max('sort');
                if ($maxSort == '') {
                    $maxSort = 1;
                }
                $maxSort++;
                $folderName = $maxDevice;
                File::copyDirectory('katalog/' . $i, 'katalog/' . $folderName);
                $data = json_decode(file_get_contents("katalog/" . $folderName . "/data.json"), true);
                $imags = [];
                $vedio = [];
                $mp3 = [];
                $zip = [];
                foreach (glob("katalog/" . $folderName . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                foreach (glob("katalog/" . $folderName . "/vedio/*") as $target) {
                    array_push($vedio, $target);
                }
                foreach (glob("katalog/" . $folderName . "/audio/*") as $target) {
                    array_push($mp3, $target);
                }
                foreach (glob("katalog/" . $folderName . "/zip/*") as $target) {
                    array_push($zip, $target);
                }
                katalog::create([
                    "imags" => json_encode($imags),
                    "mp3" => json_encode($mp3),
                    "vedio" => json_encode($vedio),
                    "zip" => json_encode($zip),
                    "id2" => $maxDevice,
                    "sort" => $maxSort,
                    "description" => $data['data'][0]['description'],
                    "name" => $data['data'][0]['name'],
                ]);
                File::deleteDirectory('katalog/' . $i);
            }
        }
        return redirect()->back();
    }
    public function katalogUpdate($id)
    {
        $device = katalog::find($id);
        $nameFolder =  $device->id2;
        foreach (glob("katalog/*") as $folder) {
            if (strpos($folder, $nameFolder)) {
                $imags = [];
                $vedio = null;
                $mp3 = null;
                $zip = [];
                foreach (glob("katalog/" . $nameFolder . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                foreach (glob("katalog/" . $nameFolder . "/zip/*") as $target) {
                    array_push($zip, $target);
                }
                $vedio = glob("katalog/" . $nameFolder . "/vedio/*");
                $mp3 =  glob("katalog/" . $nameFolder . "/audio/*");
                $data = json_decode(file_get_contents("katalog/" . $nameFolder . "/data.json"), true);
                $device->update([
                    "imags" => json_encode($imags),
                    "mp3" => json_encode($mp3),
                    "vedio" => json_encode($vedio),
                    "zip" => json_encode($zip),
                    "description" => $data['data'][0]['description'],
                    "name" => $data['data'][0]['name'],
                ]);
                return redirect()->back();
            }
        }
        return redirect()->back()->with('updateFlashErr', 1);
    }
    public function kataloglist()
    {
        return view('admin.katalog.list', ['katalog' => katalog::all()]);
    }
    public function katalogDelete($id)
    {
        $target = katalog::find($id);
        File::deleteDirectory('katalog/' . $target->id2);
        $target->delete();
        return redirect()->back();
    }

    public function katalogUpdatView($id)
    {
        $katalog = katalog::find($id);
        return view('admin.katalog.update', ['katalog' => $katalog]);
    }
    public function katalogUpdateM($id, Request $request)
    {
        $katalog = katalog::find($id);
        $data = json_decode(file_get_contents("katalog/" . $katalog->id2 . "/data.json"), true);
        $data['data'][0]['description'] = $request->description;
        File::put("katalog/" . $katalog->id2 . "/data.json", json_encode($data));
        $katalog->update([
            'sort' => $request->sort,
            'description' => $request->description,
            'name' => $request->name,
        ]);
        return redirect()->route('kataloglist');
    }
    public function katalogUpdatAddV()
    {
        return view('admin.katalog.katalogAddV');
    }
}
