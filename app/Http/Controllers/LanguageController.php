<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        // Validate the locale
        $availableLocales = ['en', 'id']; // List of supported locales
        if (!in_array($locale, $availableLocales)) {
            $locale = 'en'; // Default locale if invalid
        }

        // Store the locale in the session
        session()->put('locale', $locale);

        // Redirect back to the previous page
        return redirect()->back();
    }
}
