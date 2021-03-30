<?php


namespace App\Services;


use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;

class HlsServices
{
    static function Convert() {
        $lowBitrate = (new X264)->setKiloBitrate(250);
        $midBitrate = (new X264)->setKiloBitrate(500);
        $highBitrate = (new X264)->setKiloBitrate(1000);

        FFMpeg::fromDisk('/storage/uploads/')
            ->open('react.MP4')
            ->exportForHLS()
            ->setSegmentLength(10) // optional
            ->addFormat($lowBitrate)
            ->addFormat($midBitrate)
            ->addFormat($highBitrate)
            ->save('sample_out.m3u8');

    }

}
