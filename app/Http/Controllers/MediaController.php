<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function delete($id)
    {
        $media = Media::findorFail($id);
        $media->delete();
    }
}
