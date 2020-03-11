<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Shop
 *
 * @property int $id
 * @property string $shop_name 店铺名
 * @property string $img_path 店铺头像
 * @property string $notice 店铺公告
 * @property string $user_id 店铺所属用户外键id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shop whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shop whereNotice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shop whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shop whereUserId($value)
 * @mixin \Eloquent
 */
class Shop extends Model
{
    //
}
