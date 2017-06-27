<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Product;

class ExportController extends Controller {

	public function getExportProducts(){
		return view('pages.export.products');
	}


	public function postExportProducts(Request $request){
		$data = Product::all();
		$exportType = $request->get('exportFormat');
		switch ($exportType) {
			case 'csv':
				return $this->exportCSV($data);
				break;
		}
		return dd($data);
	}
	public function parseProducts($data){
		$return_data = [];
		foreach($data as $product){
			$price = unserialize($product->price);
			$sect = substr($product->name, 0,strpos($product->name, '/'));
			$profile = substr($product->name, strpos($product->name, '/')+1 ,strpos($product->name, '/',1)-1);
			$rim = substr($product->name, strpos($product->name, '/',1) +1 ,strpos($product->name, '/',2)-1);


			$return_data [] = [
				'Stock Code' => $product->getBarcode(),
				'Description' => $product->description,
				'Manufacturer' => null,
				'Sect' => $sect,
				'Profile' => $profile,
				'Rim' => $rim,
				'Speed Rating' => null,
				'Load Index' => null,
				'Price' => number_format((double) $price['sale_price'],2),
				'Image' => $product->image ? asset($product->image) : '',
				'condition' => str_replace("-", " ", $product->type),
				'Quantity' => $product->quantity,
 			];
		}
		return $return_data;
	}
	public function exportCSV($data){

		$product_data = $this->parseProducts($data);
		return \Excel::create('warehousemanagement_products',function($excel) use($product_data){
			/*
				Stock Code	Description	Manufacturer	Sect	Profile	Rim	Speed Rating	Load Index	Price
			*/
			$excel->sheet('products', function($sheet) use($product_data) {

		        $sheet->fromArray($product_data);

		    });

		})->export('csv');
	}
}
