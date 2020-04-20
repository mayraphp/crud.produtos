<?php

namespace App\Jobs;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;

class ProcessCsvUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle('upload-csv')->allow(1)->every(20)->then(function(){

            dump('Processando arquivo : '. $this->file);

            $data = array_map('str_getcsv', file($this->file));

            foreach($data as $row) {
                Product::updateOrCreate([
                    'id'=>$row[0],
                    'name'=>$row[1],
                    'quantity'=>$row[2],
                    'price'=>$row[3],
                    'description'=>$row[4],
                ]);
            }

            unlink($this->file);

        }, function () {

            return $this->release(10);

        });



    }
}
