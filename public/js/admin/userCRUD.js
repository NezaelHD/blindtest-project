if (window.location.pathname === "/admin") {
    const saveChangesBtn = document.getElementById('saveUserChanges');
    const editModal = document.getElementById('userEditModal');
    const nameInput = document.getElementById('userName');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const avatarInput = document.getElementById('avatar');
    const isAdminCheckbox = document.getElementById('isAdmin');

    applyCRUDActions();

    saveChangesBtn.addEventListener('click', saveChanges);
    editModal.addEventListener('hidden.bs.modal', resetForm);

    function deleteUser(id) {
        fetch('/user/' + id, {method: 'DELETE'})
            .then((response) => {
                document.querySelector('#user-' + id).remove();
            })
            .catch(error => {
                console.error(error);
            });
    }

    function openUserEditModal(id) {
        const bootstrapModal = new bootstrap.Modal(editModal);

        if (id === 'new') {
            saveChangesBtn.dataset.action = 'create';
            saveChangesBtn.textContent = 'Créer';
            bootstrapModal.show();
        } else {
            saveChangesBtn.dataset.action = 'edit';
            saveChangesBtn.dataset.id = id;
            saveChangesBtn.textContent = 'Modifier';

            fetch('/user/' + id)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erreur lors de la récupération des données de l\'utilisateur');
                    }
                })
                .then(data => {
                    nameInput.value = data.name;
                    emailInput.value = data.email;
                    passwordInput.value = data.password;
                    avatarInput.value = data.avatar;
                    isAdminCheckbox.checked = data.isAdmin;

                    bootstrapModal.show();
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }

    function saveChanges() {
        const action = saveChangesBtn.dataset.action;
        const id = saveChangesBtn.dataset.id || '';
        const formData = {
            name: nameInput.value,
            email: emailInput.value,
            isAdmin: isAdminCheckbox.checked,
            password: passwordInput.value,
            avatar: avatarInput.value
        };

        let url = '/user';
        let method = 'POST';

        if (action === 'edit') {
            url += '/' + id;
            method = 'PUT';
        }

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    console.error('Erreur lors de la sauvegarde des modifications');
                }
            })
            .then(data => {
                if (action === 'create') {
                    const tableBody = document.querySelector('tbody');
                    const newRow = document.createElement('tr');
                    newRow.id = 'user-' + data.id;
                    newRow.innerHTML = `
                    <td>${data.id}</td>
                    <td>${data.name}</td>
                    <td>${data.email}</td>
                    <td>${data.isAdmin}</td>
                    <td>
                        <button class="btn-danger btn-sm user-modal-extra" data-type="delete" data-param="${data.id}">Supprimer</button>
                        <button class="btn-primary btn-sm user-modal-extra" data-type="edit" data-param="${data.id}">Éditer</button>
                    </td>
                `;
                    tableBody.appendChild(newRow);
                } else {
                    const userRow = document.getElementById('user-' + data.id);
                    userRow.innerHTML = `
                    <td>${data.id}</td>
                    <td>${data.name}</td>
                    <td>${data.email}</td>
                    <td>${data.isAdmin}</td>
                    <td>
                        <button class="btn-danger btn-sm user-modal-extra" data-type="delete" data-param="${data.id}">Supprimer</button>
                        <button class="btn-primary btn-sm user-modal-extra" data-type="edit" data-param="${data.id}">Éditer</button>
                    </td>
                `;
                }
                applyCRUDActions(true);
                const bootstrapModal = bootstrap.Modal.getInstance(editModal);
                bootstrapModal.hide();
            })
            .catch(error => {
                console.error(error);
            });
    }

    function resetForm() {
        nameInput.value = '';
        emailInput.value = '';
        passwordInput.value = '';
        avatarInput.value = '';
        isAdminCheckbox.checked = false;
    }

    function applyCRUDActions(isNew = false) {
        let allButtons = document.querySelectorAll('button.user-modal');
        if(isNew) {
            allButtons = document.querySelectorAll('button.user-modal-extra');
        }
        allButtons.forEach(button => {
            if (button.dataset.type === 'delete') {
                button.addEventListener('click', () => {
                    deleteUser(button.dataset.param);
                });
            } else if (button.dataset.type === 'edit') {
                button.addEventListener('click', () => {
                    const id = button.dataset.param;
                    openUserEditModal(id);
                });
            }
        });
    }
}