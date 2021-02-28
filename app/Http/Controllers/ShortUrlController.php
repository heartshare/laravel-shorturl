<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    const STR_SHUFFLE_62 = '9uDsa6I2GzjMCRg8PXc4ZHFhtmVniwLWYeKyqO7blpQ5BES3TUdAx0Jrk1fvNo';

    /**
     * 10进制数转自定义62进制数
     * @param $num 10进制数
     * @return string
     */
    public function base10To62($num)
    {
        $res = '';
        while ($num > 0) {
            $res = substr(self::STR_SHUFFLE_62, $num % 62, 1) . $res;
            $num = floor($num / 62);
        }
        return $res;
    }

    /**
     * 生成短链接
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string
     */
    public function longToShort(Request $request)
    {
        $longUrl = $request->post('longUrl');
        $request->validate(['longUrl' => 'required|url']);//验证url
        $ShortUrl = new ShortUrl();
        if ($ShortUrl->longUrlIsExist($longUrl)) {//该长链接已存在数据库
            $code = $ShortUrl->longToShort($longUrl);
        } else {
            $ShortUrl->long_url = $longUrl;
            $res = $ShortUrl->save();
            if (!$res) {
                return '生成短链接错误';
            }
            $id = $ShortUrl->id;
            $code = $this->base10To62($id);//生成code
            $ShortUrl->code = $code;
            $res = $ShortUrl->save();
            if (!$res) {
                return '生成短链接错误';
            }
        }
        $shortUrl = env('APP_URL') . $code;
        return view('result', ['shortUrl' => $shortUrl]);
    }

    /**
     * 跳转长链接
     * @param $code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function shortToLong($code)
    {
        $ShortUrl = new ShortUrl();
        $longUrl = $ShortUrl->shortToLong($code);
        if (empty($longUrl)) {
            return redirect('/');
        } else {
            return redirect($longUrl);
        }
    }
}
