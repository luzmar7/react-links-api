drop database if exists reactlinksdb;
CREATE DATABASE reactlinksdb DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
use reactlinksdb;
create table link (
  id integer not null auto_increment,
  url varchar(255),
  dsc varchar(255),
  fecha date,
  hora time,
  primary key(id)
);
create table comentario (
  id integer not null auto_increment,
  link_id integer not null,
  username varchar(127),
  cont varchar(255),
  fecha date,
  hora time,
  primary key(id),
  foreign key (link_id)
  references link(id)
  on delete cascade
);
