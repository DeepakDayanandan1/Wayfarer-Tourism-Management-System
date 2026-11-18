<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('admin')) {
            Schema::create('admin', function (Blueprint $table) {
                $table->increments('id');
                $table->string('UserName', 100)->nullable();
                $table->string('Name', 250)->nullable();
                $table->string('EmailId', 250)->nullable();
                $table->string('MobileNumber', 10)->nullable();
                $table->string('Password', 255)->nullable();
                $table->timestamp('updationDate')->useCurrent()->useCurrentOnUpdate();
            });
        }

        if (!Schema::hasTable('tblusers')) {
            Schema::create('tblusers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('FullName', 100)->nullable();
                $table->string('MobileNumber', 10)->nullable();
                $table->string('EmailId', 70)->nullable()->unique();
                $table->string('Password', 255)->nullable();
                $table->timestamp('RegDate')->useCurrent();
                $table->timestamp('UpdationDate')->nullable()->useCurrentOnUpdate();
            });
        }

        if (!Schema::hasTable('tbltourpackages')) {
            Schema::create('tbltourpackages', function (Blueprint $table) {
                $table->increments('PackageId');
                $table->string('PackageName', 200)->nullable();
                $table->string('PackageType', 150)->nullable();
                $table->string('PackageLocation', 100)->nullable();
                $table->integer('PackagePrice')->nullable();
                $table->string('PackageFetures', 255)->nullable();
                $table->mediumText('PackageDetails')->nullable();
                $table->string('PackageImage', 100)->nullable();
                $table->timestamp('Creationdate')->useCurrent();
                $table->timestamp('UpdationDate')->nullable()->useCurrentOnUpdate();
            });
        }

        if (!Schema::hasTable('tblbooking')) {
            Schema::create('tblbooking', function (Blueprint $table) {
                $table->increments('BookingId');
                $table->integer('PackageId')->nullable();
                $table->string('UserEmail', 100)->nullable();
                $table->string('FromDate', 100)->nullable();
                $table->string('ToDate', 100)->nullable();
                $table->mediumText('Comment')->nullable();
                $table->timestamp('RegDate')->useCurrent();
                $table->integer('status')->nullable()->default(0);
                $table->string('CancelledBy', 5)->nullable();
                $table->timestamp('UpdationDate')->nullable()->useCurrentOnUpdate();
            });
        }

        if (!Schema::hasTable('tblenquiry')) {
            Schema::create('tblenquiry', function (Blueprint $table) {
                $table->increments('id');
                $table->string('FullName', 100)->nullable();
                $table->string('EmailId', 100)->nullable();
                $table->string('MobileNumber', 10)->nullable();
                $table->string('Subject', 100)->nullable();
                $table->mediumText('Description')->nullable();
                $table->timestamp('PostingDate')->useCurrent();
                $table->integer('Status')->nullable()->default(0);
            });
        }

        if (!Schema::hasTable('tblissues')) {
            Schema::create('tblissues', function (Blueprint $table) {
                $table->increments('id');
                $table->string('UserEmail', 100)->nullable();
                $table->string('Issue', 100)->nullable();
                $table->mediumText('Description')->nullable();
                $table->timestamp('PostingDate')->useCurrent();
                $table->mediumText('AdminRemark')->nullable();
                $table->timestamp('AdminremarkDate')->nullable()->useCurrentOnUpdate();
            });
        }

        if (!Schema::hasTable('tblpages')) {
            Schema::create('tblpages', function (Blueprint $table) {
                $table->increments('id');
                $table->string('type', 255)->nullable();
                $table->longText('detail')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tblpages');
        Schema::dropIfExists('tblissues');
        Schema::dropIfExists('tblenquiry');
        Schema::dropIfExists('tblbooking');
        Schema::dropIfExists('tbltourpackages');
        Schema::dropIfExists('tblusers');
        Schema::dropIfExists('admin');
    }
};

