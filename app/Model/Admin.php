<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

/**
 * App\Model\Admin
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereUsername($value)
 * @mixin \Eloquent
 */
class Admin extends User
{
    protected $rememberTokenName='';
}
