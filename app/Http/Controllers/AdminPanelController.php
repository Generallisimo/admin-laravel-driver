<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{
    public function AdminPanel(){
        // получение имени текущего аутентифицированного пользователя
        $name = Auth::user()->name;

        return view('admin/admin_panel', ['name' => $name]);
    }

}
