<?php

namespace App\Http\Controllers;

use App\Support\Locale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        Locale::set($locale);

        $redirect = $request->query('redirect', url()->previous() ?: route('cv'));

        // Keep user on same page without stacking lang query params.
        $url = preg_replace('/([?&])lang=[^&]+(&|$)/', '$1', $redirect);
        $url = rtrim($url, '?&');

        return redirect()->to($url ?: route('cv'));
    }
}
