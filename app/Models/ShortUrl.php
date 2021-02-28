<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    //指定表名
    protected $table = 'short_url';
    //指示是否自动维护时间戳
    public $timestamps = false;

    /**
     * 通过短链接获取长链接
     * @param $code
     * @return string
     */
    public function shortToLong($code)
    {
        $res = self::select('long_url')
            ->where('code', $code)
            ->value('long_url');
        return $res;
    }

    /**
     * 长链接是否存在
     * @param $longUrl
     * @return bool
     */
    public function longUrlIsExist($longUrl)
    {
        return self::where('long_url', $longUrl)->exists();
    }

    /**
     * 通过长链接获取短链接
     * @param $longUrl
     * @return string
     */
    public function longToShort($longUrl)
    {
        $res = self::select('code')
            ->where('long_url', $longUrl)
            ->value('code');
        return $res;
    }
}
