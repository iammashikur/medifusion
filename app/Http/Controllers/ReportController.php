<?php

namespace App\Http\Controllers;

use App\DataTables\ReportDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(ReportDataTable $reportDataTable)
    {
        return $reportDataTable->render('admin.report_all');
    }
}
