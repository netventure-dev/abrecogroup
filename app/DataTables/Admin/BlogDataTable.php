<?php

namespace App\DataTables\Admin;


use App\Models\Bloglist;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogDataTable extends DataTable
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
            ->editColumn('title', function (Bloglist $new) {
                return $new->title;
            })
          

            ->editColumn('status', function (Bloglist $new) {
                if ($new->status) {
                    return '<span class="btn btn-sm btn-success btn-rounded waves-effect waves-light">Active</span>';
                } else {
                    return '<span class="btn btn-sm btn-danger btn-rounded waves-effect waves-light">Inactive</span>';
                }
            })
            ->addColumn('action', function (Bloglist $blog) {
                return view('admin.bloglist.action', compact('blog'));
            })

            ->rawColumns(['title', 'action', 'image', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin/BlogDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Bloglist $model)
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
                    ->setTableId('blogdatatable-table')
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
            // Column::make('link')->title(__('Link')),
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
        return 'Admin/Blog_' . date('YmdHis');
    }
}
