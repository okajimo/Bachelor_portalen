<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class ProsjektforslagController extends Controller
{
    public function showUploadForm ()
    {
        if(session('levell') >= 2)
        {
            $title = "Prosjektforslag vedlikehold";
            $files = Storage::allFiles('/public/filer/prosjektforslag');
            foreach ($files as $file)
            {
                 $documents[] = basename($file);
            }
            //return dd($documents);
            return view('pages.admin.vedlikeholdProsjektforslag')->with(['title' => $title, 'documents' => $documents]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function uploadFile (request $request)
    {
        $this->validate($request, [
            'dok' => 'required|mimes:pdf|max:1999'
        ]);

        $upload = \UploadHelper::instance()->upload($request);
        return redirect('/vedlikehold_Prosjektforslag')->with('success', $upload);
    }

    public function destroy(request $request)
    {
        Storage::delete('/public/filer/prosjektforslag/'.$request->file);
        return redirect('/vedlikehold_Prosjektforslag')->with('success', 'Fil Fjernet');
    }
}
