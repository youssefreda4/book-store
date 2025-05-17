<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
            'model' => 'string',
        ]);

        $modelImport = "App\Imports\\".$request->model.'Import';
        if (! class_exists($modelImport)) {
            return redirect()->back()->with('error', __('adminlte::adminlte.model_import_not_exist'));
        }
        Excel::import(new $modelImport, $request->file('file'));

        return redirect()->back()->with('success', __('adminlte::adminlte.imported_successfully'));
    }
}
