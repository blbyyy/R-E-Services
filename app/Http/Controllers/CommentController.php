<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Redirect;
use View;
use DB;
use File;
use Auth;

use App\Models\User;


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

    //MOBILE START
    public function mobileshowcomments($id)
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

    public function mobileaddcomment(Request $request, $id)
{
    // Check if the user is authenticated
    if (!Auth::check()) {
        return response()->json(["error" => "User not authenticated"], 401);
    }

    // Fetch user information
    $user = DB::table('users')
        ->select('users.*')
        ->where('id', Auth::id())
        ->first();

    // Check if user information is available
    if (!$user) {
        return response()->json(["error" => "User not found"], 404);
    }

    // Ensure required fields are present in the request
    $content = $request->input('content');
    $announcement_id = $request->input('announcement_id');

    if (empty($content) || empty($announcement_id)) {
        return response()->json(["error" => "Content or announcement ID missing"], 400);
    }

    // Create a formatted name using user's first, middle, and last name
    $name = $user->fname . ' ' . $user->mname . ' ' . $user->lname;

    // Create a new Comment instance
    $comment = new Comment;
    $comment->name = $name;
    $comment->content = $content;
    $comment->announcement_id = $announcement_id;
    $comment->user_id = $request->user_id;
    $comment->save();

    // Include user information in the response
    $commentWithUser = [
        "comment" => $comment,
        "user" => [
            "id" => $user->id,
            "name" => $name,
            // Add other user information if needed
        ],
    ];

    return response()->json($commentWithUser);
}

    //MOBILE END
}
