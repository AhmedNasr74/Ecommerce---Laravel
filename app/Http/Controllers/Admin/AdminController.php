<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{



    public function index(AdminDataTable $adminsTable)
    {
        return $adminsTable->render('admin.admins.index', ['title' => 'Admin Control']);
    }

    public function setLang($lang)
    {
        session()->has('lang') ? session()->forget('lang') : '';
        session()->put('lang', $lang);
        return back();
    }

    public function create()
    {
        return view('admin.admins.create', ['title' => trans('admin.create_admin')]);
    }

    public function store()
    {
        $data = $this->validate(request(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:admins',
                'password' => 'required|min:6',
            ], [], [
                'name' => trans('admin.name'),
                'email' => trans('admin.email'),
                'password' => trans('admin.password'),
            ]);
        $data['password'] = Hash::make(request('password'));
        Admin::create($data);
        session()->flash('success', trans('admin.record_added'));
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $admin = Admin::find($id);

        if (empty($admin)) {
            return abort('404');
        }

        return view('admin.admins.edit', ['title' => trans('admin.edit'), 'admin' => $admin]);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:admins,email,' . $id,
                'password' => 'sometimes|nullable|min:6',
            ], [], [
                'name' => trans('admin.Name'),
                'email' => trans('admin.E-Mail'),
                'password' => trans('admin.password'),
            ]);
        $data['password'] = request()->has('password') ?? bcrypt(request('password'));
        Admin::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return back();
    }
    public function destroy($id)
    {
        Admin::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return back();
    }
    public function multi_delete()
    {
        if (is_array(request('item'))):
            Admin::destroy(request('item'));
        else:
            Admin::find(request('item'))->delete();
        endif;
        session()->flash('success', trans('admin.deleted_record'));
        return back();
    }
}
