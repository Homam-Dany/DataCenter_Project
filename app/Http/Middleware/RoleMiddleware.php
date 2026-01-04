<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
   public function handle(Request $request, Closure $next, ...$roles)
{
    // On vérifie si le rôle de l'utilisateur est présent dans le tableau des rôles autorisés
    if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
        abort(403, "Accès interdit : Vous n'avez pas le rôle nécessaire.");
    }

    return $next($request);
}
}
