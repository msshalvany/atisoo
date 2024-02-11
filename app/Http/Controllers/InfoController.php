<?php

namespace App\Http\Controllers;

use App\Models\info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InfoController extends Controller
{
    public function changInfo(Request $request)
    {
        $pathPic =  info::first()->logo;
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $namePic = rand(1, 99999999) . '.' . $file->getClientOriginalExtension();
            $file->move('flash/img', 'flash/img/' . $namePic);
            $pathPic = 'flash/img/' . $namePic;
            File::delete(info::first()->logo);
        }
        info::first()->update([
            'indexKey' => $request->indexKey,
            'searchFlashKey' => $request->searchFlashKey,
            'searchUpdateKey' => $request->searchUpdateKey,
            'byFlahYouKey' => $request->byFlahYouKey,
            'byUpdateYouKey' => $request->byUpdateYouKey,
            'resetDeviceKey' => $request->resetDeviceKey,
            'resetCamKey' => $request->resetCamKey,
            'deviceKey' => $request->deviceKey,
            'logo' => $pathPic,
            'ruls' =>  $request->ruls,
            'ibaladam' =>  $request->ibaladam,
        ]);
        return redirect()->back();
    }
}
