<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ShortUrl extends Model{
    //指定表名
    protected $table= 'short_url';
    //指定主键
    protected $primaryKey= 'id';
    //指示模型主键是否递增
    public $incrementing = true;
    //自动递增ID的类型
    protected $keyType = 'int';
    //指示是否自动维护时间戳
    public $timestamps = false;
    //通过短链接获取长链接
    public function shortToLong($code){
        $res=$this->select('long_url')
            ->where('code', $code)
            ->first();
        if($res!=null){
            $res=$res->toArray();
        }
        return $res;
    }
    //长链接是否存在
    public function longUrlIsExist($longUrl){
        $count=$this->where('long_url', $longUrl)->count();
        return $count;
    }
    //通过长链接获取短链接
    public function longToShort($longUrl){
        $res=$this->select('code')
            ->where('long_url', $longUrl)
            ->first();
        if($res!=null){
            $res=$res->toArray()['code'];
        }
        return $res;
    }
}
