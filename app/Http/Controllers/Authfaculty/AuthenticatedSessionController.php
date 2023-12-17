<?php

namespace App\Http\Controllers\Authfaculty;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\FacultyLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('facultyauth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(FacultyLoginRequest $request): RedirectResponse
    {
     
        $request->authenticate();
   
        $request->session()->regenerate();
      
        return redirect()->intended(RouteServiceProvider::FACULTYHOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('faculty')->logout();

        $request->session()->invalidate();
   

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
