<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Comment {

    public $id;
    public $text;
    public $snap;
    public $user;
    public $timestamps = true;

    public function getComments($snapID) {

        $result = DB::table('comments')
            ->join('users', 'comments.user', '=', 'users.id')
            ->join('user_images', 'users.image', '=', 'user_images.id')
            ->select('*', 'comments.created_at as commentDate', 'comments.updated_at as commentNewDate', 'comments.id as commentID')
            ->where('comments.snap', '=', $snapID)
            ->get();

        return $result;
    }

    public function getMyCommentsCount($userID) {

        $result = DB::table('comments')
            ->select('*')
            ->where('user', '=', $userID)
            ->count();

        return $result;
    }

    public function getUserCommentsCount($username) {

        $result = DB::table('comments')
            ->join('users', 'comments.user', '=', 'users.id')
            ->select('*')
            ->where('users.username', '=', $username)
            ->count();

        return $result;
    }

    public function comment() {

        $result = DB::table('comments')
            ->insert([
                'text' => $this->text,
                'snap' => $this->snap,
                'user' => $this->user,
            ]);

        return $result;
    }

    public function updateComment($snapID, $commentID) {

        $result = DB::table('comments')
            ->where([
                'id' => $commentID,
                'snap' => $snapID
            ])
            ->update(['text' => $this->text]);

        return $result;
    }

    public function getCommentsCount($snapID) {

        $result = DB::table('comments')
            ->select('*')
            ->where('snap', '=', $snapID)
            ->count();

        return $result;
    }

    public function removeComment($snapID, $commentID) {

        $result = DB::table('comments')
            ->where([
                'id' => $commentID,
                'snap' => $snapID
            ])
            ->delete();

        return $result;
    }

    public function deleteSnapComments($snapId) {

        $result = DB::table('comments')
            ->where('snap', '=', $snapId)
            ->delete();

        return $result;
    }

    public function deleteUserComments($userID) {

        $result = DB::table('comments')
            ->where('user', '=', $userID)
            ->delete();

        return $result;
    }

    public function getAdminComments() {

        $result = DB::table('comments')
            ->join('users', 'comments.user', '=', 'users.id')
            ->select('*', 'users.username as user', 'comments.id as commentID', 'comments.created_at as created', 'comments.updated_at as updated')
            ->orderBy('users.id')
            ->get();

        return $result;
    }

    public function getCommentData($id) {

        $result = DB::table('comments')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return $result;
    }

    public function editComment($id) {

        $result = DB::table('comments')
            ->where('id', '=', $id)
            ->update(['text'  => $this->text]);

        return $result;
    }

    public function deleteComment($id) {

        $result = DB::table('comments')
            ->where('id', '=', $id)
            ->delete();

        return $result;
    }
}
