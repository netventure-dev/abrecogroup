<?php

namespace App\DataTables\Admin;

use App\Models\Quote;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RequestQuoteReportDataTable extends DataTable
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
            ->editColumn('name', function (Quote $new) {
                return $new->name;
            })
            ->editColumn('service', function (Quote $new) {

                return $new->service;
            })
            ->editColumn('phone', function (Quote $new) {
                return $new->phone;
            })
            ->editColumn('created_at', function (Quote $new) {
                return $new->created_at->format('Y-m-d');
            })
            ->addColumn('action', function (Quote $new) {
                return view('admin.reports.action', compact('new'));
            })

            ->rawColumns(['name', 'service', 'phone', 'created_at','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RequestQuoteReportDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Quote $model)
    {
        // return $model->with('service_doc')->newQuery();
        return $model->with('service_doc')
                ->orderBy('created_at', 'desc')
                ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('requestquotereportdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->buttons(
                        // Button::make('create'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('print'),
                        // Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title(__('Sl No'))->searchable(false)->orderable(false)->addClass('no-sort'),
            Column::make('name')->title(__('Name'))->orderable(false),
            Column::make('service')->title(__('Service'))->orderable(false),
            Column::make('phone')->title(__('Phone'))->orderable(false),
            Column::make('created_at')->title(__('Date'))->orderable(false),
            Column::make('email')->title(__('Email'))->orderable(false),
            // Column::make('type')->title(__('Type')),
            Column::computed('action')
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
        return 'RequestQuoteReport_' . date('YmdHis');
    }
}
