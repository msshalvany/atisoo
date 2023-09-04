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
            $maxDevice = 5000000;
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
                'imags'=>'[]',
                "id2" => $maxDevice,
                "description" => $request->description,
                "price" => $request->price,
                'mp3'=>'-'
            ]);
            $file = $request->file('mp3');
            $name = rand(1000000000, 99999999999) . '.' . $file->getClientOriginalExtension();
            $path = 'flash/img/byForYou/'.$new->id.'/mp3/';
            $file->move($path, $name);
            $mp3 = $path . $name;
            byForYou::find($new->id)->update([
                'mp3'=>$mp3
            ]);
            return redirect()->route('byForYouImage',['idDevice'=>$new->id]);
        }
    }
    public function byForYouImageInsert(Request $request)
    {  
        $file = $request->file('img');
        $name = rand(1000000000, 99999999999) . '.' . $file->getClientOriginalExtension();
        $path = 'flash/img/byForYou/'.$request->idDevice.'/img/';
        $file->move($path, $name);
        $img = $path . $name;
        $imags = json_decode(byForYou::find($request->idDevice)->imags);
        array_push($imags,$img); 
        byForYou::find($request->idDevice)->update([
            'imags'=>$imags
        ]);
        return redirect()->back();
    }
    public function byForYouDelete($id)
    {  
        File::deleteDirectories('flash/img/byForYou/'.$id);
        byForYou::find($id)->delete();
        return redirect()->back();
    }
}
