<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index(UsersDataTable $usersTable)
    {
        return $usersTable->render('admin.users.index', ['title' => trans('admin.users')]);
    }

    public function setLang($lang)
    {
        session()->has('lang') ? session()->forget('lang') : '';
        session()->put('lang', $lang);
        return back();
    }

    public function create()
    {
        return view('admin.users.create', ['title' => trans('admin.add')]);
    }

    public function store()
    {
        $data = $this->validate(request(),
            [
                'name' => 'required',
                'level' => 'required|in:user,vendor,company',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ], [], [
                'name' => trans('admin.name'),
                'email' => trans('admin.email'),
                'level' => trans('admin.level'),
                'password' => trans('admin.password'),
            ]);
        $data['password'] = Hash::make(request('password'));
        User::create($data);
        session()->flash('success', trans('admin.record_added'));
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return abort('404');
        }

        return view('admin.users.edit', ['title' => trans('admin.edit'), 'user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'name' => 'required',
                'level' => 'required|in:user,vendor,company',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'sometimes|nullable|min:6',
            ], [], [
                'name' => trans('admin.Name'),
                'level' => trans('admin.level'),
                'email' => trans('admin.E-Mail'),
                'password' => trans('admin.password'),
            ]);
        $data['password'] = request()->has('password') ?? bcrypt(request('password'));
        User::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return back();
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return back();
    }
    public function multi_delete()
    {
        if (is_array(request('item'))):
            User::destroy(request('item'));
        else:
            User::find(request('item'))->delete();
        endif;
        session()->flash('success', trans('admin.deleted_record'));
        return back();
    }
}
