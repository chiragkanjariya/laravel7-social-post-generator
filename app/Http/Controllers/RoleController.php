<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
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
    $roles = Role::orderBy('id')->paginate(5);
    return view('pages.roles.index',compact('roles'))
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
    $permission = Permission::pluck('name', 'name')->all();
    return view('pages.roles.create',compact('permission'))
      ->with('breadcrumbs', [
        ['link'=>"/roles",'name'=>trans('locale.role.title')], ['name'=>trans('locale.role.create')]
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
      'name' => 'required|unique:roles,name',
      'permission' => 'required',
    ]);

    $role = Role::create(['name' => $request->input('name')]);
    dd($request->input('permission'));
    $role->syncPermissions($request->input('permission'));

    return redirect()->route('roles.index')
      ->with('success',trans('locale.role.message.save'));
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $role = Role::find($id);
    $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
      ->where("role_has_permissions.role_id",$id)
      ->get();

    return view('pages.roles.show',compact('role','rolePermissions'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $role = Role::find($id);
    $permission = Permission::pluck('name', 'name')->all();
    $rolePermissions = $role->permissions()->pluck('name', 'name');

    return view('pages.roles.edit',compact('role','permission','rolePermissions'))
      ->with('breadcrumbs', [
        ['link'=>"/roles",'name'=>trans('locale.role.title')], ['name'=>trans('locale.role.edit')]
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
      'permission' => 'required',
    ]);

    $role = Role::find($id);
    $role->name = $request->input('name');
    $role->save();

    $role->syncPermissions($request->input('permission'));

    return redirect()->route('roles.index')
      ->with('success',trans('locale.role.message.update'));
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    DB::table("roles")->where('id',$id)->delete();
    return redirect()->route('roles.index')
      ->with('success',trans('locale.role.message.delete'));
  }
}
