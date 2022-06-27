create table users
(
    id       serial
        constraint users_pk
            primary key,
    name     varchar(100) not null,
    surname  varchar(255) not null,
    email    varchar(255) not null,
    password varchar(255) not null
);

alter table users
    owner to lqyfejeclxywfi;

create unique index users_id_uindex
    on users (id);

INSERT INTO public.users (id, name, surname, email, password) VALUES (118, 'admin', 'admin', 'admin@gmail.com', '$2y$10$uvm5KlZGgtEo.nBsV7nubeHMbIIszCjJUl/dedbkQ7kiZ3vmWkIj2');
INSERT INTO public.users (id, name, surname, email, password) VALUES (119, 'user', 'user', 'user@gmail.com', '$2y$10$C/ZzH7BHlslq8NI7qjMWoekclOhxD3XHeYwBOKD.1yM70KyYPt/Lu');


create table sets
(
    id      integer default nextval('topics_id_seq'::regclass) not null
        constraint topics_pk
            primary key,
    id_user integer                                            not null
        constraint sets_users_id_fk
            references users
            on update cascade on delete cascade,
    name    varchar(100)                                       not null
);

alter table sets
    owner to lqyfejeclxywfi;

create unique index topics_id_uindex
    on sets (id);

INSERT INTO public.sets (id, id_user, name) VALUES (150, 118, 'Stolice Europy');


create table cards
(
    id       serial
        constraint cards_pk
            primary key,
    id_set   integer not null
        constraint cards_sets_id_fk
            references sets
            on update cascade on delete cascade,
    question varchar not null,
    answer   varchar not null
);

alter table cards
    owner to lqyfejeclxywfi;

create unique index cards_id_uindex
    on cards (id);

INSERT INTO public.cards (id, id_set, question, answer) VALUES (295, 150, 'Polska', 'Warszawa');
INSERT INTO public.cards (id, id_set, question, answer) VALUES (296, 150, 'Hiszpania', 'Madryt');
INSERT INTO public.cards (id, id_set, question, answer) VALUES (297, 150, 'Francja', 'Paryż');
INSERT INTO public.cards (id, id_set, question, answer) VALUES (298, 150, 'Norwegia', 'Oslo');
INSERT INTO public.cards (id, id_set, question, answer) VALUES (299, 150, 'Portugalia', 'Lizbona');
INSERT INTO public.cards (id, id_set, question, answer) VALUES (300, 150, 'Niemcy', 'Berlin');
INSERT INTO public.cards (id, id_set, question, answer) VALUES (301, 150, 'Czechy', 'Praga');

create table users_roles
(
    id_user integer           not null
        constraint users_roles_users_id_fk
            references users
            on update cascade on delete cascade,
    id_role integer default 1 not null
        constraint users_roles_roles_id_fk
            references roles
            on update cascade on delete cascade
);

alter table users_roles
    owner to lqyfejeclxywfi;

INSERT INTO public.users_roles (id_user, id_role) VALUES (118, 2);
INSERT INTO public.users_roles (id_user, id_role) VALUES (119, 1);


create table roles
(
    id   serial
        constraint roles_pk
            primary key,
    name varchar(100) not null
);

alter table roles
    owner to lqyfejeclxywfi;

create unique index roles_id_uindex
    on roles (id);

INSERT INTO public.roles (id, name) VALUES (1, 'user');
INSERT INTO public.roles (id, name) VALUES (2, 'admin');


create view all_sets_by_user(id, id_user, name) as
SELECT s.id,
       s.id_user,
       s.name
FROM users u
         JOIN sets s ON u.id = s.id_user;

alter table all_sets_by_user
    owner to lqyfejeclxywfi;

INSERT INTO public.all_sets_by_user (id, id_user, name) VALUES (150, 118, 'Stolice Europy');
