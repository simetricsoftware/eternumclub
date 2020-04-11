<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRole;
use App\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('name', 'ASC')
            ->search($request->search)
            ->get(['id', 'name', 'description']);
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')
            ->get(['name', 'description'])
            ->pluck('description', 'name');
        return view('dashboard.roles.create', ['permissions' => $permissions, 'role' => new Role()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        $data = $request->validated();
        $role = Role::create([
            'name'        => $data['name'],
            'description' => $data['description']
        ]);
        $role->syncPermissions($data['permissions']);
        return redirect()->route('roles.show', $role)->with('status', 'Rol creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('dashboard.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name', 'ASC')
            ->get(['name', 'description'])
            ->pluck('description', 'name');
        return view('dashboard.roles.edit', compact(['role', 'permissions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRole $request, Role $role)
    {
        $data = $request->validated();
        $role->update([
            'name'        => $data['name'],
            'description' => $data['description']
        ]);
        $role->syncPermissions($data['permissions']);
        return redirect()->route('roles.show', $role)->with('status', 'Rol actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('status', 'Rol Eliminado con exito');
    }
}
