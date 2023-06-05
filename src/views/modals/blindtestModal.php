<div class="modal fade" id="blindtestEditModal" tabindex="-1" aria-labelledby="blindtestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blindtestModalLabel">Édition de blindtest</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="blindtestForm">
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="blindtestName" required>
                    </div>
                    <div class="form-group">
                        <label for="creator">Description</label>
                        <input type="text" class="form-control" id="description" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Auteur</label>
                        <select class="form-control" id="author" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="songList">Liste des chansons</label>
                        <div id="songList">
                        </div>
                        <button type="button" class="btn btn-primary mt-2" id="addSongBtn">Ajouter une chanson</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" id="saveBlindtestChanges">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>