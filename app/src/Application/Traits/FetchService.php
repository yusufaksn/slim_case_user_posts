<?php

namespace App\Application\Traits;

trait FetchService {

    public function getService($url){
        if(isset($url) and is_string($url)){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            if($response === false) {
                $error = curl_error($ch);
                curl_close($ch);
                return ['error' => 'cURL Error: ' . $error];
            }
            curl_close($ch);
            $users = json_decode($response, true);
            if($users === null) {
                return ['error' => 'Error decoding JSON'];
            }
            return $users;
        }

    }
}
