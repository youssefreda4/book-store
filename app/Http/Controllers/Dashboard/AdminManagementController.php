<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminManagementRequest;
use App\Http\Requests\AdminUpdateManagmentRequest;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = Admin::filter(request()->all())
            ->latest('id')
            ->paginate();
        return view('dashboard.admin-management.index', compact('admins'));
    }
    public function show(Admin $admin)
    {
        return view('dashboard.admin-management.show', compact('admin'));
    }


    public function create()
    {
        return view('dashboard.admin-management.create');
    }

    public function store(AdminManagementRequest $request)
    {
        $data = $request->validated();
        Admin::create($data);
        return redirect()->route('dashboard.admins.index')->with('success', __('admin.admin_created_successfully'));
    }

    public function edit(Admin $admin)
    {
        return view('dashboard.admin-management.edit', compact('admin'));
    }

    public function update(AdminUpdateManagmentRequest $request, Admin $admin)
    {
        $data = $request->validated();

        if ($request->password == null && $request->password_confirmation == null) {
            $data = Arr::except($request->validated(), ['password', 'password_confirmation']);
        }
        $admin->update($data);
        return redirect()->route('dashboard.admins.index')->with('success', __('admin.admin_updated_successfully'));
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('dashboard.admins.index')->with('success', __('admin.admin_deleted_successfully'));
    }
}
