<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\byed;
use App\Models\byForYou;
use App\Models\byForYouUpdate;
use App\Models\chate;
use App\Models\Comment;
use App\Models\cooperate;
use App\Models\data;
use App\Models\device;
use App\Models\info;
use App\Models\katalog;
use App\Models\messegeChat;
use App\Models\onlin;
use App\Models\packege;
use App\Models\rsetCam;
use App\Models\rsetDevice;
use App\Models\shop;
use App\Models\UpdateFile;
use App\Models\user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class viewConreoller extends Controller
{

    public function index()
    {
        // Artisan::call('config:clear');
        // Artisan::call('optimize');
        // $atisoo_phon =  Crypt::decrypt(Cookie::get('atisoo_phon'));
        if (Cookie::has('atisoo_phon') && Cookie::has('atisoo_password') || !session()->has('user')) {
            $atisoo_phon = Cookie::get('atisoo_phon');
            $atisoo_password = Cookie::get('atisoo_password');
            $user = User::where('phon', $atisoo_phon)->where('password', $atisoo_password)->first();
            if ($user) {
                session(['user' => $user->id]);
            }
        }
        $userCount = count(user::all());
        $fileCount = count(device::all());
        $info = info::first();
        return view('flash.index', ['info' => $info, 'fileCount' => $fileCount, 'userCount' => $userCount]);
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

    public function shopPage()
    {
        $deviceShop = shop::where('userId', session()->get('user'))->get();
        $deviceByed = byed::where('userId', session()->get('user'))->get();
        byed::where("created_at", '<=', Carbon::now()->subDays(5))->delete();
        return view('flash.shopPage', ['deviceShop' => $deviceShop, 'deviceByed' => $deviceByed]);
    }

    public function dashbord()
    {
        // $chats = chate::all();
        // foreach ($chats as $key) {
        //     $meess = user::find($key->user_id);
        //     if (!$meess) {
        //        chate::find($key->id)->delete();
        //     }
        // }

        $admin = admin::find(session()->get('admin'))->first();
        return view('admin.index', ['data' => data::first(), 'admin' => $admin]);
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

    public function fileUpdateList()
    {
        $device = UpdateFile::paginate(250);
        return view('admin.fileUpdate.list', ['device' => $device]);
    }

    public function fileUpdateShow($id)
    {
        $device = UpdateFile::find($id);
        $comment = Comment::where('device_id', $id)->get();
        return view('admin.fileUpdate.show', ['device' => $device, 'comment' => $comment]);
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
        $info = info::first();
        $userCount = count(user::all());
        $fileCount = count(device::all());
        $info = info::first();
        return view('flash.searchFlash', ['device' => $device, 'info' => $info, 'fileCount' => $fileCount, 'userCount' => $userCount]);
    }

    public function searchUpdate(Request $request)
    {
        $device = 'null';
        if ($request->text != '') {
            $device = UpdateFile::where('name1', 'like', '%' . $request->text . '%')
                ->orWhere('name2', 'like', '%' . $request->text . '%')
                ->orWhere('name3', 'like', '%' . $request->text . '%')
                ->orWhere('lable', 'like', '%' . $request->text . '%')
                ->orWhere('id2', 'like', '%' . $request->text . '%')
                ->orWhere('chanel', 'like', '%' . $request->text . '%')
                ->orWhere('description', 'like', '%' . $request->text . '%')
                ->orWhere('ic', 'like', '%' . $request->text . '%')->paginate(20);
        }
        $info = info::first();
        $userCount = count(user::all());
        $fileCount = count(UpdateFile::all());
        $info = info::first();
        return view('flash.searchUpdate', ['device' => $device, 'info' => $info, 'fileCount' => $fileCount, 'userCount' => $userCount]);
    }

    public function searchViwe()
    {
        $info = info::first();
        $fileCount = count(device::all());
        return view('flash.searchFlash', ['info' => $info, 'device' => 'null', 'fileCount' => $fileCount]);
    }

    public function searchUpdateViwe()
    {
        $info = info::first();
        $fileCount = count(UpdateFile::all());
        return view('flash.searchUpdate', ['info' => $info, 'device' => 'null', 'fileCount' => $fileCount]);
    }

    public function abute()
    {
        return view('flash.abute');
    }

    public function byForYouList()
    {
        $device = byForYou::where('hide', 0)->get();
        return view('admin.byForYou.list', ['device' => $device]);
    }

    public function byForYouInsertViwe()
    {
        return view('admin.byForYou.insert');
    }

    public function byForYouUpdateFileList()
    {
        $device = byForYouUpdate::where('hide', 0)->get();
        return view('admin.byForYouUpdate.list', ['device' => $device]);
    }

    public function byForYouUpdateFileInsertViwe()
    {
        return view('admin.byForYouUpdate.insert');
    }

    public function byForYouImage(Request $request)
    {
        return view('admin.byForYou.image', ['idDevice' => $request->idDevice]);
    }

    public function byForYouUpdateFileImage(Request $request)
    {
        return view('admin.byForYouUpdate.image', ['idDevice' => $request->idDevice]);
    }

    public function byForYou()
    {
        $info = info::first();
        return view('flash.byForYou', ['device' => byForYou::orderBy('sort')->get(), 'info' => $info]);
    }

    public function byForYouUpdateFile()
    {
        $info = info::first();
        return view('flash.byForYouUpdateFile', ['device' => byForYouUpdate::orderBy('sort')->get(), 'info' => $info]);
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

    public function packegeL()
    {
        $info = info::first();
        return view('flash.packege', ['packege' => packege::orderBy('sort')->get(), 'info' => $info]);
    }

    public function cooperateL()
    {
        $info = info::first();
        return view('flash.cooperate', ['cooperate' => cooperate::orderBy('sort')->get(), 'info' => $info]);
    }

    public function katalogL()
    {
        $info = info::first();
        return view('flash.katalog', ['katalog' => katalog::orderBy('sort')->get(), 'info' => $info]);
    }

    public function showDevice($id)
    {
        $info = info::first();
        $device = device::find($id);
        $comment = Comment::where('device_id', $device->id2)->get();
        return view('flash.showDevice', ['device' => $device, 'comment' => $comment, 'info' => $info]);
    }

    public function showDeviceUpdate($id)
    {
        $info = info::first();
        $device = UpdateFile::find($id);
        $comment = Comment::where('device_id', $device->id2)->get();
        return view('flash.showDeviceUpdate', ['device' => $device, 'comment' => $comment, 'info' => $info]);
    }

    public function userList()
    {
        $user = user::paginate(1000);
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
            ->orWhere('discription', 'like', '%' . $request->text . '%')->paginate(1000);
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

    public function fileUpdateSearch(Request $request)
    {
        $device = 'null';
        if ($request->text != '') {
            $device = UpdateFile::where('name1', 'like', '%' . $request->text . '%')
                ->orWhere('name2', 'like', '%' . $request->text . '%')
                ->orWhere('name3', 'like', '%' . $request->text . '%')
                ->orWhere('ipromName', 'like', '%' . $request->text . '%')
                ->orWhere('lable', 'like', '%' . $request->text . '%')
                ->orWhere('id2', 'like', '%' . $request->text . '%')
                ->orWhere('chanel', 'like', '%' . $request->text . '%')
                ->orWhere('flashSize', 'like', '%' . $request->text . '%')
                ->orWhere('ic', 'like', '%' . $request->text . '%')->paginate(250);
        }
        return view('admin.fileUpdate.list', ['device' => $device]);
    }

    public function chate()
    {
        $user = user::find(session()->get('user'));
        if ($user->name == "نامشخص" || $user->name == null || $user->name == '') {
            return View('flash.completeInfo');
        } else {
            $online = onlin::find(1);
            $time = $online->time;
            $chate = chate::where('user_id', $user->id)->first();
            if (!$chate) {
                chate::create([
                    'user_id' => $user->id
                ]);
                return View('flash.chat', ['user' => $user, 'messegs' => [], 'time' => $time]);
            }
            $messegs = messegeChat::orderBy('id', 'desc')->where('chate_id', $chate->id)->take(10000)->get();
            return View('flash.chat', ['user' => $user, 'messegs' => $messegs, 'time' => $time]);
        }
    }

    public function ruls()
    {
        $info = info::first();
        return view('flash.ruls', ['info' => $info]);
    }

    public function panel()
    {
        $user = user::find(session()->get('user'));
        return view('flash.panel', ['user' => $user]);
    }
}
