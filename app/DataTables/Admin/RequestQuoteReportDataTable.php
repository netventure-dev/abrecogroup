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

                return $new->service_doc->name;
            })
            ->editColumn('phone', function (Quote $new) {
                return $new->phone;
            })

            ->rawColumns(['title', 'image', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RequestQuoteReportDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Quote $model)
    {
        return $model->with('service_doc')->newQuery();
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
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
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
            Column::make('DT_RowIndex')->title(__('Sl No'))->searchable(false)->orderable(false),
            Column::make('name')->title(__('Name')),
            Column::make('service')->title(__('Service')),
            Column::make('phone')->title(__('Phone')),
            Column::make('location')->title(__('Location')),
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
