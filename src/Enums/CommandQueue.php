<?php

namespace derpierre65\TmiJsCluster\Enums;

class CommandQueue
{
	public const INPUT_QUEUE = 'input';

	public const COMMAND_QUEUE = 'command-queue';

	public const COMMAND_JOIN = 'join';

	public const COMMAND_PART = 'part';

	public const CREATE_CLIENT = 'create-client';
}