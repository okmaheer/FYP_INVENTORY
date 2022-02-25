<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public $model;

    public function __construct(Role $role)
    {
        $this->middleware('auth');
        $this->model = $role;
    }

    public function index()
    {
        $this->authorize('view',$this->model);

        $roles = $this->model->get();
        $page_title = 'User Roles';
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'User Roles' => '',
        ]);
        return view('dashboard.accounts.roles.index', compact('page_title', 'breadcrumbs', 'roles'));
    }

    public function create()
    {
        $this->authorize('create',$this->model);

        $users = User::where('id', '>', 1)->pluck('name', 'id');
        $models = Permission::query()->distinct()->pluck('model');

        $page_title = 'New User Roles';
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'User Roles' => route('dashboard.accounts.roles.index'),
            'New User Role' => ''
        ]);

        return view('dashboard.accounts.roles.create', compact('page_title', 'breadcrumbs', 'users', 'models'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create',$this->model);
        $request->validate([
            'name' => 'unique:roles,name',
            'label' => 'unique:roles,label',
        ]);
        $this->model = $this->model->create($request->all());
        if ($this->model) {
            if ($request->has('permissions')) {
                $permissions = $request->get('permissions', array());
                $this->model->permissions()->sync($permissions);
            }
            if ($request->has('users')) {
                $users = $request->get('users', array());
                $this->model->users()->sync($users);
            }
        }
        return redirect()->route('dashboard.accounts.roles.index')->with('success', 'Role is Created Successfully.');
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('edit',$this->model);

        if ($id == 1) {
            abort(403); //restrict editing of admin role
        }

        $model = $this->model->find($id);
        $rolePermissions = $model->permissions()->get()->pluck('id');
        $users = User::where('id', '>', 1)->pluck('name', 'id');
        $models = Permission::query()->distinct()->pluck('model');

        $page_title = 'Edit User Roles';
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'User Roles' => route('dashboard.accounts.roles.index'),
            'Edit User Role' => ''
        ]);

        return view('dashboard.accounts.roles.edit', compact('page_title', 'breadcrumbs', 'model', 'models', 'users', 'rolePermissions'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $this->authorize('edit',$this->model);
        if ($id == 1) {
            abort(403); //restrict editing of admin role
        }

        $this->model->find($id)->update($request->all());
        $this->model = $this->model->find($id);
        $request->validate([
            'name' => 'nullable|max:255|unique:roles,name,' . $id,
            'label' => 'nullable|max:255|unique:roles,label,' . $id,
        ]);

        if ($request->has('permissions')) {
            $permissions = $request->get('permissions', array());
            $this->model->permissions()->sync($permissions);
        }
        if ($request->has('users')) {
            $users = $request->get('users', array());
            $this->model->users()->sync($users);
        }
        return redirect()->route('dashboard.accounts.roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy(int $id)
    {
        $this->authorize('delete',$this->model);
        if ($id == 1) {
            abort(403); //restrict deletion of admin role
        }

        $this->model = $this->model->findorFail($id);
        $this->model->delete();
        return redirect()->route('dashboard.accounts.roles.index')->with('success', 'Role Deleted successfully');
    }


}
