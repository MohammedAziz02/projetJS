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
                        <input type="text" class="form-control" name="id" id="idMembre" hidden >

                    </div>
                <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" name="nom" id="modalNom" placeholder="Entrer un nom:">
                        <span id="nomerrormembre"></span>

                    </div>
                    <div class="form-group">
                        <label for="nom">Prenom:</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrer prenom">
                        <span id="prenomerrormembre"></span>
                    </div>
                    <div class="form-group">
                        <label for="nom">Adresse:</label>
                        <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Entrer adresse:">
                        <span id="adresseerrormembre"></span>
                    </div>
                    <div class="form-group">
                        <label for="nom">Email:</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Entrer un Email:">
                        <span id="emailerrormembre"></span>
                    </div>
                    <div class="form-group">
                        <label for="nom">Telephone:</label>
                        <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Numero:.....">
                        <span id="numeroerrormembre"></span>
                    </div>

                    <button type="submit" class="btn btn-primary" id="modifierMembreInModal">Modifier</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </form>

            </div>

        </div>
    </div>
</div>