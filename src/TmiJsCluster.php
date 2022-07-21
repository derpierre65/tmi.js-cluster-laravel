<?php

namespace derpierre65\TmiJsCluster;

use derpierre65\TmiJsCluster\ChannelDistributor\IChannelDistributor;
use derpierre65\TmiJsCluster\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

class TmiJsCluster
{
	public static bool $runsMigrations = true;

	public static function ignoreMigrations() : static
	{
		static::$runsMigrations = false;

		return new static;
	}

	public static function routes(array $options = []) : void
	{
		$options = array_merge([
			'domain' => config('tmi.js-cluster.domain', null),
			'prefix' => config('tmi.js-cluster.path', 'tmi.js-cluster'),
			'middleware' => config('tmi.js-cluster.middleware', 'web'),
		], $options);

		Route::group($options, function ($router) {
			$router->get('', [DashboardController::class, 'index']);
			$router->get('/statistics/', [DashboardController::class, 'statistics']);
		});
	}

	/**
	 * @param string|string[] $channels
	 * @param bool $now
	 *
	 * @return void
	 */
	public static function join($channels, bool $now = false) : void
	{
		if ( is_string($channels) ) {
			$channels = [$channels];
		}

		app(IChannelDistributor::class)->{$now ? 'joinNow' : 'join'}($channels);
	}

	/**
	 * @param string|string[] $channels
	 * @param bool $now
	 *
	 * @return void
	 */
	public static function part($channels, bool $now = false) : void
	{
		if ( is_string($channels) ) {
			$channels = [$channels];
		}

		app(IChannelDistributor::class)->{$now ? 'partNow' : 'part'}($channels);
	}
}