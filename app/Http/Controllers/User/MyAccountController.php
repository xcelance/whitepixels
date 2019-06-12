<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UploadUserImageRequest;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use AvoRed\Framework\Image\Facades\Image;

use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Framework\Models\Database\Order;
use AvoRed\Framework\Models\Database\User;

use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Contracts\OrderHistoryInterface;

use App\Http\Requests\MyAccount\Order\OrderReturnRequest;
use AvoRed\Framework\Models\Contracts\OrderReturnRequestInterface;
use AvoRed\Framework\Models\Contracts\OrderReturnProductInterface;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

class MyAccountController extends Controller
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
    */
    protected $configurationRepository;


    public function __construct(ConfigurationInterface $configurationRepository)
    {
        parent::__construct();
        $this->configurationRepository = $configurationRepository;
    }

    public function home()
    {

        if(Auth::guard()->user()){
            $user = Auth::guard()->user();
            $orders = Order::whereUserId($user->id)->get();
            $useraddress = DB::table("user_address")
                        ->where('user_id', $user->id)->get();   
            return view('user.my-account.home', ['user' => $user, 'orders' => $orders, 'useraddress' => $useraddress[0], 'myaccount'=> 'active']);
        }else{
            return redirect('home');
        }
    }

    public function edit()
    {
        $user = Auth::user();
        $deleteRequestDays = $this->configurationRepository->getValueByKey('user_delete_request_days');

        return view('user.my-account.edit')
            ->withUser($user)
            ->withDeleteRequestDays($deleteRequestDays);
    }

    /**
     *
     * Update User Profile Fields and Return to My Account Page
     *
     * @param \App\Http\Requests\UserProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     *
     */
    public function store(UserProfileRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());

        return redirect()->route('my-account.home');
    }
    public function edit_profile(Request $request)
    {
        //echo "<pre>"; print_r($_POST); die;
         $request = $request->all();
          $rules = [
                'username' => 'required|max:255|unique:users',
            ];

        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
           // handler errors

           $errors = $validator->errors();
          if($errors->has('username')){
              $data=array("action"=>"edit_error","msg"=>$errors->first('username'));
                    echo json_encode($data);
           }else{
              $data=array("action"=>"edit_error","msg"=>"Something went wrong");
                    echo json_encode($data);
           }
        }else{
            $user = Auth::user();
            $user->update($request);
            $data=array("action"=>"edit_success","msg"=>"Updated successfully!");
                    echo json_encode($data);
        }    
        

        //return redirect()->route('my-account.home');
    }
     public function edit_billing(Request $request)
    {
        //echo "<pre>"; print_r($request->all()); die;
         $date = date("Y-m-d H:i:s");
         DB::table('user_address')->where('user_id', Auth::user()->id)->update(["billing_business"=>$request->billing_business,"billing_address1"=>$request->billing_address1,"billing_address2"=>$request->billing_address2,"billing_city"=>$request->billing_city,"billing_country"=>$request->billing_country,"billing_state"=>$request->billing_state, "billing_postalcode"=>$request->billing_postalcode,"updated_at"=>$date]);
         
            $data=array("action"=>"edit_success","msg"=>"Updated successfully!");
                    echo json_encode($data);

        //return redirect()->route('my-account.home');
    }
    public function edit_delivery(Request $request)
    {
       // echo "<pre>"; print_r($request->all()); die;
         $date = date("Y-m-d H:i:s");
         DB::table('user_address')->where('user_id', Auth::user()->id)->update(["delivery_contact_person"=>$request->delivery_contact_person,"delivery_contact_number"=>$request->delivery_contact_number,"delivery_business"=>$request->delivery_business,"delivery_address1"=>$request->delivery_address1,"delivery_address2"=>$request->delivery_address2,"delivery_city"=>$request->delivery_city,"delivery_country"=>$request->delivery_country,"delivery_state"=>$request->delivery_state, "delivery_postalcode"=>$request->delivery_postalcode,"updated_at"=>$date]);
         
            $data=array("action"=>"edit_success","msg"=>"Updated successfully!");
                    echo json_encode($data);

        //return redirect()->route('my-account.home');
    }

    public function uploadImage()
    {
        return view('user.my-account.upload-image');
    }

    /**
     * @param \App\Http\Requests\UploadUserImageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadImagePost(UploadUserImageRequest $request)
    {
        $user = Auth::user();
        $image = $request->file('profile_image');
        if (false === empty($user->image_path)) {
            $user->image_path->destroy();
        }

        $image = Image::upload($request->file('profile_image'), 'users/' . $user->id)->makeSizes()->get();
        $user->update(['image_path' => $image->relativePath]);

        return redirect()->route('my-account.home')
            ->with('notificationText', 'User Profile Image Uploaded successfully!!');
    }

    public function changePassword()
    {
        return view('user.my-account.change-password');
    }

    public function changePasswordPost(Request $request)
    {
        $request = $request->all();
          $rules = [
                'password' => 'required|min:6|confirmed',
                'current_password' => 'required'
            ];

        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
           // handler errors

           $errors = $validator->errors();
          if($errors->has('password')){
              $data=array("action"=>"edit_error","msg"=>$errors->first('password'));
                    echo json_encode($data);
           }elseif($errors->has('current_password')){
              $data=array("action"=>"edit_error","msg"=>$errors->first('current_password'));
                    echo json_encode($data);
           }else{
              $data=array("action"=>"edit_error","msg"=>"Something went wrong");
                    echo json_encode($data);
           }
        }else{
            
            $user = Auth::user();
            if (Hash::check($request["current_password"], $user->password)) {
                $user->update(['password' => bcrypt($request["password"])]);
                $data=array("action"=>"edit_success","msg"=>"User Password Changed Successfully!");
                    echo json_encode($data);
            } else {
                $data=array("action"=>"edit_error","msg"=>"Your Current Password Wrong!");
                    echo json_encode($data);
            }
        }  
    }

    /**
     * Destroy the User Account as Soft Delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $days = $this->configurationRepository->getValueByKey('user_delete_request_days') ?? 60;
        $dueData = Carbon::now()->addDay($days);
        $user = Auth::user();
        $user->delete_due_date = $dueData;
        $user->status = 'DELETE_IN_PROGRESS';
        $user->update();
        
        $user->delete();
        return redirect()->route('my-account.home');
    }
}
