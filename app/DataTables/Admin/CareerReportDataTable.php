<?php

namespace App\DataTables\Admin;

use App\Models\Career;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CareerReportDataTable extends DataTable
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
            ->editColumn('name', function (Career $new) {
                return $new->name;
            })
            ->editColumn('email', function (Career $new) {
                return $new->email;
            })
            ->editColumn('phone', function (Career $new) {
                return $new->phone;
            })
            ->editColumn('position', function (Career $new) {
                return $new->position;
            })
            ->addColumn('action', function (Career $new) {
                return view('admin.reports.career.action', compact('new'));
            })

            ->rawColumns(['title', 'phone', 'email','position','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CareerReportDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Career $model)
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
                    ->setTableId('careerreportdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('print')
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
            Column::make('email')->title(__('Email')),
            Column::make('phone')->title(__('Phone')),
            Column::make('position')->title(__('Position')),
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
        return 'CareerReport_' . date('YmdHis');
    }
}
