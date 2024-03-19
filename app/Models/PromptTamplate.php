<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromptTamplate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'prompt',
        'image_prompt',
    ];

}
