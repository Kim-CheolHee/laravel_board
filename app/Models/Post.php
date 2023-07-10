<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use HasFactory, LogsActivity;

    /**
     * 변경 감지 항목 - 변경 시, 로그 저장
     *
     * @var array
     */
    protected static $logAttributes = [
        'id', 'user_id', 'title', 'content', 'published_at', 'bulletin_board_id', 'created_at', 'updated_at',
    ];

    /**
     * 변경 무시 항목 - 변경되어도 로그 저장하지 않음
     *
     * @var array
     */
    protected static $ignoreChangedAttributes = [

    ];

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'published_at',
        'bulletin_board_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function bulletinBoard()
    {
        return $this->belongsTo(BulletinBoard::class);
    }
}
