## Laravel Short URL

用laravel实现的一个短链接系统

## 安装
1. 在网站根目录的终端执行
`git clone https://github.com/fishtailstudio/shortUrl.git`

2. 创建`short_url`数据库

3. 修改.env中数据库配置
```nginx
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=short_url
DB_USERNAME=root
DB_PASSWORD=123456
```

4. 执行`php artisan migrat`

5. 修改.env文件的`APP_URL`为当前网站域名

5. 修改Nginx.conf（[官方文档](https://learnku.com/docs/laravel/6.x/installation/5124#37e654)）
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```
并且修改
```nginx
root "D:/phpstudy_pro/WWW/shortUrl/public";
```

4. 访问你的域名。

## 截图

首页：


![首页：](https://i.loli.net/2021/02/28/XtuSYbvW8VZ1nzU.png)

生成短链接：


![生成短链接：](https://i.loli.net/2021/02/28/aJsnqe2wkWlipSC.png)