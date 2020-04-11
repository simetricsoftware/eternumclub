<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
        // $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::withTrashed()
            ->select('id', 'name', 'lastname', 'email', 'deleted_at')
            ->with('roles')
            ->search($request->search)
            ->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create', ['user' => new User()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $user = User::create($request->validated());
        $user->assignRole('admin');
        return redirect()->route('users.show', $user)->with(['status' => 'Usuario creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get(['name', 'description'])->pluck('description', 'name');
        $permissions = Permission::get(['name', 'description'])->pluck('description', 'name');
        return view('dashboard.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        $user->syncRoles($data['role']);
        $user->syncPermissions($data['permissions']);
        return redirect()->route('users.show', $user)->with(['status' => 'Usuario actualizado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->forceDelete();
        return redirect()->route('users.index')->with(['status' => 'Usuario eliminado permanentemente']);
    }

    public function restore($user) {
        User::withTrashed()->find($user)->restore();
        return redirect()->route('users.index')->with(['status' => 'Usuario restaurado']);
    }

    public function delete(User $user) {
        $user->delete();
        return redirect()->route('users.index')->with(['status' => 'Usuario eliminado']);
    }

    public function uploadImage(Request $request) {
        $file = $request->validate([
            'image' => 'required|mimes:jpeg,bmp,png|max:10240' //10 Mb
        ]);

        $user = $request->user();
        $url = Storage::putFile("users/$user->id", $file['image']);
        return ['image' => "/storage/$url"];
    }

    public function deleteImage(Request $request) {
        if (Storage::exists($request->image)) {
            Storage::delete($request->image);
        }
    }
}
