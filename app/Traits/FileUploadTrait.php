<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;

trait FileUploadTrait {

    public function fileUpload($photo,$path=null){
        $imagename = uniqid().'.'.$photo->getClientOriginalExtension();
        $destinationPath = public_path('site_images/'.$path);
        
        $photo->move($destinationPath, $imagename);
        return $imagename;
    }
    
    public function fileDeleted($photo,$path=null){
        $image_path = public_path('site_images/'.$path.'/'.$photo);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }    
    }

    public function uploadMultipleFiles($files, $model_id, $model_type, $request_type=null)
    {
        try {
           
            DB::beginTransaction();
            foreach ( $files as $file ) :
                    $file_name = $this->fileUpload($file, $model_type);
                    $type =   $file->getClientMimeType();
                    $type = explode('/', $type);
                    $type = $type[0];
                    $data['model_type'] = $model_type;
                    $data['file_type'] = $type;
                    $data['file'] = $file_name; 
                    $data['transaction_id'] = $model_id;
 
  
                Media::create($data);
            endforeach;
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }




}
