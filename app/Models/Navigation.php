<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Navigation {

    public function getAll() {
        $result = DB::table('navigation')
            ->select('*')
            ->get();

        return $result;
    }

    public function getNavAdmin() {
        $result = DB::table('navigation')
            ->select('*')
            ->whereNotIn('path', ['auth'])
            ->get();

        return $result;
    }

    public function getNavUser() {
        $result = DB::table('navigation')
            ->select('*')
            ->whereNotIn('path', ['auth', 'admin-panel/users'])
            ->get();

        return $result;
    }

    public function getNav() {
        $result = DB::table('navigation')
            ->select('*')
            ->where([
                ['path', '!=', 'profile'],
                ['auth', '=', 'no']
            ])
            ->get();

        return $result;
    }
}