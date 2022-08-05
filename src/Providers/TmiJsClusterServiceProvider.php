<?php

namespace derpierre65\TmiJsCluster\Providers;

use derpierre65\TmiJsCluster\ChannelDistributor\IChannelDistributor;
use derpierre65\TmiJsCluster\Commands\TmiJsClusterJoinCommand;
use derpierre65\TmiJsCluster\Commands\TmiJsClusterPartCommand;
use derpierre65\TmiJsCluster\Commands\TmiJsClusterPublishCommand;
use derpierre65\TmiJsCluster\TmiJsCluster;
use Illuminate\Support\ServiceProvider;

class TmiJsClusterServiceProvider extends ServiceProvider
{
	public function boot() : void
	{
		$this->config();
		$this->offerPublishing();
		$this->registerServices();
		$this->registerCommands();
		$this->registerFrontend();
		$this->defineAssetPublishing();
	}

	protected function config()
	{
		$this->mergeConfigFrom(__DIR__.'/../../config/tmi.js-cluster.php', 'tmi.js-cluster');

		if ( TmiJsCluster::$runsMigrations ) {
			$this->loadMigrationsFrom(__DIR__.'/../../migrations');
		}
	}

	protected function offerPublishing() : void
	{
		if ( $this->app->runningInConsole() ) {
			$this->publishes([
				__DIR__.'/../../config/tmi.js-cluster.php' => config_path('tmi.js-cluster.php'),
			], 'tmi.js-cluster-config');
		}
	}

	protected function registerServices() : void
	{
		$this->app->singleton(IChannelDistributor::class, config('tmi.js-cluster.channel_distributor.class'));
	}

	protected function registerCommands() : void
	{
		if ( $this->app->runningInConsole() ) {
			$this->commands([
				TmiJsClusterPublishCommand::class,
				TmiJsClusterJoinCommand::class,
				TmiJsClusterPartCommand::class,
			]);
		}
	}

	protected function registerFrontend() : void
	{
		$this->loadViewsFrom(__DIR__.'/../../resources/views', 'tmi.js-cluster');
	}

	protected function defineAssetPublishing() : void
	{
		$this->publishes([
			__DIR__.'/../../public' => public_path('vendor/tmi.js-cluster'),
		], 'tmi.js-cluster-assets');
	}
}