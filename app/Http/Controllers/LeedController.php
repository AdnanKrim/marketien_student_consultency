<?php

namespace App\Http\Controllers;

use App\Models\Leed;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserOtp;
use Carbon\Carbon;

use Illuminate\Http\Request;

class LeedController extends Controller
{
    public function saveLeed(Request $req)
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
            }else{
                return response([
                    'message' => 'something went wrong'
                ]);
            }
        }
    }
    public function studentReg(Request $req){
        $data = new User();
        $data ->email = $req->email;
        $data->password = Hash::make($req->password);
        $data->role = '2';
        $result = $data->save();
        if($result){
            return response([
                'message'=> 'student successfully registered'
            ]);
        }else{
            return response([
                'message'=> 'something went wrong'
            ]);
        }
        
    }
    public function otpGenerate(Request $req)
    {
        $user = UserOtp::where('phoneNo', $req->phoneNo)->first();
        // $leed = Leed::where('email', $req->email)->first();
        // $leed->phoneNo = $req->phoneNo;
        // $leed->save();
        if ($user) {

            $user->delete();
        }
        $data = UserOtp::create([
            'otp' => rand(123456, 999999),
            'phoneNo' => $req->phoneNo
        ]);
        if ($data) {
            $this->sms_send($data->phoneNo, $data->otp);
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
    public function otpVerify(Request $req)
    {
        $data = UserOtp::where('phoneNo', $req->phoneNo)->first();
        if ($data) {
            if ($data->created_at > Carbon::now()->subMinutes(3)->toDateTimeString()) {
                if ($data->otp === $req->otp) {
                    return response([
                        'message' => 'otp verified successfully',
                        'status' => '201'
                    ]);
                } else {
                    return response([
                        'message' => 'otp didnt match',
                        'status' => '401'
                    ]);
                }
            } else {
                return response([
                    'message' => 'otp is expired',
                    'status' => '403'

                ]);
            }
        } else {
            return response([
                'message' => 'otp is not generated, invalid number',
                'status' => '404'

            ]);
        }
    }
    function sms_send($phone, $otp) {
        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = "tqaynG0piLxtv6zgxbNI";
        $senderid = "8809617617020";
        $number = $phone;
        $message = $otp;
     
        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $message
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }






    // public function sms($phone, $otp)
    // {
    //     $basic  = new \Vonage\Client\Credentials\Basic("8907d8da", "wurXL6eDUM5dJwld");
    //     $client = new \Vonage\Client($basic);
    //     $response = $client->sms()->send(
    //         new \Vonage\SMS\Message\SMS($phone, 'testing', $otp)
    //     );

    //     $message = $response->current();

    //     if ($message->getStatus() == 0) {
    //         echo "The message was sent successfully\n";
    //     } else {
    //         echo "The message failed with status: " . $message->getStatus() . "\n";
    //     }
    // }
}
