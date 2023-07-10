<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BulletinBoard extends Model
{
    use HasFactory, LogsActivity;

    /**
     * 변경 감지 항목 - 변경 시, 로그 저장
     *
     * @var array
     */
    protected static $logAttributes = [
        'id', 'user_id', 'subject', 'content', 'created_at', 'updated_at',
    ];

    /**
     * 변경 무시 항목 - 변경되어도 로그 저장하지 않음
     *
     * @var array
     */
    protected static $ignoreChangedAttributes = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
