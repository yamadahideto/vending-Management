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
			// $table->foreign('company_id')->references('id')->on('companies');
			$table->unsignedBigInteger('company_id');
			$table->string('product_name');
			$table->integer('price');
			$table->integer('stock');
			$table->text('comment')->nullable()->change();
			$table->string('img_path')->nullable()->change();
			$table->timestamps();

			$table->foreign('company_id')->references('id')->on('companies');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('products');
			$table->text('comment')->nullable('false')->change();
			$table->string('img_path')->nullable('false')->change();
	}
}
