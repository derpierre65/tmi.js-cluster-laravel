<?php

namespace derpierre65\TmiJsCluster\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property array|null $options
 * @property array|null $metrics
 * @property CarbonInterface $last_ping_at
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property CarbonInterface $deleted_at
 *
 * relations:
 * @property SupervisorProcess[]|Collection $processes
 */
class Supervisor extends Model
{
	use SoftDeletes;

	public $incrementing = false;

	protected $keyType = 'string';

	protected $table = 'tmi_cluster_supervisors';

	protected $guarded = [];

	protected $casts = [
		'options' => 'array',
		'metrics' => 'array',
		'last_ping_at' => 'datetime',
	];

	public function processes() : HasMany
	{
		return $this->hasMany(SupervisorProcess::class);
	}
}