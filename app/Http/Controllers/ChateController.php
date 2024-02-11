<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\chate;
use App\Models\messegeChat;
use App\Models\onlin;
use App\Models\readyMessege;
use App\Models\user as ModelsUser;
use Carbon\Carbon;
use Ghasedak\GhasedakApi;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ChateController extends Controller
{
    private function convertLinksToHtml($text)
    {
        return str::of($text)->replaceMatches('/(?<!href=\")(https?:\/\/[^\s<]+[^<.,:;"\')\]])(?![^<>]*>)/i', '<a target="_blank" class="link-in-chat" href="$1">$1</a>');
    }
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
            if (!File::exists('user/' . $id)) {
                File::makeDirectory('user/' . $id);
            }
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
        $valid = Validator::make($request->all(), [
            'text' => 'max:2000',
        ]);
        $text = $this->convertLinksToHtml($request->text);
        if ($valid->fails()) {
            return 3;
        }
        $valid = Validator::make($request->all(), [
            'file' => 'max:300000',
        ]);
        if ($valid->fails()) {
            return 4;
        }
        $user = ModelsUser::find(session()->get('user'));
        $file = $request->file('file');
        if (is_null($file) == 0) {
            $ext = $this->checkExtention($file->getClientOriginalExtension());
            $fileName = rand(1, 999999999) . '.' . $file->getClientOriginalExtension();
            $path = 'user/' . $user->id . '/' . $fileName;
            $file->move('user/' . $user->id, $fileName);
            $replyText = messegeChat::find($request->reply);
            if ($ext == 'p') {
                $masssege = messegeChat::create([
                    'text' => $text,
                    'user_id' => $user->id,
                    'chate_id' => $request->chat_id,
                    'image' => $path,
                    'reply' => $request->reply
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chat_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'pic', 'path' => $path, 'text' => $text, 'masssege' => $masssege, 'user' => $user, 'replyText' => $replyText]);
            } else if ($ext == 'f') {
                $masssege = messegeChat::create([
                    'text' => $text,
                    'user_id' => $user->id,
                    'chate_id' => $request->chat_id,
                    'file' => $path,
                    'reply' => $request->reply
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chat_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'file', 'path' => $path, 'text' => $text, 'masssege' => $masssege, 'user' => $user, 'replyText' => $replyText]);
            } else {
                return 0;
            }
        } else {
            if ($request->text != '') {
                $replyText = messegeChat::find($request->reply);
                $masssege = messegeChat::create([
                    'text' => $text,
                    'user_id' => $user->id,
                    'chate_id' => $request->chat_id,
                    'reply' => $request->reply
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chat_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'text', 'text' => $text, 'masssege' => $masssege, 'user' => $user, 'replyText' => $replyText]);
            }
        }
    }
    public function chatList()
    {
        $chats = chate::orderBy('order', 'desc')->paginate(500);
        return view('admin.chat.chatlist', ['chats' => $chats, 'status' => 'show']);
    }
    public function chatlistSearch(Request $request)
    {
        $text = $request->text;
        $messeges = messegeChat::where('text', 'LIKE', "%$text%")->paginate(500);
        $chats = [];
        foreach ($messeges as $key) {
            $caht = chate::find($key->chate_id);
            $caht->setAttribute('text', $key->text);
            $caht->setAttribute('goTo', $key->id);
            array_push($chats, $caht);
        }
        return view('admin.chat.chatlist', ['chats' => $chats, 'status' => 'search']);
    }
    public function chatAdmin($chate_id)
    {
        $readyMessege = readyMessege::all();
        $chate = chate::find($chate_id);
        $user = User::find($chate->user_id);
        $messegs = messegeChat::orderBy('id', 'desc')->where('chate_id', $chate->id)->take(10000)->get();
        $online = onlin::find(1);
        $time = $online->time;
        return view('admin.chat.chat', ['messegs' => $messegs, 'user' => $user, '$item->user_id', 'chate_id' => $chate_id, 'readyMessege' => $readyMessege, 'time' => $time]);
    }
    public function reciveDataAdmin(Request $request)
    {
        $text = $this->convertLinksToHtml($request->text);
        $file = $request->file('file');
        if (is_null($file) == 0) {
            $ext = $this->checkExtention($file->getClientOriginalExtension());
            $fileName = rand(1, 999999999) . '.' . $file->getClientOriginalExtension();
            $path = 'user/' . 'maneger' . '/' . $fileName;
            $file->move('user/' . 'maneger', $fileName);
            $replyText = messegeChat::find($request->reply);
            if ($ext == 'p') {
                $masssege = messegeChat::create([
                    'text' => $text,
                    'user_id' => 0,
                    'chate_id' => $request->chate_id,
                    'image' => $path,
                    'reply' => $request->reply,
                    'admin_id' => session()->get('admin')
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chate_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'pic', 'path' => $path, 'text' =>$text, 'masssege' => $masssege, 'replyText' => $replyText]);
            } else if ($ext == 'f') {
                $masssege = messegeChat::create([
                    'text' => $text,
                    'user_id' => 0,
                    'chate_id' => $request->chate_id,
                    'file' => $path,
                    'reply' => $request->reply,
                    'admin_id' => session()->get('admin')
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chate_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'file', 'path' => $path, 'text' => $text, 'masssege' => $masssege, 'replyText' => $replyText]);
            } else {
                return 0;
            }
        } else {
            if ($request->text != '') {
                $replyText = messegeChat::find($request->reply);
                $masssege = messegeChat::create([
                    'text' => $text,
                    'user_id' => 0,
                    'chate_id' => $request->chate_id,
                    'reply' => $request->reply,
                    'admin_id' => session()->get('admin')
                ]);
                $maxValue = chate::max('order');
                chate::find($request->chate_id)->update([
                    'order' => $maxValue + 1,
                ]);
                return json_encode(['type' => 'text', 'text' => $text, 'masssege' => $masssege, 'replyText' => $replyText]);
            }
        }
    }
    public function checkSendChat(Request $request)
    {
        $chatId = chate::where('user_id', $request->user)->first()->id;
        $lastMssege = messegeChat::orderBy('id', 'desc')->where('chate_id', $chatId)->first()->id;
        if ($request->id < $lastMssege) {
            $messege = messegeChat::find($lastMssege);
            $updatedAt = Carbon::parse($messege->updated_at)->format('Y-m-d H:i:s');
            $messege->setAttribute('updated_at', $updatedAt);
            $messege->save();
            return $messege;
        } else {
            return 0;
        }
    }
    public function chateOther($row, $id)
    {
        $messegs = messegeChat::orderBy('id', 'desc')->where('chate_id', $id)->skip($row * 250)->take(250)->get();
        return $messegs;
    }
    public function lastSeenAdmin($last, $id)
    {
        chate::find($id)->update([
            'see_admin' => $last,
        ]);
    }
    public function lastSeenUser($last, $id)
    {
        chate::find($id)->update([
            'see_user' => $last,
        ]);
    }
    public function checkSeeAdmin($last, $id)
    {
        $chat = chate::find($id);
        if ($chat->see_admin == $last) {
            return 1;
        } else {
            return 0;
        }
    }
    public function checkSeeUser($last, $id)
    {
        $chat = chate::find($id);
        if ($chat->see_user == $last) {
            return 1;
        } else {
            return 0;
        }
    }
    public function sendUserAudio(Request $request)
    {
        $user = ModelsUser::find(session()->get('user'));
        $file = $request->file('file');
        $valid = Validator::make($request->all(), [
            'file' => 'max:100000',
        ]);
        if ($valid->fails()) {
            return 4;
        }
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
                'voice' => $path,
                'admin_id' => session()->get('admin')
            ]);
            $maxValue = chate::max('order');
            chate::find($request->chat_id)->update([
                'order' => $maxValue + 1,
            ]);
        }
    }
    public function sendSmsNow($id)
    {
        $user = ModelsUser::find($id);
        $api = new GhasedakApi('ff35f8690aa652194bbcd5cbad763622b0638f4af8059d9e1fb749969dc3fbda');
        $api->Verify(
            $user->phon,
            'readyUser',
            $user->phon,
        );
        return redirect()->back();
    }
    public function readyMessegeV()
    {
        $list = readyMessege::all();
        return view('admin.raedyMessege', ['list' => $list]);
    }
    public function addReadyMessege(Request $request)
    {
        readyMessege::create([
            'text' => $request->text
        ]);
        return redirect()->back();
    }
    public function readyMessegeDelete($id)
    {
        readyMessege::find($id)->delete();
        return redirect()->back();
    }
    public function deletMessUser(Request $request)
    {
        $messege = messegeChat::where('id', $request->id)->where('user_id', '!=', 0)->first();
        $messege->update([
            'hide' => 1
        ]);
        return 1;
    }
    public function deletMessAdmin(Request $request)
    {
        $admin = admin::find(session()->get('admin'));
        $messege = messegeChat::where('id', $request->id)->where('user_id', '=', 0)->first();
        if ($messege->admin_id != $admin->id) {
            return 2;
        }
        if ($admin->level == 1) {
            $messege->delete();
        } else {
            $messege->update([
                'hide' => 1
            ]);
        }
        return 1;
    }
}
