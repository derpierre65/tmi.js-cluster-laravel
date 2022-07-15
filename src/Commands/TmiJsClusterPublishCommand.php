<?php

namespace derpierre65\TmiJsCluster\Commands;

use Illuminate\Console\Command;

class TmiJsClusterPublishCommand extends Command
{
	protected $signature = 'tmi.js-cluster:publish';

	protected $description = 'Publish all tmi.js-cluster assets';

	public function handle(): int
	{
		$this->comment('Publishing tmi.js-cluster assets...');
		$this->callSilent('vendor:publish', ['--tag' => 'tmi.js-cluster-assets', '--force' => true]);
		$this->info('tmi.js-cluster assets published successfully.');

		return Command::SUCCESS;
	}
}