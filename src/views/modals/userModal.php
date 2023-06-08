<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Édition d'utilisateur</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="userName" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="text" class="form-control" id="avatar" required>
                    </div>
                    <div class="form-group">
                        <label for="isAdmin">Administrateur</label>
                        <input type="checkbox"  id="isAdmin">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" id="saveUserChanges">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>