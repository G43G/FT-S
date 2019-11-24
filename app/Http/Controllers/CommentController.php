<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;

class CommentController extends Controller {

    public function comment(Request $request) {

        $text = $request->get('text');
        $snap = $request->get('snap');
        $user = $request->get('user');

        try {
            $comment = new Comment();

            $comment->text = $text;
            $comment->snap = $snap;
            $comment->user = $user;

            $comment->comment();

            return response(200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function updateComment($snapID, $commentID, Request $request) {

        $text = $request->get('text');

        try {
            $comment = new Comment();

            $comment->text = $text;

            $comment->updateComment($snapID, $commentID);

            return response(200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function removeComment($snapID, $commentID) {

        try {
            $comment = new Comment();

            $comment->removeComment($snapID, $commentID);

            return response(200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function getComments($snapID) {

        try {
            $comment = new Comment();

            $comments = $comment->getComments($snapID);

            return response($comments, 200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function getCommentsCount(Request $request) {

        $snapID = $request->get('id');

        try {
            $comment = new Comment();

            $commentsCount = $comment->getCommentsCount($snapID);

            return response($commentsCount, 200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function activateEditComment(Request $request) {

        $id = intval($request->get('id'));

        try {
            $comment = new Comment();

            $data = $comment->getCommentData($id);

            return response($data, 200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function editComment($commentID, Request $request) {

        $text = $request->get('text');

        try {
            $comment = new Comment();

            $comment->text = $text;

            $comment->editComment($commentID);

            return response(200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function deleteComment($commentID) {

        try {
            $comment = new Comment();

            $comment->deleteComment($commentID);

            return redirect()->back();
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }
}
