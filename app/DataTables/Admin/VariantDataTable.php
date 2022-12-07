<?php

namespace App\DataTables\Admin;

use App\Models\Variant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VariantDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('name', function (Variant $model) {
                return $model->name;
            })
            ->editColumn('offer', function (Variant $model) {
                return $model->offer;
            })
            ->editColumn('on_road_price', function (Variant $model) {
                return $model->on_road_price;
            })
            ->editColumn('brand_id', function (Variant $model) {
                if(isset($model->brand_data)){
                 
                    return @$model->brand_data->name;

                }
            })
            ->editColumn('sub_model_id', function (Variant $model) {
                if(isset($model->sub_model_data)){
                    return @$model->sub_model_data->name;

                }
            })
            ->editColumn('fuel_id', function (Variant $model) {
                if(isset($model->fuel_type)){
                    return @$model->fuel_type->name;

                }
            })
            ->editColumn('status', function (Variant $model) {
                if ($model->status) {
                    return '<span class="btn btn-sm btn-success btn-rounded waves-effect waves-light">Active</span>';
                } else {
                    return '<span class="btn btn-sm btn-danger btn-rounded waves-effect waves-light">Inactive</span>';
                }
            })
            ->addColumn('action', function (Variant $model) {
                return view('admin.variants.action', compact('model'));
            })
            ->rawColumns(['action','status','name','sub_model_id','fuel_id','brand_id','offer','on_road_price']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\VariantDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Variant $model)
    {
        return $model->with('brand_data','sub_model_data','fuel_type')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('variantdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title(__('Sl No'))->searchable(false)->orderable(false),
            Column::make('name')->title(__('Name')),
            Column::make('brand_id')->title(__('Band')),
            Column::make('sub_model_id')->title(__('Sub Model')),
            Column::make('fuel_id')->title(__('Fuel Type')),
            Column::make('on_road_price')->title(__('On Road Price')),
            Column::make('offer')->title(__('Offer')),
            Column::make('status')->title(__('Status'))->orderable(false),
            Column::computed('action')
                ->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Variant_' . date('YmdHis');
    }
}
