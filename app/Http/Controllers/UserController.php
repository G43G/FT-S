<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\UserImage;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like;

class UserController extends Controller {

    public function showUserData(Request $request) {

        $id = intval($request->get('id'));

        try {

            $user = new User();

            $data = $user->getUserData($id);

            $html = '<div>';

            foreach( $data as $i ) {
                $image = $i->image;

                $birthday = $i->birthday;

                if ( $birthday === null ) {
                    $birthday = '';
                } else {
                    $birthday = date('d-M-Y', strtotime($i->birthday));
                }

                $city = $i->city;

                $bio = $i->bio;

                $registered = date( 'd-M-Y', strtotime( $i->registered ) );

                $updated = $i->updated;

                if ( $updated === null ) {
                    $updated = '';
                } else {
                    $updated = date( 'd-M-Y', strtotime( $i->updated ) );
                }

                $html .= '<div class="data-image-holder">';
                $html .= '<img alt="user-image" src="' . asset($image) . '" />';
                $html .= '</div>';
                $html .= '<div class="data-text-holder">';
                $html .= '<span class="head">Joined: </span><span>' . $registered . '</span><br/>';
                $html .= '<span class="head">Updated: </span><span>' . $updated . '</span><br/>';
                $html .= '<span class="head">Birthday: </span><span>' . $birthday . '</span><br/>';
                $html .= '<span class="head">From: </span><span>' . $city . '</span><br/>';
                $html .= '<span class="head">About: </span><span>' . $bio . '</span><br/>';
                $html .= '</div>';
            }

            $html .= '</div>';

            return response($html, 200);

        } catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function activateEditUser(Request $request) {

        $id = intval($request->get('id'));

        try {

            $user = new User();

            $data = $user->getUserData($id);

            return response($data, 200);

        } catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function editUser($userID, Request $request) {

        $name = $request->get('name');
        $surname = $request->get('surname');
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $role = $request->get('role');
        $birthday = $request->get('birthday');
        $city = $request->get('city');
        $bio = $request->get('bio');

        try {

            $user = new User();

            $user->name = $name;
            $user->surname = $surname;
            $user->username = $username;
            $user->email = $email;

            if( strlen( $password ) === 32) {
                $user->password = $request->get('password');
            }
            else {
                $user->password = md5( $request->get('password') );
            }

            $user->role = $role;
            $user->birthday = $birthday;
            $user->city = $city;
            $user->bio = $bio;

            $user->editUser($userID);

            return response(200);

        } catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function insertUser(Request $request) {

        $name = $request->get('name');
        $surname = $request->get('surname');
        $username = $request->get('username');
        $email = $request->get('email');
        $password = md5( $request->get('password') );
        $role = $request->get('role');
        $birthday = $request->get('birthday');
        $city = $request->get('city');
        $bio = $request->get('bio');

        try {

            $user = new User();

            $user->name = $name;
            $user->surname = $surname;
            $user->username = $username;
            $user->email = $email;
            $user->password = $password;
            $user->role = $role;
            $user->image = 1;
            $user->birthday = $birthday;
            $user->city = $city;
            $user->bio = $bio;

            $user->insertUser();

            return response(200);

        } catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function deleteUser($userID) {

        try {
            $user = new User();
            $image = new UserImage();
            $like = new Like();
            $comment = new Comment();

            $imageID = $user->getUserImage($userID)->image;

            if ( $imageID !== 1 ) {
                $image->id = $imageID;
                $image_to_delete = $image->get();
                File::delete($image_to_delete->path);
                File::delete($image_to_delete->thumb_path);
                $image->deleteImage();
            }

            $like->deleteUserLikes($userID);
            $comment->deleteUserComments($userID);
            $user->deleteUser($userID);

            return redirect()->back();

        } catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }
}
