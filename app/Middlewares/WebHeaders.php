<?php

namespace App\Middlewares;

use App\Systems\Middleware\MiddlewareInterface;
use App\Systems\Response;

class WebHeaders implements MiddlewareInterface
{
    public function handle(): ?Response
{
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');

    header(
        "Content-Security-Policy: " .
            "default-src 'self'; " .
            // 'unsafe-inline' যোগ করা হয়েছে যাতে Inline Script চলতে পারে
            "script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; " . 
            // Google Fonts CSS এবং আপনার লোকাল সাইটের জন্য অনুমতি যোগ করা হয়েছে
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com http://portfolio-new.test; " .
            // Google Fonts-এর ফন্ট ফাইলগুলোর অনুমতি দেওয়া হয়েছে
            "font-src 'self' https://fonts.gstatic.com data:; " . 
            "img-src 'self' data:; " .
            "connect-src 'self' https://cdn.jsdelivr.net;"
    );

    return null;
}
}
