<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;


class Tidligere_prosjekterController extends Controller
{
    public function tidligere_prosjekter()
    {
        if(session('levell') >= 2)
        {
            $title = "Generer html fil for tidligere prosjekter/presentasjonsplan";
            return view('pages.admin.vedlikehold_tidligere_prosjekter')->with('title', $title);
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function opprett_html_sider()
    {
        $sjekk = DB::select('SELECT presentation.presentation_group_number FROM presentation ORDER BY presentation.start');
        if($sjekk)
        {   
            $date = date('Y');
            $finnes = Storage::exists('/public/filer/tidligere_prosjekter_sluttrapport/'.$date);
            $finnesfil = Storage::exists('/public/filer/tidligere_prosjekter_sluttrapport/'.$date.'/'.$date);
            if($finnes == false)
            {
                Storage::makeDirectory('/public/filer/tidligere_prosjekter_sluttrapport/'.$date);
            }
            if($finnesfil == true)
            {
                Storage::delete('/public/filer/tidligere_prosjekter_sluttrapport/'.$date.'/'.$date.'.txt');
            }
            else
            {
                Storage::put('/public/filer/tidligere_prosjekter_sluttrapport/'.$date.'/'.$date.'.txt', "");
            }

            $dato = DB::select('SELECT presentation.start FROM presentation ORDER BY presentation.start');
            foreach($dato as $Dato)
            {
                $nyDato[] = \Carbon\Carbon::parse($Dato->start)->format('d');
            }
            $kunDato = array_unique($nyDato);

            //$gjort = $nyDato[0];

            $finnes2 = Storage::exists('/public/filer/presentasjonsplan/false.txt');
            $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt');
            if($finnes == true)
            {
                Storage::delete('/public/filer/presentasjonsplan/false.txt');
            }
            if($finnes == true)
            {
                Storage::delete('/public/filer/presentasjonsplan/true.txt');
            }
            foreach($kunDato as $dat)
            {
                $finnDato = DB::select('SELECT * FROM presentation');
                foreach($finnDato as $Dato)
                {
                    $sjekk = \Carbon\Carbon::parse($Dato->start)->format('d');
                    if($sjekk == $dat)
                    {
                        $html = "<h3>".\Carbon\Carbon::parse($Dato->start)->format('D.d.M')." - Rom: ".$Dato->presentation_room."</h3>
                            <table class='table table-responsive'>
                            <thead class='thead-light'>
                            <tr>
                                <th>Tid</th>
                                <th>Gruppe</th>
                                <th>Dokumentasjon</th>
                                <th>Studenter</th>
                                <th>Veileder</th>
                                <th>Sensor</th>
                            </tr>
                            </thead>
                        ";
                    }
                }
                foreach($finnDato as $grupper)
                {
                    $sjekk = \Carbon\Carbon::parse($grupper->start)->format('d');
                    $ar = $grupper->presentation_group_number;
                    //$files = Storage::allFiles('/public/filer/tidligere_prosjekter/'.$date.'/'.$ar);
                    $studenter = DB::select('SELECT student FROM student_groups WHERE student_groups.student_groups_number = :nummer AND student_groups.student_groups_year = :ar',['nummer'=>$grupper->presentation_group_number,'ar'=>$grupper->presentation_year]);
                    $veileder = DB::select('SELECT supervisor FROM groups WHERE groups.group_number = :nummer AND groups.year = :ar',['nummer'=>$grupper->presentation_group_number,'ar'=>$grupper->presentation_year]);
                    if($sjekk == $dat)
                    {
                        $ulr = "http://student.cs.hioa.no/hovedprosjekter/data/".$date."/".$ar."/";
                        $html .= "
                            <tr>
                            <tbody>
                                <td>".$grupper->start."</td>
                                <td>".$grupper->presentation_group_number."</td>
                                <td><a href='".$ulr."'target='_blank'>Sluttrapport</a></td>"
                                ;
                        $html .= "<td>";
                                foreach($studenter as $stud)
                                {
                                    $html .= $stud->student."</br>";
                                }
                        $html .="
                                </td>
                                <td>".$veileder[0]->supervisor."</td>
                                <td>".$grupper->sensor."</td>
                            </tr>
                            </tbody>
                        ";
                    }
                }
                $file = "storage/filer/tidligere_prosjekter_sluttrapport/".$date."/".$date.".txt";
                $current = file_get_contents($file);
                $current .= $html;
                $current .= "</table>";
                file_put_contents($file, $current);

                $finnes2 = Storage::exists('/public/filer/presentasjonsplan/false.txt');
                $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt');

                if($finnes2 == true)
                {
                    $file = "storage/filer/presentasjonsplan/false.txt";
                    $current = file_get_contents($file);
                    $current .= $html;
                    $current .= "</table>";
                    file_put_contents($file, $current);
                }
                else
                {
                    if($finnes3 == true)
                    {
                        $file = "storage/filer/presentasjonsplan/true.txt";
                        $current = file_get_contents($file);
                        $current .= $html;
                        $current .= "</table>";
                        file_put_contents($file, $current);
                    }
                    else
                    {
                        Storage::put('/public/filer/presentasjonsplan/false.txt', "");
                        $file = "storage/filer/presentasjonsplan/false.txt";
                        $current = file_get_contents($file);
                        $current .= $html;
                        $current .= "</table>";
                        file_put_contents($file, $current);
                    }
                }
            }
            return redirect('/tidligere_prosjekter');
        }
        else
        {
            return redirect('/vedlikehold_tidligere_prosjekter')->with('error', 'Det er ingen data å hente.');
        }
    }

    public function showTidligereProsjekter(request $request)
    {
        if(Input::get('sub'))
        {
            $verdi = $request->year;

            $fileHandle = fopen('storage/filer/tidligere_prosjekter_sluttrapport/'.$verdi.'/'.$verdi.'.txt', "r");
            $hvis =  fread($fileHandle,filesize("storage/filer/tidligere_prosjekter_sluttrapport/".$verdi."/".$verdi.".txt"));
            fclose($fileHandle);

            return redirect('/tidligere_prosjekter')->with('hvis',$hvis);
        }
    }

    public function publiserPresentasjonsplan()
    {
        if(session('levell') >= 2)
        {
            $finnes2 = Storage::exists('/public/filer/presentasjonsplan/false.txt');
            $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt');
            if($finnes2 == true)
            {
                Storage::move('/public/filer/presentasjonsplan/false.txt', '/public/filer/presentasjonsplan/true.txt');
            }
            if($finnes3 == true)
            {
                Storage::move('/public/filer/presentasjonsplan/true.txt', '/public/filer/presentasjonsplan/false.txt');
            }
            return redirect('/vedlikehold_tidligere_prosjekter');
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }

    public function hvisPresentasjonsplan()
    {
        if(session('levell') >= 1)
        {
            $title = "Presentasjonsplan";
            return view('admin.hvisPresentasjonsplan')->with('title' , $title);
        }
        else
        {
            return redirect('/login')->with('error', 'Du er ikke admin og har ikke tilgang');
        }
    }
}
