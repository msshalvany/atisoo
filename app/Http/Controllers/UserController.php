<?php

namespace App\Http\Controllers;
use App\Models\byed;
use App\Models\chate;
use App\Models\data;
use App\Models\device;
use App\Models\packege;
use App\Models\shop;
use App\Models\UpdateFile;
use App\Models\user as ModelsUser;
use Ghasedak\GhasedakApi;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Evryn\LaravelToman\CallbackRequest;
use Evryn\LaravelToman\Facades\Toman;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function getPhon(Request $request)
    {
        $user = User::where('phon', $request->phon)->first();
        if ($user) {
            return 'ex';
        }
        $valid = Validator::make($request->all(), [
            'phon' => 'required|min:10|numeric'
        ]);
        if ($valid->fails()) {
            return 0;
        } else {
            $code = rand(10000, 99999);
            session(['code' => $code, 'phon' => $request->phon]);
            $api = new GhasedakApi('ff35f8690aa652194bbcd5cbad763622b0638f4af8059d9e1fb749969dc3fbda');
            $api->Verify(
                $request->phon,
                'atisoo',
                $code,
            );
            return 1;
        }
    }

    public function atheUser(Request $request)
    {
        $code = session()->get('code');
        if ($code == $request->code) {
            session()->forget('code');
            return 1;
        } else {
            return 0;
        }
    }

    public function setUserPass(Request $request)
    {
        if ($request->invidPhon != '') {
            $userInvidre = ModelsUser::where('phon', $request->invidPhon)->first();
            if ($userInvidre == null) {
                return 2;
            } else {
                $newScor =  $userInvidre->score + 1;
                $userInvidre->update([
                    "score" => $newScor
                ]);
            }
        }
        $valid = Validator::make($request->all(), [
            'password' => 'required'
        ]);
        if ($valid->fails()) {
            return 0;
        } else {
            if (!User::where('phon',session()->get('phon'))->first()) {
                ModelsUser::create([
                    'password' => $request->password,
                    'name' => 'نامشخص',
                    'phon' => session()->get('phon'),
                    'stor' => 'نامشخص',
                    'city' => 'نامشخص',
                    'discription' => 'نامشخص',
                    'discount' => '0',
                    'image' => 'flash/img/man.png'
                ]);
                $api = new GhasedakApi('ff35f8690aa652194bbcd5cbad763622b0638f4af8059d9e1fb749969dc3fbda');
                $api->Verify(
                    session()->get('phon'),
                    'phonErr',
                    session()->get('phon'),
                );
                return 1;
            }
        }
    }

    public function login(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'phon' => 'required|min:10|numeric',
            'password' => 'required|min:4',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->with('erroreLogin', 'data');
        } else {
            $user = User::where('phon', $request->phon)->first();
            if ($user) {
                if ($user->phon == $request->phon && $user->password == $request->password ) {
                    session(['user' => $user->id]);
                    if ($request->remember == 'on') {
                        $atisoo_phon = $request->phon;
                        $atisoo_password = $request->phon;
                        Cookie::make('atisoo_phon',$atisoo_phon,60 * 60 * 24 * 365);
                        Cookie::make('atisoo_password',$atisoo_password,60 * 60 * 24 * 365);
                        return redirect('/')->with('remember', 1)->with('atisoo_password', $request->password,)->with('atisoo_phon', $request->phon);
                    }
                    return redirect('/');
                }
            }
            return redirect()->back()->with('erroreLogin', 'null');
        }
    }

    public function logout()
    {
        $cookiePhon = Cookie::forget('atisoo_phon');
        $cookiePassword = Cookie::forget('atisoo_password');
        session()->forget('user');
        // ارسال کوکی‌های جدید به کاربر برای حذف کوکی‌های قبلی
        return redirect('/')->withCookies([$cookiePhon, $cookiePassword]);
    }

    public function resetPassAuth(Request $request)
    {
        if (User::where('phon', $request->phon)->first() == []) {
            return 'ex';
        }
        $valid = Validator::make($request->all(), [
            'phon' => 'required|min:10|numeric'
        ]);
        if ($valid->fails()) {
            return 0;
        } else {
            $code = rand(10000, 99999);
            $api = new GhasedakApi('ff35f8690aa652194bbcd5cbad763622b0638f4af8059d9e1fb749969dc3fbda');
            $api->Verify(
                $request->phon,
                'atisoo',
                $code,
            );
            session(['code' => $code, 'phon' => $request->phon]);
            return 1;
        }
    }

    public function resetPass(Request $request)
    {
        $code = session()->get('code');
        session(['changPasss' => true]);
        if ($code == $request->code) {
            session()->forget('code');
            return 1;
        } else {
            return 0;
        }
    }

    public function passChang(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'password' => 'required|min:4'
        ]);
        if ($valid->fails()) {
            return 0;
        }
        if (session()->get('changPasss')) {
            session()->forget('changPasss');
            ModelsUser::where('phon', session()->get('phon'))->update([
                "password" => $request->password
            ]);
            return 1;
        }
    }

    public function UserInfo(Request $request)
    {
        ModelsUser::find(session()->get('user'))->update([
            'name' => $request->name,
            'stor' => $request->stor,
            'city' => $request->city,
            'discription' => $request->discription,
        ]);
        return redirect()->back();
    }

    public function addFlash($device, $user, $flash, $iprom)
    {
        if ($flash != 'false' || $iprom != 'false') {
            shop::create([
                'userId' => $user,
                'deviceId' => $device,
                'flash' => $flash,
                'iprom' => $iprom,
            ]);
            return 1;
        } else {
            return 0;
        }
    }
    public function addFileUpdShop($device)
    {
        $user = user::find(session()->get('user'));
        shop::create([
            'userId' => $user->id,
            'updateFile_id' => $device,
            'deviceId' => 0,
        ]);
        return redirect()->back()->with(['shopUpdateSu' => 1]);
    }

    public function deleteFlash($id)
    {
        shop::find($id)->delete();
        return redirect()->back();
    }

    public function byFlash(Request $request)
    {
        // get price count
        $shop = shop::where('userId', session()->get('user'))->get();
        $user = ModelsUser::find(session()->get('user'));
        $count = 0;
        foreach ($shop as $key) {
            if ($key->deviceId != 0) {
                # code...
                if ($key->iprom == 'true') {
                    $price = device::find($key->deviceId)->ipromPrice;
                    $count += $price;
                }
                if ($key->flash == 'true') {
                    $price = device::find($key->deviceId)->flashPrice;
                    $count += $price;
                }
            }
            if ($key->updateFile_id != 0) {
                $price = UpdateFile::find($key->updateFile_id)->price;
                $count += $price;
            }
            if ($key->package_id != 0) {
                $price = packege::find($key->package_id)->price;
                $count += $price;
            }
        }
        // get price count
        $userPhon = User::find(session()->get('user'))->phon;
        session(['userPhon' => $userPhon]);
        if ($request->discount == 'on') {
            if ($user->discount >= $count) {
                $discount = $user->discount;
                $discount = $discount - $count;
                $user = ModelsUser::find(session()->get('user'));
                $shop = shop::where('userId', $user->id)->get();
                foreach ($shop as $key) {
                    byed::create([
                        'flash' => $key->flash,
                        'iprom' => $key->iprom,
                        'userId' => $key->userId,
                        'deviceId' => $key->deviceId,
                        'updateFile_id' => $key->updateFile_id,
                        'package_id' => $key->package_id,
                    ]);
                    $this->updateData(session()->get('count'));
                }
                $user->update([
                    'discount' => $discount
                ]);
                $key::find($key->id)->delete();
                return redirect()->back()->with('pay', 'successful');
            } else {
                $count = $count - $user->discount;
                session(['discountAll' => 1]);
            }
        }
        session(['count' => $count]);
        $user = session()->get('user');
        $devices = shop::where('userId', $user)->get();
        $request = Toman::amount($count * 1000)->callback(route('checkPay'))->request();
        if ($request->successful()) {
            $transactionId = $request->transactionId();
            return $request->pay(); // Redirect to payment URL
        }
        if ($request->failed()) {
            return 'در حال حاضر امکان پرداخت وجود ندارد';
        }
    }


    public function checkPay(CallbackRequest $request)
    {
        $payment = $request->amount(session()->get('count') * 1000)->verify();
        if ($payment->successful()) {
            $user = ModelsUser::find(session()->get('user'));
            $shop = shop::where('userId', $user->id)->get();
            foreach ($shop as $key) {
                byed::create([
                    'flash' => $key->flash,
                    'iprom' => $key->iprom,
                    'userId' => $key->userId,
                    'deviceId' => $key->deviceId,
                    'updateFile_id' => $key->updateFile_id,
                    'package_id' => $key->package_id,
                ]);
                if ($key->updateFile_id != 0) {
                    $target = UpdateFile::find($key->updateFile_id);
                } elseif ($key->package_id != 0) {
                    $target = packege::find($key->package_id);
                } elseif ($key->deviceId != 0) {
                    $target = device::find($key->deviceId);
                }
                $this->updateData(session()->get('count'));
                $api = new GhasedakApi('ff35f8690aa652194bbcd5cbad763622b0638f4af8059d9e1fb749969dc3fbda');
                $api->Verify(
                    '09131572450',
                    'atisooSendForUser',
                    session()->get('count') * 1000,
                    session()->get('userPhon'),
                    $target->id2
                );
                shop::find($key->id)->delete();
            }
            if (session()->exists('discountAll')) {
                $user->update([
                    'discount' => 0
                ]);
                session()->forget('discountAll');
            }
            return redirect('/shopPage')->with('pay', 'successful');
        }
        if ($payment->alreadyVerified()) {
            return 'پرداخت قبلاً یه بار بررسی و تایید شده بود. شناسه ارجاع همچنان در دسترسه.';
        }

        if ($payment->failed()) {
            return redirect('/shopPage')->with('pay', 'erroe');
        }
    }


    public function downloadeFile($file, $order, $type)
    {

        $type  =  Crypt::decrypt($type);
        if ($type == 'iprom' || $type == 'flash') {
            $file  =  Crypt::decrypt($file);
            $device = device::find($file);
            return Response::download(json_decode($device->$type)[$order]);
        }
        if ($type == 'pack') {
            $file  =  Crypt::decrypt($file);
            $packege = packege::find($file);
            $packege =  json_decode($packege->zip);
            return Response::download($packege[0]);
        }
        if ($type == 'up') {
            $file  =  Crypt::decrypt($file);
            $UpdateFile = UpdateFile::find($file);
            return Response::download(json_decode($UpdateFile->path)[$order]);
        }
    }


    private function updateData($price)
    {
        $data = data::first();
        $total = $data->total + $price;
        $count = $data->count + 1;
        $data->update([
            'total' => $total,
            'count' => $count
        ]);
        return $data;
    }


    public function editeUserInfo(Request $request, $id)
    {
        $user = ModelsUser::find($id);
        $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'stor' => 'required|regex:/^[\pL\s]+$/u',
            'city' => 'required|regex:/^[\pL\s]+$/u',
        ]);
        if (!chate::where('user_id', $user->id)->exists()) {
            if (!File::exists('user/' . $user->id )) {
                File::makeDirectory('user/' . $user->id);
            }
            chate::create([
                'user_id' => $user->id
            ]);
        }
        $user->update([
            'name' => $request->name,
            'stor' => $request->stor,
            'city' =>  $request->city,
            'discription' => $request->discription,
        ]);
        return redirect()->back();
    }
    function checkFrind(Request $request)
    {
        $user = ModelsUser::find(session()->get('user'));
        if ($user->frind == 0) {
            if ($request->code == 'atisoo1402'||$request->code == 'atisoo 1402'||$request->code == 'Atisoo1402'||$request->code == 'Atisoo 1402') {
                $user->update([
                    'frind' => 1
                ]);
                return redirect()->back()->with('frind', 1);
            } else {
                return redirect()->back()->with('Nfrind', 1);
            }
        }
        if ($request->nas || $request->ta || $request->fro) {
            $frind = '';
            if ($request->nas) {
                $frind = $frind . ' , ' .  $request->nas;
            }
            if ($request->ta) {
                $frind = $frind . ' , ' .  $request->ta;
            }
            if ($request->fro) {
                $frind = $frind . ' , ' .  $request->fro;
            }
            $user->update([
                'frind' => $frind
            ]);
            return redirect()->back();
        }
    }
    public function editeUserImg(Request $request, $id)
    {
        $user = ModelsUser::find($id);
        $path = $user->image;
        if (!File::exists('user/' . $user->id )) {
            File::makeDirectory('user/' . $user->id);
        }
        if ($request->file('image')) {
            File::delete($path);
            $pic = $request->file('image');
            $picName = rand(1, 999999999) . '.' . $pic->getClientOriginalExtension();
            $pic->move('user/' . $id, $picName);
            $path = 'user/' . $id . '/' . $picName;
            $user->update([
                'image' => $path,
            ]);
        }
        return redirect()->back();
    }
    function changScorDisc()
    {
        $user = ModelsUser::find(session()->get('user'));
        if ($user->score <= 0) {
            return 'scoreErr';
        } else {
            $score = $user->score;
            $discount = $user->discount;
            $nweCount = $discount + $score;
            $user->update([
                'discount' => $nweCount,
                'score' => 0,
            ]);
            return $nweCount;
        }
    }
}
