<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Snap {

    public $id;
    public $image;
    public $filter;
    public $text;
    public $status;
    public $user;
    public $timestamps = true;

    public function increaseView($snapID, $ip) {

        $result = DB::table('views')
            ->insert([
                'ip' => $ip,
                'snap' => $snapID
            ]);

        return $result;
    }

    public function getAllHomeSnaps() {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->orderBy('snaps.id', 'desc')
            ->limit(6)
            ->get();

        return $result;
    }

    public function loadMoreAllHomeSnaps($lastID) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->where('snaps.id', '<', $lastID)
            ->orderBy('snaps.id', 'desc')
            ->limit(6)
            ->get();

        return $result;
    }

    public function getPublicHomeSnaps() {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->where('snaps.status', '=', 'public')
            ->orderBy('snaps.id', 'desc')
            ->limit(6)
            ->get();

        return $result;
    }

    public function loadMorePublicHomeSnaps($lastID) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->where('snaps.id', '<', $lastID)
            ->where('snaps.status', '=', 'public')
            ->orderBy('snaps.id', 'desc')
            ->limit(6)
            ->get();

        return $result;
    }

    public function getMostLikedSnaps() {

        $result = DB::Table('snaps')
            ->leftJoin('likes', 'likes.snap', '=', 'snaps.id')
            ->leftJoin('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->leftJoin('filters', 'snaps.filter', '=', 'filters.id')
            ->select(\DB::raw('*, count(likes.snap) as aggregate'), 'snaps.id as snapID')
            ->groupBy('likes.snap')
            ->orderBy('aggregate', 'desc')
            ->limit(3)
            ->get();

        return $result;
    }

    public function getMostCommentedSnaps() {

        $result = DB::Table('snaps')
            ->leftJoin('comments', 'comments.snap', '=', 'snaps.id')
            ->leftJoin('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->leftJoin('filters', 'snaps.filter', '=', 'filters.id')
            ->select(\DB::raw('*, count(comments.snap) as aggregate'), 'snaps.id as snapID')
            ->groupBy('comments.snap')
            ->orderBy('aggregate', 'desc')
            ->limit(3)
            ->get();

        return $result;
    }

    public function getMostViewedSnaps() {

        $result = DB::Table('snaps')
            ->leftJoin('views', 'views.snap', '=', 'snaps.id')
            ->leftJoin('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->leftJoin('filters', 'snaps.filter', '=', 'filters.id')
            ->select(\DB::raw('*, count(views.snap) as aggregate'), 'snaps.id as snapID')
            ->groupBy('views.snap')
            ->orderBy('aggregate', 'desc')
            ->limit(3)
            ->get();

        return $result;
    }

    public function getSearchAuthSnaps($keyword) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->where('snaps.text', 'like', '%'.$keyword.'%')
            ->limit(4)
            ->get();

        return $result;
    }

    public function getSearchSnaps($keyword) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->where('snaps.text', 'like', '%'.$keyword.'%')
            ->where('snaps.status', '=', 'public')
            ->limit(4)
            ->get();

        return $result;
    }

    public function getMySnaps($userID) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->where('snaps.user', '=', $userID)
            ->orderBy('snaps.id', 'desc')
            ->get();

        return $result;
    }

    public function getMySnapsCount($userID) {

        $result = DB::table('snaps')
            ->select('*')
            ->where('user', '=', $userID)
            ->count();

        return $result;
    }

    public function getAllUserSnaps($username) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->join('users', 'snaps.user', '=', 'users.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->where('users.username', '=', $username)
            ->orderBy('snaps.id', 'desc')
            ->get();

        return $result;
    }

    public function getPublicUserSnaps($username) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->join('users', 'snaps.user', '=', 'users.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->where('users.username', '=', $username)
            ->where('snaps.status', '=', 'public')
            ->orderBy('snaps.id', 'desc')
            ->get();

        return $result;
    }

    public function getUserSnapsCount($username) {

        $result = DB::table('snaps')
            ->join('users', 'snaps.user', '=', 'users.id')
            ->select('*')
            ->where('users.username', '=', $username)
            ->count();

        return $result;
    }

    public function addSnap() {

        $result = DB::table('snaps')
            ->insert([
                'image'  => $this->image,
                'filter' => $this->filter,
                'text'   => $this->text,
                'status' => $this->status,
                'user'   => $this->user
            ]);

        return $result;
    }

    public function updateSnap($snapID) {

        $result = DB::table('snaps')
            ->where('id', '=', $snapID)
            ->update([
                'text' => $this->text,
                'status' => $this->status
            ]);

        return $result;
    }

    public function removeSnap() {

        $result = DB::table('snaps')
            ->where('image', '=', $this->image)
            ->delete();

        return $result;
    }

    public function getSingleSnap($snapID) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->join('users', 'snaps.user', '=', 'users.id')
            ->select('*', 'snaps.created_at as snapDate', 'snaps.updated_at as snapNewDate', 'snaps.id as snapID', 'users.id as userID', \DB::raw("(SELECT count(id) FROM views WHERE snap = $snapID) as views"))
            ->where('snaps.id', '=', $snapID)
            ->first();

        return $result;
    }

    public function getViewsCount($snapID) {

        $result = DB::table('views')
            ->select('*')
            ->where('snap', '=', $snapID)
            ->count();

        return $result;
    }

    public function deleteSnapViews($snapId) {

        $result = DB::table('views')
            ->where('snap', '=', $snapId)
            ->delete();

        return $result;
    }

    public function getSnapToDelete($snapID) {

        $result = DB::table('snaps')
            ->select('*')
            ->where('image', '=', $snapID)
            ->first();

        return $result;
    }

    public function getArchiveSnaps($archiveDate) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->join('users', 'snaps.user', '=', 'users.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->where('snaps.created_at', 'like', '%'.$archiveDate.'%')
            ->orderBy('snaps.id', 'desc')
            ->limit(6)
            ->get();

        return $result;
    }

    public function loadMoreArchiveSnaps($lastID, $archiveDate) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->select('*', 'snap_images.id as snapId', 'snaps.id as snapID')
            ->where('snaps.created_at', 'like', '%'.$archiveDate.'%')
            ->where('snaps.id', '<', $lastID)
            ->orderBy('snaps.id', 'desc')
            ->limit(6)
            ->get();

        return $result;
    }

    public function getPublicSnap($snapID) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->join('users', 'snaps.user', '=', 'users.id')
            ->select('*', 'snaps.created_at as snapDate', 'snaps.updated_at as snapNewDate', 'snaps.id as snapID', 'users.id as userID', \DB::raw("(SELECT count(id) FROM views WHERE snap = $snapID) as views"))
            ->where('snaps.id', '=', $snapID)
            ->where('snaps.status', '=', 'public')
            ->first();

        return $result;
    }

    public function getSnaps() {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->join('filters', 'snaps.filter', '=', 'filters.id')
            ->join('users', 'snaps.user', '=', 'users.id')
            ->select('*', 'snaps.id as snapID', 'snaps.created_at as created', 'snaps.updated_at as updated', 'filters.name as filter', 'users.username as user')
            ->orderBy('snaps.id')
            ->get();

        return $result;
    }

    public function getSnapData($id) {

        $result = DB::table('snaps')
            ->join('snap_images', 'snaps.image', '=', 'snap_images.id')
            ->select('snaps.*', 'snap_images.thumb_path as image', 'snap_images.id as imageID')
            ->where('snaps.id', '=', $id)
            ->get();

        return $result;
    }

    public function updateSnapInfo($snapID) {

        $result = DB::table('snaps')
            ->where('id', '=', $snapID)
            ->update([
                'user' => $this->user,
                'filter' => $this->filter,
                'status' => $this->status,
                'text' => $this->text
            ]);

        return $result;
    }

    public function getImageToDelete($snapID) {

        $result = DB::table('snaps')
            ->select('image')
            ->where('id', '=', $snapID)
            ->first();

        return $result;
    }

    public function deleteSnap() {

        $result = DB::table('snaps')
            ->where('id', '=', $this->id)
            ->delete();

        return $result;
    }

    public function deleteView($snapID) {

        $result = DB::table('views')
            ->where('snap', '=', $snapID)
            ->orderBy('id', 'DESC')
            ->take(1)
            ->delete();

        return $result;
    }
}
