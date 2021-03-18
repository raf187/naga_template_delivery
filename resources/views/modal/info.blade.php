<div class="modal fade" id="nagaInfo" tabindex="1" role="dialog" aria-labelledby="nagaInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-body px-3">
                <h4 class="text-center pt-2 headSec orderComfir">Infos Nâga Sophia</h4>
                <hr class="my-4">
                <div class="container infoResto">
                    <h5 class="pb-2">Nous trouver</h5>
                    <p>
                        <a  class="text-dark text-decoration-none" href="https://www.google.fr/maps/place/24+Cours+Fragonard,+06560+Valbonne/@43.6208058,7.0430788,17z/data=!3m1!4b1!4m5!3m4!1s0x12cc2ba8b99a8515:0x6ebeb993d5f73a29!8m2!3d43.6208058!4d7.0452675" target="_blank">
                            <i class="fas fa-map-marker-alt pr-2"></i>
                            24 Cours Fragonard, 06560 Valbonne
                        </a>
                    </p>
                    <p><i class="fas fa-phone-alt pr-2"></i>09 53 76 41 78</p>
                    <p><i class="fas fa-at pr-2"></i>contact@naga-sophia.com</p>
                    <p><i class="fas fa-clock pr-2"></i>Horaires</p>
                    <ul class="openT px-5">
                      @foreach($schedules as $time)
                        <li class="d-flex justify-content-between"><span class="font-weight-bold col-4">{{$time->dayFr}}:</span><span class="offset-1"> @if($time->morningIsClose == 1 && $time->nigthIsClose == 1) Fermé @else Midi - @if($time->morningOpen == 1) Fermé @else{{ date("H:i", strtotime($time->morningOpen)) }} à {{ date("H:i", strtotime($time->morningClose)) }} @endif<br>Soir - @if($time->nigthIsClose == 1) Fermé @else{{ date("H:i", strtotime($time->nightOpen)) }} à {{ date("H:i", strtotime($time->nightClose)) }} @endif @endif</span></li>
                        <hr class="m-1">
                      @endforeach
                    </ul>
                </div>
                <div class="deliInfo container">
                    <h5 class="pb-2">Livraison</h5>
                    <p><i class="fas fa-shipping-fast pr-2"></i>Nous effectuons deux tournées de livraison midi:
                        <br>1ère tournée midi: entre 11h45 et 12h20
                        <br>2ème tournée midi: entre 12h45 et 13h30
                        <br>Le temps de livraison varie selon le nombre de commandes de la tournée. Si vous avez des demandes particulières pour la livraison, veuillez le preciser dans la case "information livraison" dans l'onglet "mes infos".</p>
                </div>
                <div class="payMethod container">
                    <h5 class="pb-2">Methodes de paiement</h5>
                    <p><i class="fas fa-credit-card pr-2"></i>Paiement en ligne par CB/Visa/MasterCard et cartes Titres-Restaurant Apetiz/Pass-Restaurant/Chèque-Déjeuner ainsi que Resto Flash et Swile. Paiement est entièrement securisé chez notre partenaire PayGreen.</p>
                    <p><i class="fas fa-ticket-alt pr-2"></i>Les titres-restaurant papiers sont acceptés à la livraison, si vous avez besoin de compléter seul un appoint en espèces est accepté. Nos livreurs ne disposent pas de caisse ni de terminaux bancaires, merci de votre compréhension.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light mr-4" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
