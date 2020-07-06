<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        //字段缓存
        $reply->topic->reply_count = $reply->topic->replies->count();
 		$reply->topic->save();
    }

    public function updating(Reply $reply)
    {
        //
    }
    //话题下每新增一条回复，应该 +1 
    public function created(Reply $reply)
	{
	 	$reply->topic->increment('reply_count', 1);
	}

}