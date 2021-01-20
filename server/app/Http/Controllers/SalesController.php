<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Jobs\ProcessSales;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use DB;

class SalesController extends Controller
{


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('file'))
        {
            $data = file($request->file);
            $header = array_shift($data);
            $header = explode(",", rtrim(str_replace(" ","_",strtolower($header))));
            $chunks = array_chunk($data, 1000);

            //batching
            $batch = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk)
            {
                $data = array_map('str_getcsv', $chunk);
                $batch->add(new ProcessSales($data, $header));
                
            }
            return $batch;
        }
    }

    public function batch($batchId)
    {
        return Bus::findBatch($batchId);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }
        return "";
    }
}
