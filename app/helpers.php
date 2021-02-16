<?php

use Illuminate\Support\Str;

if (!function_exists('sanitizeFile')) {
    function sanitizeFile($file)
    {
        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $sanitize = Str::of($file_name)->slug('-');
        $sanitize2 = $sanitize . '.' . $file_ext;

        return $sanitize2;
    }
}
