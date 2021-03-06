<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\UsersEdit;
use App\Http\Requests\UsersRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all('name','id')->toArray();
        //dd($roles);
        
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        //var_dump($request);
        $input = $request->all();

        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();

            $file->move('images',$name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }
        // encrypt the password given
        $input['password'] = bcrypt($request->password); 
        User::create($input);
        Session::flash('alert_message','New User Created');
        return redirect('/admin/users');
       //echo 'name:'.$request->name;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::all();
        //dd($rolea);

        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEdit $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $input = $request->all();
        
        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id']= $photo->id;
        }
        
        //sometime user doesnt need to change their password
        if(!empty($input['password'])){
            $input['password'] = bcrypt($request->password);
        }else{
            unset($input['password']);
        }
            
        $user->update($input);
        Session::flash('alert_message','User Detail Updated');
        return redirect(route('admin.users.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //return "destroy";
        $user = User::findOrFail($id);
        if(!empty($user->photo->file) && file_exists(public_path().$user->photo->file)){
            unlink(public_path(). $user->photo->file);
       }
        
        $user->delete();
        Session::flash('alert_message','The user has been deleted');
        return redirect(route('admin.users.index'));
    }
}
