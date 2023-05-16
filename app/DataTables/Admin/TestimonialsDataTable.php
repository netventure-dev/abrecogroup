<?php

namespace App\DataTables\Admin;

use App\Models\Testimonial;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TestimonialsDataTable extends DataTable
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
        ->editColumn('title', function (Testimonial $new) {
            return $new->title;
        })
        ->editColumn('status', function (Testimonial $new) {
                if ($new->status) {
                    return '<span class="btn btn-sm btn-success btn-rounded waves-effect waves-light">Active</span>';
                } else {
                    return '<span class="btn btn-sm btn-danger btn-rounded waves-effect waves-light">Inactive</span>';
                }
            })
            ->editColumn('image', function (Testimonial $new) {
            if ($new->image) {
                $url = asset('storage/' . $new->image);
                $d = '<img class="rounded avatar-md" src="' . $url . '" border="0" width="70" height="60" class="img-rounded" align="center" /> ';
                return $d;
            }
            else{
                $url = asset('assets/images/no_image.png');
                $d = '<img class="rounded avatar-md" src="' . $url . '" border="0" width="70" height="60" class="img-rounded" align="center" /> ';
                return $d;
            }
        })
        ->addColumn('action', function (Testimonial $new) {
            return view('admin.testimonials.action', compact('new'));
        })

        ->rawColumns(['title','action','image','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TestimonialsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Testimonial $model)
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
                    ->setTableId('testimonialsdatatable-table')
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
            Column::make('position')->title(__('Position')),
            Column::make('image')->title(__('Image')),
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
        return 'Testimonials_' . date('YmdHis');
    }
}
