<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

class Post extends Model
{
    use HasFactory, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'category',
        'publish_at',
        'image',
        'view_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publish_at' => 'datetime',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    /**
     * Get formatted ID
     * 
     * @return string
     */
    public function getFormattedIdAttribute()
    {
        return '#' . $this->id;
    }

    /**
     * Upload Image and save path to database.
     *
     * @param UploadedFile $image
     * 
     * @return void
     */
    public function setImageAttribute($image)
    {
        if (is_null($image)) {
            return;
        }
        
        //Delete on update
        if (!is_null($this->getAttribute('image'))) {
            \Storage::disk('public')->delete($this->getAttribute('image')); 
        }

        $this->attributes['image'] = \Storage::disk('public')->put('assets/posts', $image);
    }

    /**
     * Get Image URL attribute.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if (is_null($this->getAttribute('image'))) {
            return null;
        }
        
        return \Storage::disk('public')->url($this->getAttribute('image'));
    }

    /**
     * Mapping field form.
     *
     * @return array
     */
    public static function mappingFieldForm()
    {
        return [
            'title' => [
                'label' => 'Title',
                'type' => 'text',
                'class' => 'col-12',
                'required' => true,
            ],
            'image' => [
                'label' => 'Image',
                'type' => 'file',
                'class' => 'col-12',
                'required' => true,
            ],
            'category' => [
                'label' => 'Category',
                'type' => 'text',
                'class' => 'col-12',
                'required' => true,
            ],
            'content' => [
                'label' => 'Content',
                'type' => 'wysiwyg',
                'class' => 'col-12',
                'required' => true,
            ],
            'publish_at' => [
                'label' => 'Publish At',
                'type' => 'text',
                'class' => 'col-12',
                'required' => true,
            ],
        ];
    }

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
