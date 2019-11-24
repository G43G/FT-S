<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Like {

    public $snap;
    public $user;

    public function like() {

        $result = DB::table('likes')
            ->insert([
                'snap' => $this->snap,
                'user' => $this->user
            ]);

        return $result;
    }

    public function dislike() {

        $result = DB::table('likes')
            ->where([
                'snap' => $this->snap,
                'user' => $this->user
            ])
            ->delete();

        return $result;
    }

    public function getLikes($snapID, $userID) {

        $result = DB::table('likes')
            ->select('*')
            ->where([
                'snap' => $snapID,
                'user' => $userID
            ])
            ->get();

        return $result;
    }

    public function getLikesCount($snapID) {

        $result = DB::table('likes')
            ->select('*')
            ->where('snap', '=', $snapID)
            ->count();

        return $result;
    }

    public function showLikeUsers($snapID) {

        $result = DB::table('likes')
            ->join('users', 'likes.user', '=', 'users.id')
            ->select('*')
            ->where('likes.snap', '=', $snapID)
            ->get();

        return $result;
    }

    public function deleteSnapLikes($snapId) {

        $result = DB::table('likes')
            ->where('snap', '=', $snapId)
            ->delete();

        return $result;
    }

    public function deleteUserLikes($userID) {

        $result = DB::table('likes')
            ->where('user', '=', $userID)
            ->delete();

        return $result;
    }
}