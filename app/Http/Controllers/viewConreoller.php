<?php

namespace App\Http\Controllers;

use App\Models\byed;
use App\Models\byForYou;
use App\Models\chate;
use App\Models\Comment;
use App\Models\data;
use App\Models\device;
use App\Models\info;
use App\Models\messegeChat;
use App\Models\rsetCam;
use App\Models\rsetDevice;
use App\Models\shop;
use App\Models\user;
use Carbon\Carbon;
use Illuminate\Http\Request;

class viewConreoller extends Controller
{

    public function index()
    {
        $device = 'null';
        $userCount = count(user::all());
        $fileCount = count(device::all());
        $info = info::first();
        return view('flash.index', ['device' => $device, 'info' => $info, 'fileCount' => $fileCount, 'userCount' => $userCount]);
    }

    public function register()
    {
        return view('flash.register');
    }

    public function login()
    {
        return view('flash.login');
    }

    public function other()
    {
        $user = user::find(session()->get('user'))->first();
        $users = user::where('name', '!=', 'نامشخص')->get();
        return view('flash.others', ['user' => $user, 'users' => $users]);
    }

    public function panel()
    {
        $deviceShop =  shop::where('userId', session()->get('user'))->get();
        $deviceByed =  byed::where('userId', session()->get('user'))->get();
        byed::whereDate("created_at", '<',  Carbon::now()->subDays(5))->delete();
        return view('flash.panel', ['deviceShop' => $deviceShop, 'deviceByed' => $deviceByed]);
    }

    public function dashbord()
    {
        return view('admin.index', ['data' => data::first()]);
    }

    public function loginAdmin()
    {
        return view('admin.login');
    }


    public function flashList()
    {
        $device = device::paginate(250);
        return view('admin.flash.list', ['device' => $device]);
    }
    public function flashShow($id)
    {
        $device = device::find($id);
        $comment = Comment::where('device_id', $id)->get();
        return view('admin.flash.show', ['device' => $device, 'comment' => $comment]);
    }
    public function resePassVwie()
    {
        return view('flash.resetPass');
    }
    public function infoVwie()
    {
        $info = info::first();
        return view('admin.info', ['info' => $info]);
    }

    public function search(Request $request)
    {
        $device = 'null';
        if ($request->text != '') {
            $device = device::where('name1', 'like', '%' . $request->text . '%')
                ->orWhere('name2', 'like', '%' . $request->text . '%')
                ->orWhere('name3', 'like', '%' . $request->text . '%')
                ->orWhere('ipromName', 'like', '%' . $request->text . '%')
                ->orWhere('lable', 'like', '%' . $request->text . '%')
                ->orWhere('id2', 'like', '%' . $request->text . '%')
                ->orWhere('chanel', 'like', '%' . $request->text . '%')
                ->orWhere('flashSize', 'like', '%' . $request->text . '%')
                ->orWhere('description', 'like', '%' . $request->text . '%')
                ->orWhere('ic', 'like', '%' . $request->text . '%')->paginate(20);
        }
        $info  = info::first();
        $userCount = count(user::all());
        $fileCount = count(device::all());
        $info = info::first();
        return view('flash.searchFlash', ['device' => $device, 'info' => $info, 'fileCount' => $fileCount, 'userCount' => $userCount]);
    }
    public function searchViwe()
    {
        $info = info::first();
        $fileCount = count(device::all());
        return view('flash.searchFlash', ['info' => $info, 'device' => 'null', 'fileCount' => $fileCount]);
    }
    public function abute()
    {
        return view('flash.abute');
    }
    public function byForYouList()
    {
        $device = byForYou::all();
        return view('admin.byForYou.list', ['device' => $device]);
    }
    public function byForYouInsertViwe()
    {
        return view('admin.byForYou.insert');
    }
    public function byForYouImage(Request $request)
    {
        return view('admin.byForYou.image', ['idDevice' => $request->idDevice]);
    }
    public function byForYou()
    {
        $info = info::first();
        return view('flash.byForYou', ['device' => byForYou::orderBy('sort')->get(), 'info' => $info]);
    }
    public function resetCam()
    {
        $info = info::first();
        return view('flash.resetCam', ['device' => rsetCam::orderBy('sort')->get(), 'info' => $info]);
    }
    public function resetDevice()
    {
        $info = info::first();
        return view('flash.resetDevice', ['device' => rsetDevice::orderBy('sort')->get(), 'info' => $info]);
    }
    public function showDevice($id)
    {
        $info = info::first();
        $comment = Comment::where('device_id', $id)->get();
        $device = device::find($id);
        return view('flash.showDevice', ['device' => $device, 'comment' => $comment, 'info' => $info]);
    }
    public function userList()
    {
        $user = user::paginate(250);
        $count = count(user::all());
        return view('admin.userList', ['user' => $user, 'count' => $count]);
    }
    public function userSearch(Request $request)
    {
        $user = user::where('id', 'like', '%' . $request->text . '%')
            ->orWhere('phon', 'like', '%' . $request->text . '%')
            ->orWhere('stor', 'like', '%' . $request->text . '%')
            ->orWhere('city', 'like', '%' . $request->text . '%')
            ->orWhere('name', 'like', '%' . $request->text . '%')
            ->orWhere('discription', 'like', '%' . $request->text . '%')->paginate(250);
        $count = count($user);
        return view('admin.userList', ['user' => $user, 'count' => $count]);
    }
    public function flashSearch(Request $request)
    {
        $device = 'null';
        if ($request->text != '') {
            $device = device::where('name1', 'like', '%' . $request->text . '%')
                ->orWhere('name2', 'like', '%' . $request->text . '%')
                ->orWhere('name3', 'like', '%' . $request->text . '%')
                ->orWhere('ipromName', 'like', '%' . $request->text . '%')
                ->orWhere('lable', 'like', '%' . $request->text . '%')
                ->orWhere('id2', 'like', '%' . $request->text . '%')
                ->orWhere('chanel', 'like', '%' . $request->text . '%')
                ->orWhere('flashSize', 'like', '%' . $request->text . '%')
                ->orWhere('ic', 'like', '%' . $request->text . '%')->paginate(250);
        }
        return view('admin.flash.list', ['device' => $device]);
    }
    public function chate()
    {
        $user = user::find(session()->get('user'));

        if ($user->name == "نامشخص") {
            return View('flash.completeInfo');
        } else {
            $chate = chate::where('user_id', $user->id)->first();
            $messegs = messegeChat::orderBy('id', 'desc')->where('chate_id', $chate->id)->take(250)->get();
            return View('flash.chat', ['user' => $user, 'messegs' => $messegs]);
        }
    }
}
