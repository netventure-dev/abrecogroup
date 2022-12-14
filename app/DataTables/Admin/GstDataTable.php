<?php

namespace App\DataTables\Admin;



use App\Models\Gst;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GstDataTable extends DataTable
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
            ->editColumn('gst', function (Gst $gst) {
                return $gst->gst;
            })
            ->editColumn('status', function (Gst $gst) {
                if ($gst->status) {
                    return '<span class="btn btn-sm btn-success btn-rounded waves-effect waves-light">Active</span>';
                } else {
                    return '<span class="btn btn-sm btn-danger btn-rounded waves-effect waves-light">Inactive</span>';
                }
            })
            // ->addColumn('action', function (Size $size) {
            //     return view('admin.size.action', compact('size'));

            ->rawColumns(['status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin/GstDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Gst $model)
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
            ->setTableId('gstdatatable-table')
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
            Column::make('gst')->title(__('Gst percentage')),
            Column::make('status')->title(__('Status')),
            // Column::make('role')->title(__('Role'))->orderable(false),
            // Column::computed('action')
            //     ->title(__('Action'))
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/Gst_' . date('YmdHis');
    }
}
