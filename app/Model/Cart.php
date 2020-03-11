<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Cart
 *
 * @property int $id
 * @property string $user_id
 * @property string $goods_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cart whereGoodsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cart whereUserId($value)
 * @mixin \Eloquent
 */
class Cart extends Model
{
    //
}
