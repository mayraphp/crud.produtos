<?php

namespace App;

use App\Jobs\ProcessCsvUpload;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['name', 'description', 'price', 'quantity'];


    public function importProduct()
    {
        $path = resource_path('pending-products/*.csv');

        $files = glob($path);

        foreach($files as $file) {

            ProcessCsvUpload::dispatch($file);

        }

    }

}
