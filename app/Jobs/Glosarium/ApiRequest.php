<?php

namespace App\Jobs\Glosarium;

use App\ApiRequest as ApiRequestModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ApiRequest implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $data = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $request = [])
    {
        $this->data = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return ApiRequestModel::create($this->data);
    }
}
