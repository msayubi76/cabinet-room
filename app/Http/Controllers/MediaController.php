<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function destroy($id)
    {
        $media = Media::findorFail($id);
        $media->delete();
        // return redirect('admin.products/id/edit')->with('success','Media file deleted successfully ');
    }
}
