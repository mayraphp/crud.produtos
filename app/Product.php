<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['name', 'description', 'price', 'quantity'];


    public function importProduct()
    {
        $path = resource_path('pending-products/*.csv');

        $g = glob($path);

        foreach(array_slice($g, 0, 1) as $file) {

            $data = array_map('str_getcsv', file($file));

            foreach($data as $row) {
                self::updateOrCreate([
                    'id'=>$row[0],
                    'name'=>$row[1],
                    'quantity'=>$row[2],
                    'price'=>$row[3],
                    'description'=>$row[4],
                ]);
            }

            unlink($file);

        }

    }

}
