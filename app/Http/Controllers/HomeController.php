<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = User::create($input);
        // $user = Role::create(['name' => 'writer']);
        // Role::create(['name' => 'admin']);
        //  Permission::create(['name' => 'publish post']);
        // $permission = Permission::create(['name' => 'edit post']);

        // $role = Role::findById(1);
        //$permission = Permission::findById(3);
        //$role->givePermissionTo($permission);

        //$permission->assignRole($role);
        //$role->syncPermissions($permission);
        //$permission->syncRoles($role); 

        // $permission->removeRole($role);
        //$role->revokePermissionTo($permission);

        //return 'hello';

        //auth()->user()->givePermissionTo('edit post');
        //auth()->user()->assignRole('publisher');

        //return response()->json(auth()->user()->permissions);
        //  $permission = Permission::findById(1);
        //$role = Role::findById(1);
        //$role->givePermissionTo($permission);
        //return response()->json(auth()->user()->getDirectpermissions());
        //return response()->json(auth()->user()->getpermissionsViaRoles());
        //return response()->json(auth()->user()->getAllpermissions());

        //return User::role('writer')->get();

        // return User::permission('write post')->get();

        //return auth()->user()->revokePermissionTo('edit post');
        //  return auth()->user()->removeRole('writer');
        return view('home');
    }
}