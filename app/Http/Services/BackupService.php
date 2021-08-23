<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BackupService
{
    public function handle()
    {
        $name = config('backup.backup.name');

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        $backups = $disk->files($name);

        $files = [];
        foreach ($backups as $key => $file) {
            if($disk->exists($file)) {
                $files[] = [
                    'file_name' => str_replace($name . '/', '', $file),
                    'file_size' => number_format(($disk->size($file) / 1024) / 1024, 2) . 'MB',
                    'file_created' => Carbon::createFromTimestamp($disk->lastModified($file))->toDateTimeString()
                ];
            }
        }

        return array_reverse($files);
    }
}