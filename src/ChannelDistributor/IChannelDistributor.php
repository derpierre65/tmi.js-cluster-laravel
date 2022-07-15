<?php

namespace derpierre65\TmiJsCluster\ChannelDistributor;

interface IChannelDistributor
{
	/**
	 * Join some channels. Command will be queued.
	 *
	 * @param array $channels a list of channels that should be joined
	 */
	public function join(array $channels) : void;

	/**
	 * Join some channels with higher priority.
	 *
	 * @param array $channels a list of channels that should be joined
	 */
	public function joinNow(array $channels) : void;

	/**
	 * Part some channels. Command will be queued.
	 *
	 * @param array $channels a list of channels that should be parted
	 */
	public function part(array $channels) : void;

	/**
	 * Part some given channels with higher priority.
	 *
	 * @param array $channels a list of channels that should be parted
	 */
	public function partNow(array $channels) : void;
}