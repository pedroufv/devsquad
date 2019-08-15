<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProductsTable.
 */
class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 64);
            $table->text('description');
            $table->decimal('price');
            $table->string('image')->nullable();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name', 'deleted_at']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}
}
