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

class convertVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return string
     */
    public function handle()
    {
        //
        //        $format = new X264('aac', 'libx264');
        $lowBitrate = new X264('aac', 'libx264');
        $lowBitrate->setKiloBitrate(200);
        $midBitrate = (new X264)->setKiloBitrate(500);
        $highBitrate = (new X264)->setKiloBitrate(1000);
        $encryptionKey = HLSExporter::generateEncryptionKey();
//        $en =  HLSExporter::ge
        Storage::put('secret.key', $encryptionKey);
//        FFMpeg::openUrl('https://videocoursebuilder.com/lesson-1.mp4');

//        FFMpeg::open('H:\Project\Laravel_project\onlineMovie\storage\uploads\react.MP4')
//            ->exportForHLS()
//            ->setSegmentLength(10) // optional
//            ->addFormat($lowBitrate)
//            ->save('H:\Project\Laravel_project\onlineMovie\storage\uploads\test.m3u8');
        $media = FFMpeg::fromDisk('public')->open('react.MP4')
            ->exportForHLS()->withEncryptionKey($encryptionKey)->setSegmentLength(2)
            ->addFormat($lowBitrate)
            ->save('7/test.m3u8');
        FFMpeg::cleanupTemporaryFiles();
//        return $encryptionKey;
    }
}
