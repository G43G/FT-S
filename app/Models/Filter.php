<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Filter {

    public $id;
    public $name;
    public $class;
    public $timestamps = true;

    public function getAll() {

        $result = DB::table('filters')
            ->select('*')
            ->where('id', '!=', 1)
            ->get();

        return $result;
    }

    public function getFilters() {

        $result = DB::table('filters')
            ->select('*')
            ->get();

        return $result;
    }

    public function getFilterData($id) {

        $result = DB::table('filters')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return $result;
    }

    public function editFilter($id) {

        $result = DB::table('filters')
            ->where('id', '=', $id)
            ->update([
                'name'  => $this->name,
                'class' => $this->class
            ]);

        return $result;
    }

    public function insertFilter() {

        $result = DB::table('filters')
            ->insert([
                'name'  => $this->name,
                'class' => $this->class
            ]);

        return $result;
    }

    public function deleteFilter($id) {

        $result = DB::table('filters')
            ->where('id', '=', $id)
            ->delete();

        return $result;
    }
}
