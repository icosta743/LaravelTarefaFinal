<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

//configuração do Fortify (criado com php artisan fortify:install)
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Regista os serviços da aplicação.
     */
    public function register(): void
    {
        //
    }

    /**
     * Inicializa os serviços da aplicação.
     */
    public function boot(): void
    {
        //registo de utilizadores novos
        Fortify::createUsersUsing(CreateNewUser::class);
        //atualizar o nome e o email do perfil
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        //mudar a password
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        //recuperar a password esquecida
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        //login com autenticação de dois fatores
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        //limita as tentativas de login a 5 por minuto (por email e IP)
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        //limita as tentativas do código de dois fatores a 5 por minuto
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        //limita as tentativas com passkeys a 10 por minuto
        RateLimiter::for('passkeys', function (Request $request) {
            $credentialId = $request->input('credential.id');

            return Limit::perMinute(10)->by(
                ($credentialId ?: $request->session()->getId()).'|'.$request->ip()
            );
        });

        //view que o Fortify mostra na página de login
        Fortify::loginView(function () {
            return view('auth.login');
        });

        //view que o Fortify mostra na página de registo
        Fortify::registerView(function () {
            return view('auth.register');
        });
    }
}
