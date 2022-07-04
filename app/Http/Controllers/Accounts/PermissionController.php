<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public $model;

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', $this->model);
        $permissions = $this->model->get();
        $page_title = 'All Permissions';
        $breadcrumbs = [['text' => 'All Permissions']];
        $viewParams = [
            'permissions' => $permissions,
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title
        ];
        return view('dashboard.accounts.permissions.index', $viewParams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', $this->model);
        $page_title = 'Create New Permission';
        $breadcrumbs = [['text' => $page_title]];
        $roles = Role::pluck('name', 'id');
        $viewParams = [
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title,
            'roles' => $roles
        ];

        return view('dashboard.accounts.permissions.create', $viewParams);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', $this->model);
        $request->validate([
            'name' => 'unique:permissions,name',
            'label' => 'unique:permissions,label',
        ]);
        $this->model = $this->model->create($request->all());
        if ($this->model) {
            if ($request->has('roles')) {
                $roles = $request->get('roles', array());
                $this->model->roles()->sync($roles);
            }
        }
        return redirect()->route('dashboard.accounts.permissions.index')
            ->with('success', 'Permission is Created Successfully.');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Request $request, $id)
    {
        $this->authorize('edit', $this->model);
        $model = $this->model->find($id);
        $roles = Role::pluck('label', 'id');
        $page_title = 'Edit ' . $model->name;
        $breadcrumbs = [['text' => $page_title]];
        $viewParams = [
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title,
            'model' => $model,
            'roles' => $roles
        ];

        return view('dashboard.accounts.permissions.edit', $viewParams);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $this->authorize('edit', $this->model);
        $this->model->find($id)->update($request->all());
        $this->model = $this->model->find($id);
        $request->validate([
            'name' => 'nullable|max:255|unique:permissions,name,' . $id,
            'label' => 'nullable|max:255|unique:permissions,label,' . $id,
        ]);

        if ($request->has('roles')) {
            $roles = $request->get('roles', array());
            $this->model->roles()->sync($roles);
        }
        return redirect()->route('dashboard.accounts.permissions.index')
            ->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function destroy(int $id)
    {
        $this->authorize('delete', $this->model);
        $this->model = $this->model->find($id);
        if ($this->model) {
            $this->model->delete();
            return \view('dashboard.accounts.permissions.index')
                ->with('success', 'Permission Deleted successfully');
        }
    }

    /**
     * Sync Permissions
     * @return RedirectResponse
     */
    public function syncPermissions(): RedirectResponse
    {
        if (Permission::syncPermissions()) {
            return redirect()
                ->route('dashboard.accounts.permissions.index')
                ->with('success', 'Permissions synced!');
        } else {
            return redirect()->back()
                ->withErrors('Failed to sync permissions!');
        }
    }
}
