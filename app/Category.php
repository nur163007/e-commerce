<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SubCategory;
use App\Subsubcategory;
class Category extends Model
{
    use softDeletes;

    public function subcategories(){
        return $this->hasMany(SubCategory::class,Subsubcategory::class);
    }
    
}
