<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function comment(){
      return $this->hasMany(Comment::class);
    }

    public function user(){
      return $this->beongsTo(User::class, 'user_id');
    }
}
