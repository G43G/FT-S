<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AuthController extends Controller {

    public function login(Request $request) {

        $rules = [
                'usernamel' => 'required',
                'passwordl' => 'required'
            ];

        $messages = [
                'usernamel.required' => 'Username field is required.',
                'passwordl.required' => 'Password field is required.'
            ];

        $request->validate($rules, $messages);

        try {
            $user = new User();

            $user->username = $request->get('usernamel');
            $user->password = $request->get('passwordl');

            $userLogin = $user->loginUser();

            if(!empty($userLogin)) {
                $request->session()->push('user', $userLogin);

                if( session()->get('user')[0]->role == 'administrator') {
                    return redirect('/admin-panel/users');

                } elseif (session()->get('user')[0]->role == 'user') {
                    return redirect('/profile');

                }
            } else {
                return redirect()->back()->with('error', 'There are no users registered with that username and password, please try again.');
            }
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect('/')->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function logout(Request $request) {

        try {
            $request->session()->forget('user');
            $request->session()->flush();
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect('/')->with('error', 'Oops, there\'s been an error. Please, try again.');
        }

        return redirect('/');
    }

    public function register(Request $request) {

        $rules = [
            'name'       => ['bail', 'required', 'regex:/^([A-ZŠĐČĆŽ][a-zšđčćž]+)$/'],
            'surname'    => ['bail', 'required', 'regex:/^([A-ZŠĐČĆŽ][a-zšđčćž]+)$/'],
            'email'      => ['bail', 'required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'unique:users,email'],
            'usernamer'  => ['bail', 'required', 'regex:/^[a-zA-Z0-9]{3,25}$/', 'unique:users,username', 'min:3', 'max:25'],
            'passwordr'  => ['bail', 'required', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', 'min:6'],
            'passwordc'  => ['same:passwordr']
        ];

        $messages = [
            'name.required'      => 'First Name field is required',
            'surname.required'   => 'Last Name field is required.',
            'passwordr.required' => 'Password field is required.',
            'usernamer.required' => 'Username field is required.',
            'email.required'     => 'E-Mail field is required.',
            'name.regex'         => 'First Name is not in valid format.',
            'surname.regex'      => 'Last Name is not in valid format.',
            'usernamer.regex'    => 'Username is not in valid format.',
            'email.regex'        => 'E-mail is not in valid format.',
            'passwordr.regex'    => 'Password is not in valid format.',
            'email.unique'       => 'E-mail is already registered.',
            'usernamer.unique'   => 'Username is already taken.',
            'passwordc.same'     => 'Passwords do not match.'
        ];

        $request->validate($rules, $messages);

        try {
            $user = new User();

            $user->name     = $request->get('name');
            $user->surname  = $request->get('surname');
            $user->username = $request->get('usernamer');
            $user->email    = $request->get('email');
            $user->password = md5($request->get('passwordr'));
            $user->role     = 2;
            $user->image    = 1;

            $user->registerUser();

            return redirect()->back()->with('success', 'You have successfully registered.');
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect('/')->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function resetPassword(Request $request) {

        try {
            $user = new User();

            $email = $request->get('email');
            $password = rand(100000, 999999);

            $message = 'Your password has been reset. Use this temporary password for login and change it afterwards. ---> ' . $password;

            $user->password = md5($password);
            $user->email = $email;

            $user->resetPassword();
            mail($email, "Password Reset", $message);

            return response(200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect('/')->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function sendMail(Request $request) {

        try {
            $name = $request->get('contact-name');
            $email = $request->get('contact-email');
            $message = $request->get('contact-message');

            mail('bogdan_992@outlook.com', 'From: "' . $name . ' (' . $email . ')' . '"', $message);

            return redirect()->back()->with('success', 'Your message has been sent.');
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect('/')->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }
}
