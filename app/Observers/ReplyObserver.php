<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
       
    }

    public function updating(Reply $reply)
    {
        //
    }
    //话题下每新增一条回复，应该 累加 
    public function created(Reply $reply)
    {
    $topic = $reply->topic;
    $reply->topic->increment('reply_count', 1);
    // 通知作者话题被回复了
    $topic->user->topicNotify(new TopicReplied($reply));
    }



}