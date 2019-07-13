<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Department;
use Illuminate\Http\Request;
use Storage;
class DepartmentsController extends Controller
{

    public function index()
    {
        return view('admin.departments.index', ['title' => trans('admin.departments')]);

    }
    public function create()
    {
        return view('admin.departments.create', ['title' => trans('admin.add_new_department')]);
    }
    public function store()
    {
        $data = $this->validate(request(),
            [
                'dept_name_ar' => 'required',
                'dept_name_en' => 'required',
                'icon' => 'sometimes|nullable|'.v_image(),
                'desc' => 'sometimes|nullable',
                'keyword' => 'sometimes|nullable',
                'parent' => 'sometimes|nullable|numeric',
            ], [], [
                'dept_name_ar' => trans('admin.dept_name_ar'),
                'dept_name_en' => trans('admin.dept_name_en'),
                'icon' => trans('admin.icon'),
                'desc' => trans('admin.desc'),
                'keyword' => trans('admin.keyword'),
                'parent' => trans('admin.parent'),
            ]);
            if (request()->hasFile('icon')) :
                $data['icon'] = up()->upload([
                    'file' => 'icon',
                    'path' => 'departments',
                    'upload_type' => 'single',
                    'delete_file' => '',
                ]);
            endif;
        Department::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(admin_routes('departments'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $department = Department::find($id);
        if (empty($department)) {
            return abort('404');
        }

        $title = trans('admin.edit');
        return view('admin.departments.edit', compact('department', 'title'));
    }
    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'dept_name_ar' => 'required',
                'dept_name_en' => 'required',
                'icon' => 'sometimes|nullable|'.v_image(),
                'desc' => 'sometimes|nullable',
                'keyword' => 'sometimes|nullable',
                'parent' => 'sometimes|nullable',
            ], [], [
                'dept_name_ar' => trans('admin.dept_name_ar'),
                'dept_name_en' => trans('admin.dept_name_en'),
                'icon' => trans('admin.icon'),
                'desc' => trans('admin.desc'),
                'keyword' => trans('admin.keyword'),
                'parent' => trans('admin.parent'),
            ]);
            if (request()->hasFile('icon')) :
                $data['icon'] = up()->upload([
                    'file' => 'icon',
                    'path' => 'departments',
                    'upload_type' => 'single',
                    'delete_file' => Department::find($id)->icon,
                ]);
            endif;
        Department::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(admin_routes('departments'));
    }
    public static function delete_node($id)
    {
        $department_parent = Department::where('parent', $id)->get();
		foreach ($department_parent as $sub) {
			self::delete_node($sub->id);
			if (!empty($sub->icon)) {
				Storage::has($sub->icon)?Storage::delete($sub->icon):'';
			}
			$subdepartment = Department::find($sub->id);
			if (!empty($subdepartment)) {
				$subdepartment->delete();
			}
		}
		$dep = Department::find($id);

		if (!empty($dep->icon)) {
			Storage::has($dep->icon)?Storage::delete($dep->icon):'';
		}
		$dep->delete();
    }
    public function destroy($id)
    {
        self::delete_node($id);
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(admin_routes('departments'));
    }
}
