<?php

namespace derpierre65\TmiJsCluster;

use derpierre65\TmiJsCluster\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

class TmiJsCluster
{
	public static bool $runsMigrations = true;

	public string $currentCluster = 'default';

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

	public function getCluster() : string
	{
		return $this->currentCluster;
	}

	public function setCluster(string $cluster) : self
	{
		$this->currentCluster = $cluster;

		return $this;
	}

	/**
	 * @param string|string[] $channels
	 * @param bool $now
	 *
	 * @return void
	 */
	public function join($channels, bool $now = false) : void
	{
		if ( is_string($channels) ) {
			$channels = [$channels];
		}

		app(config('tmi.js-cluster.clusters.'.$this->currentCluster.'.channel_distributor.class'))->setCluster($this->currentCluster)->{$now ? 'joinNow' : 'join'}($channels);
	}

	/**
	 * @param string|string[] $channels
	 * @param bool $now
	 *
	 * @return void
	 */
	public function part($channels, bool $now = false) : void
	{
		if ( is_string($channels) ) {
			$channels = [$channels];
		}

		app(config('tmi.js-cluster.clusters.'.$this->currentCluster.'.channel_distributor.class'))->setCluster($this->currentCluster)->{$now ? 'partNow' : 'part'}($channels);
	}
}