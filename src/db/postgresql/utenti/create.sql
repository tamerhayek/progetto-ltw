create table utenti(
    nome varchar(50),
    cognome varchar(50),
    email varchar(50),
    username varchar(50) not null primary key,
    password varchar(50) not null,
    admin boolean default false
);