create table utenti(
    nome varchar(50),
    cognome varchar(50),
    email varchar(50),
    username varchar(50) not null primary key,
    password varchar(50) not null,
    punteggio integer default 0,
    partiteGiocate integer default 0,
    admin boolean default false
);