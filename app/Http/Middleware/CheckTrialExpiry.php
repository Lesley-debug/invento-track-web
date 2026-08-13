<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTrialExpiry
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->tenant) {
            return $next($request);
        }

        $tenant = $user->tenant;

        // Active subscription — always allow
        if ($tenant->subscription_status === 'active') {
            return $next($request);
        }

        // Trial — check if expired
        if ($tenant->subscription_status === 'trial') {
            if ($tenant->trial_ends_at && now()->isAfter($tenant->trial_ends_at)) {
                $tenant->update(['subscription_status' => 'expired']);
            }
        }

        // Expired — only allow settings and logout
        if ($tenant->subscription_status === 'expired') {
            $allowedRoutes = [
                'settings',
                'settings.update',
                'settings.password',
                'logout',
                'dashboard'
            ];
            if (!in_array($request->route()->getName(), $allowedRoutes)) {
                return redirect()->route('dashboard')
                    ->with('trial_expired', true);
            }
        }

        return $next($request);
    }
}
