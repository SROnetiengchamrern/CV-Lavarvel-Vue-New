<?php

namespace App\Http\Controllers;

use App\Models\CvFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CvDownloadController extends Controller
{
    public function download(): StreamedResponse
    {
        $file = CvFile::active();

        if (! $file || ! Storage::disk('public')->exists($file->file_path)) {
            abort(404, 'CV PDF not found.');
        }

        $downloadName = $file->original_name
            ?: (($file->title ?: 'CV').'.pdf');

        return Storage::disk('public')->download($file->file_path, $downloadName, [
            'Content-Type' => $file->mime_type ?: 'application/pdf',
        ]);
    }
}
