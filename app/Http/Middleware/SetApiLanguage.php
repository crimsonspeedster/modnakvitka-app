<?php

namespace App\Http\Middleware;

use App\Models\Langs;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class SetApiLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $code = $request->query('lang')
            ?? $request->header('Accept-Language')
            ?? 'ua';

        if (str_contains($code, ',')) {
            $code = explode(',', $code)[0];
        }

        $code = strtolower(substr($code, 0, 2));

        $language = Cache::remember(
            "language_$code",
            60 * 60,
            fn () => Langs::where('code', $code)->first()
        );

        if (!$language) {
            $language = Cache::remember(
                "language_default",
                60 * 60,
                fn () => Langs::where('code', 'ua')->firstOrFail()
            );
        }

        app()->instance('currentLanguage', $language);
        app()->instance('lang_id', $language->id);

        return $next($request);
    }
}
