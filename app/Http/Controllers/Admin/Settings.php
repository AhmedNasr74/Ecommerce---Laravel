<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Setting;

class Settings extends Controller
{
    public function setting()
    {
        return view('admin.settings', ['title' => trans('admin.settings')]);
    }
    public function setting_save()
    {
        $data = $this->validate(request(), [
            'sitename_ar' => "required",
            'sitename_en' => "required",
            'email' => "required",
            'description' => "required",
            'keywords' => "required",
            'status' => "required",
            'message_maintenance' => "required",
            'main_lang' => "required",
            'logo' => v_image(),
            'icon' => v_image(),
        ], [], [
            'logo' => trans('admin.logo'),
            'icon' => trans('admin.icon'),

        ]);
        if (request()->hasFile('logo')):
            $data['logo'] = up()->upload([
                'file' => 'logo',
                //'new_name'      => null,
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->logo,
            ]);
        endif;
        if (request()->hasFile('icon')):
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->icon,
            ]);
        endif;
        Setting::orderBy('id', 'desc')->update($data);
        session()->put('lang', request('main_lang'));
        session()->flash('success', trans('admin.updated_record'));
        return redirect(admin_routes('settings'));
    }
}
