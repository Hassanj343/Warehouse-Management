<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($product)
    {
        return datatables($product)
            ->addColumn('stock_available', function ($product) {
                return $product->quantity;
            })
            ->addColumn('action', function ($product) {
                $buttons = [
                    [
                        'title' => 'Modify',
                        'class' => 'btn btn-xs btn-primary btn-block',
                        'href' => route('modify-product', $product->id)
                    ],
                    [
                        'title' => 'Stock In',
                        'class' => 'btn btn-xs btn-success btn-block',
                        'href' => route('stock-in-product', $product->id)
                    ],
                    [
                        'title' => 'Stock Out',
                        'class' => 'btn btn-xs btn-primary btn-block',
                        'href' => route('stock-out-product', $product->id)
                    ],
                ];

                $html = '';
                foreach ($buttons as $btn) {
                    $html .= sprintf('<a class="%s" href="%s">%s</a>', $btn['class'], $btn['href'], $btn['title']);
                }
                return $html;
            })
            ->addColumn('cost_price', function ($product) {
                return sprintf("&pound; %s", number_format($product->purchase_price, 2, 0, 3));
            })
            ->addColumn('sale_price', function ($product) {
                return sprintf("&pound; %s", number_format($product->sale_price, 2, 0, 3));
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
            ->addColumn('group', function ($product) {
                return sprintf(
                    '<a href="%s" title="%s">%s</a>',
                    route('view-group', $product->group->id),
                    $product->group->name,
                    $product->group->name
                );
            })
            ->addColumn('supplier', function ($product) {
                return sprintf(
                    '<a href="%s" title="%s">%s</a>',
                    route('view-supplier', $product->supplier->id),
                    $product->supplier->name,
                    $product->supplier->name
                );
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()
            ->select(
                'id',
                'name',
                'barcode',
                'description',
                'options',
                'location',
                'purchase_price',
                'sale_price',
                'warning_id',
                'supplier_id',
                'group_id',
                'quantity'
            )->with('supplier', 'group');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'select',
            'name',
            'cost_price',
            'sale_price',
            'stock_available',
            'location',
            'group',
            'supplier',

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Products_' . date('YmdHis');
    }
}
