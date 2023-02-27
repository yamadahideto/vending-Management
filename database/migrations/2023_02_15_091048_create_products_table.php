<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('company_id');
			$table->string('product_name');
			$table->integer('price');
			$table->integer('stock');
			$table->text('comment')->nullable();
			$table->string('img_path')->nullable();
			$table->timestamps();

			$table->foreign('company_id')->references('id')->on('companies')->omDelete('cascade');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('products', function (Blueprint $table){
    $table->text('comment')->nullable('false');
    $table->string('img_path')->nullable('false');
    });
  }
}
