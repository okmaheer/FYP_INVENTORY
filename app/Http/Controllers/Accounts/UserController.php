<?php

namespace App\Http\Controllers\Accounts;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public $model;
    private $location;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->model = $user;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index()
    {
        $this->authorize('view',$this->model);
        $users = $this->model->where('location_id', $this->location)->get();
        $page_title = 'User Accounts';
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'User Accounts' => '',
        ]);

        return view('dashboard.accounts.users.index', compact('page_title', 'breadcrumbs','users'));
    }

    public function create()
    {
        $this->authorize('create',$this->model);
        $roles = Role::pluck('label', 'id');

        $page_title = 'New User Account';
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'User Accounts' => route('dashboard.accounts.users.index'),
            'New User Account' => ''
        ]);

        return view('dashboard.accounts.users.create', compact('page_title', 'breadcrumbs', 'roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create',$this->model);
        $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required|min:4',
        ]);

        $this->model = $this->model->create($request->except(['password']));

        if ($this->model) {
            if ($request->has('password') && $request->password != '') {
                $this->model->password = Hash::make($request->password);
            }

            $this->model->location_id = $this->location;
            $this->model->save();

            if ($request->file('avatar')) {
                $file = $request->file('avatar');
                $name = sha1('img' . $this->model->id . time()) . '.' . $file->getClientOriginalExtension();
                $image = Image::make($file);
                $image->save(public_path('uploads/users/') . $name);
                $this->model->avatar = 'uploads/users/' . $name;
                $this->model->save();
            }

            if ($request->has('roles')) {
                $roles = $request->get('roles', array());
                $this->model->roles()->attach($roles);
            }

            if ($request->has('is_PettyCash')) {
                $this->checkPettyCashAccount();
            }
        }
        return redirect()->route('dashboard.accounts.users.index')->with('success', 'User is Created Successfully.');
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('edit',$this->model);
        if ($id == 1) {
            abort(403); //restrict editing of super admin
        }

        $model = $this->model->where('location_id', $this->location)->findorFail($id);
        $roles = Role::pluck('label', 'id');

        $page_title = 'Edit User Account';
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'User Accounts' => route('dashboard.accounts.users.index'),
            'Edit User Account' => ''
        ]);

        return view('dashboard.accounts.users.edit', compact('page_title', 'breadcrumbs', 'model', 'roles'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {

        $this->authorize('edit',$this->model);
        if ($id == 1) {
            abort(403); //restrict editing of super admin
        }

        $request->validate([
            'email' => 'required|unique:users,email,' . $id,
        ]);
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:4',
            ]);
        }

        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->except(['password']));
        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);

        if ($request->missing('is_PettyCash')) {
            $this->model->is_PettyCash = 0;
        } else {
            $this->model->is_PettyCash = 1;
        }
        if ($request->missing('active')) {
            $this->model->active = 0;
        } else {
            $this->model->active = 1;
        }

        if ($request->has('password') && $request->password != '') {
            $this->model->password = Hash::make($request->password);
        }
        $this->model->save();

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

        if ($request->has('is_PettyCash')) {
            $this->checkPettyCashAccount();
        }

        return redirect()->route('dashboard.accounts.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(int $id)
    {
        $this->authorize('delete',$this->model);
        if ($id == 1) {
            abort(403); //restrict deletion of super admin
        }

        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        $this->model->delete();
        return redirect()->route('dashboard.accounts.users.index')->with('success', 'User Deleted successfully');
    }

    private function CheckPettyCashAccount() {
        $petty_account = AccountHead::where('location_id', $this->location)->where('pettycash_id', $this->model->id)->first();
        if (empty($petty_account)) {

            $headCode = AccountHead::where('HeadLevel',4)
                            ->where('HeadCode', 'like',  '1070' . '%')
                            ->max('HeadCode');

            $headName = 'PettyCash-'.$this->model->id.'-'.$this->model->name;
            if ($headCode != NULL) {
                $headCode = $headCode + 1;
            } else {
                $headCode = "107010201";
            }

            AccountHead::create([
                'HeadCode'         => $headCode,
                'HeadName'         => $headName,
                'PHeadName'        => 'Cash In Hand',
                'HeadLevel'        => '4',
                'IsActive' => '1',
                'IsTransaction' => '1',
                'IsGL' => '0',
                'HeadType' => 'A',
                'IsBudget' => '0',
                'IsDepreciation' => '1',
                'DepreciationRate' => '1',
                'pettycash_id' => $this->model->id,
                'location_id' => $this->location,
            ]);
        }
    }

}
