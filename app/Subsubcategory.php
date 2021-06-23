<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
class Subsubcategory extends Model
{
    public function category(){
    return $this->belongsTo(Category::class,'cat_id');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_cat_id');
        }
}
