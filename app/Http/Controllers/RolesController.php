<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function createRole(Request $request)
    {
        $role = Roles::create($request->all());
        foreach ($request->permissions as $permission) {

            Permissions::insert([
                "role_id" => $role->id,
                "permission" => $permission["permission"],
                "dependency" => $permission["dependency"]
            ]);
        }
    }

    public function existRole()
    {
        $roles = Roles::all();
        return response()->json(["roles" => $roles]);
    }

    public function getForEdit(Request $request)
    {
        $permissions = Permissions::where('role_id', $request->id)->select("permission", "dependency")->get();
        return response()->json(["permissions" => $permissions]);
    }

    public function editRole(Request $request)
    {
        Roles::firstWhere('id', $request->role["id"])->update($request->role);
        Permissions::where('role_id', $request->role["id"])->delete();
        foreach ($request->permissions as $permission) {
            Permissions::insert([
                "role_id" => $request->role["id"],
                "permission" => $permission["permission"],
                "dependency" => $permission["dependency"]
            ]);
        }
    }

    public function deleteRole(Request $request)
    {
        Roles::firstWhere("id", $request->id)->delete();
        Permissions::where('role_id', $request->id)->delete();
    }
}
