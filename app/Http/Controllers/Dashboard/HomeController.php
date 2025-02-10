<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function changeLanguage($lang)
    {
        if (in_array($lang, ['en', 'ar'])) {
            Session::put('locale', $lang);
        }
        return redirect()->back();
    }

    public function bulkDelete()
    {
        $ids = request()->input('ids');
        $model = 'App\Models\\' . request()->model;
        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' =>  __('adminlte::adminlte.no_items_selected_for_deletion')
            ]);
        }

        try {
            $model::whereIn('id', $ids)->delete();
            return response()->json([
                'success' =>  __('adminlte::adminlte.succes'),
                'message' => __('adminlte::adminlte.succes_selected')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' =>  __('adminlte::adminlte.error_selected')
            ]);
        }
    }
}
