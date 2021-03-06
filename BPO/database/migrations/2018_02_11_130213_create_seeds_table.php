<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('accesslevel', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('level');
		    $table->enum('type', ['superadmin',  'admin',  'assistant',  'student', 'ingenTilgang']);
		    
		    $table->primary('level');
		
		});

		Schema::create('users', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->string('username', 15);
		    $table->integer('level');
		    $table->string('firstname', 45);
		    $table->string('lastname', 45);
		    $table->string('email', 45);
		    $table->string('password', 45);
		    $table->string('sex', 45);
		    
		    $table->primary('username');
                
		    $table->index('level','level_idx');
		
		});

		Schema::create('groups', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->integer('group_number');
            $table->integer('year');
		    $table->string('leader', 45);
		    $table->string('title', 127)->nullable();
		    $table->string('url', 127)->nullable();
			$table->string('supervisor', 45)->nullable();
			$table->string('searching', 45)->nullable();
		    
		    $table->primary(['group_number', 'year']);
		
		
		});

		Schema::create('student', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->string('username', 15);
		    $table->string('student_points', 45);
		    $table->string('program', 45);
		    
		    $table->primary('username');
		
		});

		Schema::create('student_groups', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
            $table->string('student', 15);
            $table->integer('student_groups_number');
		    $table->integer('student_groups_year');
		    
		    $table->primary(['student', 'student_groups_year']);
		
		    $table->index(['student_groups_number', 'student_groups_year'],'group_number_idx');
		
		});

		Schema::create('documents', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id');
			$table->integer('documents_groups_number');
			$table->integer('documents_year');
		    $table->string('file_name', 127);
		    $table->string('title', 45);
		
		    $table->index(['documents_year', 'documents_groups_number'],'connect_groups_idx');
		
		});

		Schema::create('dates', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id');
		    $table->string('name', 25);
		    $table->date('date');
		
		});

		Schema::create('sensors_supervisors', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->string('email', 45);
		    $table->string('firstname', 45);
		    $table->string('lastname', 45);
		    $table->string('status', 45);
		    $table->primary('email');
		
		
		});

		Schema::create('room', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->string('room', 45);
		    
		    $table->primary('room');
		
		});

		Schema::create('presentation', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('presentation_group_number');
		    $table->integer('presentation_year');
		    $table->dateTime('start');
		    $table->dateTime('end');
		    $table->string('presentation_room', 45);
			$table->string('sensor', 45)->nullable();
		    
		    $table->primary(['presentation_group_number', 'presentation_year']);
		
		    $table->index('presentation_room','presentation_idx');
		
		});

		Schema::create('news', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id');
		    $table->string('user', 45);
		    $table->string('tittel', 45);
		    $table->string('melding', 1000);
		
		});

		Schema::create('prosjektforslag', function(Blueprint $table) {
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('date_added', 10);
			$table->string('file_name', 127);
			
		});


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('presentation_plan');
		Schema::drop('room');
		Schema::drop('sensors_supervisors');
		Schema::drop('dates');
		Schema::drop('documents');
		Schema::drop('student_groups');
		Schema::drop('student');
		Schema::drop('groups');
		Schema::drop('users');
		Schema::drop('accesslevel');
		Schema::drop('prosjektforslag');

    }
}