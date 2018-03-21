<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('level')
                ->references('level')->on('accesslevel');
        });

        Schema::table('student', function (Blueprint $table) {

            $table->foreign('username')
		        ->references('username')->on('users');
        });

        Schema::table('groups', function (Blueprint $table) {

            $table->foreign('supervisor')
		        ->references('email')->on('sensors_supervisors');
        });

        Schema::table('student_groups', function (Blueprint $table) {

            $table->foreign('student')
		        ->references('username')->on('student');
            
            $table->foreign(['student_groups_number','student_groups_year'])
                ->references(['group_number','year'])->on('groups');

        });

        Schema::table('documents', function (Blueprint $table) {

            $table->foreign(['documents_groups_number','documents_year'])
                ->references(['group_number','year'])->on('groups');
        });

        Schema::table('presentation', function (Blueprint $table) {

            $table->foreign(['presentation_group_number','presentation_year'])
                ->references(['group_number','year'])->on('groups');
		
		    $table->foreign('presentation_room')
                ->references('room')->on('room');
                
            $table->foreign('sensor')
		        ->references('email')->on('sensors_supervisors');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_keys');
    }
}
