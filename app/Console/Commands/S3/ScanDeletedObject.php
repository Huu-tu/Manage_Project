<?php

namespace App\Console\Commands\S3;

use App\Models\FileCloud;
use Illuminate\Console\Command;

class ScanDeletedObject extends Command
{
    /**
     * 20 rows / time
     */
    const MAX_RECORD_TO_PROCESS = 20;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 's3:scan-deleted-object';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan deleted object on S3 then sync with DB';


    /**
     * @var \App\Services\S3CloudService
     */
    private $cloudService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $query = app()->make(FileCloud::class);
        $fileOnDb = $query->take(20)->orderBy('last_sync_at')->get();
        /** @var \App\Models\FileCloud[] $fileOnDb */
        foreach($fileOnDb as $row){
            $rs = $this->getCloudService()->hasFile($row->key);
            if(!$rs){
                $row->delete();
                $this->warn(sprintf('Object with key: %s has been deleted !', $row->key));
            }else{
                $row->fill(['last_sync_at' => \Carbon\Carbon::now()])->save();
            }
        }
        
        return 0;
    }

    /**
     * Lazy Denpendency Injection
     * @return \App\Services\S3CloudService
     */
    public function getCloudService(){
        if(!$this->cloudService instanceof \App\Services\S3CloudService){
            $this->cloudService = app()->make(\App\Services\S3CloudService::class);
        }

        return $this->cloudService;
    }
}
