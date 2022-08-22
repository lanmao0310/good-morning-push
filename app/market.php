<?php

namespace app;

/**
 * 墨迹天气
 */
class market
{

    public static function get()
    {
        $url = "https://restapi.amap.com/v3/weather/weatherInfo?city=120000&key=8b136db0ddb09dc192cf19949e3cc28b";
        $data = self::post(url: $url, headers: [
//            "Authorization:APPCODE $appcode",
            "Content-Type:application/x-www-form-urlencoded;charset=UTF-8",
        ], body: "cityId=24&token=677282c2f1b3d718152c4e25ed434bc4");
        return $data['lives'][0] ?? [];
    }

    public static function post($url, $headers, $body, $method = 'GET')
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data, true);
    }


}