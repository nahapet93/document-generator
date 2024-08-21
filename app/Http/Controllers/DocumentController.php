<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{
    /**
     * @throws Exception
     */
    public function generateDocument(Request $request): BinaryFileResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $phpWord = new PhpWord();

        $section = $phpWord->addSection();
        $section->addText($request->input('date'), ['size' => 12]);

        $fileName = $request->input('title') . '.docx';
        $filePath = storage_path($fileName);

        $writer = IOFactory::createWriter($phpWord);
        $writer->save($filePath);

        return response()->download($filePath, $fileName);
    }
}
