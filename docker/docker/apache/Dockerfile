FROM httpd:2.4.35-alpine
MAINTAINER Stefan Durubala, durubalastefan@gmail.com

RUN apk --no-cache update \
      && apk upgrade

RUN echo "Include /usr/local/apache2/conf/vhttpd.conf" \
      >> /usr/local/apache2/conf/httpd.conf

WORKDIR /usr/local/apache2/htdocs/
EXPOSE 80
CMD httpd-foreground
