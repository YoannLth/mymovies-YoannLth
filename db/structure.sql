drop table if exists movie;
drop table if exists movie_genre;
drop table if exists user_mymovies;


create table movie_genre (
    genre_id integer not null primary key auto_increment,
    genre_name varchar(100) not null	
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table movie (
    mov_id integer not null primary key auto_increment,
    mov_name varchar(100) not null,
    mov_description_short varchar(500) not null,
    mov_description_long varchar(2000) not null,
    mov_author varchar(150) not null,
    mov_year integer not null,
	mov_poster varchar(150) not null,
	mov_mark TINYINT not null,
	mov_genre integer not null	
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table user_mymovies (
    user_id integer not null primary key auto_increment,
    user_username varchar(255) not null,
    user_password varchar(255) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

ALTER TABLE movie
ADD CONSTRAINT fk_movie_movieType FOREIGN KEY (mov_genre) REFERENCES movie_genre(genre_id);