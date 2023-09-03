<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTracker extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'report_id',
        'status',
        'note',
    ];
    public function report()
    {
        return $this->belongsTo(Report::class, "id", "report_id");
    }
    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
}
