<?php

namespace App\DataTables\Admin;

use App\Models\AboutUsList;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AboutUsListDataTable extends DataTable
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
        ->editColumn('title', function (AboutUsList $new) {
            return $new->title;
        })
        ->editColumn('status', function (AboutUsList $new) {
                if ($new->status) {
                    return '<span class="btn btn-sm btn-success btn-rounded waves-effect waves-light">Active</span>';
                } else {
                    return '<span class="btn btn-sm btn-danger btn-rounded waves-effect waves-light">Inactive</span>';
                }
            })
            ->editColumn('icon', function (AboutUsList $new) {
            if ($new->icon) {
                $url = asset('storage/' . $new->icon);
                $d = '<img class="rounded avatar-md" src="' . $url . '" border="0" width="70" height="60" class="img-rounded" align="center" /> ';
                return $d;
            }
            else{
                $url = asset('assets/images/no_image.png');
                $d = '<img class="rounded avatar-md" src="' . $url . '" border="0" width="70" height="60" class="img-rounded" align="center" /> ';
                return $d;
            }
        })
        ->addColumn('action', function (AboutUsList $new) {
            return view('admin.about-us.list.action', compact('new'));
        })

        ->rawColumns(['title','action','icon','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AboutUsListDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AboutUsList $model)
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
                    ->setTableId('aboutuslistdatatable-table')
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
            Column::make('icon')->title(__('Icon')),
            Column::make('status')->title(__('Status')),
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
        return 'AboutUsList_' . date('YmdHis');
    }
}
