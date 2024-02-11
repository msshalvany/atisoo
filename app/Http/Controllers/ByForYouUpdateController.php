<?php

namespace App\Http\Controllers;

use App\Models\byForYouUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ByForYouUpdateController extends Controller
{
    public function byForYouUpdateFileInsert(Request $request)
    {
        $maxDevice = byForYouUpdate::max('id2');
        if ($maxDevice == '') {
            $maxDevice = 8000000;
        }
        $maxDevice++;
        $valid = Validator::make($request->all(), [
            'name1' => 'required',
            'name2' => 'required',
            'name3' => 'required',
            'ic' => 'required',
            'lable' => 'required',
            'chanel' => 'required',
            'sort' => 'required',
        ]);
        if ($valid->fails()) {
            return 0;
        } else {
            $new =  byForYouUpdate::create([
                'name1' => $request->name1,
                'name2' => $request->name2,
                'name3' => $request->name3,
                'ic' => $request->ic,
                'lable' => $request->lable,
                'chanel' => $request->chanel,
                'sort' => $request->sort,
                'imags' => '[]',
                "id2" => $maxDevice,
                "description" => $request->description,
                "price" => $request->price,
                'mp3' => '-'
            ]);
            if ($request->file('mp3')) {
                $file = $request->file('mp3');
                $name = rand(1000000000, 99999999999) . '.' . $file->getClientOriginalExtension();
                $path = 'img/byForYouUpdate/' . $new->id . '/mp3/';
                $file->move($path, $name);
                $mp3 = $path . $name;
                byForYouUpdate::find($new->id)->update([
                    'mp3' => $mp3
                ]);
            }
            return redirect()->route('byForYouUpdateFileImage', ['idDevice' => $new->id]);
        }
    }
    public function byForYouUpdateFileImageInsert(Request $request)
    {
        $file = $request->file('img');
        $name = rand(1000000000, 99999999999) . '.' . $file->getClientOriginalExtension();
        $path = 'img/byForYouUpdate/' . $request->idDevice . '/img/';
        $file->move($path, $name);
        $img = $path . $name;
        $imags = json_decode(byForYouUpdate::find($request->idDevice)->imags);
        array_push($imags, $img);
        byForYouUpdate::find($request->idDevice)->update([
            'imags' => $imags
        ]);
        return redirect()->back();
    }
    public function byForYouUpdateFileDelete($id)
    {
        $maxDevice = byForYouUpdate::min('sort');
        $item = byForYouUpdate::find($id);
        $item->update([
            'sort'=>$maxDevice--,
            'hide'=>1
        ]);
        return redirect()->back();
    }
    public function byForYouUpdateFileUpdateV($id)
    {
        $byForYou = byForYouUpdate::find($id);
        return view('admin.byForYouUpdate.edit',['byForYou'=>$byForYou]);
    }
    public function byForYouUpdateFileUpdate(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'name1' => 'required',
            'name2' => 'required',
            'name3' => 'required',
            'ic' => 'required',
            'lable' => 'required',
            'chanel' => 'required',
            'sort' => 'required',
        ]);
        if ($valid->fails()) {
            return 0;
        } else {
            $item = byForYouUpdate::find($id);
            $mp3 = $item->mp3;
            if ($request->file('mp3')) {
                $file = $request->file('mp3');
                $name = rand(1000000000, 99999999999) . '.' . $file->getClientOriginalExtension();
                $path = 'img/byForYouUpdate/' . $item->id . '/mp3/';
                $file->move($path, $name);
                $mp3 = $path . $name;
            }
            $item->update([
                'name1' => $request->name1,
                'name2' => $request->name2,
                'name3' => $request->name3,
                'ic' => $request->ic,   
                'lable' => $request->lable,
                'chanel' => $request->chanel,
                'sort' => $request->sort,
                'imags' => '[]',
                "description" => $request->description,
                "price" => $request->price,
                'mp3' => $mp3
            ]);
            return redirect('/dashbord/byForYouUpdateFileList');
        }
    }
}
