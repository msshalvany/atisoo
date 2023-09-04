<?php

namespace App\Http\Controllers;



use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;


class AdminController extends Controller
{
    public function loginAdmin(Request $request){
        $valid = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($valid->fails()){
            return redirect()->back()->with('eroore','salam');
        }else{
            $admin = admin::where('username',$request->username)->first();
            if ($admin==[]){
                return redirect()->back()->with('eroore','salam');
            }else {
                if ($admin->username == $request->username && $admin->password == $request->password) {
                    session(['admin'=>$admin->id]);
                    return redirect('dashbord');
                } else {
                    return redirect()->back()->with('eroore','salam');
                }
            }
        }
    }
    public function logoutAdmin(){
        session()->forget('admin');
        return redirect('/');
    }
}
