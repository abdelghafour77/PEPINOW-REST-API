<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return response()->json($roles);
    }

    public function indexWithPermissions()
{
    $roles = Role::with('permissions')->get();

    return response()->json($roles);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'nullable|string',
        ]);

        $role = Role::create($validatedData);

        return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'sometimes|required|unique:roles,name,' . $role->id,
        'description' => 'nullable|string',
    ]);

    $role->update($validatedData);

    return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

    $role->delete();

    return response()->json(['message' => 'Role deleted successfully']);
    }

    public function updatePermission(Role $role, Permission $permission)
{
    $grant = request()->input('grant');
    if ($grant=="true") {
        $role->givePermissionTo($permission);
        return response()->json([
            'message' => 'Permission granted successfully.'
        ], 200);
    } else {
        $role->revokePermissionTo($permission);
        return response()->json([
            'message' => 'Permission revoked successfully.'
        ], 200);
    }
}
//     public function grantPermissions(Request $request, $roleId)
// {
//     $role = Role::findOrFail($roleId);

//     $permissionIds = $request->input('permissions');

//     $permissions = Permission::whereIn('id', $permissionIds)->get();

//     $role->givePermissionTo($permissions);

//     return response()->json(['message' => 'Permissions granted successfully']);
// }

}
