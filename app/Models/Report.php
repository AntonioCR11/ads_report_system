<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Report extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'reporter_id',
        'category_id',
        'ticket_id',
        'title',
        'description',
        'status',
    ];
    public function reporter()
    {
        return $this->hasOne(Reporter::class, "id", "reporter_id");
    }
    public function category()
    {
        return $this->hasOne(Category::class, "id", "category_id");
    }
    public function tracks()
    {
        return $this->hasMany(ReportTracker::class, "report_id", "id");
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}
