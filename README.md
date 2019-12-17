<h1 align="center"> laravel-miniprogram </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require hogus/laravel-miniprogram -vvv
```
## Usage

```php
$gateway = Miniprogram::gateway('wechat');

$gateway->code2session($code); //code2session
$gateway->getAccessToken(); //获取用户授权信息
```

## Contributing

目前仅支持：`wechat`、`toutiao`、`baidu`

使用前复制配置文件到项目中: `config/miniprogram.php`

`php artisan vendor:publish --provider="Hogus\LaravelMiniProgram\ServiceProvider" --tag="config"`


## License

MIT
