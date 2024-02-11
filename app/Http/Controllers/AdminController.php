<?php

namespace App\Http\Controllers;



use App\Models\admin;
use App\Models\onlin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    
    public function loginAdmin(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->with('eroore', 'salam');
        } else {
            $admin = admin::where('username', $request->username)->first();
            if ($admin == []) {
                return redirect()->back()->with('eroore', 'salam');
            } else {
                if ($admin->username == $request->username && $admin->password == $request->password) {
                    session(['admin' => $admin->id]);
                    session(['username' => $admin->username]);
                    session(['level' => $admin->level]);
                    session(['onlin' => onlin::find(1)->online]);
                    $currentTime = now();
                    // $targetTime = $currentTime->setHour(0)->setMinute(0);
                    // onlin::find(1)->update([
                    //     'time' => $targetTime,
                    // ]);
                    return redirect('dashbord/chatlist');
                } else {
                    return redirect()->back()->with('eroore', 'salam');
                }
            }
        }
    }
    public function logoutAdmin()
    {
        onlin::find(1)->update([
            'online' => 0
        ]);
        session()->forget('admin');
        session()->forget('username');
        session()->forget('level');
        return redirect('/');
    }
    public function adminList()
    {   

        $admin = admin::all();
        return view('admin.admin.list',['admin'=> $admin]);
    }
    public function adminUpdateV($id)
    {
        $admin = admin::find($id);
        return view('admin.admin.update',['admin'=> $admin]);
    }
    public function adminUpdate($id,Request $request)
    {
        $request->validate([
            'username'=> ['required'],
            'password'=>['required'],
            'level'=>['required'],
        ]);
        admin::find($id)->update([
            'username'=>$request->username,
            'password'=> $request->password,
            'level'=> $request->level,
        ]);
        return redirect('dashbord/adminList');
    }
    public function adminAddV()
    {
        return view('admin.admin.add');
    }
    public function adminAdd(Request $request)      
    {  
        $request->validate([
            'username'=> ['required'],
            'password'=>['required'],
            'level'=>['required'],
        ]); 
        admin::create([
            'username'=>$request->username,
            'password'=>$request->password,
            'level'=> $request->level,
        ]);
        return redirect('dashbord/adminList');
    }
    public function adminDelete($id)
    {
        admin::find($id)->delete();
        return redirect()->back();
    }
}
