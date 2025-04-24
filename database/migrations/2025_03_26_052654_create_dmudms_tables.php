<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('block', function (Blueprint $table) {
            $table->string('block_id', 10)->primary();
            $table->string('disable_group', 10);
            $table->string('status', 10);
            $table->unsignedInteger('capacity');
            $table->string('reserved_for', 10);
        });

        Schema::create('emergency', function (Blueprint $table) {
            $table->id('emergence_id');
            $table->string('student_id', 50);
            $table->string('father_name', 50);
            $table->string('grand_father', 50);
            $table->string('grand_grand_father', 50);
            $table->unsignedBigInteger('phone');
            $table->string('region', 50);
            $table->string('woreda', 50);
            $table->string('kebele', 50);
            $table->string('mother_name', 50);
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->string('employee_id', 50)->primary();
            $table->string('first_name', 50);
            $table->string('second_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50);
            $table->unsignedBigInteger('phone');
            $table->string('address', 50);
            $table->string('citizenship', 50);
        });

        Schema::create('exit_paper', function (Blueprint $table) {
            $table->id('exit_id');
            $table->string('stud_id', 50);
            $table->date('request_date');
            $table->date('approved_date');
            $table->string('type', 200);
            $table->unsignedInteger('color');
            $table->unsignedInteger('number');
        });

        Schema::create('materials', function (Blueprint $table) {
            $table->id('registration_id');
            $table->string('block', 10);
            $table->unsignedInteger('room');
            $table->string('unlocker', 10);
            $table->unsignedInteger('locker');
            $table->unsignedInteger('chair');
            $table->unsignedInteger('pure_foam');
            $table->unsignedInteger('damaged_foam');
            $table->unsignedInteger('tiras');
            $table->unsignedInteger('tables');
            $table->unsignedInteger('chibud');
        });

        Schema::create('notification', function (Blueprint $table) {
            $table->id('notification_id');
            $table->string('registrar_id', 50);
            $table->string('message', 100);
            $table->enum('status', ['Read', 'Unread'])->default('Unread');
            $table->date('date');
        });

        Schema::create('proctor_placement', function (Blueprint $table) {
            $table->id('placement_id');
            $table->string('proctor_id', 50);
            $table->year('year');
            $table->date('first_entry');
        });

        Schema::create('request', function (Blueprint $table) {
            $table->id('request_id');
            $table->string('student_id', 50);
            $table->string('message', 400);
            $table->string('status', 10);
            $table->date('request_date');
            $table->string('approved_by', 50);
            $table->date('approved_date');
        });

        Schema::create('room', function (Blueprint $table) {
            $table->bigInteger('room_id');
            $table->string('block', 10);  // Using 'block' as column name
            $table->enum('status', ['Free', 'Occupied', 'Partially Occupied', 'Unavailable']);
            $table->integer('capacity')->default(6);
            $table->timestamps();
            
            // Define composite primary key
            $table->primary(['room_id', 'block']);
            
            // Foreign key reference (assuming 'block' table has 'block_id' as PK)
            $table->foreign('block')->references('block_id')->on('block');
        });
        
          
        

        Schema::create('students', function (Blueprint $table) {
            $table->string('student_id', 50)->primary();
            $table->string('first_name', 50);
            $table->string('second_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50);
            $table->string('gender', 10);
            $table->string('disability_status', 10);
            $table->string('status', 10);
            $table->string('password', 100);

        });

        Schema::create('student_placement', function (Blueprint $table) {
            $table->id('placement_id');
            $table->string('student_id', 50);
            $table->string('block', 10);  // Matches rooms.block
            $table->bigInteger('room');   // Matches rooms.room_id
            $table->string('status', 10);
            $table->year('year');
            
            // Composite foreign key
            $table->foreign(['room', 'block'])
                  ->references(['room_id', 'block'])
                  ->on('rooms');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->string('username', 50)->primary();
            $table->string('password', 100);
            $table->string('role', 20);
            $table->string('status', 10);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('student_placement');
        Schema::dropIfExists('students');
        Schema::dropIfExists('room');
        Schema::dropIfExists('request');
        Schema::dropIfExists('proctor_placement');
        Schema::dropIfExists('notification');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('exit_paper');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('emergency');
        Schema::dropIfExists('block');
    }
};
