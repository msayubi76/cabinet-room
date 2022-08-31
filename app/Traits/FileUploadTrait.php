<?php

namespace App\Traits;
use File;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait FileUploadTrait {
    public static function fileUpload($photo,$folder_name='upload'){
        $filename = uniqid().'.'.$photo->getClientOriginalExtension();
        $photo->storeAs($folder_name, $filename,'public');
        return $filename;
    }

    public function fileDeleted($photo,$path=null){
        $image_path = public_path('images/'.$path.'/'.$photo);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }

    public static function uploadMultipleFiles($files, $model, $folder_name='uploads')
    {

            DB::beginTransaction();
            $array = [];

            foreach ( $files as $file ) :

                    $file_name = self::fileUpload($file, $folder_name);

                    $type =   $file->getClientMimeType();



                    $data['model_type'] = get_class($model);

                    $data['name'] = $file_name;
                    $data['size'] = $file->getSize();

                    $data['folder_name'] = 'products';
                    $data['url'] =  url('/storage/products/' . $file_name);;
                    $data['extension'] = $type;

                    $data['model_id'] = $model->id;



                    $array[] = $data;


            endforeach;

            $media = Media::insert($array);
            DB::commit();
            return $media;

    }

    public function MultipleFilesDeleted($files, $model,$path=null){
        $image_path = public_path('images/'.$path.'/'.$files, $model,);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }



}
