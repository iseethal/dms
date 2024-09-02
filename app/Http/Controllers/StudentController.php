<?php

namespace App\Http\Controllers;

use Zxing\QrReader;
use App\Models\Student;
use Spatie\Image\Convert;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class StudentController extends Controller
{

    public function AddStudent()
    {
        return view('student.add_student');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
        ]);

        // Create a new student record
        $student = Student::create($request->only(['name', 'email']));

        // Generate the QR code
        $qrCode = QrCode::format('png')->generate($student->id);

        dd($qrCode);


        // Define the file path
        $filePath = 'qrcodes/' . $student->id . '.png';

        // Store the QR code image in the public storage
        Storage::disk('public')->put($filePath, $qrCode);

        // Update the student record with the QR code path
        $student->update(['qr_code_path' => $filePath]);

        return response()->json(['student' => $student], 201);
    }

    public function generateUrlQrCode()
    {

        $id = "sreeja";
        $qrCode = QrCode::size(200)->generate($id);

        $path = 'qr-codes/';
        $filename = 'qr-code-' . $id . '.svg';

        $pngPath = storage_path('app/qr-codes/qr-code-123.svg');

        Storage::disk('public')->put($path . $filename, $qrCode);

        $publicUrl = asset('storage/' . $path . $filename);

        return view('welcome', compact('qrCode'));
    }

       public function readQrCode()
    {

        $filePath = storage_path('app/public/qr-codes/qr-code-sreeja.svg');
        $pngPath = storage_path('app/public/qr-codes/qr-code-sreeja.png');

        // Browsershot::html("<img src='{$filePath}' />")
         Browsershot::html("<img src='{$filePath}' style='background: transparent;' />")
        ->setScreenshotType('png')
        ->save($pngPath);


        $filePath = storage_path('app/public/qr-codes/qr-code-sreeja.png');
        $qrReader = new QrReader($filePath);
        $qrCodeContent = $qrReader->text();


        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // dd($qrCodeContent);


    }

    // public function readQrCode()
    // {

    //     $filePath = storage_path('app/public/qr-codes/qr-code-seethal.svg');
    //     $pngPath = storage_path('app/public/qr-codes/qr-code-seethal.png');

    //     Browsershot::html("<img src='{$filePath}' />")
    //     ->setScreenshotType('png')
    //     ->save($pngPath);


    //     $filePath = storage_path('app/public/qr-codes/qr-code-seethal.png');
    //     $qrReader = new QrReader($filePath);
    //     $qrCodeContent = $qrReader->text();

    //     Storage::disk('public')->delete($pngPath);

    //     dd($qrCodeContent);
    // }




}
