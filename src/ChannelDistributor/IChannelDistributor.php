<?php

namespace derpierre65\TmiJsCluster\ChannelDistributor;

interface IChannelDistributor
{
	/**
	 * Set the name of the current cluster.
	 *
	 * @param string $clusterName
	 *
	 * @return $this
	 */
	public function setCluster(string $clusterName) : self;

	/**
	 * Join some channels. Command will be queued.
	 *
	 * @param array $channels a list of channels that should be joined
	 */
	public function join(array $channels, bool $now = false) : void;

	/**
	 * Join some channels with higher priority.
	 *
	 * @param array $channels a list of channels that should be joined
	 * @deprecated
	 */
	public function joinNow(array $channels) : void;

	/**
	 * Part some channels. Command will be queued.
	 *
	 * @param array $channels a list of channels that should be parted
	 */
	public function part(array $channels, bool $now = false) : void;

	/**
	 * Part some given channels with higher priority.
	 *
	 * @param array $channels a list of channels that should be parted
	 * @deprecated
	 */
	public function partNow(array $channels) : void;
}