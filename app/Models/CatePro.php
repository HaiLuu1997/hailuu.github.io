<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatePost extends Model
{
    public $timestamps = false ;
    protected $fillable =['category_name','category_status','category_desc'];

    protected $primaryKey = 'category_id';

    protected $table ='tbl_category_product';

}
