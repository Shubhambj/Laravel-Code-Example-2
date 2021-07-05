<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    /**
     * @description used to login page.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function index() {
        return response()->view('auth.login');
    }
    
    /**
     * @description used to check login credentials $ authenticate user.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
                
        $validationRules = [
            'email' => 'required|email',
            'password' => 'required|string|min:8|regex:/[@$!%*#?&]/'
        ];
        
        $customMessage = array(
		'password.regex' => 'Password must contain special character (@$!%*#?&)'
	);
        
        $validationObj = Validator::make($credentials, $validationRules, $customMessage);

        if($validationObj->fails()) {
            return redirect()->back()->withErrors($validationObj)->withInput();
        }
        
        $rememberMe = $request->has('remember_me') ? true : false;
        
        if(Auth::guard('web')->attempt($credentials, $rememberMe)) {
            return redirect()->route('dashboard');
        }
        
        session()->flash('message', 'Invalid Credentials');
        session()->flash('alert-type', 'danger');

        return redirect()->back();
    }
    
    /**
     * @description used to logout authenticated user.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function logout() {
        Auth::logout();
        return redirect()->route('auth.login-page');
    }
}
