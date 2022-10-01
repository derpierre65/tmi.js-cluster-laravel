<?php

use derpierre65\TmiJsCluster\ChannelDistributor\RedisChannelDistributor;

return [
	/*
    |--------------------------------------------------------------------------
    | tmi.js-cluster Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where tmi.js-cluster will be accessible from. If this
    | setting is null, tmi.js-cluster will reside under the same domain as the
    | application. Otherwise, this value will serve as the subdomain.
    */
	'domain' => null,

	/*
	|--------------------------------------------------------------------------
	| Path
	|--------------------------------------------------------------------------
	|
	| This is the URI path where tmi.js-cluster will be accessible from. Feel free
	| to change this path to anything you like. Note that the URI will not
	| affect the paths of its internal API that aren't exposed to users.
	*/
	'path' => 'tmi-cluster',

	'middleware' => 'web',

	/*
    |--------------------------------------------------------------------------
    | tmi.js-cluster Cluster Configuration
    |--------------------------------------------------------------------------
    |
	| Here you may define the cluster settings used by your application in
	| all environments.
	| You can control multiple clusters with one application.
    */
	'clusters' => [
		'default' => [
			'channel_distributor' => [
				'class' => RedisChannelDistributor::class,
				'prefix' => 'tmi-cluster:',
			],
		]
	],
];