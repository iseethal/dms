<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [

        'doc_cat_id',
        'doc_file',
        'doc_type',
        'doc_size',
        'expiry_date',
    ];

    public function category(){

    	return $this->belongsTo(Category::class,'doc_cat_id','id');
    }
}
