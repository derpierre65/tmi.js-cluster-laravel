<?php

namespace derpierre65\TmiJsCluster\ChannelDistributor;

use derpierre65\TmiJsCluster\Enums\CommandQueue;
use Illuminate\Support\Facades\Redis;

class RedisPubSubChannelDistributor extends RedisChannelDistributor
{
	public function join(array $channels, bool $now = false) : void
	{
		parent::join($channels, $now);

		if ( $now ) {
			$this->triggerQueue();
		}
	}

	public function part(array $channels, bool $now = false) : void
	{
		parent::part($channels, $now);

		if ( $now ) {
			$this->triggerQueue();
		}
	}

	protected function triggerQueue()
	{
		Redis::PUBLISH($this->getRedisPrefix().'events:'.CommandQueue::COMMAND_QUEUE, '');
	}
}