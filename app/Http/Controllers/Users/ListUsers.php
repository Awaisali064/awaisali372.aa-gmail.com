<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListUsers extends Controller
{
    public function getusers(Request $request)
    {
        $data = User::get();
        echo $out = '<div class="container">
<div class="row mb-5" >
<div class = "col-md-12"  style="padding-top:30px;">
<a class="btn btn-primary px-3"  href="home" style="float:right;">Back</a>
<!--<a class="btn btn-success px-3 mr-3" style="float:right;" onClick="adduser(this)" href="#">Add User</a>-->
</div>
</div>
</div>
<table style="width:100%; border:black 1; border:solid;" id="allSides ">
<thead>
    <tr>
    <th style="width:20px; border:black 1; border:solid; text-align:center;">Sr#</th>
    <th style="width:50px; border:black 1; border:solid; text-align:center;">Name</th>  
    <th style="width:100px; border:black 1; border:solid; text-align:center;">Email</th>
        <th style="width:100px; border:black 1; border:solid; text-align:center;">Permissions</th>
    <th style="width:400px; border:black 1; border:solid; text-align:center;">Action</th>
</thead>';
        $count = 0;
        foreach ($data as $user) {
            $count++;
            $permissions = $user->getAllPermissions();
            echo  $out1 = '<tr style="width:100px; height:25px; border:black 1; border:solid;">                                  
                                    <td style="width:100px; height:25px; border:black 1; border:solid; text-align:center;"> 
                                    ' . $count . '</td>
                                      <td style="width:100px; height:25px; border:black 1; border:solid; text-align:center;">
                                     ' . $user->name . '</td>
                                    <td style="width:100px; height:25px; border:black 1; border:solid; text-align:center;">
                                     ' . $user->email . '</td>';
            echo ' <td style="width:100px; height:25px; border:black 1; border:solid; text-align:center;">
                                     ';
            foreach ($permissions as $permission) {
                $per = $permission->name;
                echo $per . "<br>";
            }
            echo   '</td>';

            echo '  <td>
            <a class="btn btn-info" id="per" data-value="assign"  onClick="show(' . $user->id . ')"  href="#">Assign Permission</a>
             <a class="btn btn-danger" id="rem" data-value="remove"  onClick="remove(' . $user->id . ')"  href="#">Remove Permission</a>
            <a class="btn btn-primary"  onClick="edit(' . $user->id . ')"  href="#">Assign Role</a>
            <a class="btn btn-danger" onClick="deleteCelebrity(' . $user->id . ')" href="#">Delete</a>
        </td>
        </tr>';
        }
        echo $out2 = '</table>';
    }
    public function DeleteUser(Request $request)
    {
        $id = $request->user_id;
        // echo 'delete';
        echo '  <label onClick="manageCelebrity()" class="px-2 mt-1 mb-5 btn btn-success" style="float:right;">Back</label>';


        $del = User::find($id);


        if (isset($del)) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            //  echo 'celebrity';
            if ($del->delete()) {
                $dele = $del->revokePermissionTo('publish post');
                // echo 'deleted';
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');
                echo ' <div class="col-sm-12 mt-5">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
           Celebrity Deleted successfully!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>';
            }
        }
    }
    public function AssignPermission(Request $request)
    {
        //echo 'permission';
        $id = $request->user_id;
        $role = $request->role;
        echo '
        
         <div class="container">
                                        <div class="row">
                                            <div class="col-md-12" style="padding-top:10px;">
                                                <label onClick="manageCelebrity()" class="px-2 mt-1 mb-5 btn btn-success" style="float:right;">Back</label>
                                                <!--<a class="btn btn-success px-3 mr-3" style="float:right;" onClick="adduser(this)" href="#">Add User</a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="card-header text-center"
                                                        style="font-size: 25px;">
                                                        <p>Assign Permission</p>
                                                    </div>

                                                    <div class="card-body">                                                  

                                                        <form action="Permission" method="POST">
                                                           ' . csrf_field() . '
                                                            <div class="form-group">
                                                            <input type="hidden" name="id" value="' . $id . '">
                                                             </div>
                                                              <div class="form-group">
                                                            <input type="hidden" name="role" value="' . $role . '">
                                                             </div>
                                                            <div class="form-group">                                                               
                                                               <input type="checkbox"  id="vehicle2" name="writepost" value="write post">
                                                                <label>Write Post</label>
                                                            </div>
                                                            <div class="form-group">                                                                
                                                               <input type="checkbox" id="vehicle2" name="editpost" value="edit post">
                                                               <label>Edit Post</label>
                                                            </div>
                                                              <div class="form-group">                                                                
                                                               <input type="checkbox" id="vehicle2" name="publishpost" value="publish post">
                                                               <label>Publish Post</label>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary px-3">' . $role . ' Permission</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
    }
    public function Permission(Request $request)
    {
        //  echo 'assign';
        $id = $request->id;
        $role = $request->role;
        $per1 = $request->writepost;
        $per2 = $request->editpost;
        $per3 = $request->publishpost;
        //  echo '  <label onClick="manageCelebrity()" class="px-2 mt-1 mb-5 btn btn-success" style="float:right;">Back</label>';
        $user = User::find($id);
        if ($role == 'assign') {
            if ($per1) {
                $user->givePermissionTo($per1);
            }
            if ($per2) {
                $user->givePermissionTo($per2);
            }
            if ($per3) {
                $user->givePermissionTo($per3);
            }

            return redirect('home')->with('success', 'Permission assign successfully!');
        } else if ($role == 'remove') {
            if (isset($per1)) {
                $user->revokePermissionTo('write post');
                //  $a = $user->revokePermissionTo('edit post');
                $user->removeRole('writer');
            }
            if (isset($per2)) {
                $user->revokePermissionTo('edit post');
                // $b =  $user->revokePermissionTo($per2);
                $user->removeRole('editor');
            }
            if (isset($per3)) {
                $user->revokePermissionTo('publish post');
                $user->removeRole('publisher');
                // $c = $user->revokePermissionTo($per3);
            }
            return redirect('home')->with('success', 'Permission remove successfully!');
        }
    }
    public function assignrole(Request $request)
    {
        //echo 'assign role';
        $id = $request->user_id;
        echo '
        
         <div class="container">
                                        <div class="row">
                                            <div class="col-md-12" style="padding-top:10px;">
                                                <label onClick="manageCelebrity()" class="px-2 mt-1 mb-5 btn btn-success" style="float:right;">Back</label>
                                                <!--<a class="btn btn-success px-3 mr-3" style="float:right;" onClick="adduser(this)" href="#">Add User</a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="card-header text-center"
                                                        style="font-size: 25px;">
                                                        <p>Assign Role</p>
                                                    </div>

                                                    <div class="card-body">                                                  

                                                        <form action="Role" method="POST">
                                                           ' . csrf_field() . '
                                                            <div class="form-group">
                                                            <input type="hidden" name="id" value="' . $id . '">
                                                             </div>
                                                             
                                                            <div class="form-group">                                                               
                                                               <input type="checkbox"  id="vehicle2" name="writer" value="writer">
                                                                <label>Writer</label>
                                                            </div>
                                                            <div class="form-group">                                                                
                                                               <input type="checkbox" id="vehicle2" name="editor" value="editor">
                                                               <label>Editor</label>
                                                            </div>
                                                              <div class="form-group">                                                                
                                                               <input type="checkbox" id="vehicle2" name="publisher" value="publisher">
                                                               <label>Publisher</label>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary px-3">Assign Role</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
    }

    public function Role(Request $request)
    {
        // echo 'role';
        $id = $request->id;
        //$role = $request->role;
        $per1 = $request->writer;
        $per2 = $request->editor;
        $per3 = $request->publisher;
        $user = User::find($id);
        if ($per1) {
            $user->assignRole($per1);
        }
        if ($per2) {
            $user->assignRole($per2);
        }
        if ($per3) {
            $user->assignRole($per3);
        }

        return redirect('home')->with('success', 'Role assign successfully!');
    }
}