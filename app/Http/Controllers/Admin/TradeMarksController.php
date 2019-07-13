<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TradeMarkDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TradeMark;
use Storage;
class TradeMarksController extends Controller
{

    public function index(TradeMarkDataTable $trademark)
    {
        return $trademark->render('admin.trademarks.index', ['title' => trans('admin.trademarks')]);
    }

    public function setLang($lang)
    {
        session()->has('lang') ? session()->forget('lang') : '';
        session()->put('lang', $lang);
        return back();
    }

    public function create()
    {
        return view('admin.trademarks.create', ['title' => trans('admin.add_new_trademark')]);
    }

    public function store()
    {
        $data = $this->validate(request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'logo' => 'sometimes|nullable|' . v_image(),
            ], [], [
                'name_ar' => trans('admin.name_ar'),
                'name_en' => trans('admin.name_en'),
                'logo' => trans('admin.logo'),
            ]);
        if (request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        TradeMark::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(admin_routes('trademarks'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $trademark = TradeMark::find($id);
        if(empty($trademark))
             return abort('404');
        $title = trans('admin.edit');
        return view('admin.trademarks.edit', compact('trademark', 'title'));
    }
    public function update(Request $r,$id)
    {
        $data = $this->validate(request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'logo' => 'sometimes|nullable|' . v_image(),
            ], [], [
                'name_ar' => trans('admin.name_ar'),
                'name_en' => trans('admin.name_en'),
                'logo' => trans('admin.logo'),
            ]);
        if (request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => TradeMark::find($id)->logo,
            ]);
        }
        TradeMark::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(admin_routes('trademarks'));
    }
    public function destroy($id)
    {
        $trademarks = TradeMark::find($id);
        Storage::delete($trademarks->logo);
        $trademarks->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('trademarks'));
    }
    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $trademarks = TradeMark::find($id);
                Storage::delete($trademarks->logo);
                $trademarks->delete();
            }
        } else {
            $trademarks = TradeMark::find(request('item'));
            Storage::delete($trademarks->logo);
            $trademarks->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('trademarks'));
    }
}
