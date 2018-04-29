<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  protected $guarded = [];

  public static function boot()
  {
    parent::boot();

    static::creating(function($model) {
      $model->uuid = Uuid::uuid4()->toString();
    });
  }
}
