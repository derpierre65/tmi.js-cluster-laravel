<?php

namespace derpierre65\TmiJsCluster\ChannelDistributor;

use Illuminate\Support\Facades\Redis;

class RedisChannelDistributor implements IChannelDistributor
{
	public function join(array $channels) : void
	{
		Redis::RPUSH(config('tmi.js-cluster.channel_distributor.prefix').'commands:join-handler', json_encode([
			'time' => time(),
			'command' => 'join',
			'options' => [
				'channels' => $channels,
			],
		]));
	}

	public function joinNow(array $channels) : void
	{
		Redis::LPUSH(config('tmi.js-cluster.channel_distributor.prefix').'commands:join-handler', json_encode([
			'time' => time(),
			'command' => 'join',
			'options' => [
				'channels' => $channels,
			],
		]));
	}

	public function part(array $channels) : void
	{
		Redis::RPUSH(config('tmi.js-cluster.channel_distributor.prefix').'commands:join-handler', json_encode([
			'time' => time(),
			'command' => 'part',
			'options' => [
				'channels' => $channels,
			],
		]));
	}

	public function partNow(array $channels) : void
	{
		Redis::LPUSH(config('tmi.js-cluster.channel_distributor.prefix').'commands:join-handler', json_encode([
			'time' => time(),
			'command' => 'part',
			'options' => [
				'channels' => $channels,
			],
		]));
	}
}