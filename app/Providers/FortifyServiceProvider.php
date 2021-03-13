<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function ($request) {

            $data['request'] = $request;
            return view("web.auth.login")->with($data);
        });


        Fortify::authenticateUsing(function (Request $request) {

            $credential = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            $remember_me  = (!empty($request->remember_me)) ? TRUE : FALSE;
            if (Auth::attempt($credential, $remember_me)) {

                $user = User::where('email', $request->email)->first();
                Auth::login($user, $remember_me);
            }
        });

        Fortify::registerView(function () {

            return view('web.auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {

            return view("web.auth.password.forgot-password");
        });

        Fortify::resetPasswordView(function ($request) {
            $data['request'] = $request;
            return view("web.auth.password.reset-password")->with($data);
        });


        Fortify::verifyEmailView(function () {
            return view("web.auth.verify-email");
        });


        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });
    }
}
