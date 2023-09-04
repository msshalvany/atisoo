<?php

namespace App\Http\Controllers;

use App\Models\byed;
use App\Models\data;
use App\Models\device;
use App\Models\shop;
use App\Models\user as ModelsUser;
use Ghasedak\GhasedakApi;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Evryn\LaravelToman\CallbackRequest;
use Evryn\LaravelToman\Facades\Toman;
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
            $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
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
        $valid = Validator::make($request->all(), [
            'password' => 'required|min:4'
        ]);
        if ($valid->fails()) {
            return 0;
        } else {
            ModelsUser::create([
                'password' => $request->password,
                'name' => 'نامشخص',
                'phon' => session()->get('phon'),
                'stor' => 'نامشخص',
                'city' => 'نامشخص',
                'discription' => 'نامشخص',
                'discount' => '0',
            ]);
            return 1;
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
                if ($user->phon == $request->phon && $user->password == $request->password) {
                    session(['user' => $user->id]);
                    return redirect('/');
                }
            }
            return redirect()->back()->with('erroreLogin', 'null');
        }
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->back();
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
            $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
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

    public function deleteFlash($id)
    {
        shop::find($id)->delete();
        return redirect()->back();
    }

    public function byFlash(Request $request)
    {
        $shop = shop::where('userId', session()->get('user'))->get();
        $user = ModelsUser::find(session()->get('user'));
        $count = 0;
        foreach ($shop as $key) {
            if ($key->iprom == 'true') {
                $price = device::find($key->deviceId)->ipromPrice;
                $count += $price;
            }
            if ($key->flash == 'true') {
                $price = device::find($key->deviceId)->flashPrice;
                $count += $price;
            }
        }
        $userPhon = User::find(session()->get('user'))->phon;
        session(['count' => $count, 'userPhon' => $userPhon]);
        if ($request->discount == 'on') {
            if ($user->discount >= $count) {
                $discount = $user->discount;
                $discount = $discount - $count;
                $user->update([
                    'discount' => $discount
                ]);
                $user = session()->get('user');
                $devices = shop::where('userId', $user)->get();
                for ($i = 0; count($devices) > $i; $i++) {
                    byed::create([
                        'flash' => $devices[$i]->flash,
                        'iprom' => $devices[$i]->iprom,
                        'userId' => $devices[$i]->userId,
                        'deviceId' => $devices[$i]->deviceId,
                    ]);
                    $this->updateData(session()->get('count'));
                    shop::find($devices[$i]->id)->delete();
                }
                return redirect()->back()->with('pay', 'successful');
            } else {
                $count = $count - $user->discount;
                $user->update([
                    'discount' => 0
                ]);
            }
        }
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

    public function downloadeFile($file, $order, $type)
    {
        $device = device::find($file);
        return Response::download(json_decode($device->$type)[$order]);
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

    public function checkPay(CallbackRequest $request)
    {
                $payment = $request->amount(session()->get('count')*1000)->verify();
        if ($payment->successful()) {
            $user = session()->get('user');
            $devices = shop::where('userId', $user)->get();
            for ($i = 0; count($devices) > $i; $i++) {
                byed::create([
                    'flash' => $devices[$i]->flash,
                    'iprom' => $devices[$i]->iprom,
                    'userId' => $devices[$i]->userId,
                    'deviceId' => $devices[$i]->deviceId,
                ]);
                $targrt = device::find($devices[$i]->deviceId);
                $this->updateData(session()->get('count'));
                $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
                $api->Verify(
                    '09131572450',
                    'atisooSendForUser',
                    session()->get('count') * 1000,
                    session()->get('userPhon'),
                    $targrt->id2,
                    $targrt->labale
                );
                shop::find($devices[$i]->id)->delete();
            }
            return redirect('/panel')->with('pay', 'successful');
        }

        if ($payment->alreadyVerified()) {
            return 'پرداخت قبلاً یه بار بررسی و تایید شده بود. شناسه ارجاع همچنان در دسترسه.';
        }

        if ($payment->failed()) {
            return redirect('/panel')->with('pay', 'erroe');
        }
    }
}
