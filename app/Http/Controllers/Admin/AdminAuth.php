<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AdminAuth extends Controller
{
    protected $path = 'admin.Auth.';

    public function index(){
        return view('admin.home');
    }
    public function login_get(){
        return view($this->path.'login');
    }
    public function login_post(Request $request){
        $rememberme = $request->remeberme == 1 ? true : false ;

        $data  = array(
            'email'=>$request->email,
            'password' =>$request->password,
         ) ;
        if(Admin()->attempt($data,$rememberme)):
            if(setting()->main_lang):
                session()->put('lang' , setting()->main_lang) ;
            endif;
            return redirect(admin_routes());
        else:
            session()->flash('login_error' , trans('admin.invalid_login_data'));
            return redirect(admin_routes('login'));
        endif;
    }
    public function logout()
    {
        Admin()->logout();
        return redirect(admin_routes('login'));
    }

}
