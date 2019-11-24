<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class User {

    public $id;
    public $email;
    public $username;
    public $password;
    public $name;
    public $surname;
    public $birthday;
    public $city;
    public $bio;
    public $role;
    public $image;
    public $timestamps = true;

    public function resetPassword() {

        $result = DB::table('users')
            ->where('email', '=', $this->email)
            ->update([
                'password' => $this->password
            ]);

        return $result;
    }

    public function getUserToSend($thread_to) {

        $result = DB::table('users')
            ->select('*')
            ->where('username', '=', $thread_to)
            ->orWhere('email', '=', $thread_to)
            ->first();

        return $result;
    }

    public function getRecentUsers() {

        $result = DB::table('users')
            ->join('user_images', 'user_images.id', '=', 'users.image')
            ->select('*', 'users.id as userID', 'user_images.id as imageId', 'user_images.thumb_path as image')
            ->orderBy('users.id', 'asc')
            ->limit(5)
            ->get();

        return $result;
    }

    public function getSearchUsers($keyword) {

        $result = DB::table('users')
            ->join('user_images', 'user_images.id', '=', 'users.image')
            ->select('*', 'user_images.id as imageId', 'user_images.thumb_path as image')
            ->where('users.username', 'like', '%'.$keyword.'%')
            ->orWhere('users.name', 'like', '%'.$keyword.'%')
            ->orWhere('users.surname', 'like', '%'.$keyword.'%')
            ->orWhere('users.email', 'like', '%'.$keyword.'%')
            ->limit(4)
            ->get();

        return $result;
    }

    public function loginUser() {

        $result = DB::table('users')
            ->join('roles', 'roles.id', '=', 'users.role')
            ->select('users.*', 'roles.name as role')
            ->where([
                'username' => $this->username,
                'password' => md5($this->password)
            ])
            ->first();

        return $result;
    }

    public function registerUser() {

        $result = DB::table('users')
            ->insert([
                'email'    => $this->email,
                'username' => $this->username,
                'password' => $this->password,
                'name'     => $this->name,
                'surname'  => $this->surname,
                'role'     => $this->role,
                'image'    => $this->image
            ]);

        return $result;
    }

    public function getUserPass() {

        $result = DB::table('users')
            ->select('*')
            ->where('password', '=', $this->password)
            ->first();

        return $result;
    }

    public function getLoggedUser($id) {

        $result = DB::table('users')
            ->join('user_images', 'user_images.id', '=', 'users.image')
            ->select('*', 'user_images.id as imageId')
            ->where('users.id', '=', $id)
            ->first();

        return $result;
    }

    public function editProfile() {

        $result = DB::table('users')
            ->where('id', '=', $this->id)
            ->update([
                'email'    => $this->email,
                'username' => $this->username,
                'password' => $this->password,
                'name'     => $this->name,
                'surname'  => $this->surname,
                'birthday' => $this->birthday,
                'city'     => $this->city,
                'bio'      => $this->bio
            ]);

        return $result;
    }

    public function uploadImage() {

        $result = DB::table('users')
            ->where('id', $this->id)
            ->update(['image' => $this->image]);

        return $result;
    }

    public function getRequestedUser($username) {

        $result = DB::table('users')
            ->join('user_images', 'user_images.id', '=', 'users.image')
            ->select('*', 'user_images.id as imageId')
            ->where('username', '=', $username)
            ->first();

        return $result;
    }

    public function getAdminUsers() {

        $result = DB::table('users')
            ->join('user_images', 'user_images.id', '=', 'users.image')
            ->join('roles', 'roles.id', '=', 'users.role')
            ->select('*', 'users.id as userID', 'users.name as name', 'roles.name as role', 'users.image as imageID')
            ->get();

        return $result;
    }

    public function getUserData($id) {

        $result = DB::table('users')
            ->join('user_images', 'user_images.id', '=', 'users.image')
            ->select('users.*', 'users.created_at as registered', 'users.updated_at as updated', 'user_images.thumb_path as image')
            ->where('users.id', '=', $id)
            ->get();

        return $result;
    }

    public function editUser($userID) {

        $result = DB::table('users')
            ->where('users.id', '=', $userID)
            ->update([
                'name'     => $this->name,
                'surname'  => $this->surname,
                'username' => $this->username,
                'email'    => $this->email,
                'password' => $this->password,
                'role'     => $this->role,
                'birthday' => $this->birthday,
                'city'     => $this->city,
                'bio'      => $this->bio
            ]);

        return $result;
    }

    public function insertUser() {

        $result = DB::table('users')
            ->insert([
                'email'    => $this->email,
                'username' => $this->username,
                'password' => $this->password,
                'name'     => $this->name,
                'surname'  => $this->surname,
                'role'     => $this->role,
                'image'    => $this->image,
                'birthday' => $this->birthday,
                'city'     => $this->city,
                'bio'      => $this->bio
            ]);

        return $result;
    }

    public function getUserImage($userID) {

        $result = DB::table('users')
            ->select('users.image')
            ->where('users.id', '=', $userID)
            ->first();

        return $result;
    }

    public function deleteUser($userID) {

        $result = DB::table('users')
            ->where('users.id', '=', $userID)
            ->delete();

        return $result;
    }
}
