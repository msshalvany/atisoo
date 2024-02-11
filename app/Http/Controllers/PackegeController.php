<?php

namespace App\Http\Controllers;

use App\Models\packege;
use App\Models\shop;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PackegeController extends Controller
{
    public function packegeLoder(Request $request)
    {
        for ($i = 1; $i < 200; $i++) {
            if (File::exists('packege/' . $i)) {
                $maxDevice = packege::max('id2');
                if ($maxDevice == '') {
                    $maxDevice = 2000000;
                }
                $maxDevice++;
                $maxSort = packege::max('sort');
                if ($maxSort == '') {
                    $maxSort = 1;
                }
                $maxSort++;
                $folderName = $maxDevice;
                File::copyDirectory('packege/' . $i, 'packege/' . $folderName);
                $data = json_decode(file_get_contents("packege/" . $folderName . "/data.json"), true);
                $imags = [];
                $vedio = [];
                $mp3 = [];
                $zip = [];
                foreach (glob("packege/" . $folderName . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                foreach (glob("packege/" . $folderName . "/vedio/*") as $target) {
                    array_push($vedio, $target);
                }
                foreach (glob("packege/" . $folderName . "/audio/*") as $target) {
                    array_push($mp3, $target);
                }
                foreach (glob("packege/" . $folderName . "/zip/*") as $target) {
                    array_push($zip, $target);
                }
                packege::create([
                    "imags" => json_encode($imags),
                    "mp3" => json_encode($mp3),
                    "vedio" => json_encode($vedio),
                    "zip" => json_encode($zip),
                    "id2" => $maxDevice,
                    "sort" => $maxSort,
                    "description" => $data['data'][0]['description'],
                    "name" => $data['data'][0]['name'],
                    "price" => $data['data'][0]['price'],
                ]);
                File::deleteDirectory('packege/' . $i);
            }
        }
        return redirect()->back();
    }
    public function packegeUpdate($id)
    {
        $device = packege::find($id);
        $nameFolder =  $device->id2;
        foreach (glob("packege/*") as $folder) {
            if (strpos($folder, $nameFolder)) {
                $imags = [];
                $vedio = null;
                $mp3 = null;
                $zip = [];
                foreach (glob("packege/" . $nameFolder . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                foreach (glob("packege/" . $nameFolder . "/zip/*") as $target) {
                    array_push($zip, $target);
                }
                $vedio = glob("packege/" . $nameFolder . "/vedio/*");
                $mp3 =  glob("packege/" . $nameFolder . "/audio/*");
                $data = json_decode(file_get_contents("packege/" . $nameFolder . "/data.json"), true);
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
    public function packegelist()
    {
        return view('admin.packege.list', ['packege' => packege::all()]);
    }
    public function packegeDelete($id)
    {
        $target = packege::find($id);
        File::deleteDirectory('packege/' . $target->id2);
        $target->delete();
        return redirect()->back();
    }

    public function packegeUpdatView($id)
    {
        $packege = packege::find($id);
        return view('admin.packege.update', ['packege' => $packege]);
    }
    public function packegeUpdateM($id, Request $request)
    {
        $packege = packege::find($id);
        $data = json_decode(file_get_contents("packege/" . $packege->id2 . "/data.json"), true);
        $data['data'][0]['description'] = $request->description;
        File::put("packege/" . $packege->id2 . "/data.json", json_encode($data));
        $packege->update([
            'sort' => $request->sort,
            'description' => $request->description,
            'price' => $request->price,
            'name' => $request->name,
        ]);
        return redirect()->route('packegelist');
    }
    public function packegeUpdatAddV()
    {
        return view('admin.packege.packegeAddV');
    }
    public function addShopPackege($id)
    {
        $user = user::find(session()->get('user'));
        $packege = packege::find($id);
        shop::create([
            'userId' => $user->id,
            'package_id' => $packege->id,
        ]);
        return redirect()->back()->with(['addPackS' => 1]);
    }
    public function deleteShopPack($id)
    {
        shop::find($id)->delete();
        return redirect()->back();
    }
}
