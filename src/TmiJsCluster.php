<?php

namespace derpierre65\TmiJsCluster;

use derpierre65\TmiJsCluster\ChannelDistributor\IChannelDistributor;
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
	public function join(array|string $channels, bool $now = false) : void
	{
		if ( is_string($channels) ) {
			$channels = [$channels];
		}

		/** @var IChannelDistributor $distributor */
		$distributor = app(config('tmi.js-cluster.clusters.'.$this->currentCluster.'.channel_distributor.class'));
		$distributor->setCluster($this->currentCluster)->join($channels, $now);
	}

	/**
	 * @param string|string[] $channels
	 * @param bool $now
	 *
	 * @return void
	 */
	public function part(array|string $channels, bool $now = false) : void
	{
		if ( is_string($channels) ) {
			$channels = [$channels];
		}

		/** @var IChannelDistributor $distributor */
		$distributor = app(config('tmi.js-cluster.clusters.'.$this->currentCluster.'.channel_distributor.class'));
		$distributor->setCluster($this->currentCluster)->part($channels, $now);
	}
}