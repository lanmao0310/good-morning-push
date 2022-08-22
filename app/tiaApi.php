<?php

namespace app;
/**
 * 墨迹天气
 */
class tiaApi
{

    public static function get()
    {
        $url = "http://api.tianapi.com/caihongpi/index?key=584fec05e7fa5d00c6f2b2636f6d7ee8";
        $data = json_decode(file_get_contents($url), true);
        return $data['newslist'][0]['content'] ?? '';
    }




}