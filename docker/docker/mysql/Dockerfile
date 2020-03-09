FROM mysql:5.7
MAINTAINER Stefan Durubala, durubalastefan@gmail.com

COPY ./configs/my.cnf /etc/mysql/conf.d/my.cnf
COPY ./configs/users.sql /docker-entrypoint-initdb.d/

EXPOSE 3306
CMD ["mysqld"]
