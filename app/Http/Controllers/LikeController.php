<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Like;

class LikeController extends Controller {

    public function like(Request $request) {

        $snap = $request->get('snap');
        $user = $request->get('user');

        try {
            $like = new Like();

            $like->snap = $snap;
            $like->user = $user;

            $like->like();

            return response(200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function dislike(Request $request) {

        $snap = $request->get('snap');
        $user = $request->get('user');

        try {
            $like = new Like();

            $like->snap = $snap;
            $like->user = $user;

            $like->dislike();

            return response(200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function getLikesCount(Request $request) {

        $snapID = $request->get('id');

        try {
            $like = new Like();

            $likesCount = $like->getLikesCount($snapID);

            return response($likesCount, 200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function showLikeUsers(Request $request) {

        $snapID = $request->get('id');

        try {
            $like = new Like();

            $likeUsers = $like->showLikeUsers($snapID);

            return response($likeUsers, 200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function getLikeDislikeButton(Request $request) {

        $snapID = $request->get('id');

        if(session()->has('user')) {
            $userID = session()->get('user')[0]->id;
        }

        try {
            $like = new Like();

            $result = $like->getLikes($snapID, $userID);

            return response($result, 200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }
}
