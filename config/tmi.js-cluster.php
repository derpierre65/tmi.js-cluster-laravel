<?php

use derpierre65\TmiJsCluster\ChannelDistributor\RedisChannelDistributor;

return [
	'channel_distributor' => [
		'class' => RedisChannelDistributor::class,
		'prefix' => 'tmi-cluster:',
	],

	'domain' => null,
	'path' => 'tmi-cluster',
	'middleware' => 'web',
];