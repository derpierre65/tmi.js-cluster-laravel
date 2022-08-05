<?php

namespace derpierre65\TmiJsCluster\Commands;

use derpierre65\TmiJsCluster\TmiJsCluster;
use Illuminate\Console\Command;

class TmiJsClusterPartCommand extends Command
{
	protected $signature = 'tmijs-cluster:part {channel} {now?}';

	protected $description = 'Part the given channel';

	public function handle() : int
	{
		TmiJsCluster::part(explode(',', $this->argument('channel')), !!$this->argument('now'));

		return Command::SUCCESS;
	}
}