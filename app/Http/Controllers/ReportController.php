<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ActivityShipment;
use App\Models\Group;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function list_products()
    {
        $data = Product::all();

        return \Datatables::of($data)
            ->addColumn('group', function ($product) {
                $group = $product->getGroup;
                return $group ? '<a href="' . route('view-group', $group->id) . '"> ' . $group->name . '</a>' : '';
            })
            ->addColumn('supplier', function ($product) {
                $supplier = $product->getSupplier;
                return $supplier ? '<a href="' . route('view-group', $supplier->id) . '"> ' . $supplier->name . '</a>' : '';
            })
            ->make(true);
    }

    public function list_stockAlertProducts($level)
    {
        $defaultwarnings = array(
            'warning_1' => \HelperFunctions::getSettings('warning-level-1'),
            'warning_2' => \HelperFunctions::getSettings('warning-level-2'),
            'warning_3' => \HelperFunctions::getSettings('warning-level-3'),
        );
        $products = Product::all();
        foreach ($products as $key => $product) {
            $warnings = (array) unserialize($product->warning);
            if (empty($product->warning)) {
                $warnings = $defaultwarnings;
            }
            if ($product->quantity >= $warnings['warning_' . $level]) {
                unset($products[$key]);
            }
        }


        return \Datatables::of($products)
            ->addColumn('group', function ($product) {
                $group = $product->getGroup;
                return $group ? '<a href="' . route('view-group', $group->id) . '"> ' . $group->name . '</a>' : '';
            })
            ->addColumn('supplier', function ($product) {
                $supplier = $product->getSupplier;
                return $supplier ? '<a href="' . route('view-group', $supplier->id) . '"> ' . $supplier->name . '</a>' : '';
            })
            ->make(true);
    }

    public function list_outOfStockProducts()
    {
        $products = Product::where('quantity', '<=', 0);

        return \Datatables::of($products)
            ->addColumn('group', function ($product) {
                $group = $product->getGroup;
                return $group ? '<a href="' . route('view-group', $group->id) . '"> ' . $group->name . '</a>' : '';
            })
            ->addColumn('supplier', function ($product) {
                $supplier = $product->getSupplier;
                return $supplier ? '<a href="' . route('view-group', $supplier->id) . '"> ' . $supplier->name . '</a>' : '';
            })
            ->make(true);
    }

    public function list_groupProducts($id)
    {
        $group = Group::find($id);
        $products = $group->listProducts;
        return \Datatables::of($products)
            ->addColumn('supplier', function ($product) {
                $supplier = $product->getSupplier;
                return $supplier ? '<a href="' . route('view-group', $supplier->id) . '"> ' . $supplier->name . '</a>' : '';
            })
            ->make(true);
    }

    public function postSalesReport(Request $input)
    {
        $product_id = $input->get('product');
        $date = explode(' - ', $input->get('daterange'));
        $start_date = date('Y-m-d', strtotime($date[0]));
        $end_date = date('Y-m-d', strtotime($date[1]));
        $report = ActivityShipment::select('*')
            ->whereRaw("product_id=$product_id and date between '$start_date' and '$end_date'")
            ->get();
        return view('pages.reports.product-sale-report', array(
            'submitted' => true,
            'data' => $report
        ));
    }

    public function api_getShipmentList()
    {
        $data = Shipment::all();

        return \Datatables::of($data)
            ->addColumn('action', function ($shipment) {
                return '<a href="' . route('reports-view-invoice', $shipment->id) . '" class="btn btn-primary btn-xs"> Generate Invoice </a> ';
            })
            ->addColumn('date', function ($shipment) {
                $time = strtotime($shipment->created_at);
                return '<a class= "text-left" href="' . route('view-shipment', $shipment->id) . '">' . date('H:i:s D, d M Y', $time) . '</a>';
            })
            ->addColumn('customer', function ($shipment) {
                $customer = Customer::find($shipment->customer_id);
                $name = ($customer) ? "<a href='" . route('modify-customer', $customer->id) . "'>" . ucfirst($customer->name) . "</a>" : '<span class="fg-red">' . $shipment->customer . '</span>';
                return $name;
            })
            ->addColumn('products', function ($shipment) {
                return $shipment->getShipmentCount();
            })
            ->make(true);
    }

    public function view_shipmentInvoice($id)
    {
        $shipment = Shipment::find($id);
        if ( ! empty($shipment) or ! is_null($shipment)) {
            $activity = $shipment->getProductActivity();
            return view('pages.reports.invoices.generate', array('shipment' => $shipment, 'activity' => $activity));
        }
        return abort(404);
    }

    public function post_generateInvoice($id, Request $input)
    {
        $shipment = Shipment::find($id);
        if ( ! empty($shipment) or ! is_null($shipment)) {
            $sorter = array();
            $activity = $shipment->getProductActivity;
            foreach ($activity as $key => $value) {
                if(array_key_exists($value->product_id,$sorter)){
                    $sorter[$value->product_id]['quantity'] += $value->quantity;
                } else {
                    $sorter[$value->product_id] = $value;
                }
            }
            $data = array(
                'info' => $input->all(),
                'shipment' => $shipment,
                'activity' => $sorter
            );
            $pdf = \PDF::loadView('pages.reports.invoices.invoice', $data);
            return $pdf->download('invoice.pdf');
        }
    }
}
