<?php

namespace App\Http\Controllers;

use App\Models\byForYou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ByForYouController extends Controller
{
    public function byForYouInsert(Request $request)
    {
        $maxDevice = byForYou::max('id2');
        if ($maxDevice == '') {
            $maxDevice = 7000000;
        }
        $maxDevice++;
        $valid = Validator::make($request->all(), [
            'name1' => 'required',
            'name2' => 'required',
            'name3' => 'required',
            'ic' => 'required',
            'lable' => 'required',
            'chanel' => 'required',
            'ipromName' => 'required',
            'sort' => 'required',
        ]);
        if ($valid->fails()) {
            return 0;
        } else {
            $new =  byForYou::create([
                'name1' => $request->name1,
                'name2' => $request->name2,
                'name3' => $request->name3,
                'ic' => $request->ic,
                'lable' => $request->lable,
                'chanel' => $request->chanel,
                'ipromName' => $request->ipromName,
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
                $path = 'img/byForYou/' . $new->id . '/mp3/';
                $file->move($path, $name);
                $mp3 = $path . $name;
                byForYou::find($new->id)->update([
                    'mp3' => $mp3
                ]);
            }
            return redirect()->route('byForYouImage', ['idDevice' => $new->id]);
        }
    }
    public function byForYouImageInsert(Request $request)
    {
        $file = $request->file('img');
        $name = rand(1000000000, 99999999999) . '.' . $file->getClientOriginalExtension();
        $path = 'img/byForYou/' . $request->idDevice . '/img/';
        $file->move($path, $name);
        $img = $path . $name;
        $imags = json_decode(byForYou::find($request->idDevice)->imags);
        array_push($imags, $img);
        byForYou::find($request->idDevice)->update([
            'imags' => $imags
        ]);
        return redirect()->back();
    }
    public function byForYouDelete($id)
    {
        $minDevice = byForYou::min('sort');
        $item = byForYou::find($id);
        $item->update([
            'sort'=>$minDevice--,
            'hide'=>1
        ]);
        return redirect()->back();
    }
    public function byForYouUpdateV(Request $request, $id)
    {
        $byForYou = byForYou::find($id);
        return view('admin.byForYou.edit',['byForYou'=>$byForYou]);
    }
    public function byForYouUpdate(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'name1' => 'required',
            'name2' => 'required',
            'name3' => 'required',
            'ic' => 'required',
            'lable' => 'required',
            'chanel' => 'required',
            'ipromName' => 'required',
            'sort' => 'required',
        ]);
        if ($valid->fails()) {
            return 0;
        } else {
            $item = byForYou::find($id);
            $mp3 = $item->mp3;
            if ($request->file('mp3')) {
                $file = $request->file('mp3');
                $name = rand(1000000000, 99999999999) . '.' . $file->getClientOriginalExtension();
                $path = 'img/byForYou/' . $item->id . '/mp3/';
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
                'ipromName' => $request->ipromName,
                'sort' => $request->sort,
                'imags' => '[]',
                "description" => $request->description,
                "price" => $request->price,
                'mp3' => $mp3
            ]);
            
            return redirect('/dashbord/byForYouList');
        }
    }
}
