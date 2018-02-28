<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Velkommen til bachelorprosjektet på Institutt for informasjonsteknologi";
        return view('pages.Index')->with('title', $title);
    }

    public function grupper(){
        $title = "Grupper";
        return view('pages.grupper')->with('title', $title);
    }

    public function informasjon(){
        //Henter årstall for bruk på siden
        $year = \DateHelper::instance()->year();
        $title = "Informasjon";
        return view('pages.info.informasjon')->with(['title' => $title, 'year' => $year]);
    }

    public function kontakt_info(){
        $title = "Kontakt Info";
        return view('pages.info.kontakt_info')->with('title', $title);
    }

    public function prosjektforslag(){
        $title = "Prosjektforslag";
        return view('pages.prosjektforslag')->with('title', $title);
    }

    public function tidligere_prosjekter(){
        $title = "Tidligere Prosjekter";
        return view('pages.tidligere_prosjekter')->with('title', $title);
    }

    public function studenter(){
        // henter året fra prosjeket start og legger til 1 for å få året som avlsutter prosjektet.
        $year = \DateHelper::instance()->year();
        $title = "Huskeliste for studenter ". $year['year'] ."/". $year['year1'];
        return view('pages.info.studenter')->with('title', $title);
    }
    
    public function dokumentasjon(){
        $title = "Dokumentasjon";
        return view('pages.info.dokumentasjon')->with('title', $title);
    }

    public function lastNed($file_name) {
        $file_path = public_path('files/'.$file_name);
        return response()->download($file_path);
    }

    public function veiledning(){
        $title = "Veiledning";
        return view('pages.info.veiledning')->with('title', $title);
    }

    public function forprosjekt(){
        $title = "Forprosjekt";
        return view('pages.info.forprosjekt')->with('title', $title);
    }

    public function prosjektrapport(){
        $title = "Prosjektrapport";
        return view('pages.info.prosjektrapport')->with('title', $title);
    }

    public function evaluering(){
        $title = "Evaluering";
        return view('pages.info.evaluering')->with('title', $title);
    }

    public function sensorer(){
        // henter året fra prosjeket start og legger til 1 for å få året som avlsutter prosjektet.
        $year = \DateHelper::instance()->year();
        $title = "Informasjon for sensorer ". $year['year'] ."/". $year['year1'];
        return view('pages.info.sensorer')->with('title', $title);
    }

    public function oppdragsgivere(){
        //Henter årstall for bruk på siden
        $year = \DateHelper::instance()->year();
        $title = "Informasjon for oppdragsgivere";
        return view('pages.info.oppdragsgivere')->with(['title' => $title, 'year' => $year]);
    }
    
    public function oppdragProsjekt(){
        //$title = "Hva er et bachelorprosjekt?";
        $title = null;
        return view('pages.info.oppdragProsjekt')->with('title', $title);
    }

    public function oppdragStudent(){
        //$title = "Hva kan en datastudent utrette?";
        $title = null;
        return view('pages.info.oppdragStudent')->with('title', $title);
    }

    public function oppdragSammarbeid(){
        //$title = "Samarbeid med bedrifter";
        $title = null;
        return view('pages.info.oppdragSammarbeid')->with('title', $title);
    }

    public function oppdragBedrift(){
        //$title = "En samarbeidsavtale";
        $title = null;
        return view('pages.info.oppdragBedrift')->with('title', $title);
    }

    public function oppdragKontakt(){
        //$title = "Ta kontakt med oss!";
        $title = null;
        return view('pages.info.oppdragKontakt')->with('title', $title);
    }
}
