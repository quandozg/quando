CREATE DATABASE demo;
GRANT ALL PRIVILEGES ON demo.* to 'demo'@'uniled-php-server.docker_public_net2' IDENTIFIED BY 'password';
flush privileges;
USE demo;
CREATE TABLE Users (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstName VARCHAR(50) NOT NULL,
lastName VARCHAR(50) NOT NULL,
email  VARCHAR(100) NOT NULL
);

