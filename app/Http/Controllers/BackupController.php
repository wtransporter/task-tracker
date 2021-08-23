<?php

namespace App\Http\Controllers;

use App\Http\Services\BackupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function index(BackupService $backup)
    {
        $files = $backup->handle();

        return view('admin.backup.index', compact('files'));
    }

    public function store(Request $request)
    {
        if (!$request->has('onlySql')) {
            Artisan::call('backup:run');
        } else {
            Artisan::call('backup:run --only-db');
        }

        return redirect()->route('backups')->withSuccess('Database backup finished successfully.');
    }
}
