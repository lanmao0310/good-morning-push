<?php

namespace app;

use EasyWeChat\Kernel\Exceptions\BadResponseException;
use EasyWeChat\Kernel\HttpClient\AccessTokenAwareClient;
use EasyWeChat\OfficialAccount\Application;
use Exception;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class weChat
{


    /**
     * 初始化
     * @throws Exception
     */
    public static function ini(): AccessTokenAwareClient
    {
        $config = self::getCount();
        $app = new Application([
            'app_id' => $config['appId'],
            'secret' => $config['appSecret'],
        ]);
        return $app->getClient();

    }

    /**
     * run
     * @throws Exception|TransportExceptionInterface
     */
    public static function run($data): array
    {
        $response = self::ini()->postJson("/cgi-bin/message/template/send", [
            "touser" => self::getCount('userAppId'),//用户openid
            "template_id" => self::getCount('templateMessage'),//模板信息
            "topcolor" => "#FF0000",
            "data" => $data
        ]);
        try {
            return $response->toArray(true);
        } catch (BadResponseException|ServerExceptionInterface|RedirectionExceptionInterface|DecodingExceptionInterface|ClientExceptionInterface|TransportExceptionInterface $e) {
            throw new Exception("请求异常");
        }
    }

    /**
     * 获取配置文件
     * @throws Exception
     */
    public static function getCount($key = null)
    {

        $count = require BASE_PATH . "config.php";
        if (is_null($key)) {
            return $count;
        } else {
            return $count[$key] ?? '';
        }
    }
}