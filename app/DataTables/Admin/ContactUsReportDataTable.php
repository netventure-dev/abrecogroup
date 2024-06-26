<?php

namespace App\DataTables\Admin;

use App\Models\Contact;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContactUsReportDataTable extends DataTable
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
            ->editColumn('name', function (Contact $new) {
                return $new->name;
            })
            ->editColumn('email', function (Contact $new) {
                return $new->email;
            })
            ->editColumn('phone', function (Contact $new) {
                return $new->phone;
            })
            ->editColumn('refer', function (Contact $new) {
                return $new->refer;
            })
            ->addColumn('action', function (Contact $new) {
                return view('admin.reports.contact_action', compact('new'));
            })

            ->rawColumns(['name', 'email', 'phone', 'refer']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ContactUsReportDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contact $model)
    {
        return $model->orderBy('created_at', 'desc')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('contactusreportdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->buttons(
                Button::make('excel'),
                Button::make('csv'),
                Button::make('print'),
                // Button::make('reset'),

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
            // Column::make('email')->title(__('Email'))->orderable(false),
            Column::make('phone')->title(__('Phone'))->orderable(false),
            // Column::make('organization')->title(__('Organization'))->orderable(false),
            Column::make('job')->title(__('Job'))->orderable(false),
            Column::make('reason')->title(__('Reason'))->orderable(false),
            Column::make('refer')->title(__('From'))->orderable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            // Column::make('message')->title(__('Message')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ContactUsReport_' . date('YmdHis');
    }
}
