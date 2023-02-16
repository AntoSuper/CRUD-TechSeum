import { writable } from "svelte/store";
export const loggedIn = writable(false)
export const current_User = writable(null);

export const login = async (username, password) => {
    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);
    const res = await fetch('http://localhost:3000/back-end_development/check_login.php', {
        method: 'post',
        body: formData
    });
    const data = await res.json();

    if (data["status"] == 0) {
        alert('Credenziali non corrette!');
        return;
    }
    else {
        current_User.set(data);
    }
    /////////////////////////////////////////
    ////////////////////////////////////////
}

export const creaUtente = async (nome, cognome, amministratore, username, password) => {
    const formData = new FormData();
    formData.append('nome', nome);
    formData.append('cognome', cognome);
    formData.append('amministratore', amministratore);
    formData.append('username', username);
    formData.append('password', password);
    const res = await fetch('http://localhost:3000/back-end_development/utente/create_utente.php', {
        method: 'post',
        body: formData
    });
    const data = await res.json();
    console.log(data)

    if (data["status"] == 0) {
        alert('Errore nella creazione dell\'utente!');
        return;
    }
    else {
        alert('Utente aggiunto al database!');
    }
    /////////////////////////////////////////
    ////////////////////////////////////////
}