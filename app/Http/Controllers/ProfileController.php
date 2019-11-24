<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Models\UserImage;
use App\Models\User;

use App\Rules\checkPass;

class ProfileController extends Controller {

    public function editProfile(Request $request) {

        $user = new User();

        $loggedUser = $request->session()->get('user');

        $checkUsername = $loggedUser[0]->username;
        $checkEmail = $loggedUser[0]->email;

        if($request->get('editUsername') != $checkUsername && $request->get('editEmail') != $checkEmail) {

            $rules = [
                'editName' => ['bail', 'required', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+$/'],
                'editSurname' => ['bail', 'required', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+$/'],
                'editEmail' => ['bail', 'required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'unique:user,email'],
                'editUsername' => ['bail', 'required', 'regex:/^[a-zA-Z0-9]{3,25}$/', 'unique:user,username', 'min:3', 'max:25'],
                'oldPassword' => ['bail', 'nullable', new checkPass(), 'required_with:newPassword,'],
                'newPassword' => ['bail', 'nullable', 'required_with:oldPassword,', 'different:oldPassword', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', 'min:6'],
                'editCity' => ['bail', 'nullable', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+(?:[\s-][A-ZŠĐČĆŽ][a-zšđčćžA-ZŠĐČĆŽ]+)*$/', 'max:30']
            ];

            $messages = [
                'editName.required' => 'First Name field is required.',
                'editName.regex' => 'First Name is not in valid format.',
                'editSurname.required' => 'Last Name field is required.',
                'editSurname.regex' => 'Last Name is not in valid format.',
                'editUsername.required' => 'Username field is required.',
                'editUsername.regex' => 'Username is not in valid format.',
                'editUsername.unique' => 'Username is already taken.',
                'editEmail.required' => 'E-Mail field is required.',
                'editEmail.regex' => 'E-mail is not in valid format.',
                'editEmail.unique' => 'E-mail is already registered.',
                'oldPassword.required_with' => 'Old Password field is required.',
                'newPassword.regex' => 'New password is not in valid format.',
                'newPassword.required_with' => 'New Password field is required.',
                'newPassword.different' => 'New password cannot be the same as old password.',
                'editCity.regex' => 'City Name is not in valid format.'
            ];

        } else if($request->get('editUsername') != $checkUsername && $request->get('editEmail') == $checkEmail) {

            $rules = [
                'editName' => ['bail', 'required', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+$/'],
                'editSurname' => ['bail', 'required', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+$/'],
                'editUsername' => ['bail', 'required', 'regex:/^[a-zA-Z0-9]{3,25}$/', 'unique:user,username', 'min:3', 'max:25'],
                'oldPassword' => ['bail', 'nullable', new checkPass(), 'required_with:newPassword,'],
                'newPassword' => ['bail', 'nullable', 'required_with:oldPassword,', 'different:oldPassword', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', 'min:6'],
                'editCity' => ['bail', 'nullable', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+(?:[\s-][A-ZŠĐČĆŽ][a-zšđčćžA-ZŠĐČĆŽ]+)*$/', 'max:30']
            ];

            $messages = [
                'editName.required' => 'First Name field is required.',
                'editName.regex' => 'First Name is not in valid format.',
                'editSurname.required' => 'Last Name field is required.',
                'editSurname.regex' => 'Last Name is not in valid format.',
                'editUsername.required' => 'Username field is required.',
                'editUsername.regex' => 'Username is not in valid format.',
                'editUsername.unique' => 'Username is already taken.',
                'oldPassword.required_with' => 'Old Password field is required.',
                'newPassword.regex' => 'New password is not in valid format.',
                'newPassword.required_with' => 'New Password field is required.',
                'newPassword.different' => 'New password cannot be the same as old password.',
                'editCity.regex' => 'City Name is not in valid format.'
            ];

        } else if($request->get('editUsername') == $checkUsername && $request->get('editEmail') != $checkEmail) {

            $rules = [
                'editName' => ['bail', 'required', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+$/'],
                'editSurname' => ['bail', 'required', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+$/'],
                'editUsername' => ['bail', 'required', 'regex:/^[a-zA-Z0-9]{3,25}$/', 'unique:user,username', 'min:3', 'max:25'],
                'oldPassword' => ['bail', 'nullable', new checkPass(), 'required_with:newPassword,'],
                'newPassword' => ['bail', 'nullable', 'required_with:oldPassword,', 'different:oldPassword', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', 'min:6'],
                'editCity' => ['bail', 'nullable', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+(?:[\s-][A-ZŠĐČĆŽ][a-zšđčćžA-ZŠĐČĆŽ]+)*$/', 'max:30']
            ];

            $messages = [
                'editName.required' => 'First Name field is required.',
                'editName.regex' => 'First Name is not in valid format.',
                'editSurname.required' => 'Last Name field is required.',
                'editSurname.regex' => 'Last Name is not in valid format.',
                'editUsername.required' => 'Username field is required.',
                'editUsername.regex' => 'Username is not in valid format.',
                'editUsername.unique' => 'Username is already taken.',
                'oldPassword.required_with' => 'Old Password field is required.',
                'newPassword.regex' => 'New password is not in valid format.',
                'newPassword.required_with' => 'New Password field is required.',
                'newPassword.different' => 'New password cannot be the same as old password.',
                'editCity.regex' => 'City Name is not in valid format.'
            ];

        } else {
            $rules = [
                'editName' => ['bail', 'required', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+$/'],
                'editSurname' => ['bail', 'required', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+$/'],
                'oldPassword' => ['bail', 'nullable', new checkPass(), 'required_with:newPassword,'],
                'newPassword' => ['bail', 'nullable', 'required_with:oldPassword,', 'different:oldPassword', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', 'min:6'],
                'editCity' => ['bail', 'nullable', 'regex:/^[A-ZŠĐČĆŽ][a-zšđčćž]+(?:[\s-][A-ZŠĐČĆŽ][a-zšđčćžA-ZŠĐČĆŽ]+)*$/', 'max:30']
            ];

            $messages = [
                'editName.required' => 'First Name field is required.',
                'editName.regex' => 'First Name is not in valid format.',
                'editSurname.required' => 'Last Name field is required.',
                'editSurname.regex' => 'Last Name is not in valid format.',
                'oldPassword.required_with' => 'Old Password field is required.',
                'newPassword.regex' => 'New password is not in valid format.',
                'newPassword.required_with' => 'New Password field is required.',
                'newPassword.different' => 'New password cannot be the same as old password.',
                'editCity.regex' => 'City Name is not in valid format.'
            ];

        }

        $request->validate($rules, $messages);

        try {

            $id = $loggedUser[0]->id;
            $name = $request->get('editName');
            $surname = $request->get('editSurname');
            $username = $request->get('editUsername');
            $email = $request->get('editEmail');

            if($request->get('newPassword') != '') {
                $password = md5($request->get('newPassword'));
            } else {
                $password = $loggedUser[0]->password;
            }

            if($request->get('editBirthday') != '') {
                $birthday = $request->get('editBirthday');
            } else {
                $birthday = null;
            }

            if($request->get('editCity') != '') {
                $city = $request->get('editCity');
            } else {
                $city = null;
            }

            if($request->get('editBio') != '') {
                $bio = $request->get('editBio');
            } else {
                $bio = null;
            }

            $user->id = $id;
            $user->email = $email;
            $user->username = $username;
            $user->password = $password;
            $user->name = $name;
            $user->surname = $surname;
            $user->birthday = $birthday;
            $user->city = $city;
            $user->bio = $bio;

            $result = $user->editProfile();

            if($result == 1) {
                return redirect('/profile')->with('success', 'Profile information changed.');
            } else {
                return redirect()->back()->with('error', 'You didn\'t change anything.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect('/')->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function uploadImage(Request $request) {

        $rules = [
            'profileImgUpload' => 'required|mimes:jpg,jpeg,png',
        ];

        $messages = [
            'required' => 'You didn\'t choose an image.',
            'mimes'    => 'Allowed picture formats are .jpg, .jpeg and .png.',
        ];

        $request->validate($rules, $messages);

        $id = session()->get('user')[0]->id;
        $image = $request->file('profileImgUpload');
        $name = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $tmp_path = $image->getPathName();

        $folder = 'img/users/';
        $file_name = $name.'.'.time().'.'.$extension;
        $new_path = public_path($folder).$file_name;

        $thumb_image = Image::make($image->getRealPath());
        $thumb_image->orientate();
        $thumb_image->resize(256, 256);

        try {
            File::move($tmp_path, $new_path);
            $thumb_image->save(public_path('img/users/thumbs/'.$file_name));

            $userImage = new UserImage();
            $user = new User();

            $userImage->path = 'img/users/'.$file_name;
            $userImage->thumb_path = 'img/users/thumbs/'.$file_name;

            $user->id = $id;
            $user->image = $userImage->uploadImage();
            $user->uploadImage();

            return redirect()->back()->with('success', 'Profile picture added.');
        }
        catch(\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function deleteImage($imageId) {

        try {
            $user = new User();
            $image = new UserImage();

            $user->id = session()->get('user')[0]->id;
            $user->image = 1;
            $user->uploadImage();

            $image->id = $imageId;
            $image_to_delete = $image->get();
            File::delete($image_to_delete->path);
            File::delete($image_to_delete->thumb_path);
            $image->deleteImage();

            return redirect()->back()->with('success','Profile picture deleted.');
        }
        catch(\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }
}
