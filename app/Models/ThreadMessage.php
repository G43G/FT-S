<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ThreadMessage extends Model {

    public $timestamps = true;

    protected $table = 'thread_messages';

    public function threads() {
        return $this->belongsTo('App\Models\Thread');
    }

    public function sendMessage($text, $threadID, $thread_from) {

        $result = DB::table('thread_messages')
            ->insert([
                'text' => $text,
                'thread_id' => $threadID,
                'sender' => $thread_from
            ]);

        return $result;
    }

    public function deleteThreadMessages($threadID) {

        $result = DB::table('thread_messages')
            ->where('thread_id', '=', $threadID)
            ->delete();

        return $result;
    }

    public function getMyThreadMessages($username) {

        $result = DB::table('thread_messages')
            ->select('*')
            ->where('sender', '!=', $username)
            ->where('status', '=', 'no')
            ->get();

        return $result;
    }
}