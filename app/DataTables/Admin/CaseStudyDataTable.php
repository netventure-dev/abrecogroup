<?php

namespace App\DataTables\Admin;

use App\Models\CaseStudy;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CaseStudyDataTable extends DataTable
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
            ->editColumn('status', function (CaseStudy $case) {
                if ($case->status) {
                    return '<span class="btn btn-sm btn-success btn-rounded waves-effect waves-light">Active</span>';
                } else {
                    return '<span class="btn btn-sm btn-danger btn-rounded waves-effect waves-light">Inactive</span>';
                }
            })
            ->editColumn('service_id', function (CaseStudy $case) {

                return @$case->service_name->name;
            })
            ->editColumn('sub_service_id', function (CaseStudy $case) {

                return @$case->sub_service->name;
            })
            ->editColumn('inner_service_id', function (CaseStudy $case) {

                return @$case->inner_service->name;
            })

            ->addColumn('action', function (CaseStudy $case) {
                return view('admin.casestudy.action', compact('case'));
            })


            ->rawColumns(['status','action','service']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CaseStudyDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CaseStudy $model)
    {
        return $model->with('service_name','sub_service','inner_service')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('casestudydatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('print'),
                        // Button::make('reset'),
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
            Column::make('title')->title(__('Title')),
            Column::make('order')->title(__('Order')),
            // Column::make('service')->title(__('Service')),
            Column::make('service_id')->title(__('Service')),
            Column::make('sub_service_id')->title(__('Sub Service')),
            Column::make('inner_service_id')->title(__('Inner Service')),

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
        return 'CaseStudy_' . date('YmdHis');
    }
}
