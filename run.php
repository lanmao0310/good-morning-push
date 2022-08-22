<?php
//加载
require __DIR__ . '/vendor/autoload.php';
//use market\market;
use app\market;
use app\tiaApi;
use app\weChat;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
$birthdayTime = strtotime(date("Y-03-12 "));//生日日期
if ($birthdayTime > time()) {
    $birthday = (int)((time() - $birthdayTime) / 86400);
} else {
    $birthday = (int)((strtotime("+1 year", $birthdayTime) - time()) / 86400);
}

$market = market::get();
try {
    $res = weChat::run(
        data: [
            "data" => [
                'value' => date("Y-m-d ") . ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"][date("w")],
                'color' => '#57c9ed'
            ],
            "weather" => [
                'value' => $market['weather'] . (!empty($market['winddirection']) && !empty($market['windpower']) ? "({$market['winddirection']}风,{$market['windpower']}级)" : ''),
                'color' => '#57c9ed'
            ],//天气
            "temperature" => [
                'value' => $market['temperature'] . "℃"
            ],//当前温度
            "first" => [
                'value' => (int)((time() - strtotime('2020-09-05')) / 86400),// 在一起的日期
                'color' => '#173177'
            ],//今天是我们在一起的第{{first.DATA}}天！
            "birthday" => [
                'value' => $birthday,
                'color' => '#173177'
            ],//当前温度
            "firstaaa" => [
                'value' => tiaApi::get(),
                'color' => '#ab6699'
            ]
        ]
    );
    print_r($res);
} catch (TransportExceptionInterface|Exception $e) {
    echo "异常";
}