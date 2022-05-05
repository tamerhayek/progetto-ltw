create table utenti(
    nome varchar(20),
    cognome varchar(20),
    email varchar(30),
    username varchar(20) not null primary key,
    password varchar(20) not null,
    punteggio integer default 0,
    partiteGiocate integer default 0,
    admin boolean default false
);