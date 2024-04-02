<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DocController;
use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
   // public function fileSave($file,$name)
   // {
   //    $extension = $file->getClientOriginalExtension();
   //    $fileName =$name. time() . '.' . $extension;
   //    $file->move('upload/pdf', $fileName);
   //    return $fileName;
   // }
    public function createContract(Request $req){
      $contro = new DocController();
        $data = new Contract();
        $data->leedId = auth()->user()->id;
        if($paper = $req->file('contractPaper')){
            $data->contractPaper = $contro->fileSave($paper,'CONT');
         }else{
            unset($data['contractPaper']);
         }
         if($paper = $req->file('paymentSlip')){
            $data->paymentSlip = $contro->fileSave($paper,'PAY');
         }else{
            unset($data['paymentSlip']);
         }
         $data->contractCode = rand(1234,9999);
         $data->endDate = $req->endDate;
         $result = $data->save();
         if($result){
            return response([
               'message'=>'Contract saved successfully',
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
