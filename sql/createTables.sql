create table events (
	id int(16) PRIMARY KEY auto_increment,
	name varchar(32)
);

create table dates (
	id int(16) PRIMARY KEY auto_increment,
	event int(16),
	date date NOT NULL,
	FOREIGN KEY (event) REFERENCES events(id)
);

create table people (
	id int(16) PRIMARY KEY auto_increment,
	username varchar(32),
	displayName varchar(32),
	password varchar(32),
	salt varchar(32),
	picture varchar(128),
	email varchar(128)
);

create table availability (
	event int(16),
	person int(16),
	date int(16),
	available varchar(16),
	FOREIGN KEY (event) REFERENCES events(id),
	FOREIGN KEY (person) REFERENCES people(id),
	FOREIGN KEY (date) REFERENCES dates(id)
);