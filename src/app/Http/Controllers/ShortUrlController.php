<?php

namespace App\Http\Controllers;

use App\ShortUrl;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    const STR_SHUFFLE_62 = '9uDsa6I2GzjMCRg8PXc4ZHFhtmVniwLWYeKyqO7blpQ5BES3TUdAx0Jrk1fvNo';
    // 10进制数 转 自定义62进制数
    public function base10To62($num)
    {
        $res = '';
        while ($num > 0) {
            $res = substr(self::STR_SHUFFLE_62, $num % 62, 1) . $res;
            $num = floor($num / 62);
        }
        return $res;
    }
    public function longToShort(Request $request){
        $longUrl=$request->post('longUrl');
        //验证url
        if(!preg_match("/(https?):\/\/[-A-Za-z0-9+&@#\/\%?=~_|!:,.;]+[-A-Za-z0-9+&@#\/\%=~_|]/",$longUrl)){
            return 'url不合法';
        }
        $ShortUrl=new ShortUrl();
        $count=$ShortUrl->longUrlIsExist($longUrl);
        if($count==1){//该长链接已存在数据库
            $code=$ShortUrl->longToShort($longUrl);
        }else{
            $ShortUrl->long_url=$longUrl;
            $ShortUrl->created_at=date('Y-m-d H:i:s');
            $res=$ShortUrl->save();
            if(!$res){
                return '生成短链接错误';
            }
            $id=$ShortUrl->id;
            $code=$this->base10To62($id);//生成code
            $ShortUrl->code=$code;
            $res=$ShortUrl->save();
            if(!$res){
                return '生成短链接错误';
            }
        }
        $shortUrl='http://fish.com/'.$code;
        return view('result', ['shortUrl'=>$shortUrl]);
    }
    public function shortToLong($code)
    {
        $ShortUrl=new ShortUrl();
        $longUrl=$ShortUrl->shortToLong($code);
        if(empty($longUrl)){
            return redirect('/');
        }else{
            $longUrl=$longUrl['long_url'];
            header('Location:' . $longUrl, true, 302);
        }
    }
}
