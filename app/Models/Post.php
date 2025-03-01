<?php

namespace App\Models;

use App\Enums\StatusPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'publish_date',
        'status',
    ];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'status' => StatusPost::class,
    ];

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
