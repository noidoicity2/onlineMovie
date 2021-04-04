<?php

namespace App\Jobs;

use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSExporter;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class HandleVideoUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
protected $video;
protected $slug;
protected $fileName;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($video , $slug , $fileName)
    {
        //
        $this->video = $video;
        $this->slug = $slug;
        $this->fileName =$fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lowBitrate = new X264('aac', 'libx264');
        $lowBitrate->setKiloBitrate(200);

        $highRate =  (new X264('aac', 'libx264'))->setKiloBitrate(1000);
//
//        $midBitrate = (new X264)->setKiloBitrate(500);
//        $highBitrate = (new X264)->setKiloBitrate(1000);
        $encryptionKey = HLSExporter::generateEncryptionKey();
//        $en =  HLSExporter::ge
        Storage::put($this->video.'secret.key', $encryptionKey);
        Storage::disk('public' )->put('videos/'.$this->slug.'/'.'secret.key' , $encryptionKey);

        $media = FFMpeg::fromDisk('public')
            ->open('videos/'.$this->slug.'/'.$this->slug.'.'.$this->fileName)
            ->exportForHLS()
            ->withEncryptionKey($encryptionKey)
            ->setSegmentLength(5)
            ->addFormat($lowBitrate)
            ->addFormat($highRate)
            ->toDisk('public')
            ->save('videos/'.$this->slug.'/'.$this->slug.'.m3u8');
        FFMpeg::cleanupTemporaryFiles();
        info("ok");

    }
}