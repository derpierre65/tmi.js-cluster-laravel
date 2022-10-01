<?php

namespace derpierre65\TmiJsCluster\Commands;

use derpierre65\TmiJsCluster\TmiJsCluster;
use Illuminate\Console\Command;

class TmiJsClusterPartCommand extends Command
{
	protected $signature = 'tmijs-cluster:part {channel} {now?} {cluster?}';

	protected $description = 'Part the given channel';

	public function handle(TmiJsCluster $tmiJsCluster) : int
	{
		$tmiJsCluster
			->setCluster($this->argument('cluster') ?? 'default')
			->part(explode(',', $this->argument('channel')), !!$this->argument('now'));

		return Command::SUCCESS;
	}
}