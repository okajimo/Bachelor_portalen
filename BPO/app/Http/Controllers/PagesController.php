<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prosjektforslag;

class PagesController extends Controller
{
    public function index(){
        $title = "Velkommen til bachelorprosjektet på Institutt for informasjonsteknologi";
        return view('pages.Index')->with('title', $title);
    }

    public function informasjon(){
        //Henter årstall for bruk på siden
        $year = \DateHelper::instance()->year();
        if ($year == 'årstall mangler')
        {
            $year = array('year' => 'mangler', 'year1' => 'mangler');
        }
        $title = "Informasjon";
        return view('pages.informasjon')->with(['title' => $title, 'year' => $year]);
    }

    public function prosjektforslag(){
        $title = "Prosjektforslag";
        $documents = Prosjektforslag::get();
        //return dd($documents);
        return view('pages.prosjektforslag')->with(['title' => $title, 'documents' =>$documents]);
    }
    
    public function tidligere_prosjekter(){
        $title = "Tidligere Prosjekter";
        return view('pages.tidligere_prosjekter')->with('title', $title);
    }

    public function grupper(){
        $title = "Grupper";
        return view('pages.grupper')->with('title', $title);
    }

    public function kontakt_info(){
        $title = "Kontakt Info";
        return view('pages.kontakt_info')->with('title', $title);
    }

    // Statiske sider for studenter
    public function studenter(){
        // henter året fra prosjeket start og legger til 1 for å få året som avlsutter prosjektet.
        $year = \DateHelper::instance()->year();
        if ($year == 'årstall mangler')
        {
            $title = "Huskeliste for studenter '". $year."'";
        }
        else
        {
            $title = "Huskeliste for studenter ". $year['year'] ."/". $year['year1'];
        }
        return view('pages.student.studenter')->with('title', $title);
    }
    
    public function dokumentasjon(){
        $title = "Dokumentasjon";
        return view('pages.student.dokumentasjon')->with('title', $title);
    }

    public function lastNed($file_name) {
        $file_path = public_path('files/'.$file_name);
        return response()->download($file_path);
    }

    public function veiledning(){
        $title = "Veiledning";
        return view('pages.student.veiledning')->with('title', $title);
    }

    public function forprosjekt(){
        $title = "Forprosjekt";
        return view('pages.student.forprosjekt')->with('title', $title);
    }

    public function prosjektrapport(){
        $title = "Prosjektrapport";
        return view('pages.student.prosjektrapport')->with('title', $title);
    }

    public function evaluering(){
        $title = "Evaluering";
        return view('pages.student.evaluering')->with('title', $title);
    }
    
    public function statusrapport(){
        $title = "Statusrapport";
        return view('pages.student.statusrapport')->with('title', $title);
    }

    public function prosjektskisse(){
        $title = "Prosjektskisse";
        return view('pages.student.prosjektskisse')->with('title', $title);
    }

    //Statiske sider for sensorer
    public function sensorer(){
        // henter året fra prosjeket start og legger til 1 for å få året som avlsutter prosjektet.
        $year = \DateHelper::instance()->year();
        if ($year == 'årstall mangler')
        {
            $year = array('year' => 'mangler', 'year1' => 'mangler');
        }
        $title = "Informasjon for sensorer ". $year['year'] ."/". $year['year1'];
        return view('pages.sensor.sensorer')->with('title', $title);
    }

    //Statiske sider for oppdragsgivere
    public function oppdragsgivere(){
        //Henter årstall for bruk på siden
        $year = \DateHelper::instance()->year();
        if ($year == 'årstall mangler')
        {
            $year = array('year' => 'mangler', 'year1' => 'mangler');
        }
        $title = "Informasjon for oppdragsgivere";
        return view('pages.oppdragsgiver.oppdragsgivere')->with(['title' => $title, 'year' => $year]);
    }
    
    public function oppdragProsjekt(){
        $title = "Hva er et bachelorprosjekt?";
        return view('pages.oppdragsgiver.oppdragProsjekt')->with('title', $title);
    }

    public function oppdragStudent(){
        $title = "Hva kan en datastudent utrette?";
        return view('pages.oppdragsgiver.oppdragStudent')->with('title', $title);
    }

    public function oppdragSammarbeid(){
        $title = "Samarbeid med bedrifter";
        return view('pages.oppdragsgiver.oppdragSammarbeid')->with('title', $title);
    }

    public function oppdragBedrift(){
        $title = "En samarbeidsavtale";
        return view('pages.oppdragsgiver.oppdragBedrift')->with('title', $title);
    }

    public function oppdragKontakt(){
        $title = "Ta kontakt med oss!";
        return view('pages.oppdragsgiver.oppdragKontakt')->with('title', $title);
    }
}
