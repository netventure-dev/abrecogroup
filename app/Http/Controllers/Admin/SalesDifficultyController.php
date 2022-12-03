<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SalesDifficultyDataTable;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SalesDifficultyController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(SalesDifficultyDataTable $dataTable)
    {
        // $this->authorize('viewAny', Admin::class);
        $user = auth()->guard('admin')->user();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Sales Difficulty', route('admin.sales-difficulty.index')],
        ];
        return $dataTable->render('admin.sales_difficulty.index', ['user' => $user, 'breadcrumbs' =>$breadcrumbs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Sales Difficulty', route('admin.sales-difficulty.index')],
            ['Create', route('admin.sales-difficulty.create')],
        ];
        return view('admin.sales_difficulty.create', compact('breadcrumbs'));
    }
}
