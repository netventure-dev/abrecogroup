<?php

namespace App\DataTables\Admin;

use App\Models\Feedback;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FeedbackReportDataTable extends DataTable
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
            ->editColumn('name', function (Feedback $new) {
                return $new->name;
            })
            ->editColumn('email', function (Feedback $new) {
                return $new->email;
            })
            ->editColumn('phone', function (Feedback $new) {
                return $new->phone;
            })

            ->rawColumns(['title', 'image', 'status']);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Feedback $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Feedback $model)
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
                    ->setTableId('feedbackreportdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()

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
            Column::make('name')->title(__('Name'))->orderable(false),
            Column::make('email')->title(__('Email'))->orderable(false),
            Column::make('phone')->title(__('Phone'))->orderable(false),
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'FeedbackReport_' . date('YmdHis');
    }
}
