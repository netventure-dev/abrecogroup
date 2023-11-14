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
        ->addColumn('action', function (Contact $new) {
            return view('admin.reports.contact_action', compact('new'));
        })

        ->rawColumns(['title','image','status']);
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
            // Column::make('email')->title(__('Email')),
            Column::make('phone')->title(__('Phone')),
            // Column::make('organization')->title(__('Organization')),
            Column::make('job')->title(__('Job')),
            Column::make('refer')->title(__('From')),
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
