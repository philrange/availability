insert into events (name) values('Test Event');

insert into dates (event, date) values(1, '20160830');
insert into dates (event, date) values(1, '20160831');

insert into people (username, displayName, password, salt, picture, email) values('test', 'Testy McTest', 'qwerty', 'salt', 'images/defaultPhoto.png', '');

insert into availability (event, person, date, available) values(1, 1, 2, 'available');