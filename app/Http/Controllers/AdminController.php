<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;



class AdminController extends Controller
{
    public $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     * @throws AuthorizationException
     */
    public function index()
    {
        
        $users = $this->model->get();
        $page_title = 'All Users';
        $breadcrumbs = [['text' => 'All Users']];
        $viewParams = [
            'users' => $users,
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title
        ];
        return view('dashboard.accounts.users.index', $viewParams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     * @throws AuthorizationException
     */
    public function create()
    {
    
        $page_title = 'Create User';
        $breadcrumbs = [['text' => $page_title]];
        $roles = Role::where('id',1)->pluck('id');
        $viewParams = [
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title,
            'roles' => $roles
        ];

        return view('dashboard.accounts.users.create', $viewParams);
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
      
        $request->validate([
            'email' => 'unique:users,email',
        ]);
        // dd($request->all());
        $this->model = $this->model->create($request->all());
        if ($request->has('password') && $request->password != '') {
            $this->model->password = Hash::make($request->password);
            $this->model->save();
        }
        if ($this->model) {
            if ($request->file('avatar')) {
                $file = $request->file('avatar');
                $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->save(public_path('uploads/users/') . $name);
                $this->model->avatar = 'uploads/users/' . $name;
                $this->model->save();
            }

            if ($request->has('roles')) {
                $roles = $request->get('roles');
                $this->model->roles()->attach($roles);
            }
        }
        return redirect()->route('dashboard.accounts.admins.index')
            ->with('success', 'User is Created Successfully.');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Request $request, $id)
    {
       
        $model = $this->model->find($id);
        $roles = Role::where('id',1)->pluck('id');
        $page_title = 'Edit ' . $model->name;
        $breadcrumbs = [['text' => $page_title]];
        $viewParams = [
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title,
            'model' => $model,
            'roles' => $roles
        ];

        return view('dashboard.accounts.users.edit', $viewParams);
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
       
        $this->model->find($id)->update($request->all());
        $this->model = $this->model->find($id);
        $request->validate([
            'email' => 'nullable|max:255|unique:users,email,' . $id,
        ]);
        if ($request->has('password') && $request->password != '') {
            $this->model->password = Hash::make($request->password);
            $this->model->save();
        }

        if ($request->file('avatar')) {
            $oldAvatar = public_path() . "/" . $this->model->avatar;
            if (file_exists($oldAvatar) && !is_dir($oldAvatar)) {
                unlink($oldAvatar);
            }
            $file = $request->file('avatar');
            $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('uploads/users/') . $name);
            $this->model->avatar = 'uploads/users/' . $name;
            $this->model->save();

        }

        if ($request->has('roles')) {
            $roles = $request->get('roles', array());
            $this->model->roles()->sync($roles);
        }
        return redirect()->route('dashboard.accounts.admins.index')
            ->with('success', 'User updated successfully');
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
        
        $this->model = $this->model->find($id);
        if ($this->model) {
            $this->model->delete();
            return \view('dashboard.accounts.users.index')
                ->with('success', 'User Deleted successfully');
        }
    }
}
