<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ManuFactsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Manufactures;
use Storage;
class ManufacturesController extends Controller
{

    public function index(ManuFactsDataTable $manufacture)
    {
        return $manufacture->render('admin.manufactures.index', ['title' => trans('admin.manufactures')]);
    }

    public function setLang($lng)
    {
        session()->has('lng') ? session()->forget('lng') : '';
        session()->put('lng', $lng);
        return back();
    }

    public function create()
    {
        return view('admin.manufactures.create', ['title' => trans('admin.add_new_manufacture')]);
    }

    public function store()
    {
        $data = $this->validate(request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'mobile' => 'required|numeric',
                'email' => 'required|email',
                'icon' => 'sometimes|nullable|' . v_image(),
                'facebook' => 'sometimes|nullable|url',
                'twitter' => 'sometimes|nullable|url',
                'website' => 'sometimes|nullable|url',
                'contact_name' => 'sometimes|nullable|string',
                'lat' => 'sometimes|nullable',
                'lng' => 'sometimes|nullable',
                'address' => 'sometimes|nullable',
            ], [], [
                'name_ar' => trans('admin.name_ar'),
                'name_en' => trans('admin.name_en'),
                'icon' => trans('admin.icon'),
                'facebook' => trans('admin.facebook'),
                'twitter' => trans('admin.twitter'),
                'website' => trans('admin.website'),
                'contact_name' => trans('admin.contact_name'),
                'lat' => trans('admin.lat'),
                'lng' => trans('admin.lng'),
                'mobile' => trans('admin.mobile'),
                'email' => trans('admin.email'),
                'address' => trans('admin.address'),
            ]);
        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'manufactures',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        Manufactures::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(admin_routes('manufactures'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $manufacture = Manufactures::find($id);
        if(empty($manufacture))
             return abort('404');
        $title = trans('admin.edit');
        return view('admin.manufactures.edit', compact('manufacture', 'title'));
    }
    public function update(Request $r,$id)
    {
        $data = $this->validate(request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'email' => 'required|email',
                'lat' => 'sometimes|nullable',
                'lng' => 'sometimes|nullable',
                'mobile' => 'required|numeric' ,
                'facebook' => 'sometimes|nullable|url',
                'twitter' => 'sometimes|nullable|url',
                'website' => 'sometimes|nullable|url',
                'contact_name' => 'sometimes|nullable|string',
                'address' => 'sometimes|nullable',
                'icon' => 'sometimes|nullable|' . v_image(),
            ], [], [
                'name_ar' => trans('admin.name_ar'),
                'name_en' => trans('admin.name_en'),
                'icon' => trans('admin.icon'),
                'facebook' => trans('admin.facebook'),
                'twitter' => trans('admin.twitter'),
                'website' => trans('admin.website'),
                'contact_name' => trans('admin.contact_name'),
                'lat' => trans('admin.lat'),
                'lng' => trans('admin.lng'),
                'mobile' => trans('admin.mobile'),
                'email' => trans('admin.email'),
                'address' => trans('admin.address'),
            ]);
        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'manufactures',
                'upload_type' => 'single',
                'delete_file' => Manufactures::find($id)->icon,
            ]);
        }
        Manufactures::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(admin_routes('manufactures'));
    }
    public function destroy($id)
    {
        $manufactures = Manufactures::find($id);
        if(isset($manufactures->icon))
            Storage::delete($manufactures->icon);
        $manufactures->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('manufactures'));
    }
    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $manufactures = Manufactures::find($id);
                if(isset($manufactures->icon))
                    Storage::delete($manufactures->icon);
                $manufactures->delete();
            }
        } else {
            $manufactures = Manufactures::find(request('item'));
            if(isset($manufactures->icon))
                Storage::delete($manufactures->icon);
            $manufactures->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('manufactures'));
    }
}
