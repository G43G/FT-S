<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Role {

    public $id;
    public $name;
    public $timestamps = true;

    public function getRoles() {

        $result = DB::table('roles')
            ->select('*')
            ->get();

        return $result;
    }

    public function getRoleData($id) {

        $result = DB::table('roles')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return $result;
    }

    public function editRole($id) {

        $result = DB::table('roles')
            ->where('id', '=', $id)
            ->update(['name' => $this->name]);

        return $result;
    }

    public function insertRole() {

        $result = DB::table('roles')
            ->insert(['name' => $this->name]);

        return $result;
    }

    public function deleteRole($id) {

        $result = DB::table('roles')
            ->where('id', '=', $id)
            ->delete();

        return $result;
    }
}
