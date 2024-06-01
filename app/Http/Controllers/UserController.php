<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:update user', ['only' => ['update', 'edit']]);
        $this->middleware("permission:delete user", ["only" => ["destroy"]]);
    }
    public function index() {
        $users = User::all();
        return view("role-permission.user.index", compact("users"));
    }

    public function create()
    {
        //$roles = Role::get();
        $roles = Role::pluck('name', 'name')->all();
        return view("role-permission.user.create", ["roles" => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //all current roles will be removed from the user and replaced by the array given
        //$user->syncRoles($request->roles);
        $user->syncRoles($request->roles);

        return redirect("/users")->with('success', 'User saved successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('role-permission.user.edit', [
            'user'=> $user, 'roles'=> $roles, 'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);

        /* update the roles now */
        $user->syncRoles($request->roles);

        return redirect("/users")->with('success', 'User updated successfully with roles');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect("/users")->with('success', 'User deleted successfully with roles');
    }

}
