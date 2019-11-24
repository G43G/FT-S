<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Filter;

class FilterController extends Controller {

    public function activateEditFilter(Request $request) {

        $id = intval($request->get('id'));

        try {
            $filter = new Filter();

            $data = $filter->getFilterData($id);

            return response($data, 200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function editFilter($filterID, Request $request) {

        $name = $request->get('name');
        $class = $request->get('fclass');

        try {
            $filter = new Filter();

            $filter->name = $name;
            $filter->class = $class;

            $filter->editFilter($filterID);

            return response(200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function insertFilter(Request $request) {

        $name = $request->get('name');
        $class = $request->get('fclass');

        try {
            $filter = new Filter();

            $filter->name = $name;
            $filter->class = $class;

            $filter->insertFilter();

            return response(200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function deleteFilter($filterID) {

        try {
            $filter = new Filter();

            $filter->deleteFilter($filterID);

            return redirect()->back();
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }
}
