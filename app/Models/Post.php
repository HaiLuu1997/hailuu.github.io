<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false ;
    protected $fillable =['cate_post_id','post_tittle','post_desc','post_content','post_meta_desc','post_meta_keywords','post_status','post_image'];

    protected $primaryKey = 'post_id';

    protected $table ='tbl_posts';

    public function cate_post(){
    	return $this->belongsTo('App\Models\CatePost','cate_post_id');
    }
}
