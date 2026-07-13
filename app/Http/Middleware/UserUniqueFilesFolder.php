<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserUniqueFilesFolder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $folder_name = 'my' . Auth::user()->id . 'files';
            if (!Storage::disk('public')->exists($folder_name)) {
                Storage::disk('public')->makeDirectory($folder_name, 0755, true, true);
            }

            // Configure the elFinder dir
            Config::set('elfinder.dir', [Storage::disk('public')->path($folder_name)]);

        }

        return $next($request);
    }
}
