<!-- Modal -->
<div class="modal fade" id="modalAjouterPlanInscription" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Un plan D'inscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulairePlanInscription">
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nomplan" placeholder="Entrer un nom:">
                        <span id="nomerror"></span>

                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="descriptionplan" placeholder="description...">
                        <span id="descritpionerror"></span>
                    </div>

                    <div class="form-group">
                        <label for="prix">Prix:</label>
                        <input type="number" class="form-control" id="prix" name="prixplan" placeholder="Prix...">
                        <span id="prixerror"></span>
                    </div>

                    <button type="submit" class="btn btn-primary" id="ajouterPlandinscription" >Ajouter</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </form>

            </div>

        </div>
    </div>
</div>