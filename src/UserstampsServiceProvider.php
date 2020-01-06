<?php

namespace Munettt\Userstamps;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;


class UserstampsServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Providers to register.
     * @var array
     */
    protected $providers = [

    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blueprint::macro('userstamps', function($useDelete=true){
            $this->unsignedInteger('created_by')->nullable()->index();
            $this->unsignedInteger('updated_by')->nullable()->index();

            if ( $useDelete ) {
                $this->unsignedInteger('deleted_by')->nullable()->index();
            }
        });
    }



}
