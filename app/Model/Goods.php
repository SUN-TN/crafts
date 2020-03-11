<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\goods
 *
 * @property string $id
 * @property string $name
 * @property string $author
 * @property string $intro
 * @property string $size
 * @property float $price
 * @property string $imgUrl
 * @property int $genre_id
 * @property string $shop_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $stars
 * @property int $status 1代表未销售可购买 2代表已销售
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereGenreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereStars($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\goods whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class goods extends Model
{
    //指定模型使用的数据表名称
    protected $table = 'goods';

    //非递增或者非数字的主键
    public $incrementing = false;
    protected $keyType = 'string';
  
}
