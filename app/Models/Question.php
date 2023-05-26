<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }    
    public function answers()
    {
         return $this->hasMany(Answer::class);
    }
    public function excerpt($length)
    {
        return Str::limit(strip_tags($this->body), $length);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getAnswerCountAttribute()
    {
         return $this->answers()->count();
    }
}
