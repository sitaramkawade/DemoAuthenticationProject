<?php

namespace App\Http\Controllers\Authstud;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('student')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::STUDHOME);
        }

        $request->user('student')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
