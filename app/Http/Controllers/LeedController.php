<?php

namespace App\Http\Controllers;

use App\Models\Leed;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserOtp;

use Illuminate\Http\Request;

class LeedController extends Controller
{
    public function initialSaveLeed(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|unique:leeds'
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => '203',
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        } else {
            $user = new Leed();
            $user->name = $req->name;
            $user->fatherName = $req->fatherName;
            $user->motherName = $req->motherName;
            $date = strtotime($req->birthDate);
            $formatDate = date('Y-m-d', $date);
            $user->birthDate = $formatDate;
            $user->phoneNo = $req->phoneNo;
            $user->email = $req->email;
            if ($file = $req->file('image')) {
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $file->move('upload/image', $fileName);
                $user->image = $fileName;
            } else {
                unset($user['image']);
            }
            $result = $user->save();
            if ($result) {
                return response([
                    'message' => 'Data is initially saved'
                ]);
            }
        }
    }
    public function otpGenerate(Request $req)
    {
        $user = UserOtp::where('phoneNo', $req->phoneNo)->first();
        $leed = Leed::where('email', $req->email)->first();
        $leed->phoneNo = $req->phoneNo;
        $leed->save();
        if ($user) {

            $user->delete();
        }
        $data = UserOtp::create([
            'otp' => rand(123456, 999999),
            'phoneNo' => $req->phoneNo
        ]);
        if ($data) {
            $this->sms($data->phoneNo, $data->otp);
            return response([
                'message' => 'otp is sent in your mobile,please Check',
                'status' => '201'
            ]);
        } else {
            return response([
                'message' => 'something went wrong, please try again',
                'status' => '202'
            ]);
        }
    }
    public function otpVerify(Request $req){
       $data = UserOtp::where('phoneNo',$req->phoneNo)->first();
       if($data){
        if($data->otp === $req->otp){
            return response([
             'message'=> 'otp verified successfully',
             'status'=>'201'
            ]);
        }else{
            return response([
                'message'=> 'otp didnt match',
                'status'=>'401'
               ]);
        }
       }
       return response([
        'message'=> 'otp is not generated, number invalid',
        'status'=>'403'

    ]);
    }







    public function sms($phone, $otp)
    {
        $basic  = new \Vonage\Client\Credentials\Basic("8907d8da", "wurXL6eDUM5dJwld");
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($phone, 'testing', $otp)
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
