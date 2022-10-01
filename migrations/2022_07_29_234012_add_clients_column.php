<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientsColumn extends Migration
{
	public function up()
	{
		Schema::table('tmi_cluster_supervisor_processes', function (Blueprint $table) {
			$table->json('clients')->after('channels');
		});
	}

	public function down()
	{
		Schema::dropColumns('tmi_cluster_supervisor_processes', ['clients']);
	}
}