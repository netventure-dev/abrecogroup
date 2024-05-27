<?php

namespace App\DataTables\Admin;

use App\Models\MilestoneSetting;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MilestoneSettingDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('title', function (MilestoneSetting $milestone) {
                return $milestone->title;
            })
            ->editColumn('status', function (MilestoneSetting $milestone) {
                if ($milestone->status) {
                    return '<span class="btn btn-sm btn-success btn-rounded waves-effect waves-light">Active</span>';
                } else {
                    return '<span class="btn btn-sm btn-danger btn-rounded waves-effect waves-light">Inactive</span>';
                }
            })
            ->editColumn('color', function (MilestoneSetting $milestone) {
                $colorData = unserialize($milestone->color); // Unserialize color data
                $colorCode = reset($colorData); // Get the first color code from the unserialized data
                return '<div style="width: 20px; height: 20px; background-color: ' . $colorCode . '; border: 1px solid #000;"></div>';
            })

            ->addColumn('action', function (MilestoneSetting $new) {
                return view('admin.milestone.action', compact('new'));
            })
    
            ->rawColumns(['action','color','status']);
    }

    public function query(MilestoneSetting $model)
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

    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title(__('Sl No'))->searchable(false)->orderable(false),
            Column::make('title')->title(__('Title')),
            Column::make('status')->title(__('Status')),
            Column::make('color')->title(__('Color')),
            Column::computed('action')
                ->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
                ];
        
    }

    protected function filename()
    {
        return 'MilestoneSetting_' . date('YmdHis');
    }
}
