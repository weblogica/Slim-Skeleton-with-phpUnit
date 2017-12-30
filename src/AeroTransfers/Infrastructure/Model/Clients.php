<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 23/12/17
 * Time: 12:47
 */

namespace AeroTransfers\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = "clients";

    protected $fillable = [
        "id",
        "name"
    ];

    public $timestamps = false;
}