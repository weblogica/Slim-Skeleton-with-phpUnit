<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 23/12/17
 * Time: 12:47
 */

namespace AeroTransfers\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = "services";

    protected $fillable = [
        "name",
        "description",
        "price",
        "currency"
    ];

    // public $timestamps = false;
}