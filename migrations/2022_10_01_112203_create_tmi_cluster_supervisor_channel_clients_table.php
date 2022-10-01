<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmiClusterSupervisorChannelClientsTable extends Migration
{
	public function up()
	{
		Schema::create('tmi_cluster_supervisor_channel_clients', function (Blueprint $table) {
			$table->string('channel', 32);
			$table->string('username', 32);
			$table->string('password', 32);
			$table->timestamps();

			$table->primary('channel');
		});
	}

	public function down()
	{
		Schema::dropIfExists('tmi_cluster_supervisor_channel_clients');
	}
}