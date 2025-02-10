<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'model' => 'string',
        ]);

        $modelExport = "App\Exports\\" . $request->model . "Export";
        if (!class_exists($modelExport)) return redirect()->back()->with('error', __('adminlte::adminlte.model_export_not_exist'));
       return Excel::download(new $modelExport, 'all-' . Str::lower($request->model) . 's.xlsx');
        // return redirect()->back()->with('success', __('adminlte::adminlte.exported_successfully'));
    }
}
