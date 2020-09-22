<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class UserController extends Controller
{
  // Default pageConfig
  protected $pageConfigs = [
    'navbarType' => 'sticky',
    'footerType' => 'static',
    'horizontalMenuType' => 'floating',
    'theme' => 'dark',
    'navbarColor' => 'bg-primary'
  ];
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  function __construct()
  {
    $this->middleware('permission:administrator-permission', ['only' => ['index','create','store','edit','update','destroy']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $data = User::orderBy('id')->paginate(5);
    return view('pages.users.index',compact('data'))
      ->with('pageConfigs', $this->pageConfigs)
      ->with('i', ($request->input('page', 1) - 1) * 5);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $roles = Role::pluck('name','name')->all();
    return view('pages.users.create', compact('roles'))
      ->with('breadcrumbs', [
          ['link'=>"/users",'name'=>trans('locale.user.title')], ['name'=>trans('locale.user.create')]
        ])
      ->with('pageConfigs', $this->pageConfigs);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|same:confirm-password',
      'roles' => 'required'
    ]);

    $input = $request->all();
    $input['password'] = Hash::make($input['password']);

    $user = User::create($input);
    $user->assignRole($request->input('roles'));

    return redirect()->route('users.index')
      ->with('success',trans('locale.user.message.save'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::find($id);
    return view('pages.users.show',compact('user'))
      ->with('breadcrumbs', [
        ['link'=>"/users",'name'=>trans('locale.user.title')], ['name'=>trans('locale.user.create')]
      ])
      ->with('pageConfigs', $this->pageConfigs);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = User::find($id);
    $roles = Role::pluck('name','name')->all();
    $userRole = $user->roles->pluck('name','name')->all();

    return view('pages.users.edit',compact('user','roles','userRole'))
      ->with('breadcrumbs', [
        ['link'=>"/users",'name'=>trans('locale.user.title')], ['name'=>trans('locale.user.edit')]
      ])
      ->with('pageConfigs', $this->pageConfigs);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email|unique:users,email,'.$id,
      'password' => 'same:confirm-password',
      'roles' => 'required'
    ]);

    $input = $request->all();
    if(!empty($input['password'])){
      $input['password'] = Hash::make($input['password']);
    }else{
      $input = array_except($input, array('password'));
    }

    $user = User::find($id);
    $user->update($input);
    DB::table('model_has_roles')->where('model_id',$id)->delete();

    $user->assignRole($request->input('roles'));

    return redirect()->route('users.index')
      ->with('success',trans('locale.user.message.update'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    User::find($id)->delete();
    return redirect()->route('users.index')
      ->with('success',trans('locale.user.message.delete'));
  }
}
