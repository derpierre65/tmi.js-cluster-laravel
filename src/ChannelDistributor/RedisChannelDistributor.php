<?php

namespace derpierre65\TmiJsCluster\ChannelDistributor;

use derpierre65\TmiJsCluster\TmiJsCluster;
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

	public function join(array $channels) : void
	{
		Redis::RPUSH($this->getRedisPrefix().'commands:join-handler', json_encode([
			'time' => time(),
			'command' => 'join',
			'options' => [
				'channels' => $channels,
			],
		]));
	}

	public function joinNow(array $channels) : void
	{
		Redis::LPUSH($this->getRedisPrefix().'commands:join-handler', json_encode([
			'time' => time(),
			'command' => 'join',
			'options' => [
				'channels' => $channels,
			],
		]));
	}

	public function part(array $channels) : void
	{
		Redis::RPUSH($this->getRedisPrefix().'commands:join-handler', json_encode([
			'time' => time(),
			'command' => 'part',
			'options' => [
				'channels' => $channels,
			],
		]));
	}

	public function partNow(array $channels) : void
	{
		Redis::LPUSH($this->getRedisPrefix().'commands:join-handler', json_encode([
			'time' => time(),
			'command' => 'part',
			'options' => [
				'channels' => $channels,
			],
		]));
	}
}