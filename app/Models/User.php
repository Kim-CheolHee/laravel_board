<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * @method \Laravel\Sanctum\NewAccessToken createToken(string $name, array $abilities = ['*'])
 */
class User extends Authenticatable implements AuthenticatableContract, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;

    /**
     * 변경 감지 항목 - 변경 시, 로그 저장
     *
     * @var array
     */
    protected static $logAttributes = [
        'id', 'email', 'name', 'password', 'photo', 'created_at', 'updated_at',
    ];

    /**
     * 변경 무시 항목 - 변경되어도 로그 저장하지 않음
     *
     * @var array
     */
    protected static $ignoreChangedAttributes = [

    ];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
