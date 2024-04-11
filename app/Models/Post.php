<?php

namespace App\Models;


use App\Services\ImageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'tags',
        'publish_date',
        'post_to_twitter',
        'post_to_pinterest',
        'post_to_linkedin',
        'post_to_instagram',
        'post_to_facebook',
        "api_tags",
        'published',
    ];

    public function createPhotos($files)
    {
        $photos = [];

        foreach ($files as $key => $photo) {
            $file = $photo['file'];
            
            $photos[] = [
                'path' => ImageService::uploadPostPhoto($this, $file),
                'order' => $photo["position"],
            ];
        }  

        if (count($photos) > 0) $this->photos()->createMany($photos);
    }
    public function updatePhotos($photos)
    {
        foreach ($photos as $photo) {
            PostPhoto::where(['id' => $photo['id']])->update(['order' => $photo['position']]);
        }
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function campain()
    {
        return $this->belongsTo(Campain::class);
    }
    public function photos()
    {
        return $this->hasMany(PostPhoto::class);
    }
}
