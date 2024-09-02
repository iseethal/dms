<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DocumentManagementController extends Controller
{

    public function DocumentCategories()
    {
        $categories = Category::get();
        return view('document.doc_categories', compact('categories'));

    }

    public function DocumentList()
    {
        $documents  = Document::with('category')->paginate(5);

        return view('document.list', compact('documents'));

    }

    public function AddDocument()
    {
        $categories = Category::get();

        return view('document.add', compact('categories'));

    }

    public function SaveDocument(Request $request)
    {

        if($request->doc_cat_id == 1 || $request->doc_cat_id ==2)
        {
            $validatedData = $request->validate([
                'doc_file' => 'required|mimes:pdf,doc,docx',

            ]);
        } else if($request->doc_cat_id == 3){

            $validatedData = $request->validate([
                'doc_file' => 'required|mimes:jpg,jpeg,png',

            ]);

        }

        if($request->file('doc_file')!= null){
            $file       = $request->file('doc_file');
            $filename   = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();
            $size       = $file->getSize();
            $request->doc_file->move(public_path('Documents'),$filename);
            $path = "public/Documents/$filename";
        }
        else{
            $filename = "";
        }


        Document::insert([

            'doc_file'         => $filename,
            'doc_cat_id'       => $request->doc_cat_id,
            'doc_type'         => $extension,
            'doc_size'         => $size,
            'expiry_date'      => $request->expiry_date,
            'created_at'       => Carbon::now('Asia/Kolkata'),


        ]);

        return redirect()->route('document.list');

    }

    public function EditDocument(Request $request)
    {
        $id         = $request->id;
        $categories = Category::get();
        $document   = Document::findOrFail($id);

        return view('document.edit', compact('categories','document'));

    }


    public function UpdateDocument(Request $request, $id)
    {
        if($request->doc_cat_id == 1 || $request->doc_cat_id ==2)
        {
            $validatedData = $request->validate([
                'doc_file' => 'required|mimes:pdf,doc,docx',

            ]);
        } else if($request->doc_cat_id == 3){

            $validatedData = $request->validate([
                'doc_file' => 'required|mimes:jpg,jpeg,png',

            ]);

        }

        $document   = Document::findOrFail($id);

        if($request->file('doc_file')!= null){

            $imagePath = public_path('Documents/'.$document->doc_file);

            if($document->doc_file != null){
                unlink($imagePath);
            }

            $file       = $request->file('doc_file');
            $filename   = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();
            $size       = $file->getSize();
            $request->doc_file->move(public_path('Documents'),$filename);
            $path = "public/Documents/$filename";

            Document::findOrFail($id)->update([

                'doc_file'         => $filename,
                'doc_cat_id'       => $request->doc_cat_id ?? $document->doc_cat_id,
                'doc_type'         => $extension ?? $document->doc_type,
                'doc_size'         => $size ?? $document->doc_size,
                'expiry_date'      => $request->expiry_date ?? $document->expiry_date   ,
                'created_at'       => Carbon::now('Asia/Kolkata'),


            ]);
        } else {

        $filename  = $document->doc_file;


        Document::findOrFail($id)->update([

            'doc_file'         => $filename,
            'doc_cat_id'       => $request->doc_cat_id ?? $document->doc_cat_id,
            'doc_type'         => $extension ?? $document->doc_type,
            'doc_size'         => $size ?? $document->doc_size,
            'expiry_date'      => $request->expiry_date ?? $document->expiry_date   ,
            'created_at'       => Carbon::now('Asia/Kolkata'),


        ]);
    }

        return redirect()->route('document.list');

    }

    public function DeleteDocument($id)
    {
        Document::destroy($id);

        return redirect()->route('document.list');

    }

}
