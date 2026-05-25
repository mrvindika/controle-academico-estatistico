<?php

namespace App\Providers;

use App\Rules\Phone;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(config('app.env') !== 'local'){URL::forceScheme('https');}

        // Customized rules
        Validator::extend('phone', function($attribute, $value, $parameters, $validator){
            $rule= new Phone();
            $result= false;
            $rule->validate($attribute, $value, function() use(&$result){$result= true;});
            return !$result;
        });
    }
}
