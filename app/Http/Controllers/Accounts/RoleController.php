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

    public function __construct()
    {
        $this->model = new Role();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('view',$this->model);
        $roles = $this->model->get();
        $page_title = 'All Roles';
        $breadcrumbs = [['text' => 'All Users']];
        $viewParams = [
            'roles' => $roles,
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title
        ];
        return view('dashboard.accounts.roles.index', $viewParams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create',$this->model);
        $page_title = 'Create Role';
        $breadcrumbs = [['text' => $page_title]];
        $users = User::pluck('name', 'id');
        $permissions = Permission::pluck('label', 'id');
        $viewParams = [
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title,
            'users' => $users,
            'permissions' => $permissions
        ];

        return view('dashboard.accounts.roles.create', $viewParams);
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
        return redirect()->route('dashboard.accounts.roles.index')
            ->with('success', 'Role is Created Successfully.');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Request $request, $id)
    {
        $this->authorize('edit',$this->model);
        $model = $this->model->find($id);
        $users = User::pluck('name', 'id');
        $permissions = Permission::pluck('label', 'id');
        $page_title = 'Edit ' . $model->name;
        $breadcrumbs = [['text' => $page_title]];
        $viewParams = [
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title,
            'model' => $model,
            'users' => $users,
            'permissions' => $permissions
        ];

        return view('dashboard.accounts.roles.edit', $viewParams);
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
        $this->authorize('edit',$this->model);
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
        return redirect()->route('dashboard.accounts.roles.index')
            ->with('success', 'Role updated successfully');
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
        $this->authorize('delete',$this->model);
        $this->model = $this->model->find($id);
        if ($this->model) {
            $this->model->delete();
            return \view('dashboard.accounts.roles.index')
                ->with('success', 'Role Deleted successfully');
        }
    }


}
