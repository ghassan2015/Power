<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function Profile()
    {
        $user_id = auth()->id();
        $user = User::findOrFail($user_id);
        return view('Pages.User.Profile.account-information', compact('user'));

    }

    public function UpdateProfile(Request $request, $id)
    {

        $user = User::find($id);
        $request->validate([
            'email' => ['required', 'email:rfc,dns', Rule::unique('users')->ignore($user->id),],
            'name' => ['required', 'string', 'max:255',]
        ]);
        try {
            $input = $request->all();

            $user->update($input);
            toastr()->success('تم تعديل البيانات بنجاح');
            return redirect()->back();
        } catch (\Exception $exception) {
            return $exception;
            toastr()->error('هناك خطا لم يتم حفظ البيانات بنجاح');
            return redirect()->back();

        }
    }

    public function changePassword()
    {
        return view('Pages.User.Profile.change-password');

    }


    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        try {


            User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        } catch (\Exception $exception) {
            return $exception;
            toastr()->error('هناك خطا لم يتم حفظ البيانات بنجاح');
            return redirect()->back();

        }

    }

    public function logout()
    {

        $gaurd = $this->getGaurd();
        $gaurd->logout();

        return redirect()->route('login');
    }

    private function getGaurd()
    {
        return auth()->guard();
    }


}
