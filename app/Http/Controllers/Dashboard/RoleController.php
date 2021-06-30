<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    function __construct()
    {

//        $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
//        $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
//        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
//        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Name', function ($data) {

                    return $data->name;

                })
                ->addColumn('action', function ($data) {


                    $button = '<a name="edit" href="' . url("/Dashboard/roles/$data->id/show") . '" . id="' . $data->id . '" class="edit btn btn-secondary btn-sm"><span><i class="fa fa-eye" aria-hidden="true"></i></span>عرض</a>';
                    $button .= '&nbsp;&nbsp';
                    $button = $button . '<a name="edit" href="' . url("/Dashboard/roles/$data->id/edit") . '" . id="' . $data->id . '" class="edit btn btn-primary btn-sm"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                    return $button;


                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('Pages.Role.index');
    }

    public function create()
    {
        $permission = Permission::get();
        return view('Pages.Role.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('Name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id')
            ->all();
        return view('Pages.Role.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {


        $role = Role::find($id);
        $role->name = $request->input('Name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
