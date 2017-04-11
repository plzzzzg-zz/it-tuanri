<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('leader_name');
            $table->string('leader_number');
            $table->string('leader_qq');
            $table->string('leader_id');
            $table->string('leader_college');
            $table->string('leader_major');

            $table->string('member1_name')->nullable();
            $table->string('member1_number')->nullable();
            $table->string('member1_qq')->nullable();
            $table->string('member1_id')->nullable();
            $table->string('member1_college')->nullable();
            $table->string('member1_major')->nullable();

            $table->string('member2_name')->nullable();
            $table->string('member2_number')->nullable();
            $table->string('member2_qq')->nullable();
            $table->string('member2_id')->nullable();
            $table->string('member2_college')->nullable();
            $table->string('member2_major')->nullable();

            $table->string('member3_name')->nullable();
            $table->string('member3_number')->nullable();
            $table->string('member3_qq')->nullable();
            $table->string('member3_id')->nullable();
            $table->string('member3_college')->nullable();
            $table->string('member3_major')->nullable();

            $table->string('project_type');
            $table->string('project_name');
            $table->string('group_type');
            $table->integer('member_num');
            $table->integer('professional_member_num')->nullable();
            $table->integer('unprofessional_member_num')->nullable();
            $table->string('secret-key');
            $table->string('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
