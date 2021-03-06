<?php

namespace App\DataTables;

use App\Models\Supplier;
use HtmlGenerator\HtmlTag;
use Yajra\DataTables\Services\DataTable;

class SupplierDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->blacklist(['select'])
            ->editColumn('name', function ($query) {
                return HtmlTag::createElement('a')
                    ->set('title', $query->name)
                    ->set('href', route('modify-supplier', $query))
                    ->text($query->name);
            })
            ->addColumn('select', function ($query) {
                return '<div class="checkbox-custom mb5">
                    <input id="deleteSupplier-' . $query->id . '" class="multiDeleteSupplier" onchange="countSelected()" name="supplier-' . $query->id . '" type="checkbox" class="deleteSupplier" value="' . $query->id . '">
                    <label for="deleteSupplier-' . $query->id . '"></label>
                </div>';
            })
            ->addColumn('address', function ($query) {
                return sprintf("%s<br>%s", $query->contact->line_1, $query->contact->line_2);
            })
            ->addColumn('postcode', function ($query) {
                return $query->contact->postcode;
            })
            ->addColumn('city', function ($query) {
                return $query->contact->city;
            })
            ->addColumn('county', function ($query) {
                return $query->contact->county;
            })->addColumn('email', function ($query) {
                return $query->contact->email;
            })->addColumn('mobile', function ($query) {
                return $query->contact->mobile_1;
            })
            ->addColumn('products_supplied', function ($query) {
                return $query->products->count();
            })->addColumn('action', function ($query) {
                $html = HtmlTag::createElement('div')
                    ->set('class', 'btn-group');
                $edit_button = $html->addElement('a')
                    ->set('href', route('modify-supplier', $query->id))
                    ->set('class', 'btn btn-primary btn-xs  btn-block')
                    ->text('<i class="fa fa-pencil"></i> Edit');
                $delete_button = $html->addElement('button')
                    ->set('class', 'btn btn-danger btn-xs  btn-block btn-delete-item')
                    ->set('data-target', route('delete-supplier', $query->id))
                    ->set('onclick', 'deleteSupplier(this,\'' . $query->name . '\')')
                    ->text('<i class="fa fa-trash"></i> Delete');
                return $html;
            })->removeColumn('contact');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Supplier $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Supplier $model)
    {
        return $model->newQuery()->select('id', 'name', 'contact_id')->with('contact');
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
            ->addAction(['printable' => false,])
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
            'name',
            'email',
            'mobile',
            'address',
            'county',
            'city',
            'postcode',
            'products_supplied',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Supplier_' . date('YmdHis');
    }
}
