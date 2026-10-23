<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MediaController extends Controller
{
    public function show(Request $request, string $path): StreamedResponse
    {
        $path = str_replace('\\', '/', $path);
        $path = ltrim($path, '/');

        if (str_contains($path, '..')) {
            abort(404);
        }

        if (! Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return Storage::disk('public')->response($path, null, [
            'Content-Disposition' => 'inline; filename="'.basename($path).'"',
        ]);
    }
}
