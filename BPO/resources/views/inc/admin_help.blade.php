<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Help</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container row-margin-bottom">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                            <img height="90" width="90" src="{{asset('img/admin/Nyheter.PNG')}}" alt="Nyheter.PNG">
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 col-xl-10">
                            <ul>
                                <li>Lag Nyhet</li>
                                <li>Slett Nyhet</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                            <img height="90" width="90" src="{{asset('img/admin/Epost.PNG')}}" alt="Epost.PNG">
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 col-xl-10">
                            <ul>
                                <li>Send epost til elever</li>
                                <li>Send epost til veileder</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                            <img height="90" width="90" src="{{asset('img/admin/dokumenter.PNG')}}" alt="dokumenter.PNG">
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 col-xl-10">
                            <ul>
                                <li>Lese statusrapport</li>
                                <li>Les projektkisse</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                            <img height="90" width="90" src="{{asset('img/admin/administrerGruppe.PNG')}}" alt="administrerGruppe.PNG">
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 col-xl-10">
                            <ul>
                                <li>Gi gruppe veileder</li>
                                <li>Endre veileder</li>
                                <li>Slette gruppe</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                            <img height="90" width="90" src="{{asset('img/admin/presentasjonsplan.PNG')}}" alt="presentasjonsplan.PNG">
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 col-xl-10">
                            <ul>
                                <li>Generer presentasjonsplan
                                    <ul>
                                        <li>Generere plan</li>
                                        <li>Slette plan</li>
                                        <li>Publisere/upublisere plan</li>
                                    </ul>
                                </li>
                                <li>Endre Presentasjonsplan
                                    <ul>
                                        <li>Endre Dato/tid</li>
                                        <li>Endre Rom</li>
                                        <li>Endre Sensor</li>
                                    </ul>
                                </li>
                                <li>Presentasjonsplan
                                    <ul>
                                        <li>Se studentenes Presentasjonsplan</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                            <img height="90" width="90" src="{{asset('img/admin/prosjektforslag.PNG')}}" alt="prosjektforslag.PNG">
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 col-xl-10">
                            <ul>
                                <li>legge til projektforslag</li>
                                <li>Slette projektforslag</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                            <img height="90" width="90" src="{{asset('img/admin/sensorVeileder.PNG')}}" alt="sensorVeileder.PNG">
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 col-xl-10">
                            <ul>
                                <li>Registrer sensor</li>
                                <li>Registrer veileder</li>
                                <li>Slett veileder/sensor</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                            <img height="90" width="90" src="{{asset('img/admin/studenter.PNG')}}" alt="studenter.PNG">
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 col-xl-10">
                            <ul>
                                <li>Importer liste med studenter</li>
                                <li>Endre poeng på studentene
                                    <ul>
                                        <li>(under 100 poeng mister tilgang)</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                            <img height="90" width="90" src="{{asset('img/admin/grupperom.PNG')}}" alt="grupperom.PNG">
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 col-xl-10">
                            <ul>
                                <li>Legg til rom</li>
                                <li>Slett rom</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                            <img height="90" width="90" src="{{asset('img/admin/datoer.PNG')}}" alt="datoer.PNG">
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 col-xl-10">
                            <ul>
                                <li>Administrere viktige datoer</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>