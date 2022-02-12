<?php

namespace App\Http\Helpers;

class Helper
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function revertMoney($money)
    {
        //
        return "Rp. ".number_format($money,2,',','.',);
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
