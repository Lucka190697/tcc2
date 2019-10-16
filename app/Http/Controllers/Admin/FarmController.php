<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Farm;

class FarmController extends Controller
{
    public function index(User $user, Farm $farm)
    {
        return redirect()->route('admin.user.index');
    }

    public function create()
    {
        $title = "Create";
        $roles = Role::pluck('name', 'name')->all();
        return view('farm.register', compact('roles', 'title'));
    }

    public function store(Request $request, Farm $farm, User $user)
    {
        $data = $request->all();
        $data['id_users'] = auth()->user()->id;// salva o id do usuario admin que está logado.
//        $farms  = Farm::find(auth()->user()->id);
////        dd(auth()->user()->id);//4 //id do ususario logado
//        dd(auth()->user()->id_farms);//1 //id
//        dd($data['id_users']);

        $farm->create($data);

        $user->assignRole($request->input('roles'));

        if (!$user->hasRole(\App\Enums\UserRolesEnum::CLIENT)) {
            $user->assignRole(\App\Enums\UserRolesEnum::CLIENT);
        }

        return redirect()->route('admin.user.index');
    }

    public function edit(Farm $farm, User $user)
    {
        $users = $user->all();
        $roles = Role::pluck('name', 'name')->all();
        return view('farm.edit', compact('roles', 'farm', 'users'));
    }

    public function update(Request $request, Farm $farm, User $user)
    {
        dd('aki');
        $data = $request->all();
        $id_ = auth()->user()->id;
        $data['id_users'] = $id_;
        $farm->create($data);

        $user->assignRole($request->input('roles'));

        if (!$user->hasRole(\App\Enums\UserRolesEnum::CLIENT)) {
            $user->assignRole(\App\Enums\UserRolesEnum::CLIENT);
        }

        return redirect()->route('admin.farm.index');
    }

    public function show()
    {
        dd('vc n deveria estar aki');
    }
}

