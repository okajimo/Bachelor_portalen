<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\Models\Prosjektforslag;

class ProsjektforslagController extends Controller
{
    public function showUploadForm ()
    {
        if(session('levell') >= 2)
        {
            $title = "Prosjektforslag vedlikehold";
            $documents = Prosjektforslag::get();
            return view('pages.admin.vedlikeholdProsjektforslag')->with(['title' => $title, 'documents' =>$documents]);
        }
        else
        {
            return redirect('/')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function uploadFile (request $request)
    {
        $this->validate($request, [
            'dok' => 'required|mimes:pdf|max:1999',
            'file_name' => 'required'
        ]);

        $upload = \UploadHelper::instance()->upload($request);
        return redirect('/vedlikehold_Prosjektforslag')->with('success', $upload);
    }

    public function destroy(request $request)
    {
        DB::delete('DELETE FROM prosjektforslag WHERE id = :id', ['id' => $request->input('id')]);
        Storage::delete('/public/filer/prosjektforslag/'.$request->input('file'));
        return redirect('/vedlikehold_Prosjektforslag')->with('success', 'Fil Fjernet');
    }
}
