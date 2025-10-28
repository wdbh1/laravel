<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

// Полностью отключаем CSRF middleware
class DisabledVerifyCsrfToken extends VerifyCsrfToken
{
    public function handle($request, \Closure $next)
    {
        return $next($request);
    }
}

// Заменяем стандартный middleware
$app->singleton(VerifyCsrfToken::class, function () {
    return new DisabledVerifyCsrfToken();
});

echo "CSRF защита отключена!\n";
