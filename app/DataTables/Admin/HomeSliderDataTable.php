<?php

namespace App\DataTables\Admin;

use App\Models\HomeSlider;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HomeSliderDataTable extends DataTable
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
        ->editColumn('title', function (HomeSlider $new) {
            return $new->title;
        })
        ->editColumn('link', function (HomeSlider $new) {
            return @$new->link;
        })
       
        ->editColumn('status', function (HomeSlider $new) {
                if ($new->status) {
                    return '<span class="btn btn-sm btn-success btn-rounded waves-effect waves-light">Active</span>';
                } else {
                    return '<span class="btn btn-sm btn-danger btn-rounded waves-effect waves-light">Inactive</span>';
                }
            })
        ->addColumn('action', function (HomeSlider $slider) {
            return view('admin.home-slider.action', compact('slider'));
        })

        ->rawColumns(['title','action','image','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\HomeSliderDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HomeSlider $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('homesliderdatatable-table')
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
            Column::make('title')->title(__('Title')),
            Column::make('link')->title(__('Link')),
            Column::make('status')->title(__('Status')),
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
        return 'HomeSlider_' . date('YmdHis');
    }
}
