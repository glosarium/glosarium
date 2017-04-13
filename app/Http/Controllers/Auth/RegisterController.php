<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\User\RegistrationNotification;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Notification;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->redirectTo = route('user.account.dashboard');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array                                        $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Validator::extend('valid_name', function ($attribute, $value) {
            if (!\File::exists($path = storage_path('misc/name.json'))) {
                return true;
            }

            $names = json_decode(\File::get($path));

            return !str_contains(strtolower($value), $names);
        });

        return Validator::make($data, [
            'name'                 => 'required|max:100|valid_name',
            'email'                => 'required|email|max:255|unique:users,email',
            'password'             => 'required|min:6',
            'passwordConfirmation' => 'required|same:password',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        try {
            $user = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => bcrypt($data['password']),
                'is_active' => true,
            ]);

            // notif admin
            $users = User::whereType('admin')
                ->whereIsActive(true)
                ->get();
            Notification::send($users, new RegistrationNotification($user));

        } catch (Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'isSuccess' => false,
                    'message'   => trans('global.internalError'),
                ], 500);
            }

            abort(500, $e->getMessage());
        }

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if (request()->ajax()) {
            return response()->json([
                'isSuccess' => true,
                'url'       => route('glosarium.word.index'),
            ]);
        } else {
            return redirect($this->redirectPath());
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auths.registers.form', compact('image'))
            ->withTitle(trans('user.register'));
    }

    public function email()
    {
        $user = User::whereEmail(request('email'))->first();

        if (!empty($user)) {
            return response()->json([
                'success' => false,
                'message' => trans('user.emailExists'),
            ], 422);
        }

        return response()->json(['success' => true]);
    }
}
