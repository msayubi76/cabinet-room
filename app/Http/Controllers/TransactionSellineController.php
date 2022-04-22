<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\TransactionSellLine;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Support\Facades\DB;

class TransactionSellineController extends Controller
{
    use FileUploadTrait;
    public function __construct()
    {
        $this->middleware('auth');
    } 

    
 
  

}
