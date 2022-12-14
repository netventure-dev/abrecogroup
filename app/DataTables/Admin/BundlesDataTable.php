<?php

namespace App\DataTables\Admin;

use App\Models\Bundle;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BundlesDataTable extends DataTable
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
            ->editColumn('no_of_bundles', function (Bundle $bundle) {
                return $bundle->no_of_bundles;
            })
            ->editColumn('no_of_rods', function (Bundle $bundle) {
                return $bundle->no_of_rods;
            })
            ->addColumn('size_id', function (Bundle $bundle) {
                return $bundle->size_data->size;
            })
            ->editColumn('status', function (Bundle $bundle) {
                if ($bundle->status) {
                    return '<span class="btn btn-sm btn-success btn-rounded waves-effect waves-light">Active</span>';
                } else {
                    return '<span class="btn btn-sm btn-danger btn-rounded waves-effect waves-light">Inactive</span>';
                }
            })
            ->addColumn('action', function (Bundle $bundle) {
                return view('admin.bundles.action', compact('bundle'));
            })
            ->rawColumns(['action','status','size_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BundlesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Bundle $model)
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
                    ->setTableId('bundlesdatatable-table')
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
            Column::make('no_of_bundles')->title(__('No. of bundles')),
            Column::make('no_of_rods')->title(__('No. of rods')),
            Column::make('size_id')->title(__('Size')),
            Column::make('weight')->title(__('Weight')),
            Column::make('status')->title(__('Status')),
            // Column::make('role')->title(__('Role'))->orderable(false),
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
        return 'Bundles_' . date('YmdHis');
    }
}
