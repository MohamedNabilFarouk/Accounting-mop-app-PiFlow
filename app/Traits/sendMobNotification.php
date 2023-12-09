<?php

namespace App\Traits;
use GuzzleHttp\Client;
use App\Models\User;

trait sendMobNotification
{

    public function sendFCM($request,$deviceToken)
    {
        //  dd($request->all());
        // $deviceTokens, $title, $body, $data = []
        $serverKey = 'AAAAfhSe-Ls:APA91bH18GWQvWeFuDbVC6tf9AV_9Vw5drASeWboQstOHaugI8HEif9jOj70rck61IndZKkOe1_3YVs81H7FS5ImbfAZmv3WslDWvonR5IC3ZTSBuTGOkD0dXf_aFpnLpf50UwSu3EPP';
        // dd($deviceTokens);
        // $deviceTokens=$user
        // foreach($deviceTokens as $u){
        $data = [
            "registration_ids" => [
                // 'dyimhz6aQImZ9TuKApcwT8:APA91bHaH0WQwSGyJpcLNvtgKtFyiooKhWV5VX6VbgoWxx-QFuSNKyu8hu9A6wCEI11e8kIgoK-_T-mV23MkWfH4Y6pkRdhOv5hGUDjT6BICS6ZV2lyj7ccI2gvNPdh9ZEcp8be5MFXr',
                // 'eUMAtRTuQtKOghtpY5ULSK:APA91bG6xFP_eVgeJwgK6aA11fx1euGPLLVwhgS6BTrrCT46Dg7DuTUV7pFxikLn0Qoi1EwmkRmpNCPJrnGpffBA6lG6ZzYcJcDZn4gHxJSJPtNPM3XxYYiiI6vjwx9EhgHnYrLwnid-'
                // 'fHkPoYsRTjmjIUU-QaZYWq:APA91bFAOzdCxQQILttMhdInIH9zpAwbKVDdkebhveaphiJ4KoZS7gsbsQ-a9F9KlvADG4LGdQ0cs23z9P7VmgZpV1bXHyG7UtID_7GHJK-9ovaGWKH_TzP42gADTpYZTzm4W-qZD4YU'
            $deviceToken
            ],

            'data'=> [
                // 'id'=>'2',
                'title'=> $request->title,
                'body'=>$request->body,
                'type'=>$request->type
            ],

             "sound"=> "default" // required for sound on ios

        ];
        $dataString = json_encode($data);
        $headers = [

            'Authorization: key=' . $serverKey,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
    // }
        //   dd($response);
          return $response;
        
    }
    

}
