<?php

namespace App\Http\Controllers\Authstud;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('student')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::STUDHOME.'?verified=1');
        }

        if ($request->user('student')->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::STUDHOME.'?verified=1');
    }
}
