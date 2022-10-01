<?php

namespace derpierre65\TmiJsCluster\Commands;

use derpierre65\TmiJsCluster\TmiJsCluster;
use Illuminate\Console\Command;

class TmiJsClusterJoinCommand extends Command
{
	protected $signature = 'tmijs-cluster:join {channel} {now?} {cluster?}';

	protected $description = 'Join the given channel';

	public function handle(TmiJsCluster $tmiJsCluster) : int
	{
		$tmiJsCluster
			->setCluster($this->argument('cluster') ?? 'default')
			->join(explode(',', $this->argument('channel')), !!$this->argument('now'));

		return Command::SUCCESS;
	}
}