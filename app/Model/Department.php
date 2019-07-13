<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $table = 'departments';
    protected $fillable = [
        'dept_name_ar',
        'dept_name_en',
        'parent',
        'icon',
        'desc',
        'keyword',
    ];
    public function parent(){
        return $this->hasMany(\App\Model\Department::class, 'id' , 'parent');
    }

}
