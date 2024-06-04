<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

class ForumCommentsController extends Controller
{
    public function createComment(Request $request, Forum $forum){

        $request->validate([
            'content' => 'required'
        ]);

        $comment = new ForumComments;
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->content;

        $forum = Forum::find($request->forum_id);

        $forum->comments()->save($comment);

        return back()->withInfo('Comment Made!');
    }

    // public function createComment(Request $request, Forum $forum){

    //     $request->validate([
    //         'content' => 'required'
    //     ]);

    //     $comment = new ForumComments;
    //     $comment->user_id = Auth::user()->id;
    //     $comment->content = $request->content;

    //     $forum = Forum::find($request->forum_id);

    //     $forum->comments()->save($comment);

    //     return back()->withInfo('Comment Made!');
    // }
}

