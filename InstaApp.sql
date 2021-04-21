CREATE DATABASE InstaApp;

create table InstaApp.user
(
   username_user    varchar(20) not null,
   nama_user        varchar(40) not null,
   password_user    varchar(64) not null,
   primary key (username_user)
);

create table InstaApp.diskusi
(
   id_diskusi           int(7) not null auto_increment,
   username_diskusi     varchar(20) not null,
   pertanyaan_diskusi   text not null,
   tgl_diskusi          date not null,
   id_jawaban_diskusi   int(7) NULL,
   primary key (id_diskusi, username_diskusi)
);

create table InstaApp.jawaban
(
   id_jawaban           int(7) not null auto_increment,
   username_jawaban     varchar(20) not null,
   jawaban_jawaban      text not null,
   tgl_jawaban          date not null,
   primary key (id_jawaban, username_jawaban)
);

alter table InstaApp.diskusi add constraint FK_Bertanya foreign key (username_diskusi)
      references InstaApp.user (username_user) on delete restrict on update cascade;

alter table InstaApp.diskusi add constraint FK_Jawaban foreign key (id_jawaban_diskusi)
      references InstaApp.jawaban (id_jawaban) on delete restrict on update cascade;

alter table InstaApp.jawaban add constraint FK_Dijawab_Oleh foreign key (username_jawaban)
      references InstaApp.user (username_user) on delete restrict on update cascade;

INSERT INTO InstaApp.user (username_user,nama_user,password_user) VALUES ('user1', 'Paul Tibbit', SHA2('111111Qq',0));
INSERT INTO InstaApp.user (username_user,nama_user,password_user) VALUES ('expert1', 'Stephen Hillenburg', SHA2('111111Qq',0));
INSERT INTO InstaApp.diskusi (username_diskusi,pertanyaan_diskusi,tgl_diskusi) VALUES ('user1', 'Kenapa laptop saya sering overheat?', '2020-01-03');
INSERT INTO InstaApp.jawaban (username_jawaban,jawaban_jawaban,tgl_jawaban) VALUES ('expert1', 'Mungkin ada masalah di heatsink-nya', '2020-01-03');
UPDATE InstaApp.diskusi SET id_jawaban_diskusi = '1' WHERE id_diskusi = '1' AND username_diskusi = 'user1';