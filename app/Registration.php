<?php
/**
 * Created by PhpStorm.
 * User: Tii
 * Date: 02.05.16
 * Time: 15:26
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{

    protected $fillable = ["name", "workshop"];

}