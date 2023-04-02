<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
        // Добавить этот метод для аутентификации пользователя через телефон
        public function phoneLogin(Request $request)
        {
            // Проверяем, есть ли пользователь с таким номером телефона
            $user = User::where('phone', $request->phone)->first();
    
            // Если пользователь не найден, возвращаем ошибку
            if (!$user) {
                throw ValidationException::withMessages([
                    'phone' => __('auth.phone'),
                ]);
            }
    
            // Если пользователь найден, пытаемся аутентифицировать его
            if (Auth::guard('web')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->filled('remember'))) {
                $request->session()->regenerate();
                // return redirect()->intended();
                // проверка для админа
                if (Auth::user()->hasRole('admin')) {
                    return redirect()->intended('/admin');
                }
                // проверка для водителя
                if (Auth::user()->hasRole('user')) {
                    return redirect()->route('showDriver', ['id' => Auth::user()->id]);
                }
                // для других user 
                return redirect()->intended('/');
            }
    
            // Если аутентификация не удалась, возвращаем ошибку
            throw ValidationException::withMessages([
                'phone' => __('auth.phone'),
            ]);

        // меням путь редиректа при авторизации по роли
        // return redirect()->intended(Auth::user()->hasRole('admin') ? '/admin' : '/');
        }




    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }


    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();
        
    //     // меням путь редиректа при авторизации по роли
    //     return redirect()->intended(Auth::user()->hasRole('admin') ? '/admin' : '/');
    // }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
