<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.               #This is a migration file. We don't need to create tables in database manually, because laravel provides us with migration files which do the work for us.
     *                                     # php artisan make:migration create_listings_table  to make the migration file.
     * @return void
     */
    public function up()   #to create table
    {
        Schema::create('listings', function (Blueprint $table) {  #In MySQL, the term "schema" is used interchangeably with "database." #Schema::create('listings', ...);: This method call initiates the creation of a new table in the database. It takes two parameters:

            $table->string('title');  
            $table->foreignId('user_id')->constrained()  #jis user ne listing bnayi...wo agar delete ho gya ,to uski listings bhi collapse kr jayengi.
->onDelete('cascade');                                                      // 'listings': This is the name of the table being created. In this case, it's 'listings'.
            $table->string('tags'); 
            $table->longText('attachment')->nullable(); //can be null                                                      // function (Blueprint $table) { ... }: This anonymous function is a Blueprint instance that defines the table's structure.
            $table->string('venue');                                                       
            $table->string('status');                                                       // Blueprint $table: $table is an instance of the Blueprint class provided by Laravel. It allows you to define the table's columns and their properties.
            $table->string('reporter');
            $table->longText('description');
            $table->date('date');
            $table->time('time');
            $table->id();                      //This line creates an auto-incrementing primary key column named 'id'
            $table->timestamps();        //This line creates two columns: 'created_at' and 'updated_at'
        });
    }                   // use php artisan migrate:refresh to add any extra changes(you made) to the database.

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()       #to drop table
    {
        Schema::dropIfExists('listings');
    }
};              #php artisan migrate ----> runs all migrate files
