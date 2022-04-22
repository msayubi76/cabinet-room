<?php

namespace App\Http\Controllers;

use App\Events\SendEmailEvent;
use App\Models\Media;
use App\Models\Transaction;
use App\Models\TransactionSellLine;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    use FileUploadTrait;
    public function __construct()
    {
        $this->middleware('auth');
 
        $this->middleware('permission:order.upload_documents',['only'=>['uploadProductDocuments', 'uploadMultipleFiles']]);
        $this->middleware('permission:order.remove_document',['only'=>['deleteFile']]);
        
        $this->middleware(['role_or_permission:Customer|Super Admin|order.view_documents']);
 
    } 

    

    public function uploadProductDocuments(Request $request)
    {
       
        $this->validate($request,[
            'documents'=>'required', 
            'id'=>'required', 
        ]);
        try{
            DB::beginTransaction();

            $id = decrypt($request->id);
 
            
            $data = $request->except('_token', 'id');

            

            $files = $request->file('documents');


            

            foreach($files as $file):
                $file_name = $this->fileUpload($file, 'product_documents');
                $extension = $file->getClientOriginalExtension();
                $mimetypes = new MimeType;
    
                $extension = $file->getClientOriginalExtension();
                $type = $mimetypes->get($extension);
     
                $type = explode('/',$type);
                $file_type = $type[0];

                $data['model_type'] = "App\Models\Transaction";
                
                $data['file_type'] = $file_type;
                $data['file'] = $file_name; 
                $data['transaction_id'] =  $id ;  
                
                 
                Media::create($data);
 
            endforeach;

            $transaction = Transaction::find($id);
            $email = $transaction->getCustomer?$transaction->getCustomer->email:'';

            event(new SendEmailEvent($email, env('ADMIN_EMAIL'), false, 'upload_document', $transaction));
            
            DB::commit(); 
            return redirect( 'documents/'.encrypt( $id ) )->with('success','Documents Uploaded Succesfully'); 
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e->getMessage()); 
        } 
    }

    private function uploadMultipleFiles($files){
        $files_with_extension = array();
       
        foreach($files as $file):
            $file_name = $this->fileUpload($file, 'product_documents');
            $extension = $file->getClientOriginalExtension();
            $mimetypes = new MimeType;

            $extension = $file->getClientOriginalExtension();
            $type = $mimetypes->get($extension);

           
            $type = explode('/',$type);
            $file_type = $type[0];
            array_push($files_with_extension, ['name'=>$file_name, 'file_type'=>$file_type, 'extension'=>$extension]);
        endforeach;
        return $files_with_extension;
    }

    public function deleteFile($id)
    {
        try{
            DB::beginTransaction();
            $id = decrypt($id);
            $item = Media::find($id);
 
           $this->fileDeleted($item->file, "product_documents");

            $item->delete();
            DB::commit();
            return response()->json(['status' => true, 'success' =>true, 'msg' => 'File Deleted Successfully']);
 
        }catch (\Exception $e){
            DB::rollback(); 
            return response()->json(['status' => false, 'success' =>false, 'msg' =>  $e->getMessage()]);
        }
    }

    public function getDocuments($id)
    {
        try{
            DB::beginTransaction();
            $id = decrypt($id);

            $items = Media::where('transaction_id', $id)->where('model_type', 'App\Models\Transaction')->get();

            $transaction = Transaction::find($id);
 
            return view('documents.product', compact('items', 'transaction'));
 
        }catch (\Exception $e){
            DB::rollback(); 
            return response()->json(['status' => false, 'success' =>false, 'msg' =>  $e->getMessage()]);
        }
    }
}
