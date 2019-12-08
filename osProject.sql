-- Clint Schallberger

drop table cs359user cascade constraints;

create table cs359user
(email        varchar2(40) not null,
 first_name   varchar2(16) not null,
 last_name    varchar2(30) not null,
 user_name    varchar2(30) not null,
 password     varchar2(30) not null,
 set_date     date,
 is_admin     integer,  
 primary key (user_name)
);

drop table cs359score cascade constraints;

create table cs359score
(score        integer,
 user_name    varchar(30),	 
 primary key (user_name),
 foreign key (user_name) references cs359user
);

