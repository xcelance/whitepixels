<?php

namespace App\Http\Controllers\Auth;

use AvoRed\Framework\Models\Database\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Contracts\UserInterface;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    use AuthenticatesUsers;
    
    const CONFIG_KEY = 'user_logout_keep_cart_products';

    const SOCIAL_BUTTON_KEYS = ['facebook', 'twitter', 'google'];

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/my-account';
    
    /**
     * User Repository
     * @var \AvoRed\Framework\Models\Repository\UserRepository
     */
    protected $userRepository;

    /**
     * User Repository
     * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
     */
    protected $configurationRepository;

    /**
     * Admin User Controller constructor.
     *
     * @return void
     */
    public function __construct(
        UserInterface $userRepository,
        ConfigurationInterface $configurationRepository
    ) {
        parent::__construct();

        $this->middleware('guest', ['except' => 'logout']);
        $url = URL::previous();
        $checkoutUrl = route('checkout.index');

        if ($url == $checkoutUrl) {
            $this->redirectTo = $checkoutUrl;
        }
        $this->userRepository = $userRepository;
        $this->configurationRepository = $configurationRepository;
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $rep = app(ConfigurationInterface::class);
        $keepCartItems = $rep->getValueByKey(self::CONFIG_KEY);
        if ($keepCartItems) {
            $config = $cartItems = $request->session()->get('cart_products');
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        if ($keepCartItems) {
            Session::put('cart_products', $cartItems);
        }

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = User::whereEmail($request->get('email'))->first();

        if (!empty($user->activation_token)) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Please Activate your email', 'enableResendLink' => 'true']);
            ;
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $socialButtonStatus = $this->getSocialButtonStatus();
        return view('auth.login')
            ->withSocialButtonStatus($socialButtonStatus)
            ->withSocialKeys(self::SOCIAL_BUTTON_KEYS);
    }
    public function login_ajax(Request $request)
    {
        if (Auth::attempt ( array (
            'username' => $request['username'],
            'password' => $request['password'] 
        ))) {
            session ( [ 
                'username' => $request['username'],
            ] );
            $date_now = Carbon::now();
            $date = date("Y-m-d H:i:s");
                                     $user = Auth::user();
                                     $user->email_verified_at = $date;
                                     $user->save();
            
             if($request->onorder == 1){
                 $success = "Successful login. Redirecting........";
                 $redirect = url("order/orderprocess?process=order&id=".$request['order_id']);
                 DB::table('orderprocess')->where('order_id', $request['order_id'])->update(['user_id' => Auth::user()->id]);
                 $data=array("action"=>"success","success_message"=>$success,"redirect"=>$redirect);
                 echo json_encode($data);
             }else{
                 $success = "Successful login. Redirecting........";
                 $redirect = url("my-account");
                 $data=array("action"=>"success","success_message"=>$success,"redirect"=>$redirect);
                 echo json_encode($data);
             }
        } else {
           $data=array("action"=>"reg_error","errors"=>"Invalid username/password.");
                    echo json_encode($data);
        }
        
    }

    /**
     * Return url for after user  Login or Register
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('my-account.home');
    }

    /**
     * Do a Provider based login
     * @param string $provider
     *
     */
    public function providerLogin($provider)
    {
        $rep = app(ConfigurationInterface::class);

        $clientId = $rep->getValueByKey('users_' . $provider . '_client_id');
        $clientSecret = $rep->getValueByKey('users_' . $provider . '_client_secret');

        Config::set('services.' . $provider, [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect' => asset('login/' . $provider . '/callback')
        ]);

        if ('twitter' === $provider) {
            return Socialite::driver($provider)->redirect();
        } else {
            return Socialite::driver($provider)->stateless()->redirect();
        }
    }

    /**
     * Do a Provider based login
     * @param string $provider
     *
     */
    public function providerCallback($provider)
    {
        $rep = app(ConfigurationInterface::class);

        $clientId = $rep->getValueByKey('users_'. $provider .'_client_id');
        $clientSecret = $rep->getValueByKey('users_'. $provider .'_client_secret');

        Config::set('services.' . $provider, [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect' => asset('login/'. $provider .'/callback')
        ]);

        if ('twitter' === $provider) {
            $user = Socialite::driver($provider)->user();
        } else {
            $user = Socialite::driver($provider)->stateless()->user();
        }

        switch ($provider) {
            case 'twitter':
                $channel = 'TWITTER';
                break;
            case 'facebook':
                $channel = 'FACEBOOK';
                break;
            case 'google':
                $channel = 'GOOGLE';
        }

        
        if (empty($user->email)) {
            throw new \Exception(
                'Please check ' . $provider . ' permisssion or asked user to allow them to give access to their email'
            );
        }
        $modelUser = $this->userRepository->findByEmail($user->email);
        if (null === $modelUser) {
            $data = [
                'first_name' => $user->name,
                'last_name' => '',
                'email' => $user->email,
                'password' => bcrypt(str_random(8)),
                'registered_channel' => $channel
            ];
            $modelUser = $this->userRepository->create($data);
        }
        Auth::loginUsingId($modelUser->id);

        return redirect($this->redirectTo);
    }

    /**
     * Get Social button status
     * @return \Illuminate\Support\Collection $socialButtonStatus
     */
    private function getSocialButtonStatus()
    {
        $socialButtonStatus = Collection::make([]);
        $socialKeys = self::SOCIAL_BUTTON_KEYS;

        foreach ($socialKeys as $socialKey) {
            $configValue = $this->configurationRepository->getValueByKey('users_' . $socialKey . '_client_id');
            if (null !== $configValue) {
                $socialButtonStatus->put($socialKey, true);
            } else {
                $socialButtonStatus->put($socialKey, false);
            }
        }
        return $socialButtonStatus;
    }

    public function loginprocessForm()
    {
        $socialButtonStatus = $this->getSocialButtonStatus();
        return view('auth.loginprocess')
            ->withSocialButtonStatus($socialButtonStatus)
            ->withSocialKeys(self::SOCIAL_BUTTON_KEYS);
    }
}
