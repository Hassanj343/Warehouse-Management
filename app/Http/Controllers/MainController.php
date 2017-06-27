<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\ActivityShipment;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Http\Request;


class MainController extends Controller
{

    public function homepage()
    {
        return view('index');
    }

    public function get_search(Request $input)
    {
        $customers = \Searchy::search('customers')
            ->fields('name')
            ->query($input->get('search'))
            ->get();
        $groups = \Searchy::search('groups')
            ->fields('name')
            ->query($input->get('search'))
            ->get();
        $products = \Searchy::search('products')
            ->fields('name')
            ->query($input->get('search'))
            ->get();
        $oldInput = $input->get('search');
        array_splice($customers, 10);
        array_splice($groups, 10);
        array_splice($products, 10);
        return view('pages.search', compact('customers', 'groups', 'products', 'oldInput'));
    }

    public function get_trendingProducts($range = 'month', $max_query_result = 5)
    {
        $start_date = date('Y-m-d', strtotime('-1 ' . $range));
        $end_date = date('Y-m-d');
        $activity = ActivityShipment::select('*', \DB::raw('SUM(quantity) AS quantity_sold'))
            ->groupBy('product_id')
            ->orderByRaw('SUM(quantity) desc')
            ->whereRaw("date between '$start_date' and '$end_date'")
            ->take($max_query_result)
            ->get();
        $products = array();
        foreach ($activity as $key => $value) {
            $product = $value->getProduct;
            if ($product) {
                $products[] = array(
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'quantity_sold' => $value->quantity_sold,
                    'barcode' => $product->barcode,
                    'quantity' => $product->quantity,
                );
            }
        }
        return $products;

    }

    public function get_trendingProductsChart($range = 'month')
    {
        $data = $this->get_trendingProducts($range, 10);
        $returnData = array();
        foreach ($data as $key => $val) {
            $returnData[] = array($val['name'], (int) $val['quantity_sold']);
        }
		if(count($returnData) > 0){
			$data_selected = $returnData[0];
			$returnData[0] = array(
				'name' => $data_selected[0],
				'y' => $data_selected[1],
				'sliced' => true,
				'selected' => true
			);
		}
        
        return $returnData;

    }

    function dates_month($month, $year)
    {
        $num = date('t', strtotime('1-' . $month . '-' . $year));
        $dates_month = array();
        for ($i = 1; $i <= $num; $i++) {
            $dates_month[] = $i;
        }
        return $dates_month;
    }

    public function get_salesAnalytic($range = 'month')
    {
        $strings = array(
            'week' => array(
                'current' => array('monday this week', 'sunday this week'),
                'previous' => array('monday previous week', 'sunday previous week'),
            ),
            'month' => array(
                'current' => array('first day of this month', 'last day of this month'),
                'previous' => array('first day of previous month', 'last day of previous month'),
            ),
            'year' => array(
                'current' => array('first day of january this year', 'last day of december this year'),
                'previous' => array('first day of january previous year', 'last day of december previous year'),
            ),
        );
        $start_date = date('Y-m-d', strtotime($strings[$range]['current'][0]));
        $end_date = date('Y-m-d', strtotime($strings[$range]['current'][1]));
        $previous_start_date = date('Y-m-d', strtotime($strings[$range]['previous'][0]));
        $previous_end_date = date('Y-m-d', strtotime($strings[$range]['previous'][1]));

        $current = ActivityShipment::select('date', \DB::raw('SUM(quantity) as total'))
            ->whereRaw("date between '$start_date' and '$end_date'")
            ->groupBy('date')
            ->get();
        $previous = ActivityShipment::select('date', \DB::raw('SUM(quantity) as total'))
            ->whereRaw("date between '$previous_start_date' and '$previous_end_date'")
            ->groupBy('date')
            ->get();

        $date_type = array(
            'week' => 'l',
            'month' => 'm',
            'year' => 'F'
        );

        $result = array('current' => array(), 'previous' => array());
        switch ($range) {
            case 'week':
                $labels = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
                $current_info = array_fill(0, 7, 0);
                $previous_info = array_fill(0, 7, 0);
                break;
            case 'month':
                $labels = $this->dates_month(date('m'), date('Y'));
                $current_info = array_fill(0, date('t'), 0);
                $previous_info = array_fill(0, date('t', strtotime('first day of previous month')), 0);
                break;
            case 'year':
                $current_info = array_fill(0, 12, 0);
                $previous_info = array_fill(0, 12, 0);
                $labels = array('January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December');
                break;
        }

        foreach ($current as $sale => $record) {
            $curr_day = date($date_type[$range], strtotime($record->date));
            foreach ($labels as $lid => $label_data) {
                if ($label_data == $curr_day) {
                    $current_info[$lid] = $current_info[$lid] + $record->total;
                }
            }
        }
        foreach ($previous as $sale => $record) {
            $curr_day = date($date_type[$range], strtotime($record->date));
            foreach ($labels as $lid => $label_data) {
                if ($label_data == $curr_day) {
                    $previous_info[$lid] = $previous_info[$lid] + $record->total;
                }
            }
        }
        $result['labels'] = $labels;
        $result['current'] = $current_info;
        $result['previous'] = $previous_info;
        return response($result);
    }

    public function get_dashboardTiles()
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('yesterday'));
        $total_products_today = $total_products_yesterday = 0;
        $products_sold_today = ActivityShipment::select('*')
            ->whereRaw("date between '$today' and '$today'")
            ->get();

        foreach ($products_sold_today as $key => $val) {
            $total_products_today += (int) $val->quantity;

        }
        $shipment_today = Shipment::select('*')->whereRaw("date between '$today' and '$today'")->get()->count();

        $products_out_of_stock = Product::select('*')->where('quantity', '<=', '0')->get()->count();
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
            if ($product->quantity >= $warnings['warning_3']) {
                unset($products[$key]);
            }
        }
        return array(
            'products_today' => $total_products_today,

            'shipment_today' => $shipment_today,

            'products_out_stock' => $products_out_of_stock,
            'products_low_stock' => $products->count(),

        );
    }

    public function get_productStockChart()
    {
        $return_data = array();
        $product_all = Product::all();
        $product_lowStock = array();
        $product_outStock = array();
        $defaultwarnings = array(
            'warning_1' => \HelperFunctions::getSettings('warning-level-1'),
            'warning_2' => \HelperFunctions::getSettings('warning-level-2'),
            'warning_3' => \HelperFunctions::getSettings('warning-level-3'),
        );
        foreach ($product_all as $key => $product) {
            $warnings = (array) unserialize($product->warning);
            if (empty($product->warning)) {
                $warnings = $defaultwarnings;
            }
            if ($product->quantity <= 0) {
                $product_outStock[] = $product;
                unset($product_all[$key]);
            } else if ($product->quantity <= $warnings['warning_3']) {
                $product_lowStock[] = $product;
                unset($product_all[$key]);
            }
        }
        $return_data = array(
            array(
                'Products In Stock', count($product_all) ? count($product_all) : 0
            ),
            array(
                'Products Low Stock', count($product_lowStock) ? count($product_lowStock) : 0
            ),
            array(
                'Products Out of Stock', count($product_outStock) ? count($product_outStock) : 0
            ),
        );
        return $return_data;
    }
}
