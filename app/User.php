<?php

namespace App;
use App\Models\Topic;
use App\Models\link;
use App\Models\Reply;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract; 
use Auth;

class User extends  Authenticatable implements MustVerifyEmailContract 
{
    use MustVerifyEmailTrait;
    use Notifiable {
     
     }
     public function topicNotify($instance)
        {
            // 如果要通知的人是当前用户，就不必通知了！
            if ($this->id == Auth::id()) {
                return;
            }
            $this->increment('notification_count');
            $this->notify($instance);
        }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function topics()
    {
     return $this->hasMany(Topic::class);
    }

    //评论
    public function replies()
    {
     return $this->hasMany(Reply::class);
    }
    // 清除未读消息标示
    public function markAsRead()
    {
         $this->notification_count = 0;
         $this->save();
         $this->unreadNotifications->markAsRead();
    }
    //删除评论
    public function isAuthorOf($model)
    {
    return $this->id == $model->user_id;
    }

}


 