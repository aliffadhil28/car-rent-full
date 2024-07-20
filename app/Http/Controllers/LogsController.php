<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\LogsDataTable;

class LogsController extends Controller
{
    public function index(LogsDataTable $dataTable)
    {
        return $dataTable->render('logs.index');
    }
}
