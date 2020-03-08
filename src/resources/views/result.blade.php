<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<p>生成短链接成功</p>
<p>{{$shortUrl}}<a href="{{$shortUrl}}"> 访问</a></p>
<a href="/">首页</a>
</body>
</html>
