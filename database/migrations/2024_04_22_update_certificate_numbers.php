<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Certificate;

return new class extends Migration
{
    public function up()
    {
        $certificates = Certificate::all();
        
        foreach ($certificates as $certificate) {
            $certificate->certificate_number = str_replace('/', '-', $certificate->certificate_number);
            $certificate->save();
        }
    }

    public function down()
    {
        $certificates = Certificate::all();
        
        foreach ($certificates as $certificate) {
            $certificate->certificate_number = str_replace('-', '/', $certificate->certificate_number);
            $certificate->save();
        }
    }
}; 