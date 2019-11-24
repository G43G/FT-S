<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class UserImage {

    public $id;
    public $path;
    public $thumb_path;
    public $timestamps = true;

    public function uploadImage() {
        $result = DB::table('user_images')
            ->insertGetId([
                'path'       => $this->path,
                'thumb_path' => $this->thumb_path
            ]);

        return $result;
    }

    public function deleteImage() {
        $result = DB::table('user_images')
            ->where('id', '=', $this->id)
            ->delete();

        return $result;
    }

    public function get() {
        $result = DB::table('user_images')
            ->select('*')
            ->where('id', '=', $this->id)
            ->first();

        return $result;
    }
}