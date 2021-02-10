<?php


namespace App\Http;


trait ResponseTrait
{
    public function successResponse($data)
    {
        return [
            "status" => true,
            "data" => $data
        ];
    }

    public function successResponseURL($url)
    {
        return [
            "status" => true,
            "redirect_url" => $url
        ];
    }

    public function failedResponse($message)
    {
        return [
            "status" => false,
            "message" => $message
        ];
    }
}
