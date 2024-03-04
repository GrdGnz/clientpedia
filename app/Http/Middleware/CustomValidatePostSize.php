<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;

class CustomValidatePostSize extends ValidatePostSize
{
    public function handle($request, Closure $next)
    {
        $max = $this->getPostMaxSize();

        if ($max > 0 && $request->server('CONTENT_LENGTH') > $max) {
            // Handle the PostTooLargeException and return a custom response.
            return redirect()->back()->with('error', 'Profile photo must not exceed 2MB in size.');
        }

        return parent::handle($request, $next);
    }
}
