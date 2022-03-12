<?php

namespace App\Http\Helpers;

class Helper
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public static function revertMoney($money)
    {
        //
        if (gettype($money) == 'string') {
            return "Rp. " . number_format((float) $money, 2, ',', '.',);
        }
        return "Rp. " . number_format($money, 2, ',', '.',);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
