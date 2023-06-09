if ((window.location.pathname === "/admin") || (window.location.pathname === "/profil")) {
    const saveChangesBtn = document.getElementById('saveBlindtestChanges');
    const blindtestModal = document.getElementById('blindtestEditModal');
    const nameInput = document.getElementById('blindtestName');
    const descriptionInput = document.getElementById('description');
    const songList = document.getElementById('songList');
    const addSongBtn = document.getElementById('addSongBtn');
    const authorSelect = document.getElementById('author');
    const tableBody = document.querySelector('.blindtest-table > tbody');


    loadAuthors();
    applyCRUDActions();


    saveChangesBtn.addEventListener('click', saveChanges);
    blindtestModal.addEventListener('hidden.bs.modal', resetForm);
    addSongBtn.addEventListener('click', addSongInput);

    function deleteBlindtest(id) {
        fetch('/blindtest/' + id, {method: 'DELETE'})
            .then((response) => {
                document.querySelector('#blindtest-' + id).remove();
            })
            .catch(error => {
                console.error(error);
            });
    }

    function openBlindtestEditModal(id) {
        const bootstrapModal = new bootstrap.Modal(blindtestModal);

        if (id === 'new') {
            saveChangesBtn.dataset.action = 'create';
            saveChangesBtn.textContent = 'Créer';
            resetForm();
            bootstrapModal.show();
        } else {
            saveChangesBtn.dataset.action = 'edit';
            saveChangesBtn.dataset.id = id;
            saveChangesBtn.textContent = 'Modifier';

            fetch('/blindtest/' + id)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erreur lors de la récupération des données du blindtest');
                    }
                })
                .then(data => {
                    nameInput.value = data.name;
                    authorSelect.value = data.author;
                    descriptionInput.value = data.description;
                    populateSongList(data.songs);

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
            description: descriptionInput.value,
            author: authorSelect.value,
            songs: getSongList(),
        };

        let url = '/blindtest';
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
                    const newRow = document.createElement('tr');
                    newRow.id = 'blindtest-' + data.id;
                    newRow.innerHTML = `
                    <td>${data.id}</td>
                    <td>${data.name}</td>
                    <td>${data.author}</td>
                    <td>${data.description}</td>
                    <td>
                        <button class="btn-danger btn-sm blind-test-modal-extra" data-type="delete" data-param="${data.id}">Supprimer</button>
                        <button class="btn-primary btn-sm blind-test-modal-extra" data-type="edit" data-param="${data.id}">Éditer</button>
                    </td>
                `;
                    tableBody.appendChild(newRow);
                } else {
                    const blindtestRow = document.getElementById('blindtest-' + data.id);
                    blindtestRow.innerHTML = `
                    <td>${data.id}</td>
                    <td>${data.name}</td>
                    <td>${data.author}</td>
                    <td>${data.description}</td>
                    <td>
                        <button class="btn-danger btn-sm blind-test-modal-extra" data-type="delete" data-param="${data.id}">Supprimer</button>
                        <button class="btn-primary btn-sm blind-test-modal-extra" data-type="edit" data-param="${data.id}">Éditer</button>
                    </td>
                `;
                }
                applyCRUDActions(true);
                const bootstrapModal = bootstrap.Modal.getInstance(blindtestModal);
                bootstrapModal.hide();
            })
            .catch(error => {
                console.error(error);
            });
    }

    function resetForm() {
        nameInput.value = '';
        authorSelect.value = '';
        descriptionInput.value = '';
        songList.innerHTML = '';
    }

    function addSongInput() {
        const songField = document.createElement('div');
        songField.classList = 'mb-2 blindtest-song-field';

        const songInput = document.createElement('input');
        songInput.type = 'text';
        songInput.classList = 'form-control blindtest-song-url';
        songInput.placeholder = 'URL youtube';
        songField.appendChild(songInput);

        const answerInput = document.createElement('input');
        answerInput.type = 'text';
        answerInput.classList = 'form-control blindtest-song-answer';
        answerInput.placeholder = 'Réponse';
        songField.appendChild(answerInput);

        const removeSongBtn = document.createElement('button');
        removeSongBtn.classList.add('btn', 'btn-danger', 'btn-sm');
        removeSongBtn.textContent = 'Supprimer';
        removeSongBtn.addEventListener('click', () => {
            songField.remove();
        });
        songField.appendChild(removeSongBtn);

        songList.appendChild(songField);
    }

    function getSongList() {
        const songs = [];
        const songFields = songList.querySelectorAll('.blindtest-song-field');

        songFields.forEach(songField => {
            const songInput = songField.querySelector('.blindtest-song-url');
            const answerInput = songField.querySelector('.blindtest-song-answer');

            const songUrl = songInput.value.trim();
            const answer = answerInput.value.trim();

            if (songUrl !== '' && answer !== '') {
                songs.push({ songUrl, answer });
            }
        });

        return songs;
    }

    function populateSongList(songs) {
        songList.innerHTML = '';

        songs.forEach(song => {
            const songField = document.createElement('div');
            songField.classList = 'mb-2 blindtest-song-field';

            const songInput = document.createElement('input');
            songInput.type = 'text';
            songInput.classList = 'form-control blindtest-song-url';
            songInput.placeholder = 'URL youtube';
            songInput.value = song.url;
            songField.appendChild(songInput);

            const answerInput = document.createElement('input');
            answerInput.type = 'text';
            answerInput.classList = 'form-control blindtest-song-answer';
            answerInput.placeholder = 'Réponse';
            answerInput.value = song.answer;
            songField.appendChild(answerInput);

            const removeSongBtn = document.createElement('button');
            removeSongBtn.classList.add('btn', 'btn-danger', 'btn-sm');
            removeSongBtn.textContent = 'Supprimer';
            removeSongBtn.addEventListener('click', () => {
                songField.remove();
            });
            songField.appendChild(removeSongBtn);

            songList.appendChild(songField);
        });
    }

    function loadAuthors() {
        fetch('/users')
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Erreur lors de la récupération des utilisateurs');
                }
            })
            .then(data => {
                data.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.name;
                    authorSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error(error);
            });
    }

    function applyCRUDActions(isNew = false){
        let allButtons = document.querySelectorAll('button.blind-test-modal');
        if(isNew) {
            allButtons = document.querySelectorAll('button.blind-test-modal-extra');
        }
        allButtons.forEach(button => {
            if (button.dataset.type === 'delete') {
                button.addEventListener('click', () => {
                    deleteBlindtest(button.dataset.param);
                });
            } else if (button.dataset.type === 'edit') {
                button.addEventListener('click', () => {
                    const id = button.dataset.param;
                    openBlindtestEditModal(id);
                });
            }
        });
    }
}