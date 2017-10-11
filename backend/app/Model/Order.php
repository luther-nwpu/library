<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // 连接借书表
    protected $table = 'borrowrecord';
    
}
