<!-- Modal -->
<div class="modal fade" id="modalmodifierPlanInscription" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier un Plan d'inscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulaireModifierPlanInscription">
                    <div class="form-group">
                        <input type="text" class="form-control" name="id" id="idPlan" hidden>

                    </div>
                    <div class="form-group">
                        <label for="nom">Nom du Plan:</label>
                        <input type="text" class="form-control" name="nomplan" id="nomplan" placeholder="Nom du plan ....">
                        <span id="nomerrormodifier"></span>
                    </div>
                    <div class="form-group">
                        <label for="nom">Descitpion:</label>
                        <input type="text" class="form-control" name="descriptionplan"  id="descriptionplan" placeholder="description...">
                        <span id="descritpionerrormodifier"></span>
                    </div>
                    <div class="form-group">
                        <label for="nom">Prix:</label>
                        <input type="number" class="form-control" name="prixplan" id="prixplan" placeholder="prix....">
                        <span id="prixerrormodifier"></span>
                    </div>


                    <button type="submit" class="btn btn-primary" id="modfierPlanInscriptionbtninModal">Modifier</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </form>

            </div>

        </div>
    </div>
</div>