<?php

namespace App\Http\Controllers;

use App\Models\cooperate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class CooperateController extends Controller
{
    public function cooperateLoder(Request $request)
    {
        for ($i = 1; $i < 200; $i++) {
            if (File::exists('cooperate/' . $i)) {
                $maxDevice = cooperate::max('id2');
                if ($maxDevice == '') {
                    $maxDevice = 2000000;
                }
                $maxDevice++;
                $maxSort = cooperate::max('sort');
                if ($maxSort == '') {
                    $maxSort = 1;
                }
                $maxSort++;
                $folderName = $maxDevice;
                File::copyDirectory('cooperate/' . $i, 'cooperate/' . $folderName);
                $data = json_decode(file_get_contents("cooperate/" . $folderName . "/data.json"), true);
                $imags = [];
                $vedio = [];
                $mp3 = [];
                $zip = [];
                foreach (glob("cooperate/" . $folderName . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                foreach (glob("cooperate/" . $folderName . "/vedio/*") as $target) {
                    array_push($vedio, $target);
                }
                foreach (glob("cooperate/" . $folderName . "/audio/*") as $target) {
                    array_push($mp3, $target);
                }
                foreach (glob("cooperate/" . $folderName . "/zip/*") as $target) {
                    array_push($zip, $target);
                }
                cooperate::create([
                    "imags" => json_encode($imags),
                    "mp3" => json_encode($mp3),
                    "vedio" => json_encode($vedio),
                    "zip" => json_encode($zip),
                    "id2" => $maxDevice,
                    "sort" => $maxSort,
                    "description" => $data['data'][0]['description'],
                    "name" => $data['data'][0]['name'],
                    "code" => $data['data'][0]['code'],
                ]);
                File::deleteDirectory('cooperate/' . $i);
            }
        }
        return redirect()->back();
    }
    public function cooperateUpdate($id)
    {
        $device = cooperate::find($id);
        $nameFolder =  $device->id2;
        foreach (glob("cooperate/*") as $folder) {
            if (strpos($folder, $nameFolder)) {
                $imags = [];
                $vedio = null;
                $mp3 = null;
                $zip = [];
                foreach (glob("cooperate/" . $nameFolder . "/img/*") as $target) {
                    array_push($imags, $target);
                }
                foreach (glob("cooperate/" . $nameFolder . "/zip/*") as $target) {
                    array_push($zip, $target);
                }
                $vedio = glob("cooperate/" . $nameFolder . "/vedio/*");
                $mp3 =  glob("cooperate/" . $nameFolder . "/audio/*");
                $data = json_decode(file_get_contents("cooperate/" . $nameFolder . "/data.json"), true);
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
    public function cooperatelist()
    {
        return view('admin.cooperate.list', ['cooperate' => cooperate::all()]);
    }
    public function cooperateDelete($id)
    {
        $target = cooperate::find($id);
        File::deleteDirectory('cooperate/' . $target->id2);
        $target->delete();
        return redirect()->back();
    }

    public function cooperateUpdatView($id)
    {
        $cooperate = cooperate::find($id);
        return view('admin.cooperate.update', ['cooperate' => $cooperate]);
    }
    public function cooperateUpdateM($id, Request $request)
    {
        $cooperate = cooperate::find($id);
        $data = json_decode(file_get_contents("cooperate/" . $cooperate->id2 . "/data.json"), true);
        $data['data'][0]['description'] = $request->description;
        File::put("cooperate/" . $cooperate->id2 . "/data.json", json_encode($data));
        $cooperate->update([
            'sort' => $request->sort,
            'description' => $request->description,
            'code' => $request->code,
            'name' => $request->name,
        ]);
        return redirect()->route('cooperatelist');
    }
    public function cooperateUpdatAddV()
    {
        return view('admin.cooperate.cooperateAddV');
    }
    public function downCooperate(Request $request)
    {
        $cooperate = cooperate::find($request->id);
        $miancode = $cooperate->code;
        if ($miancode == $request->code) {
            $file = json_decode($cooperate->zip);
            return response()->download($file[0]);
        }else{
            return redirect()->back()->with('coddErr',1);
        }
    }
}
