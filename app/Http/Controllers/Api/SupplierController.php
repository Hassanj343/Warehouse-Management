<?php

namespace App\Http\Controllers\Api;

use App\DataTables\SupplierDataTable;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use HtmlGenerator\HtmlTag;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function list(SupplierDataTable $dataTable)
    {


        $data = Supplier::select(['id', 'name', 'contact_id'])->with('contact')->get();
        return \DataTables::of($data)
            ->blacklist(['select', 'action'])
            ->addColumn('select', function ($supplier) {
                return '<div class="checkbox-custom mb5">
                    <input id="deleteSupplier-' . $supplier->id . '" class="multiDeleteSupplier" onchange="countSelected()" name="supplier-' . $supplier->id . '" type="checkbox" class="deleteSupplier" value="' . $supplier->id . '">
                    <label for="deleteSupplier-' . $supplier->id . '"></label>
                </div>';
            })
            ->addColumn('address', function ($supplier) {
                $address = sprintf("
                        <strong>Line 1:</strong> %s <br> 
                        <strong>Line 2:</strong> %s <br> 
                        <strong>City</strong>:%s <br> 
                        <strong>County</strong>: %s <br> 
                        <strong>Postcode:</strong> %s",
                    $supplier->contact->line_1,
                    $supplier->contact->line_2,
                    $supplier->contact->city,
                    $supplier->contact->county,
                    $supplier->contact->postcode
                );
                return $address;
            })
            ->addColumn('email', function ($supplier) {
                return $supplier->contact->email;
            })
            ->addColumn('mobile', function ($supplier) {
                return $supplier->contact->mobile_1;
            })
            ->addColumn('action', function ($supplier) {
                $html_tag = HtmlTag::createElement('a');
                $html_tag->set('href', route('modify-supplier', $supplier->id))
                    ->set('class', 'btn btn-primary')
                    ->text("Edit");
                return $html_tag;
            })
            ->removeColumn('contact')
            ->make(true);

    }

    public function bulkDelete(Request $request)
    {
        $ids = array();
        foreach ($request->all() as $name => $id) {
            $ids[] = $id;
            $products = Product::where('supplier_id', '=', $id);
            foreach ($products as $key => $val) {
                $val->supplier_id = null;
                $val->save();
            }
        }

        $destroy = Supplier::destroy($ids);
        if ($destroy) {
            return response(array(
                'result' => 'success',
                'message' => count($ids) . ' Suppliers deleted successfully'
            ));
        }
        return response(array(
            'result' => 'error',
            'message' => \Lang::get('messages.general-error')
        ));

    }
}
