<?php

namespace App\DataTables\Admin;

use App\Models\CareerOpening;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CareerOpeningDataTable extends DataTable
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
        ->editColumn('position', function (CareerOpening $new) {
            return $new->position;
        })
        ->editColumn('description', function (CareerOpening $new) {
            return @$new->description;
        })
        ->editColumn('experience', function (CareerOpening $new) {
            return @$new->experience;
        })


        ->editColumn('status', function (CareerOpening $new) {
                if ($new->status) {
                    return '<span class="btn btn-sm btn-success btn-rounded waves-effect waves-light">Active</span>';
                } else {
                    return '<span class="btn btn-sm btn-danger btn-rounded waves-effect waves-light">Inactive</span>';
                }
            })
        ->addColumn('action', function (CareerOpening $career) {
            return view('admin.career-opening.action', compact('career'));
        })

        ->rawColumns(['position','description','status','experience']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CareerOpeningDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CareerOpening $model)
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
                    ->setTableId('careeropeningdatatable-table')
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
            Column::make('position')->title(__('Position')),
            Column::make('description')->title(__('Description')),
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
        return 'CareerOpening_' . date('YmdHis');
    }
}
