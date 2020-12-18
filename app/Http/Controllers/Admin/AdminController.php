<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\Faqs;
use App\Models\Property;
// use App\Models\Product;
use App\Models\Type;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{

    function login()
    {
     
        return view('Admin.Login.login');
    }
    function checklogin(Request $request)
    {
       
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:3'
            ]);
        } catch (ValidationException $e) {
        }
        $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data))
        {
            
            return redirect('admin/dashboard');
        }
        else
        {
            return back()->with('error', 'Wrong Login Details');
        }

    }
    function logout (){
        {
            Auth::logout();
            return redirect('admin/login');
        }
    }
    function dashboard (){
        // dd('kghj');
        $user = Auth::user();
        $admin_common = new \stdClass();
        // if ($user->role_id == 1){

            $admin_dashboard = $this->admin_dashboard();

            $modules = $admin_dashboard['modules'];
            $reports = $admin_dashboard['reports'];
    
            $admin_common->id = '1';
            $admin_common->modules = $modules;
            $admin_common->reports = $reports;
            $admin_common->name = 'Admin';
    
            $chart = $admin_dashboard['chart'];
            session(['admin_common' => $admin_common]);
            return \View('layouts.default_dashboard',compact(
                'chart'));
        // }
        // elseif ($user->role_id == 3){
            
        //     return $this->user_dashboard();

        // }
        // else{
        //     return $this->logout();
        // }


       
    }

    public function admin_dashboard()
    {


        // $count = Property::count('id');

        // $modules[] = [
        //     'url' => 'admin/properties',
        //     'title' => 'Properties',
        //     'count' => $count
        // ];
        // $count = User::where('role_id','2')->count('id');
        // $modules[] = [
        //     'url' => 'admin/user',
        //     'title' => 'User',
        //     'count' => $count
        // ];

        // $count = Country::count('id');
       
        $modules[] = [
            'url' => 'country',
            'title' => 'Countries',
            'count' => '1'
        ];

        // $count = Faqs::count('id');

        $modules[] = [
            'url' => 'faqs',
            'title' => 'FAQs',
            'count' => '1'
        ];
        // $count = Type::count('id');

        $modules[] = [
            'url' => 'type',
            'title' => 'Types',
            'count' => '1'
        ];
        $chart = [];

        $response['modules'] = $modules;
        $response['reports'] = [];
        $response['chart'] = $chart;
        return $response;

    }

    public function user_dashboard(){
        return redirect('home');
    }



}


