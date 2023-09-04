<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\chate;
use App\Models\messegeChat;
use App\Models\user as ModelsUser;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ChateController extends Controller
{
    public function completeInfo(Request $request, $id)
    {
        $user = ModelsUser::find($id);
        $valid = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'pic' => 'required|image',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->with('completeError', 1);
        } else {
            File::makeDirectory('user/' . $id);
            $pic = $request->file('pic');
            $picName = rand(1, 999999999) . '.' . $pic->getClientOriginalExtension();
            $pic->move('user/' . $id, $picName);
            $path = 'user/' . $id . '/' . $picName;
            $user->update([
                'name' => $request->name,
                'image' => $path,
            ]);
            chate::create([
                'user_id' => $user->id
            ]);
        }
        return redirect('/chate');
    }

    private function checkExtention($ext)
    {
        $image = ['png', 'PNG', 'GIF', 'gif', 'TIFF', 'tiff', 'JPEG', 'jpeg', 'JPG', 'jpg'];
        $file = ['xml', 'XML', 'bin', 'BIN', 'hex', "HEX"];
        // $voice = ['mp4','MP4','MOV','mov','WMV','wmv','WMV'];
        if (in_array($ext, $image)) {
            return 'p';
        } else if (in_array($ext, $file)) {
            return 'f';
        } else {
            return 0;
        }
    }
    public function reciveData(Request $request)
    {
        $user = ModelsUser::find(session()->get('user'));
        $file = $request->file('file');
        if (is_null($file) == 0) {
            $ext = $this->checkExtention($file->getClientOriginalExtension());
            $fileName = rand(1, 999999999) . '.' . $file->getClientOriginalExtension();
            $path = 'user/' . $user->id . '/' . $fileName;
            $file->move('user/' . $user->id, $fileName);
            if ($ext == 'p') {
                $masssege = messegeChat::create([
                    'text' => $request->text,
                    'user_id' => $user->id,
                    'chate_id' => $request->chat_id,
                    'image' => $path
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chat_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'pic', 'path' => $path, 'text' => $request->text, 'masssege' => $masssege, 'user' => $user]);
            } else if ($ext == 'f') {
                $masssege = messegeChat::create([
                    'text' => $request->text,
                    'user_id' => $user->id,
                    'chate_id' => $request->chat_id,
                    'file' => $path
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chat_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'file', 'path' => $path, 'text' => $request->text, 'masssege' => $masssege, 'user' => $user]);
            } else {
                return 0;
            }
        } else {
            if ($request->text != '') {
                $masssege = messegeChat::create([
                    'text' => $request->text,
                    'user_id' => $user->id,
                    'chate_id' => $request->chat_id,
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chat_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'text', 'text' => $request->text, 'masssege' => $masssege, 'user' => $user]);
            }
        }
    }
    public function chatList()
    {
        $chats = chate::orderBy('order', 'desc')->paginate(1000);
        return view('admin.chat.chatlist', ['chats' => $chats]);
    }
    public function chatAdmin($chate_id)
    {
        $chate = chate::find($chate_id);
        $chate->update([
            'see_admin' => 0,
        ]);
        $user = User::find($chate->user_id);
        $messegs = messegeChat::orderBy('id', 'desc')->where('chate_id', $chate->id)->take(250)->get();
        
        return view('admin.chat.chat', ['messegs' => $messegs, 'user' => $user, '$item->user_id', 'chate_id' => $chate_id]);
    }
    public function reciveDataAdmin(Request $request)
    {
        $file = $request->file('file');
        if (is_null($file) == 0) {
            $ext = $this->checkExtention($file->getClientOriginalExtension());
            $fileName = rand(1, 999999999) . '.' . $file->getClientOriginalExtension();
            $path = 'user/' . 'maneger'. '/' . $fileName;
            $file->move('user/' . 'maneger' , $fileName);
            if ($ext == 'p') {
                $masssege = messegeChat::create([
                    'text' => $request->text,
                    'user_id' => 0,
                    'chate_id' => $request->chate_id,
                    'image' => $path
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chate_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'pic', 'path' => $path, 'text' => $request->text, 'masssege' => $masssege]);
            } else if ($ext == 'f') {
                $masssege = messegeChat::create([
                    'text' => $request->text,
                    'user_id' => 0,
                    'chate_id' => $request->chate_id,
                    'file' => $path
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chate_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'file', 'path' => $path, 'text' => $request->text, 'masssege' => $masssege]);
            } else {
                return 0;
            }
        } else {
            if ($request->text != '') {
                $masssege = messegeChat::create([
                    'text' => $request->text,
                    'user_id' => 0,
                    'chate_id' => $request->chate_id,
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chate_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'text', 'text' => $request->text, 'masssege' => $masssege]);
            }
        }
    }
    public function checkSendChat(Request $request)
    {
        $chatId = chate::where('user_id', $request->user)->first()->id;
        $lastMssege = messegeChat::orderBy('id', 'desc')->where('chate_id', $chatId)->first()->id;
        if ($request->id < $lastMssege) {
            return messegeChat::find($lastMssege);
        } else {
            return 0;
        }
    }
    public function chateOther($row,$id)
    {
        $messegs = messegeChat::orderBy('id', 'desc')->where('chate_id',$id)->skip($row * 250)->take(250)->get();
        return $messegs;
    }
    public function lastSeenAdmin($last, $id)
    {
        $maxValue = chate::max('order');
        chate::find($id)->update([
            'see_admin' => $last,
            'order' => $maxValue + 1,
        ]);
    }
    public function sendUserAudio(Request $request)
    {
        $user = ModelsUser::find(session()->get('user'));
        $file = $request->file('file');
        if (is_null($file) == 0) {
            $fileName = rand(1, 999999999) . '.' . $file->getClientOriginalExtension();
            $path = 'user/' . $user->id . '/' . $fileName;
            $file->move('user/' . $user->id, $fileName);
            $masssege = messegeChat::create([
                'user_id' => $user->id,
                'chate_id' => $request->chat_id,
                'voice' => $path
            ]);
            $maxValue = chate::max('order');
            chate::find($request->chat_id)->update([
                'order' => $maxValue + 1,
            ]);
        }
    }
    public function sendAdminAudio(Request $request)
    {
        $file = $request->file('file');
        if (is_null($file) == 0) {
            $fileName = rand(1, 999999999) . '.' . $file->getClientOriginalExtension();
            $path = 'user/' . 'maneger' . '/' . $fileName;
            $file->move('user/' . 'maneger', $fileName);
            $masssege = messegeChat::create([
                'user_id' => 0,
                'chate_id' => $request->chat_id,
                'voice' => $path
            ]);
            $maxValue = chate::max('order');
            chate::find($request->chat_id)->update([
                'order' => $maxValue + 1,
            ]);
        }
    }
}