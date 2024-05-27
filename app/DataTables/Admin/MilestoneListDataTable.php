<?php

namespace App\DataTables\Admin;

use App\Models\MilestoneList;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MilestoneListDataTable extends DataTable
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
        ->editColumn('title', function (MilestoneList $milestone) {
            return $milestone->title;
        })
        ->editColumn('logo', function (MilestoneList $milestone) {
            if ($milestone->logo) {
                $url = asset('storage/' . $milestone->logo);
                $d = '<img class="rounded avatar-md" src="' . $url . '" border="0" width="70" height="60" class="img-rounded" align="center" /> ';
                return $d;
            }
            else{
                $url = asset('assets/images/no_image.png');
                $d = '<img class="rounded avatar-md" src="' . $url . '" border="0" width="70" height="60" class="img-rounded" align="center" /> ';
                return $d;
            }
        })

        ->addColumn('action', function (MilestoneList $new) {
            return view('admin.milestone.list.action', compact('new'));
        })


        ->rawColumns(['title','logo','action']);
    }
    
        public function query(MilestoneList $model)
        {
            return $model->newQuery();
        }
  

        public function html()
        {
            return $this->builder()
                        ->setTableId('milestonesetting-table')
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
            Column::make('logo')->title(__('Logo')),
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
        return 'Admin/MilestoneList_' . date('YmdHis');
    }
}
