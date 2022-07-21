<?php

namespace derpierre65\TmiJsCluster\Http\Controllers;

use derpierre65\TmiJsCluster\Models\Supervisor;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
	public function index()
	{
		return view('tmi.js-cluster::dashboard.index');
	}

	public function statistics()
	{
		return Supervisor::query()
			->with([
				'processes' => function (Builder $query) {
					$query->latest();
				},
			])
			->latest()
			->get();
	}
}