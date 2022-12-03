<?php

namespace App\DataTables\Admin;

use App\Models\SaleDifficulty;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalesDifficultyDataTable extends DataTable
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
            ->editColumn('name', function (SaleDifficulty $sale_difficulty) {
                return $sale_difficulty->name;
            })
            ->addColumn('point', function (SaleDifficulty $sale_difficulty) {
                return $sale_difficulty->point;
            })
            ->addColumn('action', function (SaleDifficulty $sale_difficulty) {
                return view('admin.sales_difficulty.action', compact('sale_difficulty'));
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SalesDifficultyDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SaleDifficulty $model)
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
                    ->setTableId('salesdifficultydatatable-table')
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
            Column::make('point')->title(__('Point')),
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
        return 'SalesDifficulty_' . date('YmdHis');
    }
}
