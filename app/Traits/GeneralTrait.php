<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

trait GeneralTrait
{
    protected $_user;

    public function setDefaultDataForView()
    {
        View::share('_user', $this->getUserData());
    }

    public function getUserData()
    {
        $user = Auth::user();

        if (Session::has('user_id')) {
            $_user = Session::get('user_id');
            Log::info('Session::has $_user: ' . $_user);
            $this->$_user = $_user;
        }

        return $user;
    }
}
