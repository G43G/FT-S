<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model {

    public $timestamps = true;

    protected $table = 'threads';

    public function messages() {
        return $this->hasMany('App\Models\ThreadMessage');
    }

    public function createThread($thread_from, $thread_to, $viewer) {

        $result = DB::table('threads')
            ->insertGetId([
                'thread_from' => $thread_from,
                'thread_to' => $thread_to,
                'viewer' => $viewer
            ]);

        return $result;
    }

    public function getMyThreads($username) {

        $result = DB::table('threads')
            ->select('*')
            ->where('thread_from', '=', $username)
            ->orWhere('thread_to', '=', $username)
            ->get();

        return $result;
    }

    public function getThisThread($thread_from, $thread_to) {

        $result = DB::table('threads')
            ->select('*')
            ->where([
                ['thread_from', '=', $thread_from],
                ['thread_to', '=', $thread_to]
            ])
            ->orWhere([
                ['thread_from', '=', $thread_to],
                ['thread_to', '=', $thread_from]
            ])
            ->first();

        return $result;
    }

    public function getThreadToDelete($threadID) {

        $result = DB::table('threads')
            ->select('*')
            ->where('id', '=', $threadID)
            ->first();

        return $result;
    }

    public function deleteMyThread($threadID, $newViewer) {

        $result = DB::table('threads')
            ->where('id', '=', $threadID)
            ->update(['viewer' => $newViewer]);

        return $result;
    }

    public function deleteThread($threadID) {

        $result = DB::table('threads')
            ->where('id', '=', $threadID)
            ->delete();

        return $result;
    }

    public function updateThread($thisThreadID, $viewer) {

        $result = DB::table('threads')
            ->where('id', '=', $thisThreadID)
            ->update(['viewer' => $viewer]);

        return $result;
    }

    public function getThreadToUpdate($threadID) {

        $result = DB::table('threads')
            ->select('*')
            ->where('id', '=', $threadID)
            ->first();

        return $result;
    }
}