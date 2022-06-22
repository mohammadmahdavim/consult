<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download($patch,$file)
    {

        $filepath = public_path($patch.'/'.$file);
        return Response()->download($filepath);
    }
}
