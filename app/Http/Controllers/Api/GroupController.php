<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function list()
    {
        $data = Group::all(array('id', 'name'));

        return \Datatables::of($data)
            ->addColumn('action', function ($group) {
                return '<a href=" ' . route('modify-group', $group->id) . '" class="btn btn-primary btn-xs">
                <span class="fa fa-pencil mr5"></span>
                Edit</a>';
            })
            ->addColumn('select', function ($group) {
                return '<div class="checkbox-custom mb5">
    <input id="deleteGroup-' . $group->id . '" class="multiDeleteGroup" onchange="countSelected()" name="group-' . $group->id . '" type="checkbox" class="deleteGroup" value="' . $group->id . '">
    <label for="deleteGroup-' . $group->id . '"></label>
</div>';
            })
            ->addColumn('products', function ($group) {
                return $group->countProducts();
            })
            ->editColumn('name',function($group){
                return '<a href="' . route('view-group',$group->id) . '">' . $group->name . '</a>' ;
            })
            ->make(true);
    }

    public function listProduct($gid)
    {
        $group = Group::find($gid);

        $data = $group->listProducts;
        if ( ! empty($group) && ! is_null($group)) {
            return \Datatables::of($data)
                ->addColumn('action', function ($product) {
                    return '<a class="btn btn-danger removeProduct" onclick=\'click_product("' . route('group-remove-product', $product->id) . '")\' href="javascript:void(0)">
                                                <i class="imoon imoon-remove"></i>
                                                Remove Product
                                            </a>';
                })

                ->make(true);
        }
        return abort(404, 'Page not found!');
    }

    public function bulkDelete()
    {
        $inputs = Input::all();
        $ids = array();
        foreach ($inputs as $name => $id) {
            $ids[] = $id;
        }
        $groups = Group::find($ids);
        foreach ($groups as $key => $group) {
            foreach ($group->listProducts as $id => $product) {
                $product->group_id = 0;
                $product->save();
            }
        }

        $destroy = Group::destroy($ids);
        if ($destroy) {
            return response(array(
                'result' => 'success',
                'message' => count($ids) . ' Groups deleted successfully'
            ));
        }
        return response(array(
            'result' => 'error',
            'message' => \Lang::get('messages.general-error')
        ));

    }
}
