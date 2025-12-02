<?php

namespace App\Http\Helpers;

use App\Models\PaymentGateway\OnlineGateway;

class IyzicoHelper
{
    public static function options()
    {
        $data = OnlineGateway::where('keyword', 'iyzico')->first();
        if (!$data) {
            return null;
        }
        
        $information = is_array($data->information) 
            ? $data->information 
            : json_decode($data->information, true);

        if (!$information) {
            return null;
        }

        $options = new \Iyzipay\Options();
        $options->setApiKey($information['api_key'] ?? '');
        $options->setSecretKey($information['secrect_key'] ?? $information['secret_key'] ?? '');
        
        if (isset($information['sandbox_status']) && $information['sandbox_status'] == 1) {
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        } else {
            $options->setBaseUrl("https://api.iyzipay.com"); // production mode
        }
        
        return $options;
    }
}

