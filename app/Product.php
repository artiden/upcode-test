<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function report()
    {
        return $this->hasMany('App\Report');
    }

    public function reportViews()
    {
        return $this->hasMany('App\ReportView');
    }
}
