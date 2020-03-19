<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\programmes;
use App\compare;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /* 
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/student';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
 
public function __construct(programmes $programmes,compare $compare, User $User){
      $this-> programmes = $programmes;
      $this-> compare = $compare;
      $this-> User = $User;
      
        $this->middleware('guest');

    }

    public function showRegistrationForm(){
        $data = [];
        $data["programmes"] = $this->programmes->all();

        return view('auth.register',$data);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request){
        $validator_password = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validator_email = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        if($validator_password->passes()){
        if($validator_email->passes()){

  $reg =$this->compare->where('reg_number',$request -> reg_number)->count();
  $user =$this->User->where('reg_number',$request -> reg_number)->count();
           if($reg == 1 && $user != 1){
         $user = new User();
        $user->first_name = $request -> first_name;
        $user->middlename = $request -> middle_name;
        $user->last_name = $request -> last_name;
        $user->gender = $request -> gender;
        $user->email = $request -> email;
        $user->reg_number = $request -> reg_number;
        $user->programmes_id = $request -> programme;
        $user->role_id = '2';
        $user->password = Hash::make($request -> password);
        $user->save();

        return redirect('/login')->withStatus(__('registration successful! login'));
         }else{
                return redirect()->back()->withStatus(__('Sorry your Registration number is invalid! '))->withInput();
            }
        }
        else{
        return redirect()->back()->withStatus(__('Email already exists'))->withInput();

       }
        }
       else{
        return redirect()->back()->withStatus(__('your password entry does not match'))->withInput();

       }

    }
    // protected function create(array $data)
    // {
    //     $reg =$this->compare->where('reg_number',$data['reg_number'])->count();
    //             if($reg == 1){
    //             return User::create([
    //                 'first_name' => $data['first_name'],
    //                 'middlename' => $data['middlename'],
    //                 'last_name' => $data['last_name'],
    //                 'gender' => $data['gender'],
    //                 'programmes_id' => $data['programme'],
    //                 'reg_number' => $data['reg_number'],
    //                 'role_id' => '2',
    //                 'email' => $data['email'],
    //                 'password' => Hash::make($data['password']),
    //             ]);
    //         }else{
    //             return redirect()->back(); 
    //         }
    // }
}
