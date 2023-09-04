<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\shop;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'text' => 'required',
            'device' => 'required',
            'by' => 'required'
        ]);
        if ($valid->fails()) {
            return redirect()->back();
        } else {
            $user = user::find(session()->get('user'));
            $discount = $user->discount +5;
            $user->update([
                'discount'=>$discount
            ]);
            Comment::create([
                'text' => $request->text,
                'device_id' => $request->device,
                'user_id' => session()->get('user'),
                'by_id' => $request->by
            ]);
            return redirect()->back()->with('addComment',1);
        }
    }
    public function commentList()
    {
        $comments = Comment::orderBy('created_at')->paginate(250);
        return view('admin.comment.show',['comments'=>$comments]);
    }
    public function commentUpdateShow($id)
    {
        $comment  = Comment::find($id);
        return view('admin.comment.update',['comment'=>$comment]);
    }
    public function commentDelete($id)
    {
        Comment::find($id)->delete();
        return redirect()->back();
    }
    public function commentUpdate($id ,Request $request)
    {
        Comment::find($id)->update([
            'text'=>$request->text
        ]);
        return redirect()->route('commentList');
    }
}
