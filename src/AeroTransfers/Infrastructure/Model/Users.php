<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 23/12/17
 * Time: 12:47
 */

namespace AeroTransfers\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";

    protected $fillable = [
        "id",
        "name",
        "email",
        "password"
    ];

    // public $timestamps = false;
}