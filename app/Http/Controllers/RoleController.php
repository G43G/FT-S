<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;

class RoleController extends Controller {

    public function activateEditRole(Request $request) {

        $id = intval($request->get('id'));

        try {

            $user = new Role();

            $data = $user->getRoleData($id);

            return response($data, 200);

        } catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function editRole($roleID, Request $request) {

        $name = $request->get('name');

        try {

            $role = new Role();

            $role->name = $name;

            $role->editRole($roleID);

            return response(200);

        } catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function insertRole(Request $request) {

        $name = $request->get('name');

        try {

            $role = new Role();

            $role->name = $name;

            $role->insertRole();

            return response(200);

        } catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function deleteRole($roleID) {

        try {
            $role = new Role();

            $role->deleteRole($roleID);

            return redirect()->back();

        } catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }
}
