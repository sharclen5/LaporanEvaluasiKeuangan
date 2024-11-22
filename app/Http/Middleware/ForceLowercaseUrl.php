<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceLowercaseUrl
{
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();
        $lowercasePath = strtolower($path);

        // Jika URL bukan lowercase, redirect ke versi lowercase
        if ($path !== $lowercasePath) {
            return redirect()->to($request->getSchemeAndHttpHost() . '/' . $lowercasePath, 301);
        }

        // Lanjutkan permintaan tanpa memodifikasi data lain
        return $next($request);
    }
}

