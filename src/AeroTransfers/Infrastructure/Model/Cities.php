<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 23/12/17
 * Time: 12:47
 */

namespace AeroTransfers\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = "cities";

    protected $fillable = [
        "name"
    ];

    // public $timestamps = false;
}