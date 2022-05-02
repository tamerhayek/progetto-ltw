const nome=document.getElementById("nome");
const cognome=document.getElementById("cognome");
const email=document.getElementById("email");
const username=document.getElementById("username");
const password=document.getElementById("password");
const passwordConferma=document.getElementById("passwordconferma");
const form=document.getElementById("form");

/*document.querySelector("button")
.addEventListener("click",(event)=>{
    event.preventDefault();

    validaInput();
});

function validaInput(){
    if(nome.value.trim()===""){
        setError(nome,"Questo campo non può essere vuoto!");
    }else{
        setSuccess(nome);
    }

    if(cognome.value.trim()===""){
        setError(cognome,"Questo campo non può essere vuoto!");
    }else{
        setSuccess(cognome);
    }

    if(email.value.trim()===""){
        setError(email,"Questo campo non può essere vuoto!");
    }else{
        if(!validEmail(email.value.trim())){
            setError(email,"Email non valida");
        }else
            setSuccess(email);
    }
     
    if(username.value.trim()===""){
        setError(username,"Questo campo non può essere vuoto!");
    }else if(username.value.trim().length<8){
        setError(username, "Lo username deve contenere almeno 8 caratteri!");
    }
    else{
        setSuccess(username);
    }

    if(password.value.trim()===""){
        setError(password,"Questo campo non può essere vuoto!");
    }else if(password.value.trim().length<8){
        setError(password, "La password deve contenere almeno 8 caratteri!");
    }else{
        setSuccess(password);
    }

    if(passwordConferma.value.trim()===""){
        setError(passwordConferma,"Questo campo non può essere vuoto!");
    }else{
         if(passwordConferma.value.trim()!==password.value.trim()){
            setError(passwordConferma,"La password scelta e quella di conferma non coincidono!");
         }
         else
            setSuccess(passwordConferma);
     }

}
*/ 
function validEmail(email){
    return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
 }
 
 
 
function setSuccess(input){
    parent=input.parentElement;
    messageEle=parent.querySelector("small");
    messageEle.style.visibility="hidden"; 
    parent.classList.remove("error");
    parent.classList.add("success");  
}
function setError(input,message){
    parent=input.parentElement;
    messageEle=parent.querySelector("small");
    messageEle.style.visibility="visible";
    messageEle.innerText=message;  
    parent.classList.add("error");
    parent.classList.remove("success");
}

function validaNome(){
    if(nome.value.trim()===""){
        setError(nome,"Questo campo non può essere vuoto!");
        return false;
    }else{
        setSuccess(nome);
        return true;
    }
}

function validaCognome(){
    if(cognome.value.trim()===""){
        setError(cognome,"Questo campo non può essere vuoto!");
        return false;
    }else{
        setSuccess(cognome);
        return true;
    }
}

function validaEmail(){
    if(email.value.trim()===""){
        setError(email,"Questo campo non può essere vuoto!");
        return false;
    }else{
        if(!validEmail(email.value.trim())){
            setError(email,"Email non valida");
            return false;
        }else{
            setSuccess(email);
            return true;
        }
    }
}

function validaUsername(){
    if(username.value.trim()===""){
        setError(username,"Questo campo non può essere vuoto!");
        return false;
    }else if(username.value.trim().length<8){
        setError(username, "Lo username deve contenere almeno 8 caratteri!");
        return false;
    }
    else{
        setSuccess(username);
        return true;
    }
}

function validaPassword(){
    if(password.value.trim()===""){
        setError(password,"Questo campo non può essere vuoto!");
        return false;
    }else if(password.value.trim().length<8){
        setError(password, "La password deve contenere almeno 8 caratteri!");
        return false;
    }else{
        setSuccess(password);
        return true;
    }
}

function validaPasswordConf(){
    if(passwordConferma.value.trim()===""){
        setError(passwordConferma,"Questo campo non può essere vuoto!");
        return false;
    }else{
         if(passwordConferma.value.trim()!==password.value.trim()){
            setError(passwordConferma,"La password scelta e quella di conferma non coincidono!");
            return false;
         }
         else{
            setSuccess(passwordConferma);
            return true;
         }
     }

}