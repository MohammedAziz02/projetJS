<!-- Modal -->
<div class="modal fade" id="modalModifierMembre" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier un membre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulaire">
                <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="modalNom" placeholder="Entrer un nom:">

                    </div>
                    <div class="form-group">
                        <label for="nom">Prenom:</label>
                        <input type="text" class="form-control" id="prenom" placeholder="Entrer un nom:">

                    </div>
                    <div class="form-group">
                        <label for="nom">Adresse:</label>
                        <input type="text" class="form-control" id="adresse" placeholder="Entrer un nom:">

                    </div>
                    <div class="form-group">
                        <label for="nom">Email:</label>
                        <input type="text" class="form-control" id="email" placeholder="Entrer un nom:">

                    </div>
                    <div class="form-group">
                        <label for="nom">Telephone:</label>
                        <input type="text" class="form-control" id="telephone" placeholder="Entrer un nom:">

                    </div>

                    <button type="submit" class="btn btn-primary" id="modifierMembreInModal">Modifier</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </form>

            </div>

        </div>
    </div>
</div>