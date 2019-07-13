<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StateDataTable;
use App\Http\Controllers\Controller;
use App\Model\City;
use App\Model\State;
use Form;
use Illuminate\Http\Request;

class StatesController extends Controller
{

    public function index(StateDataTable $state)
    {
        return $state->render('admin.states.index', ['title' => trans('admin.states')]);
    }

    public function setLang($lang)
    {
        session()->has('lang') ? session()->forget('lang') : '';
        session()->put('lang', $lang);
        return back();
    }

    public function create()
    {
        if (request()->ajax()):
            if (request()->has('country_id')):
                $select = request()->has('select') ? request('select') : '';
                return Form::select('city_id', City::where('country_id', request('country_id'))
                        ->pluck('city_name_' . session('lang'), 'id'), $select, ['class' => 'form-control city_id', 'style' => 'display:none', "placeholder" => trans("admin.city_id")]);
            endif;
        endif;
        return view('admin.states.create', ['title' => trans('admin.add_new_state')]);
    }

    public function store()
    {
        $data = $this->validate(request(),
            [
                'state_name_ar' => 'required',
                'state_name_en' => 'required',
                'country_id' => 'required|numeric',
                'city_id' => 'required|numeric',
            ], [], [
                'state_name_ar' => trans('admin.state_name_ar'),
                'state_name_en' => trans('admin.state_name_en'),
                'country_id' => trans('admin.country_id'),
                'city_id' => trans('admin.city_id'),
            ]);

        State::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(admin_routes('states'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $state = State::find($id);
        if (empty($state)) {
            return abort('404');
        }
        $title = trans('admin.edit');
        return view('admin.states.edit', compact('state', 'title'));
    }
    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'state_name_ar' => 'required',
                'state_name_en' => 'required',
                'country_id' => 'required|numeric',
                'city_id' => 'required|numeric',
            ], [], [
                'state_name_ar' => trans('admin.state_name_ar'),
                'state_name_en' => trans('admin.state_name_en'),
                'country_id' => trans('admin.country_id'),
                'city_id' => trans('admin.city_id'),
            ]);
        State::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(admin_routes('states'));
    }
    public function destroy($id)
    {
        $states = State::find($id);
        $states->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('states'));
    }
    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $states = State::find($id);
                $states->delete();
            }
        } else {
            $states = State::find(request('item'));
            $states->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('states'));
    }
}
