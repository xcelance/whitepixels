<?php

namespace App\Http\Controllers\Auth;

use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Framework\Models\Database\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Mail\NewUserMail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/my-account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
               $SECRET = env('NOCAPTCHA_SECRET');
       $captcha = $_POST['g-recaptcha-response'];
        //GET VERIFY RESPONSE DATA
       $CAPTCHARESPONSE = FILE_GET_CONTENTS('https://www.google.com/recaptcha/api/siteverify?secret=' . $SECRET . '&response=' . $captcha);
        $RESPONSEDATA = JSON_DECODE($CAPTCHARESPONSE );
        /*echo "<pre>"; print_r($RESPONSEDATA); echo $RESPONSEDATA->success; die;*/
        if($RESPONSEDATA->success != 1) {

            return redirect()->back()->with('captcha_error', 'captcha error!');
        }
            // This function will return a random 
            // string of specified length 
            function random_strings($length_of_string) { 
                  
                // md5 the timestamps and returns substring 
                // of specified length 
                return substr(md5(time()), 0, $length_of_string); 
            } 
              
            // This function will generate  
            // Random string of length 10
        $email = $request->email;  
        $company_name = $request->company_name;     
        $password = random_strings(10); 
        $this->validator($request->all())->validate();
        
        //$userActivationRequired = Configuration::getConfiguration('user_activation_required');
        $request->merge(['password' => bcrypt($password)]);
        if($request->country == "Republic of Ireland"){
            $request["currency"] = "EUR";
        }else{
            $request["currency"] = "GBP";
        }
        $user = User::create($request->all());
        //event(new Registered($user));
        ///Mail::to($user)->send(new NewUserMail($user));

        
        $date = date("Y-m-d H:i:s");
        DB::table('user_address')->insertGetId(["user_id"=>$user->id,"delivery_contact_person"=>$request->contact_person,"delivery_contact_number"=>$request->phone,"delivery_email"=>$request->email,"delivery_business"=>$request->company_name,"delivery_address1"=>$request->address1,"delivery_address2"=>$request->address2,"delivery_city"=>$request->city,"delivery_country"=>$request->country,"delivery_state"=>$request->state,"delivery_postalcode"=>$request->postcode,"billing_contact_person"=>$request->contact_person,"billing_contact_number"=>$request->phone,"billing_email"=>$request->email,"billing_business"=>$request->company_name,"billing_address1"=>$request->address1,"billing_address2"=>$request->address2,"billing_city"=>$request->city,"billing_country"=>$request->country,"billing_state"=>$request->state,"billing_postalcode"=>$request->postcode,"submit_at"=>$date,"updated_at"=>$date]);
        $data = array("username"=> $user->username,"password"=> $password);
        Mail::send("mail.register_mail", $data, function($message) use($email,$company_name){
         $message->to($email, "<".$company_name.">")->subject
            ('User registeration');
        });
        return redirect()->back()->with('register_success', 'You have been successfully registred! Please check your email for username and password.');
        /*if (0 == $userActivationRequired) {
            $user->markEmailAsVerified();
            $this->guard()->login($user);
            return redirect($this->redirectPath());
        } else {
            return redirect()->route('login')
                            ->with('notificationText', 'Please Active your account then you can login!');
        }*/
    }

    public function guest_login(Request $request)
    {
                                            
        $date = date("Y-m-d h:i:s");
        $user = User::create([
            'first_name' => "Guest",
            'last_name' => "Guest",
            'username' => "Guest".time(),
            'email' => "guest@".time().".com",
            'password' => bcrypt("pw"),
            'role' => "guest"
        ]);
        if (Auth::attempt(['id' => $user->id, 'password' => "pw"])) {
            // Authentication passed...
                    $get_orderprocess= DB::table('orderprocess')
                               ->where("order_id",$request->id)
                               ->first();
                    $get_orderprocess->order_data = json_decode($get_orderprocess->order_data);
                    
                    if($get_orderprocess->order_data->order_price_symbol == "£"){
                        $currency = "GBP";
                    }else{
                        $currency = "EUR";
                    }   
            $user = Auth::user();
            $user->email_verified_at = $date;
            $user->currency = $currency;
            $user->save();
            DB::table('orderprocess')->where('order_id', $request->id)->update(['user_id' => Auth::user()->id]);
            return redirect('/order/orderprocess?process=order&id='.$request->id);
        }

    }


    protected function guard()
    {
        return Auth::guard('web');
    }
}
