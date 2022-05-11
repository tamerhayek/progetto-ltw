create table sfide(
    id serial primary key,
    status1 boolean not null default false,
    status2 boolean not null default false,
    giocatore1 varchar(50) not null,
    giocatore2 varchar(50) not null,
    vincitore varchar(50),
    punteggio1 integer not null default 0,
    punteggio2 integer not null default 0
);