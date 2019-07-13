<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CityDataTable;
use App\Http\Controllers\Controller;
use App\Model\City;
use Illuminate\Http\Request;
// use Storage;

class CitiesController extends Controller
{

    public function index(CityDataTable $city)
    {
        return $city->render('admin.cities.index', ['title' => trans('admin.cities')]);
    }

    public function setLang($lang)
    {
        session()->has('lang') ? session()->forget('lang') : '';
        session()->put('lang', $lang);
        return back();
    }

    public function create()
    {
        return view('admin.cities.create', ['title' => trans('admin.add_new_city')]);
    }

    public function store()
    {
        $data = $this->validate(request(),
            [
                'city_name_ar' => 'required',
                'city_name_en' => 'required',
                'country_id' => 'required|numeric',
            ], [], [
                'city_name_ar' => trans('admin.city_name_ar'),
                'city_name_en' => trans('admin.city_name_en'),
                'country_id' => trans('admin.country_id'),
            ]);

        City::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(admin_routes('cities'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $city = City::find($id);
        if (empty($city)) {
            return abort('404');
        }

        $title = trans('admin.edit');
        return view('admin.cities.edit', compact('city', 'title'));
    }
    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'city_name_ar' => 'required',
                'city_name_en' => 'required',
                'country_id' => 'required|numeric',
            ], [], [
                'city_name_ar' => trans('admin.city_name_ar'),
                'city_name_en' => trans('admin.city_name_en'),
                'country_id' => trans('admin.country_id'),
            ]);

        City::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(admin_routes('cities'));
    }
    public function destroy($id)
    {
        $cities = City::find($id);
        $cities->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('cities'));
    }
    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $cities = City::find($id);
                $cities->delete();
            }
        } else {
            $cities = City::find(request('item'));
            $cities->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('cities'));
    }
}
