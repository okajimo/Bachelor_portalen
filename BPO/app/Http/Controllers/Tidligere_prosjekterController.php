<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DateTime;
use DateTimezone;


class Tidligere_prosjekterController extends Controller
{
    public function generer_presentasjonsplanView()
    {
        if(session('levell') >= 2)
        {
            $title = "Generer html fil for tidligere prosjekter/presentasjonsplan";
            return view('pages.admin.generer_presentasjonsplan')->with('title', $title);
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
                $finnDato = DB::select('SELECT * FROM presentation ORDER BY start');
                foreach($finnDato as $Dato)
                {
                    $sjekk = \Carbon\Carbon::parse($Dato->start)->format('d');
                    if($sjekk == $dat)
                    {
                        $dag = \Carbon\Carbon::parse($Dato->start)->format('D');
                        switch($dag)
                        {
                            case "Mon";
                                $Ndag = "Man";
                                break;
                            case "Tue";
                                $Ndag = "Tir";
                                break;
                            case "Wed";
                                $Ndag = "Ons";
                                break;
                            case "Thu";
                                $Ndag = "Tor";
                                break;
                            case "Fri";
                                $Ndag = "Fre";
                                break;
                            case "Sat";
                                $Ndag = "Lør";
                                break;
                            case "Sun";
                                $Ndag = "Søn";
                                break;
                        }
                        $html = "<h3>".$Ndag.".".\Carbon\Carbon::parse($Dato->start)->format('d.M')."</h3>
                            <table class='table'>
                            <div class='table-responsive'>
                            <thead class='thead-light'>
                            <tr>
                                <th>Tid</th>
                                <th>Gruppe</th>
                                <th>Dokumentasjon</th>
                                <th>Studenter</th>
                                <th>Veileder</th>
                                <th>Sensor</th>
                                <th>Rom</th>
                            </tr>
                            </thead>
                        ";
                    }
                }
                foreach($finnDato as $grupper)
                {
                    $sjekk = \Carbon\Carbon::parse($grupper->start)->format('d');
                    $ar = $grupper->presentation_group_number;
                    if($ar < 10)
                    {
                        $ar = "0".$ar;
                    }
                    $studenter = DB::select('SELECT student FROM student_groups WHERE student_groups.student_groups_number = :nummer AND student_groups.student_groups_year = :ar',['nummer'=>$grupper->presentation_group_number,'ar'=>$grupper->presentation_year]);
                    $sensor = DB::select('SELECT firstname, lastname FROM sensors_supervisors WHERE email = :sensor',['sensor'=>$grupper->sensor]);
                    $veileder = DB::select('SELECT firstname, lastname FROM groups, presentation, sensors_supervisors WHERE 
                    presentation.presentation_group_number = groups.group_number AND presentation.presentation_year = groups.year AND
                    groups.supervisor = sensors_supervisors.email AND presentation.presentation_group_number = :gruppe',['gruppe'=>$ar]);
                    if($sjekk == $dat)
                    {   
                        $ulr = "http://student.cs.hioa.no/hovedprosjekter/data/".$date."/".$ar."/";
                        $html .= "
                            <tr>
                            <tbody class='bg-light'>
                                <td>".\Carbon\Carbon::parse($grupper->start)->format('H:i')." - ".\Carbon\Carbon::parse($grupper->end)->format('H:i')."</td>
                                <td>".$grupper->presentation_group_number."</td>
                                <td><a href='".$ulr."'target='_blank'>Sluttrapport</a></td>"
                                ;
                        $html .= "<td>";
                                foreach($studenter as $stud)
                                {
                                    $studNavn = DB::select('SELECT firstname, lastname FROM users WHERE username = :name',['name'=>$stud->student]);
                                    $html .= $studNavn[0]->firstname." ".$studNavn[0]->lastname."</br>";
                                }
                        $html .="
                                </td>
                                <td>".$veileder[0]->firstname." ".$veileder[0]->lastname."</td>
                                <td>".$sensor[0]->firstname." ".$sensor[0]->lastname."</td>
                                <td>".$grupper->presentation_room."</td>
                            </tr>
                            </tbody>
                        ";
                    }
                }
                $file = "storage/filer/tidligere_prosjekter_sluttrapport/".$date."/".$date.".txt";
                $current = file_get_contents($file);
                $current .= $html;
                $current .= "</div></table>";
                file_put_contents($file, $current);

                $finnes2 = Storage::exists('/public/filer/presentasjonsplan/false.txt');
                $finnes3 = Storage::exists('/public/filer/presentasjonsplan/true.txt');

                if($finnes2 == true)
                {
                    $file = "storage/filer/presentasjonsplan/false.txt";
                    $current = file_get_contents($file);
                    $current .= $html;
                    $current .= "</div></table>";
                    file_put_contents($file, $current);
                }
                else
                {
                    if($finnes3 == true)
                    {
                        $file = "storage/filer/presentasjonsplan/true.txt";
                        $current = file_get_contents($file);
                        $current .= $html;
                        $current .= "</div></table>";
                        file_put_contents($file, $current);
                    }
                    else
                    {
                        Storage::put('/public/filer/presentasjonsplan/false.txt', "");
                        $file = "storage/filer/presentasjonsplan/false.txt";
                        $current = file_get_contents($file);
                        $current .= $html;
                        $current .= "</div></table>";
                        file_put_contents($file, $current);
                    }
                }
            }

            $bruker = session('navn');
            \LogHelper::Log($bruker." har generert html side for presentasjonsplan og lagret den i tidligere prosjekter", "1");

            return redirect('/presentasjonsplan')->with('success', 'Plan opprettet, trykk publiser for å gi studentene tillgang');
        }
        else
        {
            return redirect('/presentasjonsplan')->with('error', 'Det er ingen data å hente.');
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
            $bruker = session('navn');
            if($finnes2 == true)
            {
                Storage::move('/public/filer/presentasjonsplan/false.txt', '/public/filer/presentasjonsplan/true.txt');

                \LogHelper::Log($bruker." har publisert presentasjonsplan for studenter", "1");
            }
            if($finnes3 == true)
            {
                Storage::move('/public/filer/presentasjonsplan/true.txt', '/public/filer/presentasjonsplan/false.txt');

                \LogHelper::Log($bruker." har fjernet publisering av presentasjonsplan for studenter", "1");
            }
            return redirect('/presentasjonsplanView')->with('success', 'En endring har blitt gjort for visning av presentasjonsplan');
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
