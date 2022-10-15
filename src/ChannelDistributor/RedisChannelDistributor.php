<?php

namespace derpierre65\TmiJsCluster\ChannelDistributor;

use derpierre65\TmiJsCluster\Enums\CommandQueue;
use Illuminate\Support\Facades\Redis;

class RedisChannelDistributor implements IChannelDistributor
{
	protected string $currentCluster;

	public function setCluster(string $clusterName) : IChannelDistributor
	{
		$this->currentCluster = $clusterName;

		return $this;
	}

	protected function getRedisPrefix()
	{
		return config('tmi.js-cluster.clusters.'.$this->currentCluster.'.channel_distributor.prefix');
	}

	public function join(array $channels, bool $now = false) : void
	{
		$redisPrefix = $this->getRedisPrefix();

		foreach ( $channels as $channel ) {
			Redis::{$now ? 'LPUSH' : 'RPUSH'}($redisPrefix.'commands:'.CommandQueue::COMMAND_QUEUE, json_encode([
				'time' => time(),
				'command' => CommandQueue::COMMAND_JOIN,
				'options' => [
					'channel' => $channel,
				],
			]));
		}
	}

	/**
	 * @deprecated
	 */
	public function joinNow(array $channels) : void
	{
		$this->join($channels, true);
	}

	public function part(array $channels, bool $now = false) : void
	{
		$redisPrefix = $this->getRedisPrefix();

		foreach ( $channels as $channel ) {
			Redis::{$now ? 'LPUSH' : 'RPUSH'}($redisPrefix.'commands:'.CommandQueue::COMMAND_QUEUE, json_encode([
				'time' => time(),
				'command' => CommandQueue::COMMAND_PART,
				'options' => [
					'channel' => $channel,
				],
			]));
		}
	}

	/**
	 * @deprecated
	 */
	public function partNow(array $channels) : void
	{
		$this->part($channels, true);
	}
}