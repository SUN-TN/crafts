<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Star
 *
 * @property int $id
 * @property string $user_id
 * @property string $goods_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Star newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Star newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Star query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Star whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Star whereGoodsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Star whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Star whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Star whereUserId($value)
 * @mixin \Eloquent
 */
class Star extends Model
{
    //
}
