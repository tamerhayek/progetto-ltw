create table domande(
    id serial primary key,
    domanda varchar(300) not null,
    risposta1 varchar(300) not null,
    risposta2 varchar(300) not null,
    risposta3 varchar(300) not null,
    risposta4 varchar(300) not null,
    corretta integer not null
);