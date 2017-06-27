<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Customer;
use App\Models\Shipment;
use Helpers\BasicFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CustomerController extends Controller
{

    public function index()
    {
        return view('pages.customer.index');
    }

    public function get_create()
    {
        return view('pages.customer.create');
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

            $customer = Customer::create($data);
            if ($customer->save()) {
                return response(array(
                    'result' => 'success',
                    'message' => 'Customer created successfully',
                    'id' => $customer->id,
                    'url' => route('modify-customer', $customer->id)
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
        $data = Customer::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            return view('pages.customer.modify', compact('data'));
        }
        return abort(404, 'Page not found!');
    }

    public function post_update($id,Request $request)
    {
        $customer = Customer::find($id);
        if ( ! empty($customer) && ! is_null($customer)) {
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

                $customer->name = $request->get('name');
                $customer->address = $request->get('address');
                $customer->city = $request->get('city');
                $customer->country = $request->get('country');
                $customer->mobile = $request->get('mobile');
                $customer->telephone = $request->get('telephone');
                $customer->email = $request->get('email');

                if ($customer->save()) {
                    return response(array(
                        'result' => 'success',
                        'message' => 'Customer updated successfully'
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
        $customer = Customer::find($id);
        if ( ! empty($customer) && ! is_null($customer)) {
            $shipments  = $customer->getShipments;
            foreach($shipments as $key => $shipment)
            {
                $shipment->customer_id = 0;
                $shipment->customer = $customer->name;
                $shipment->save();
            }
            Customer::destroy($id);
            return response(array(
                'result' => 'success',
                'message' => 'Customer deleted successfully'
            ));

        }
        return response(array(
            'result' => 'error',
            'message' => \Lang::get('messages.general-error')
        ));
    }

    public function get_view($id)
    {
        $data = Customer::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            return view('pages.customer.view',compact('data'));
        }
        return abort(404, 'Page not found!');
    }

    public function api_getList()
    {
        $data = Customer::all(array('id', 'name', 'address', 'city', 'country', 'mobile', 'email'));

        return \Datatables::of($data)
            ->addColumn('action', function ($customer) {
                return '<a class="btn btn-primary btn-xs" href="' . route('modify-customer', $customer->id) . '">Edit</a>
        <a class="btn btn-danger btn-xs" href="' . route('delete-customer', $customer->id) . '" class="deleteCustomer">Delete</a>';
            })
            ->editColumn('country', function($customer){
                $country = BasicFunctions::getcountry($customer->country);
                return $country;
            })
            ->editColumn('name',function($customer){
                return '<a href="' . route('view-customer',$customer->id) . '">' . $customer->name . '</a>' ;
            })
            ->make(true);
    }


}

