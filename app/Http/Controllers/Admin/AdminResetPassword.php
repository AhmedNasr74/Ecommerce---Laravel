<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Admin;
use DB;
use Carbon\Carbon;
use Mail;
use  App\Mail\AdminResetPassword as Mailer;

class AdminResetPassword extends Controller
{
    protected $path = 'admin.passwords.';
    public function forgot_password_view()
    {
        return view($this->path.'forgot');
    }
    public function forgot_password_post(Request $request)
    {
        $admin = Admin::where('email' , $request->email)->first();
        if(!empty($admin)):
            $token = app('auth.password.broker')->CreateToken($admin);
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            Mail::to($admin->email)->send(new Mailer(['token' => $token , 'data' => $admin]));
            session()->flash('reset_password_email_sent' , trans('You have recived a mail to reset your password , check your mail'));
            return back();
        else:
                return redirect(admin_routes('password/forgot'));
        endif;
    }
    public function reset_password_view($token)
    {
        $check_token = DB::table('password_resets')
                        ->where('token' , $token)
                        ->where('created_at' , '>' , Carbon::now()->subHours(2))
                        ->first();
        if(!empty($check_token)):
            return view($this->path.'reset' , ['data' => $check_token]);
        else:
            session()->flash('reset_password_token_expired' ,'Your Token has been Expired , Try agin to reset your password');
            return redirect(admin_routes('password/forgot'));
        endif;
    }
    public function reset_password($token)
    {
        $this->validate(request(),[
            'password' =>'required|confirmed',
            'password_confirmation'=>'required'
        ],[],
        [
            'password' =>'Password',
            'password_confirmation'=>'Confirmation Password'
        ]);
        $check_token = DB::table('password_resets')
                        ->where('token' , $token)
                        ->where('created_at' , '>' , Carbon::now()->subHours(2))
                        ->first();
        if(!empty($check_token)):
            DB::table('password_resets')->where('email' , $check_token->email)->delete();
            $admin_account = Admin::where('email' , $check_token->email)->update([
                'email'=> $check_token->email,
                'password' => Hash::make(request('password'))
            ]);
            Admin()->attempt(['email'=>request('email'),
            'password' => request('password')],false);
            return redirect(admin_routes());

        else:
            session()->flash('reset_password_token_expired' ,'Your Token has been Expired , Try agin to reset your password');
            return redirect(admin_routes('password/forgot'));
        endif;
    }




}
