<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\ActivityShipment;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Shipment;
use Faker;
use Helpers\BasicFunctions;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{

    public function index()
    {
        return view('pages.shipments.index');
    }

    public function get_quickCreate()
    {
        return view('pages.shipments.quick-shipment');
    }

    private function createActivity($args){
        $datetime = array(
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
        );
        $arr = array_merge($args,$datetime);
        $activity = ActivityShipment::create($arr);
        return $activity;
    }

    public function get_quickSell(Request $request)
    {
        $code = $request->get('code');
        $product = Product::where('barcode', '=', $code)
                            ->orWhere('name', '=', $code)
                            ->get()->first();
        if ( ! empty($product) && ! is_null($product)) {

            $pquantity = $product->quantity - 1;
            if ($pquantity < 0) {
                return response(array(
                    'type' => 'error',
                    'message' => 'Not enough product quantity in stock for product : ' . $product->name
                ));
            } else {
                $product->quantity = $pquantity;
                if ($product->save()) {
                    $sale_price = unserialize($product->price)['sale_price'];
                    $shipment = $this->createActivity(array(
                        'product_id' => $product->id,
                        'sale_price' => $sale_price,
                        'quantity' => 1,
                    ));
                    return response(array(
                        'type' => 'success',
                        'name' => $product->name,
                        'code' => $code,
                        'shipment_id' => $shipment->id
                    ));
                }

            }


        }
        return response(array(
            'type' => 'error',
            'message' => 'Unable to find product with barcode : ' . $barcode,
        ));
    }

    public function post_quickRemove()
    {
        $barcode = \Request::get('code');
        $shipment_id = \Request::get('shipment_id');
        $product = Product::where('barcode', '=', $barcode)->get()->first();
        if ( ! empty($product) && ! is_null($product)) {
            $product->quantity = $product->quantity + 1;

            if ($product->save()) {
                ActivityShipment::destroy($shipment_id);

                return response(array(
                    'type' => 'success',
                    'message' => 'Product deleted from shipment'
                ));
            }
        }
        return response(array(
            'type' => 'error',
            'message' => 'Unable to find product with barcode : ' . $barcode,
        ));
    }

    public function get_create()
    {
        return view('pages.shipments.create-shipment');
    }

    public function post_createShipment(Request $input)
    {
        $shipment = Shipment::create(array(
            'customer_id' => (int) $input->get('customer_id'),
            'user_id' => \Auth::user()->id,
        ));
        if ($shipment->save()) {
            return response(array(
                'result' => 'success',
                'shipment_id' => $shipment->id,
            ));
        }
        return response(array(
            'result' => 'error',
            'message' => \Lang::get('messages.general-error')
        ));
    }

    public function post_addShipmentProducts(Request $input)
    {
        $product = Product::where('barcode', '=', $input->get('code'))
                    ->orWhere('name', '=', $input->get('code'))
                    ->limit(1)->get()->first();
        $sale_price = unserialize($product->price)['sale_price'];

        $quantity_left = $product->quantity - $input->get('quantity');
        if ($quantity_left < 0) {
            return response(array(
                'result' => 'error',
                'message' => 'Not enough quantity available.'
            ));
        }
        $product->quantity = $quantity_left;
        if ($product->save()) {
            $productActivity = $this->createActivity(array(
                'shipment_id' => $input->get('shipment_id'),
                'product_id' => $product->id,
                'sale_price' => $sale_price,
                'quantity' => $input->get('quantity'),
            ));
            if ($productActivity->save()) {
                return response(array(
                    'result' => 'success',
                    'quantity_left' => $quantity_left
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
        $data = Shipment::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            return view('pages.shipments.modify', compact('data'));
        }
        return abort(404, 'Page not found!');
    }

    public function get_update_products($id)
    {
        $data = Shipment::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            $result = [];
            foreach ($data->getProductActivity as $key => $product) {
                $prod = $product->getProduct;
                $result[] = array(
                    'id' => $product->id,
                    'name' => $prod->name,
                    'code' => $prod->barcode,
                    'quantity' => $product->quantity,
                    'available_quantity' => $prod->quantity
                );
            }

            return $result;
        }
        return abort(404, 'Page not found!');
    }

    public function get_removeShipmentProduct($id)
    {
        $data = ActivityShipment::find($id);
        if ( !empty($data) && ! is_null($data)) {
            $product = Product::find($data->product_id);
            $product->quantity = $product->quantity + $data->quantity;
            if ($product->save()) {
                if (ActivityShipment::destroy($id)) {
                    return response(array(
                        'result' => 'success',
                        'message' => 'Product removed from shipment successfully'
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

    public function post_update($id, Request $request)
    {
        $product = Product::find($id);
        if ( ! empty($product) && ! is_null($product)) {
            $validator = \Validator::make($request->all(), array(
                'product_name' => 'required|min:3',
                'product_quantity' => 'required|integer'
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
                $price = array(
                    'purchase_price' => $request->get('purchase_price'),
                    'sale_price' => $request->get('sale_price')
                );
                $warning = array(
                    'warning_1' => $request->get('warning_1'),
                    'warning_2' => $request->get('warning_2'),
                    'warning_3' => $request->get('warning_3')
                );

                $data = array(
                    'name' => $request->get('product_name'),
                    'quantity' => $request->get('product_quantity'),
                    'price' => serialize($price),
                    'warning' => serialize($warning),
                    'barcode' => $request->get('barcode'),
                    'location' => $request->get('location'),
                    'group_id' => $request->get('group'),
                    'supplier_id' => $request->get('supplier'),
                    'image' => $request->get('image'),
                    'description' => $request->get('description'),

                );

                $product->name = $data['name'];
                $product->quantity = $data['quantity'];
                $product->price = $data['price'];
                $product->warning = $data['warning'];
                $product->barcode = $data['barcode'];
                $product->location = $data['location'];
                $product->group_id = $data['group_id'];
                $product->supplier_id = $data['supplier_id'];
                $product->image = $data['image'];
                $product->description = $data['description'];

                if ($product->save()) {
                    return response(array(
                        'result' => 'success',
                        'message' => 'Product updated successfully'
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

    public function post_addProduct(Request $input)
    {
        return $input;
    }

    public function get_destroy($id)
    {
        $shipment = Shipment::find($id);
        if ( ! empty($shipment) && ! is_null($shipment)) {
            $count = 0;

            // get all products linked to shipment
            $products = $shipment->getProductActivity;
            // loop through all of them
            foreach ($products as $key => $productActivity) {
                $productActivity->shipment_id = null;
                $productActivity->save();
            }
            // when finish delete the shipment and return message
            Shipment::destroy($id);

            return response(array(
                'result' => 'success',
                'message' => 'Shipment deleted successfully!'
            ));
        }
        return abort(404, 'Page not found!');
    }

    public function get_view($id)
    {
        $data = Shipment::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            return view('pages.shipments.view', compact('data'));
        }
        return abort(404, 'Page not found!');
    }

    public function get_destroyRestock($id)
    {
        $shipment = Shipment::find($id);
        if ( ! empty($shipment) && ! is_null($shipment)) {
            $count = 0;

            // get all products linked to shipment
            $products = $shipment->getProductActivity;
            // loop through all of them
            foreach ($products as $key => $productActivity) {
                $product = Product::find($productActivity->product_id);
                // add the removed quantity
                $product->quantity = $productActivity->quantity + $product->quantity;
                if ($product->save()) {
                    // delete the record
                    ActivityShipment::destroy($productActivity->id);
                    $count++;
                }
            }
            // when finish delete the shipment and return message
            Shipment::destroy($id);

            return response(array(
                'result' => 'success',
                'message' => 'Shipment deleted and ' . $count . ' product(s) restocked successfully!'
            ));
        }
        return abort(404, 'Page not found!');
    }


    public function api_getList()
    {
        $data = Shipment::all();    

        return \Datatables::of($data)
            ->addColumn('action', function ($shipment) {
                $customer = Customer::find($shipment->customer_id);
                $modify = '';
                if ($customer && ! is_null($customer)) {
                    $modify = '<li><a href="' . route('modify-shipment', $shipment->id) . '">Edit</a></li>';
                }
                return '

<div class="btn-group text-right">
    <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Actions
        <span class="caret ml5"></span>
    </button>
    <ul class="dropdown-menu pull-right" role="menu">
        ' . $modify . '
        <li><a href="' . route('delete-shipment', $shipment->id) . '" class="deleteShipment">Delete</a></li>
        <li><a href="' . route('delete-restock-shipment', $shipment->id) . '" class="deleteShipment">Delete & Restock</a></li>
    </ul>
</div>';
            })
            ->addColumn('select', function ($shipment) {
                return '<div class="checkbox-custom mb5">
    <input id="deleteSupplier-' . $shipment->id . '" class="multiDeleteSupplier" onchange="countSelected()" name="product-' . $shipment->id . '" type="checkbox" class="deleteSupplier" value="' . $shipment->id . '">
    <label for="deleteSupplier-' . $shipment->id . '"></label>
</div>';
            })
            ->addColumn('date', function ($shipment) {
                $time = strtotime($shipment->created_at);
                return '<a href="' . route('view-shipment', $shipment->id) . '">' . date('H:i:s D, d M Y', $time) . '</a>';

            })
            ->addColumn('customer', function ($shipment) {
                $customer = Customer::find($shipment->customer_id);
                $name = ($customer) ? "<a href='" . route('modify-customer', $customer->id) . "'>" . ucfirst($customer->name) . "</a>" : '<span class="fg-red">' . $shipment->customer . '</span>';
                return $name;
            })
            ->addColumn('created_by', function ($shipment) {
                $user = \App\User::find($shipment->user_id);
                return ($user) ? ucfirst($user->name) : "Unknown";
            })
            ->addColumn('products', function ($shipment) {
                return $shipment->getShipmentCount();
            })
            ->make(true);
    }

    public function api_bulkDelete(Request $request)
    {
        $inputs = $request->all();
        $ids = array();
        foreach ($inputs as $name => $id) {
            $ids[] = $id;
        }

        $destroy = Product::destroy($ids);
        if ($destroy) {
            return response(array(
                'result' => 'success',
                'message' => count($ids) . ' Products deleted successfully'
            ));
        }
        return response(array(
            'result' => 'error',
            'message' => \Lang::get('messages.general-error')
        ));
    }

}

