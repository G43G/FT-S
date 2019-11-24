<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;


class SnapImage {

    public $id;
    public $path;
    public $thumb_path;
    public $timestamps = true;

    public function addSnap() {

        $result = DB::table('snap_images')
            ->insertGetId([
                'path'       => $this->path,
                'thumb_path' => $this->thumb_path
            ]);

        return $result;
    }

    public function get() {

        $result = DB::table('snap_images')
            ->select('*')
            ->where('id', '=', $this->id)
            ->first();

        return $result;
    }

    public function deleteSnap() {

        $result = DB::table('snap_images')
            ->where('id', '=', $this->id)
            ->delete();

        return $result;
    }

    public function updateSnap($imageID) {

        $result = DB::table('snap_images')
            ->where('id', '=', $imageID)
            ->update([
                'path'       => $this->path,
                'thumb_path' => $this->thumb_path
            ]);

        return $result;
    }
}