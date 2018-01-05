<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Group;
use App\Models\Product as ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GroupController extends Controller
{

    public function index()
    {
        return view('pages.group.index');
    }

    public function get_create()
    {
        return view('pages.group.create');
    }

    public function post_create(Request $request)
    {
        $validator = \Validator::make($request->all(), array(
            'name' => 'required|min:3',
        ));
        if ($validator->fails()) {
            $messages = '';
            $err_list = $validator->errors()->all();
            foreach ($err_list as $key => $message) {
                $messages = $messages . $message . '<br />';
            }
            return response(array(
                'result' => 'error',
                'message' => $messages
            ));
        } else {

            $data = array(
                'name' => $request->get('name'),
            );

            $group = Group::create($data);
            if ($group->save()) {
                return response(array(
                    'result' => 'success',
                    'message' => 'Group created successfully',
                    'url' => route('modify-group', $group->id)
                ));
            }
        }

        return response(array(
            'result' => 'error',
            'message' => \Lang::get('messages.general-error')
        ));

    }

    public function get_update($id)
    {
        $data = Group::find($id);
        $products = $data->listProducts;
        if ( ! empty($data) && ! is_null($data)) {
            return view('pages.group.modify', compact('data', 'products'));
        }
        return abort(404, 'Page not found!');
    }

    public function post_update($id,Request $request)
    {
        $group = Group::find($id);
        if ( ! empty($group) && ! is_null($group)) {
            $validator = \Validator::make($request->all(), array(
                'name' => 'required|min:3',
            ));
            if ($validator->fails()) {
                $messages = '';
                $err_list = $validator->errors()->all();
                foreach ($err_list as $key => $message) {
                    $messages = $messages . $message . '<br />';
                }
                return response(array(
                    'result' => 'error',
                    'message' => $messages
                ));
            } else {

                $group->name = $request->get('name');

                if ($group->save()) {
                    return response(array(
                        'result' => 'success',
                        'message' => 'Group updated successfully'
                    ));
                }
            }
            return response(array(
                'result' => 'error',
                'message' => \Lang::get('messages.general-error')
            ));
        }
        return abort(404, 'Page not found!');


    }

    public function get_destroy($id)
    {
        $data = Group::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            Group::destroy($id);
            return redirect(route('manage-groups'))->with('success', 'Group deleted successfully');
        }
        return abort(404, 'Page not found!');
    }
    public function get_view($id)
    {
        $data = Group::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            return view('pages.group.view',compact('data'));
        }
        return abort(404, 'Page not found!');
    }

    public function get_addProduct($gid, $pid)
    {
        $product = ProductModel::find($pid);
        if ($product && ! is_null($product) && ! empty($product) && ( ! empty($gid) && ! is_null($gid))) {
            $product->group_id = $gid;
            if ($product->save()) {
                return response(array(
                    'result' => 'success',
                    'message' => 'Product added to group successfully.'
                ));
            }
        } else {
            return abort(404, 'Page not found!');
        }
    }

    public function get_deleteProduct($id)
    {
        $product = ProductModel::find($id);
        if ($product && ! is_null($product) && ! empty($product)) {
            $product->group_id = 0;
            if ($product->save()) {
                return response(array(
                    'result' => 'success',
                    'message' => 'Product removed from group successfully.'
                ));
            }
        } else {
            return abort(404, 'Page not found!');
        }
    }
}

