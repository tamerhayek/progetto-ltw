const form = document.getElementsById("form");
const nome = document.getElementById("nome");
const cognome = document.getElementById("cognome");
const email = document.getElementById("email");
const username = document.getElementById("usernme");
const password = document.getElementById("pass");
const passwordconferma = document.getElementById("confirmpass");



function setError(element, message){
    inputControl = element.parentElement;
    errorDisplay = inputControl.querySelector(".error");

    errorDisplay.innerText = message;
    inputControl.classList.add("error");
    inputControl.classList.remove("success");
}

function setSuccess(element){
    inputControl = element.parentElement;
    errorDisplay = inputControl.querySelector(".error")

    errorDisplay.innerText = "";
    inputControl.classList.add("success");
    inputControl.classList.remove("error");
}


function validaDati(){
    const inputnome = nome.value.trim();
    const inputcognome = cognome.value.trim();
    const inputemail = email.value.trim();
    const inputusername = username.value.trim();
    const inputpassword = password.value.trim();
    const inputpasswordconferma = passwordconferma("confirmpass").value.trim();

    if(inputnome === ""){
        setError(nome, "Inserisci un nome!");
    } else{
        setSuccess(nome);
    }

    if(inputcognome === ""){
        setError(cognome, "Inserisci un nognome!");
    } else{
        setSuccess(cognome);
    }

    if(inputemail === ""){
        setError(email, "Inserisci un'email!");
    } else{
        setSuccess(email);
    }

    if(inputusername === ""){
        setError(username, "Inserisci un username!")
    }else if(username.length < 5){
        setError(username, "lo username deve contenere almeno 5 caratteri");
    } else{
        setSuccess(username);
    }

    if(inputpassword === ""){
        setError(password, "Inserisci una password");
    }else if(password.length < 8){
        setError(password, "la password deve contenere almeno 8 caratteri");
    } else{
        setSuccess(password);
    }

    if(inputpasswordconferma === ""){
        setError(passwordconferma, "Conferma la tua password");
    }else if(passwordconferma !== password){
        setError(passwordconferma, "la password deve contenere almeno 8 caratteri");
    } else{
        setSuccess(passwordconferma);
    }  
    return false;      
}





/*
function validaForm(){
    if(controllaDati()){
         if(document.getElementById("rmb").checked)
              alert("hai scelto di essere ricordato!");
         else
              alert("hai scelto di non essere ricordato!");
         alert("Registrazione andata a buon fine");
    }
    else {
         alert("Errore nell'inserimento dei dati!");
         return false;
    }
}

function controllaUsername(){
    if(document.signupForm.username.value.length > 20 || document.signupForm.username.value.length < 8){
        alert("La lunghezza dello username deve essere compresa tra 8 e 20 caratteri");
        return false;
    }
}

function controllaPassword(){
    if ((document.sigupForm.pass.value.length < 8 )){
        alert("La password deve contenere almeno 8 caratteri");
        return false;
    }
    return true;
}
function controllaPasswordConferma(){
    if (document.signupForm.confirmpass.value != document.signupForm.pass.value){
        alert("Le due password devono coincidere!");
        return false;
    }
    return true;
}




function controllaDati(){
    if (document.signupForm.nome.value=="") {
        alert("Inserire cognome");
        return false;
    }
    if (document.signupForm.cognome.value=="") {
        alert("Inserire nome");
        return false;
    }
    if (document.signupForm.email.value=="") {
        alert("Inserire email");
        return false;
    }
    if (document.signupForm.username.value=="") {
        alert("Selezionare un username");
        return false;
    }
    if ((document.signupForm.pass.value=="")) {
        alert("Inserire password");
        return false;
    }
    if (document.signupForm.confirmpass.value=="") {
        alert("Confermare password");
        return false;
    }
}
*/