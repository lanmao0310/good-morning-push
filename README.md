# Good morning push

早安推送

##  模板消息
```php
{{data.DATA}} 
天气:   {{weather.DATA}} 
当前温度:   {{temperature.DATA}} 
今天是我们在一起的第{{first.DATA}}天！ 
距离你的生日还有{{birthday.DATA}}天！ 


{{firstaaa.DATA}}
```
##  config.php  全部参数 对应的 appid  appSecret userAppId templateMessage
```php
return [
    "appId" => "wx56b817e605dde717",//微信appid`
    "appSecret" => "f957f28ee8ab87e9081ac1080c15043f",//微信appSecret
    "userAppId" => 'o2Wy45gPmavbMOHT2z5IGVliKPqg',//用户appid 扫码关注后看到
    'templateMessage' => 'A-0ZayusOt-wHSnV7drMRjDuZj-KLnE8OkorYfrsnoc'//模板id
];

```

## run.php
```php
$birthdayTime = strtotime(date("Y-03-12 "));//第七行生日日期



'value' => (int)((time() - strtotime('2020-09-05')) / 86400),// 第三十一行在一起的日期

```