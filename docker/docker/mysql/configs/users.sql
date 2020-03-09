CREATE SCHEMA apache;
CREATE USER 'apache'@'%' IDENTIFIED BY 'apachepass';
GRANT ALL ON apache.* TO 'apache'@'%';
FLUSH PRIVILEGES;
