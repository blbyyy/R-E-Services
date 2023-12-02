<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Redirect;
use View;
use DB;
use File;
use Auth;


class CommentController extends Controller
{
    public function showcomments($id)
    {
        $comments = DB::table('comments')
        ->join('announcements', 'announcements.id', 'comments.announcement_id')
        ->join('users', 'users.id', 'comments.user_id')
        ->leftJoin('students', function ($join) {
            $join->on('users.id', '=', 'students.user_id')
                ->where('users.role', '=', 'Student');
        })
        ->leftJoin('staff', function ($join) {
            $join->on('users.id', '=', 'staff.user_id')
                ->where('users.role', '=', 'Staff');
        })
        ->leftJoin('faculty', function ($join) {
            $join->on('users.id', '=', 'faculty.user_id')
                ->where('users.role', '=', 'Faculty');
        })
        ->select(
            'comments.content as comment_content',
            'comments.name as commentator',
            'comments.announcement_id',
            'comments.user_id as userid',
            'announcements.title as announcement_title',
            'announcements.content as announcement_content',
            'students.*',
            'staff.*',
            'faculty.*',
            'users.*',
        )
        ->where('announcements.id', $id)
        ->get();
    
    return response()->json($comments);
    
    }

    public function addcomment(Request $request, $id)
    {
        $user = DB::table('users')
        ->select('users.*')
        ->where('id',Auth::id())
        ->first();

        $name = $user->fname . ' ' . $user->mname . ' ' . $user->lname;
    
        $comment = new Comment;
        $comment->name = $name;
        $comment->content = $request->content;
        $comment->announcement_id = $request->announcement_id;
        $comment->user_id =  $user->id;
        $comment->save();

        return response()->json(["comment" => $comment]);

    }
}
