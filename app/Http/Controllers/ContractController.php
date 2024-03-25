<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    public function createContract(Request $req){
        $data = new Contract();
        $data->leedId = auth()->user()->id;
        if($paper = $req->file('contractPaper')){
            $data->certificates = $this->fileSave($paper,'CONT');
         }else{
            unset($data['contractPaper']);
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
