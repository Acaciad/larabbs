<?php

namespace App\Policies;

use App\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
	//将只允许作者对话题有编辑权限
    public function update(User $user, Topic $topic)
	{
	 return $topic->user_id == $user->id;
	}

	//将只允许作者对话题有删除权限
    public function destroy(User $user, Topic $topic)
	{
	 return $topic->user_id == $user->id;
	}

}
