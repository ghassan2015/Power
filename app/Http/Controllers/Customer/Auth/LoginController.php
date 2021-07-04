<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
//use App\Http\Requests\CustomersLoginRequest;
use App\Http\Requests\CustomersLoginRequest;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::Customers;


    public function login()
    {

        return view('Customer.auth.login');
    }


    public function postLogin(CustomersLoginRequest $request)
    {
//        return $request;

        if (auth('customer')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
            return redirect()->route('Customer.Invoice.index');
        }

        return view('Customer.auth.login');

    }


    public function logout()
    {

        $gaurd = $this->getGaurd();
        $gaurd->logout();

        return redirect()->route('Customer.login');
    }

    private function getGaurd()
    {
        return auth('customer');
    }


}
