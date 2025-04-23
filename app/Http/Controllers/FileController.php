<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class FileController extends Controller
{
public function download($filename): BinaryFileResponse
{
    $filePath = 'documents/' . $filename;

    if (!Storage::disk('public')->exists($filePath)) {
        abort(404, 'File not found.');
    }

    // Correct path based on where Laravel stores it
    $absolutePath = storage_path('app/public/' . $filePath);

    return response()->download($absolutePath);
}

}
