<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('login');
         // Si la requête attend une réponse JSON, retourner une réponse 401 Unauthorized
         if ($request->expectsJson()) {
            return response()->json(['message' => 'Non authentifié'], 401);
        }

        // Pour d'autres types de requêtes, gérer la redirection comme nécessaire (généralement pour une interface web)
        return route('login');
    }
}
