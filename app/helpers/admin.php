<?php

if (!function_exists('setting')):
    function setting()
{
        return \App\Model\Setting::orderBy('id', 'desc')->first();
    }
endif;

if (!function_exists('admin_design')):
    function admin_design($url = null)
{
        return url('/design/adminlte/') . $url;
    }
endif;

if (!function_exists('ustore_design')):
    function ustore_design($url = null)
{
        return url('/design/ustora/') . $url;
    }
endif;

if (!function_exists('admin_routes')):
    function admin_routes($url = null)
{
        return url('/admin') . '/' . $url;
    }
endif;

if (!function_exists('Admin')):
    function Admin()
{
        return auth()->guard('admin');
    }
endif;

if (!function_exists('lang')):
    function lang()
    {
        if (session()->has('lang') ):
            return  session('lang');
        else:
            $lang = setting()->main_lang;
            session()->put('lang', $lang);
            return  $lang;
        endif;

    }
endif;

if (!function_exists('direction')):
    function direction()
{
        return session()->has('lang') ?
        session('lang') == 'ar' ? 'rtl' : "ltr"
        : 'ltr';
    }
endif;

if (!function_exists('active_menu')):
    function active_menu($link)
{
        if (preg_match('/' . $link . '/i', Request::segment(2))):
            return ['menu-open', 'display:block'];
        else:
            return ['', ''];
        endif;
    }
endif;

if (!function_exists('datatable_lang')):
    function datatable_lang()
{
        $lang =
            [
            "sProcessing" => trans("admin.sProcessing"),
            "sLengthMenu" => trans("admin.sLengthMenu"),
            "sZeroRecords" => trans("admin.sZeroRecords"),
            "sEmptyTable" => trans("admin.sEmptyTable"),
            "sInfo" => trans("admin.sInfo"),
            "sInfoEmpty" => trans("admin.sInfoEmpty"),
            "sInfoFiltered" => trans("admin.sInfoFiltered"),
            "sInfoPostFix" => trans("admin.sInfoPostFix"),
            "sSearch" => trans("admin.sSearch"),
            "sUrl" => trans("admin.sUrl"),
            "sInfoThousands" => trans("admin.sInfoThousands"),
            "sLoadingRecords" => trans("admin.sLoadingRecords"),
            "oPaginate" => [
                "sFirst" => trans("admin.sFirst"),
                "sLast" => trans("admin.sLast"),
                "sNext" => trans("admin.sNext"),
                "sPrevious" => trans("admin.sPrevious"),
            ],
            "oAria" => [
                "sSortAscending" => trans("admin.sSortAscending"),
                "sSortDescending" => trans("admin.sSortDescending"),
            ],
        ];
        return $lang;
    }
endif;

if (!function_exists('v_image')):
    function v_image($extentions = null)
    {
        return $extentions === null ? 'image|mimes:jpg,jpeg,png,gif,ico' : 'image|mimes:' . $extentions;
    }
endif;

if (!function_exists('up')):
    function up()
    {
        return new \App\Http\Controllers\Upload;
    }
endif;

if (!function_exists('load_dep')):
    function load_dep($select = null,$dept_disabled = null)
    {
        $departments = \App\Model\Department::selectRaw('dept_name_'.session('lang').' as text' )
                                            ->selectRaw('id as id')
                                            ->selectRaw('parent as parent')
                                            ->get(['text' , 'parent' , 'id']);

        $dept_arr = [];
        foreach ($departments as $department):
            $list_arr = [];
            $list_arr['icon'] = '';
            $list_arr['li_attr'] = '';
            $list_arr['a_attr'] = '';
            $list_arr['children'] = [];
            if($select !== null && $select == $department->id):
                $list_arr['state'] = [
                    'opened' => true,
                    'selected' => true,
                    'disabled' => false,
                ];
            elseif($dept_disabled !== null && $dept_disabled == $department->id):
                $list_arr['state'] = [
                    'opened' => false,
                    'selected' => false,
                    'disabled' => true,
                    'hidden' => true,
                ];
            endif;
            $list_arr['id'] =  $department->id;
            $list_arr['parent'] = $department->parent !== null ? $department->parent : '#';
            $list_arr['text'] =  $department->text ;
            array_push($dept_arr , $list_arr);
        endforeach;
        return json_encode($dept_arr , JSON_UNESCAPED_UNICODE) ;
    }
endif;

