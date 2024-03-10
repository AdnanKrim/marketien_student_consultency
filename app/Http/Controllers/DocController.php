<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\InfoFile;

class DocController extends Controller
{
   //  public function docStore(Request $req){
   //    info($req);
   //   $data = new Document();
   //   $data->leedId = auth()->user()->id;
   //   $formData = json_decode($req->input('formData'), true);
   //   $eduInfofiles = [];
   //   if(isset($formData->eduInfo)){

   //      foreach ($formData->eduInfo as $edu){
   //         $eduFileC = $this->file($edu['certificates']);

   //         $extensionC = $eduFileC->getClientOriginalExtension();
   //         $eduFileNameC = time() . '.' . $extensionC;
   //         $eduFileC->move('upload/pdf', $eduFileNameC);

   //         $eduFileM = $this->file($edu['markSheet']);

   //         $extensionM = $eduFileM->getClientOriginalExtension();
   //         $eduFileNameM = time() . '.' . $extensionM;
   //         $eduFileM->move('upload/pdf', $eduFileNameM);
   //         $eduInfofiles[] =[
   //             'degreeName' => $edu['degreeName'],
   //             'institutionName' => $edu['institutionName'],
   //             'certificates' => $eduFileNameC,
   //             'markSheet' => $eduFileNameM,
   //         ];

   //      }
   //   }

   //   $docInfoFiles=[];
   //   if(isset($formData->docInfo)){

   //      foreach($formData->docInfo as $doc){
   //         $docFile = $this->file($doc['file']);

   //         $extensionD = $docFile->getClientOriginalExtension();
   //         $docFileName = time() . '.' . $extensionD;
   //         $docFile->move('upload/pdf', $docFileName);

   //         $docInfoFiles[]=[
   //             'documentName' => $doc['documentName'],
   //             'file' => $docFileName,
   //         ];
   //      }
   //   }

   //   $data->eduInfo = json_encode($eduInfofiles);
   //   $data->docInfo = json_encode($docInfoFiles);
   //   $result =$data->save();
   //   if($result){
   //      return response([
   //         'message'=>'documents saved successfully',
   //         'status'=>'201'
   //      ]);
   //   }else{
   //      return response([
   //          'message'=>'something went wrong',
   //          'status'=>'403'
   //       ]);
   //  }
   //  }
    function fileSave($file,$name)
   {
      $extension = $file->getClientOriginalExtension();
      $fileName =$name. time() . '.' . $extension;
      $file->move('upload/pdf', $fileName);
      return $fileName;
   }
   public function docStore(Request $req)
   {

      $data = new InfoFile();
      $data->leedId = auth()->user()->id;
      $data->documentType = $req->documentType;
      $data->documentName = $req->documentName;
      if($req->has('institutionName')){
         $data->institutionName = $req->institutionName;
      }else{
         unset($data['institutionName']);
      }
      if($docC = $req->file('certificates')){
         $data->certificates = $this->fileSave($docC,'CERT');
      }else{
         unset($data['certificates']);
      }
      if($docM = $req->file('markSheet')){
         $data->markSheet = $this->fileSave($docM, 'MARK');
      }else{
         unset($data['markSheet']);
      }
      if($docD = $req->file('docFile')){
         $data->docFile = $this->fileSave($docD, 'DOC');
      }else{
         unset($data['docFile']);
      }
      $result = $data->save();
      if($result){
              return response([
                 'message'=>'documents saved successfully',
                 'status'=>'201'
              ]);
           }else{
              return response([
                  'message'=>'something went wrong',
                  'status'=>'403'
               ]);
          }
      
   }
}
