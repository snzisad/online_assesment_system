<?php

namespace App\Http\Controllers;
use App\Http\ResponseTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use App\Model\OptionUser;
use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use AuthenticatesUsers;
    use ResponseTrait;

    protected $redirectTo = '/';

    public function test(){
        OptionUser::create([
            'employee_id' => 1,
            'option_id' => 12,
            'question_id' => 3,
            'mark' => 0,
        ]);

        dd("Success");
    }


    public function logout(Request $request){
        Auth::guard("web")->logout();
        Auth::guard("admin")->logout();
        return redirect("/");
    }

    public function login(Request $request){
        $this->validate($request, [
            'employee_id' => 'required|string',
         ]);

        $user = User::where(['employee_id'=>$request->employee_id])->first();


        if($user)
        {
            Auth::guard("web")->login($user);
            
            $data = $this->successResponseURL(route("welcome"));
        }
        else{
            $data = $this->failedResponse("failed");
        }

        return response()->json($data);
    }

    public function addAdmin(){
        Admin::insert([
            "employee_id" => "12345",
            "name" => "Admin 1",
            "password" => Hash::make("123456"),
        ]);

        dd("Success");
    }

    public function adminLogin(Request $request){
        $this->validate($request, [
            'employee_id' => 'required|string',
            'password' => 'required|string',
         ]);

         if(Auth::guard("admin")->attempt(['employee_id'=>$request->employee_id, 'password'=>$request->password]))
         {
            return redirect()->route("employees");
         }

         return redirect()->back()->withErrors(["Invalid Employee ID or Password"]);
    }

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
}
