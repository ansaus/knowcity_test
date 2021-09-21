create or replace table api_users
(
	id int null,
	username varchar(255) not null,
	password varchar(255) not null,
	token varchar(255) null,
	constraint api_users_token_uindex
		unique (token),
	constraint api_users_username_uindex
		unique (username)
);
INSERT INTO api_users (id, username, password, token) VALUES (1, 'devtest', 'e10adc3949ba59abbe56e057f20f883e', '559bc19c408b232e2c33a48094a1b2bde18284c9e32c3947a1d32f45dfef90f6');

create or replace table students
(
	id int auto_increment
		primary key,
	username varchar(255) not null,
	name varchar(255) not null,
	`group` varchar(255) default 'default group' null
);

INSERT INTO students (id, username, name, `group`) VALUES (1, 'kctest1', 'John Smith', 'Default group');
INSERT INTO students (id, username, name, `group`) VALUES (2, 'kctest2', 'Mark Cardenas', 'default group');
INSERT INTO students (id, username, name, `group`) VALUES (4, 'kctest3', 'Timothy Arnold', 'default group');
INSERT INTO students (id, username, name, `group`) VALUES (5, 'kctest4', 'Jessica Moyer', 'default group');
INSERT INTO students (id, username, name, `group`) VALUES (6, 'kctest5', 'Robert Bauer', 'default group');
INSERT INTO students (id, username, name, `group`) VALUES (7, 'kctest6', 'James Alvarado', 'default group');
INSERT INTO students (id, username, name, `group`) VALUES (8, 'kctest7', 'Karen Taylor', 'default group');
