<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocController extends Controller
{
    public function docStore(Request $req){
     $data = new Document();
     $data->leedId = auth()->user()->id;
     $eduInfofiles = [];
     foreach ($req->eduInfo as $edu){
        $eduFileC = $this->file($edu['certificates']);

        $extensionC = $eduFileC->getClientOriginalExtension();
        $eduFileNameC = time() . '.' . $extensionC;
        $eduFileC->move('upload/pdf', $eduFileNameC);

        $eduFileM = $this->file($edu['markSheet']);

        $extensionM = $eduFileM->getClientOriginalExtension();
        $eduFileNameM = time() . '.' . $extensionM;
        $eduFileM->move('upload/pdf', $eduFileNameM);
        $eduInfofiles[] =[
            'degreeName' => $edu['degreeName'],
            'institutionName' => $edu['institutionName'],
            'certificates' => $eduFileNameC,
            'markSheet' => $eduFileNameM,
        ];
        
     }
     $docInfoFiles=[];
     foreach($req->docInfo as $doc){
        $docFile = $this->file($doc['file']);

        $extensionD = $docFile->getClientOriginalExtension();
        $docFileName = time() . '.' . $extensionD;
        $docFile->move('upload/pdf', $docFileName);

        $docInfoFiles[]=[
            'documentName' => $doc['documentName'],
            'file' => $docFileName,
        ];
     }

     $data->eduInfo = json_encode($eduInfofiles);
     $data->docInfo = json_encode($docInfoFiles);
     $result =$data->save();
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
