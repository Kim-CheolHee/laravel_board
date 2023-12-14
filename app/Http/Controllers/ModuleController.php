<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    public function index()
    {
        return view('pos::index');
    }

    public function home()
    {
        return view('home');
    }

    /**
     * 모듈 기기 화면 출력
     */
    public function moduleHome($deviceType)
    {
        // device_type에 따라 다른 뷰를 반환할 수 있습니다.
        // 예를 들어, 'pos'일 경우, 'pos' 관련 뷰를 반환합니다.
        // return view('module_login', compact('device_type'));
        $theme = 'theme2';
        // return view('module_home', compact('deviceType', 'theme'));
        return view('pos::module_home', compact('deviceType', 'theme'));
    }
}
