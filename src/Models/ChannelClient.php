<?php

namespace derpierre65\TmiJsCluster\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelClient extends Model
{
	protected $table = 'tmi_cluster_supervisor_channel_clients';

	public $incrementing = false;

	protected $keyType = 'string';

	protected $primaryKey = 'channel';

	protected $guarded = [];
}