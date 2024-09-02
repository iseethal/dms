<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DocumentManagementController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {

//     $string = 'hey there';
//     $qrcode = QrCode::generate($string);

//     return view('welcome')->with('qrcode',$qrcode);
// });

// Route::get('/custom-qrcode', function () {
//     $qrCode = QrCode::format('png')->size(200)->generate('https://example.com');
//     $path = storage_path('app/public/qrcode.png');
//     Storage::put('public/qrcode.png', $qrCode);

//     return response()->download($path);
// });

Route::controller(DocumentManagementController::class)->group(function () {

    Route::get('/list', 'DocumentList')->name('document.list');
    Route::get('add-document', 'AddDocument')->name('document.add');
    Route::post('save-document', 'SaveDocument')->name('document.save');
    Route::get('edit-document', 'EditDocument')->name('document.edit');
    Route::post('update-document/{id}', 'UpdateDocument')->name('document.update');
    Route::get('delete-document/{id}', 'DeleteDocument')->name('document.delete');


    Route::get('doc-categories', 'DocumentCategories')->name('document.categories');


});

Route::get('/add-student', [StudentController::class, 'AddStudent']);
Route::post('/students', [StudentController::class, 'store']);
Route::get('/generate-qrcode', [StudentController::class, 'generateUrlQrCode']);
Route::get('/read-qrcode', [StudentController::class, 'ReadQrCode']);
Route::get('/handle-qrcode', [StudentController::class, 'handleQrCode']);
