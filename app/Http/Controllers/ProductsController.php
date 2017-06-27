<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Product;
use Faker;
use Helpers\BasicFunctions;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        return view('pages.products.index');
    }

    public function get_create()
    {
        return view('pages.products.create');
    }

    public function post_create(Request $request)
    {
        $validator = \Validator::make($request->all(), array(
            'product_name' => 'required|min:3',
            'product_quantity' => 'required|integer'
        ));
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $file = null;
        if($request->hasfile('image')){
            if ($request->file('image')->isValid()) {
                $input_file = $request->file('image');
                $destination_path = public_path("uploads/images/");
                $extension = $input_file->getClientOriginalExtension();
                $file_name = str_random(5) . date('hisdmY') . str_random(5) . '.' .  $extension;
                if($input_file->move($destination_path,$file_name)){
                    $file = "uploads/images/" . $file_name;
                }
            }
        }

        $data = array(
            'name' => $request->get('product_name'),
            'quantity' => $request->get('product_quantity'),
            'price' => serialize(array(
                'purchase_price' => $request->get('purchase_price') ? : 0.00,
                'sale_price' => $request->get('sale_price') ? : 0.00
            )),
            'warning' => serialize(array(
                'warning_1' => $request->get('warning_1'),
                'warning_2' => $request->get('warning_2'),
                'warning_3' => $request->get('warning_3')
            )),
            'barcode' => $request->get('barcode'),
            'location' => $request->get('location'),
            'group_id' => $request->get('group') ? : null,
            'supplier_id' => $request->get('supplier') ? : null,
            'image' => $file,
            'description' => $request->get('description'),
            'type' => $request->get('product_type')
        );

        $product = Product::create($data);
        if ($product->save()) {
            $product_barcode = $product->getBarcode();
            $message = 'Product created successfully';
            $current_page = 'products-create';
            $page_title = "Create Product";
            $buttons = [
                [
                    'href' => route('create-product'),
                    'title' => 'Create another Product',
                    'class' => 'btn btn-success',
                ],
                [
                    'href' => route('modify-product', $product->id),
                    'title' => 'Modify Product',
                    'class' => 'btn btn-primary',
                ],
                [
                    'href' => route('view-product', $product->id),
                    'title' => 'View Product',
                    'class' => 'btn btn-info',
                ],
            ];
            return view('pages.templates.finish-create',compact('message','current_page','page_title','buttons'));
        }

        return back()->with('alert-info',\Lang::get('messages.general-error'));

    }

    public function get_view($id)
    {
        $data = Product::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            return view('pages.products.view', compact('data'));
        }
        return abort(404, 'Page not found!');
    }

    public function get_update($id)
    {
        $data = Product::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            $price = unserialize($data->price);
            $warning = unserialize($data->warning);

            

            $data = array(
                'id' => $id,
                'name' => $data['name'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
                'warning' => $data['warning'],
                'barcode' => $data['barcode'],
                'type' => $data['type'],
                'location' => $data['location'],
                'group_id' => $data['group_id'],
                'supplier_id' => $data['supplier_id'],
                'image' => $data['image'],
                'description' => $data['description'],
                'price' => $price,
                'warning' => $warning,
                'version' => 'update'
            );

            return view('pages.products.modify', compact('data'));
        }
        return abort(404, 'Page not found!');
    }

    public function post_update($id, Request $request)
    {
        $product = Product::find($id);
        if ($product) {
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

                $file = null;
                if($request->hasfile('image')){
                    if ($request->file('image')->isValid()) {
                        $input_file = $request->file('image');
                        $destination_path = public_path("uploads/images/");
                        $extension = $input_file->getClientOriginalExtension();
                        $file_name = str_random(5) . date('hisdmY') . str_random(5) . '.' .  $extension;
                        if($input_file->move($destination_path,$file_name)){
                            $file = "uploads/images/" . $file_name;
                        }
                    }
                }

                $price = array(
                    'purchase_price' => $request->get('purchase_price') ? : 0.00,
                    'sale_price' => $request->get('sale_price') ? : 0.00
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
                    'barcode' => $request->get('barcode') ? : null,
                    'location' => $request->get('location') ? : null,
                    'group_id' => $request->get('group') ? : null,
                    'supplier_id' => $request->get('supplier') ? : null,
                    'image' => $file ? : $product->image,
                    'description' => $request->get('description') ? : null,
                    'type' => $request->get('product_type'),
                );
                if ($product->update($data)) {
                    return back()->with('alert-success','Product updated successfully');
                }

            }

            return back()->with('alert-danger',\Lang::get('messages.general-error'));
        }
        return abort(404, 'Page not found!');


    }

    public function get_stockIn($id)
    {
        $data = Product::find($id);
        if ( ! empty($data) && ! is_null($data)) {

            return view('pages.products.stock-in', compact('data'));
        }
        return abort(404, 'Page not found!');
    }

    public function post_stockIn($id, Request $request)
    {
        $product = Product::find($id);
        if ( ! empty($product) && ! is_null($product)) {
            $quantity = round($request->get('quantity'));
            $total = round($product->quantity + $quantity);
            $product->quantity = $total;
            if ($product->save()) {
                return response(array(
                    'result' => 'success',
                    'message' => 'Product stock increased by ' . $quantity
                ));
            }
        }
        return response(array(
            'result' => 'error',
            'message' => \Lang::get('messages.general-error')
        ));
    }

    public function get_stockOut($id)
    {
        $data = Product::find($id);
        if ( ! empty($data) && ! is_null($data)) {

            return view('pages.products.stock-out', compact('data'));
        }
        return abort(404, 'Page not found!');
    }

    public function post_stockOut($id, Request $request)
    {
        $product = Product::find($id);
        if ( ! empty($product) && ! is_null($product)) {
            $quantity = round($request->get('quantity'));
            $total = round($product->quantity - $quantity);
            if ($total <= 0) {
                return back()->with('alert-danger', 'Not enough stock available. Total stock available : ' . $product->quantity);
            } else {
                $product->quantity = $total;
                if ($product->save()) {
                    return back()->with('alert-success', 'Product stock removed by ' . $quantity);
                }
            }

        }
        return response(array(
            'result' => 'error',
            'message' => \Lang::get('messages.general-error')
        ));
    }

    public function get_destroy($id)
    {
        $data = Product::find($id);
        if ( ! empty($data) && ! is_null($data)) {
            Product::destroy($id);
            return response(array(
                'result' => 'success',
                'message' => 'Product "' . $data->name . '" deleted successfully!'
            ));
        }
        return abort(404, 'Page not found!');
    }

    public function api_getList()
    {
        $data = Product::all();

        if (count($data) > 0) {
            return \Datatables::of($data)
                ->addColumn('action', function ($product) {
                    $buttons= [
                        [
                            'title' => 'Modify',
                            'class' => 'btn btn-xs btn-primary',
                            'href' => route('modify-product', $product->id)
                        ],
                        [
                            'title' => 'Stock In',
                            'class' => 'btn btn-xs btn-success',
                            'href' => route('stock-in-product', $product->id)
                        ],
                        [
                            'title' => 'Stock Out',
                            'class' => 'btn btn-xs btn-primary',
                            'href' => route('stock-out-product', $product->id)
                        ],
                    ];

                    $html = '';
                    foreach ($buttons as $btn) {
                        $html .= sprintf('<a class="%s" href="%s">%s</a>',$btn['class'],$btn['href'],$btn['title']);
                    }
                    return $html;
                })
                ->editColumn('type', function ($product) {
                    $types = config('app_config.product_type');
                    return array_key_exists($product->type, $types) ? $types[$product->type] : '';
                })
                ->editColumn('price', function ($product) {
                    $sale_price = unserialize($product->price)['sale_price'];
                    return $sale_price;
                })
                ->addColumn('select', function ($product) {
                    return ' <div class="checkbox-custom mb5" >
    <input id = "deleteSupplier-' . $product->id . '" class="multiDeleteSupplier" onchange = "countSelected()" name = "product-' . $product->id . '" type = "checkbox" class="deleteSupplier" value = "' . $product->id . '" >
    <label for="deleteSupplier-' . $product->id . '" ></label >
</div > ';
                })
                ->editColumn('name', function ($product) {
                    return ' <a href = "' . route('view-product', $product->id) . '" > ' . $product->name . '</a > ';
                })
                ->make(true);
        } else {
            return response([
                'data' => []
            ]);
        }

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
            'message' => \Lang::get('messages . general - error')
        ));
    }

    public function api_getStockAlert()
    {
        $data = array();
        $products = Product::all();
        $warning_status = array(
            'warning_1' => 'danger',
            'warning_2' => 'warning',
            'warning_3' => 'info',
        );
        foreach ($products as $key => $product) {
            $warnings = (array) unserialize($product->warning);
            if (empty($product->warning)) {
                $warnings = array(
                    'warning_1' => BasicFunctions::getSettings('warning - level - 1'),
                    'warning_2' => BasicFunctions::getSettings('warning - level - 2'),
                    'warning_3' => BasicFunctions::getSettings('warning - level - 3'),
                );

            }
            $status = '';
            $accepted = false;
            if ($product->quantity <= $warnings['warning_1']) {
                $status = $warning_status['warning_1'];
                $accepted = true;
            } else if ($product->quantity <= $warnings['warning_2']) {
                $status = $warning_status['warning_2'];
                $accepted = true;
            } else if ($product->quantity <= $warnings['warning_3']) {
                $status = $warning_status['warning_3'];
                $accepted = true;
            }
            if ($accepted) {
                $data[] = array(
                    'name' => $product->name,
                    'quantity' => ($product->quantity <= 0) ? $product->quantity . ' - out of stock' : $product->quantity,
                    'status' => $status,
                    'warning' => $warnings
                );
            }

        }

        return $data;

    }


    public function get_search($barcode)
    {
        
        $product = Product::where('barcode', $barcode)
                            ->get()->first();
        if ($product) {
            return response(array(
                'type' => 'success',
                'name' => $product->name,
                'code' => $barcode,
                'quantity' => $product->quantity,
                'product_id' => $product->id,
            ));
        }
        return response(array(
            'type' => 'error',
            'message' => 'Unable to find product with barcode : ' . $barcode,
        ));
    }

    public function get_search_products(Request $request)
    {
        $code = $request->get('code');
        $product = Product::where('barcode', $code)
                            ->orWhere('name', $code)
                            ->get()->first();
        if ($product) {
            return response(array(
                'type' => 'success',
                'name' => $product->name,
                'code' => $code,
                'quantity' => $product->quantity,
                'product_id' => $product->id,
            ));
        }
        return response(array(
            'type' => 'error',
            'message' => 'Unable to find product',
        ));
    }

}

