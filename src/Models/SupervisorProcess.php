<?php

namespace derpierre65\TmiJsCluster\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $supervisor_id
 * @property string $state
 * @property array $channels
 * @property array|null $metrics
 * @property CarbonInterface $last_ping_at
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * relations:
 * @property Supervisor $supervisor
 */
class SupervisorProcess extends Model
{
	public $incrementing = false;

	protected $keyType = 'string';

	protected $table = 'tmi_cluster_supervisor_processes';

	protected $guarded = [];

	protected $casts = [
		'channels' => 'array',
		'metrics' => 'array',
		'last_ping_at' => 'datetime',
	];

	public function supervisor() : BelongsTo
	{
		return $this->belongsTo(Supervisor::class);
	}
}