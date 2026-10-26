<?php

namespace App\Http\Controllers;

use App\Models\CvFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CvDownloadController extends Controller
{
    public function download(): BinaryFileResponse|StreamedResponse
    {
        $file = CvFile::active();

        if ($file?->file_path && Storage::disk('public')->exists($file->file_path)) {
            $downloadName = $file->original_name
                ?: (($file->title ?: 'CV').'.pdf');

            return Storage::disk('public')->download($file->file_path, $downloadName, [
                'Content-Type' => $file->mime_type ?: 'application/pdf',
            ]);
        }

        $fallback = public_path('cv/Tieng-Chamrern.pdf');
        if (is_file($fallback)) {
            return response()->download($fallback, 'Tieng-Chamrern.pdf', [
                'Content-Type' => 'application/pdf',
            ]);
        }

        abort(404, 'CV PDF not found. Re-upload in Admin → CV PDF File.');
    }
}
