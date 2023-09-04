<?php

namespace App\Http\Controllers;

use App\Models\data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function resetMonny(){
        data::first()->update([
            'total'=>0,
            'count'=>0
        ]);
        return redirect()->back();
    }
}
