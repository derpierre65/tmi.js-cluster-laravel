<?php

namespace derpierre65\TmiJsCluster\Commands;

use derpierre65\TmiJsCluster\TmiJsCluster;
use Illuminate\Console\Command;

class TmiJsClusterJoinCommand extends Command
{
	protected $signature = 'tmijs-cluster:join {channel} {now?}';

	protected $description = 'Join the given channel';

	public function handle() : int
	{
		TmiJsCluster::join(explode(',', $this->argument('channel')), !!$this->argument('now'));

		return Command::SUCCESS;
	}
}