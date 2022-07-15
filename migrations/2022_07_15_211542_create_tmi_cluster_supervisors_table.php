<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmiClusterSupervisorsTable extends Migration
{
	public function up()
	{
		Schema::create('tmi_cluster_supervisors', function (Blueprint $table) {
			$table->string('id', 128)->primary();
			$table->json('options');
			$table->json('metrics')->nullable();
			$table->timestamp('last_ping_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('tmi_cluster_supervisor_processes', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->string('supervisor_id', 128)->nullable();
			$table->string('state', 64);
			$table->json('channels');
			$table->json('metrics')->nullable();
			$table->timestamp('last_ping_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('tmi_cluster_supervisor_processes');
		Schema::dropIfExists('tmi_cluster_supervisors');
	}
}