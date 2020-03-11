<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\genre
 *
 * @property int $id
 * @property string $genre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\genre query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\genre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\genre whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\genre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\genre whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class genre extends Model
{
    protected $guarded = [];  //不允许自动填充的字段数组
}
