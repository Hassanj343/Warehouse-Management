<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SupplierController extends Controller
{

    public function index()
    {
        return view('pages.supplier.index');
    }

    public function get_create()
    {
        return view('pages.supplier.create');
    }

    public function post_create(Request $request)
    {
        $validator = \Validator::make($request->all(), array(
            'name' => 'required|min:3',
            'email' => 'required|email'
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
                'address' => $request->get('address'),
                'city' => $request->get('city'),
                'country' => $request->get('country'),
                'mobile' => $request->get('mobile'),
                'telephone' => $request->get('telephone'),
                'email' => $request->get('email'),
            );

            $supplier = Supplier::create($data);
            if ($supplier->save()) {
                return response(array(
                    'result' => 'success',
                    'message' => 'Supplier created successfully',
                    'url' => route('modify-supplier', $supplier->id)
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
        $data = Supplier::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            return view('pages.supplier.modify', compact('data'));
        }
        return abort(404, 'Page not found!');
    }

    public function post_update($id, Request $request)
    {
        $supplier = Supplier::find($id);
        if ( ! empty($supplier) && ! is_null($supplier)) {
            $validator = \Validator::make($request->all(), array(
                'name' => 'required|min:3',
                'email' => 'required|email'
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

                $supplier->name = $request->get('name');
                $supplier->address = $request->get('address');
                $supplier->city = $request->get('city');
                $supplier->country = $request->get('country');
                $supplier->mobile = $request->get('mobile');
                $supplier->telephone = $request->get('telephone');
                $supplier->email = $request->get('email');

                if ($supplier->save()) {
                    return response(array(
                        'result' => 'success',
                        'message' => 'Supplier updated successfully'
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
        $data = Supplier::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            $products = $data->getProducts;
            foreach ($products as $key => $val) {
                $val->supplier_id = null;
                $val->save();
            }
            Supplier::destroy($id);
            return redirect(route('manage-suppliers'))->with('success', 'Supplier deleted successfully');
        }
        return abort(404, 'Page not found!');
    }

    public function get_view($id)
    {
        $data = Supplier::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            return view('pages.supplier.view', compact('data'));
        }
        return abort(404, 'Page not found!');
    }
}

