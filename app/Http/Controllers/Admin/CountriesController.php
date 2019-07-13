<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountriesDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Country;
use Storage;
class CountriesController extends Controller
{

    public function index(CountriesDataTable $adminsTable)
    {
        return $adminsTable->render('admin.countries.index', ['title' => trans('admin.countries')]);
    }

    public function setLang($lang)
    {
        session()->has('lang') ? session()->forget('lang') : '';
        session()->put('lang', $lang);
        return back();
    }

    public function create()
    {
        return view('admin.countries.create', ['title' => trans('admin.add_new_country')]);
    }

    public function store()
    {
        $data = $this->validate(request(),
            [
                'country_name_ar' => 'required',
                'country_name_en' => 'required',
                'mob' => 'required',
                'code' => 'required',
                'logo' => 'sometimes|nullable|' . v_image(),
            ], [], [
                'country_name_ar' => trans('admin.country_name_ar'),
                'country_name_en' => trans('admin.country_name_en'),
                'mob' => trans('admin.mob'),
                'code' => trans('admin.code'),
                'logo' => trans('admin.logo'),
            ]);
        if (request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'countries',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        Country::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(admin_routes('countries'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $country = Country::find($id);
        if(empty($country))
             return abort('404');
        $title = trans('admin.edit');
        return view('admin.countries.edit', compact('country', 'title'));
    }
    public function update(Request $r,$id)
    {
        $data = $this->validate(request(),
            [
                'country_name_ar' => 'required',
                'country_name_en' => 'required',
                'mob' => 'required',
                'code' => 'required',
                'logo' => 'sometimes|nullable|' . v_image(),
            ], [], [
                'country_name_ar' => trans('admin.country_name_ar'),
                'country_name_en' => trans('admin.country_name_en'),
                'mob' => trans('admin.mob'),
                'code' => trans('admin.code'),
                'logo' => trans('admin.logo'),
            ]);
        if (request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'countries',
                'upload_type' => 'single',
                'delete_file' => Country::find($id)->logo,
            ]);
        }
        Country::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(admin_routes('countries'));
    }
    public function destroy($id)
    {
        $countries = Country::find($id);
        Storage::delete($countries->logo);
        $countries->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('countries'));
    }
    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $countries = Country::find($id);
                Storage::delete($countries->logo);
                $countries->delete();
            }
        } else {
            $countries = Country::find(request('item'));
            Storage::delete($countries->logo);
            $countries->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('countries'));
    }
}
