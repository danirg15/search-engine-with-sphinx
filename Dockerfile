FROM ubuntu:16.04

MAINTAINER Daniel Ramirez

RUN apt-get update \
    && apt-get install -y locales \
    && locale-gen en_US.UTF-8

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

RUN apt-get install -y php7.0-cli

#Sql stuff

#Sphinx Setup
#RUN apt-get install -y sphinxsearch 
#COPY ./conf/sphinxsearch /etc/default/sphinxsearch 
#COPY ./conf/sphinx.conf /etc/sphinxsearch/sphinx.conf
#RUN service sphinxsearch stop
#RUN indexer --all
#RUN service sphinxsearch start

#RUN /bin/bash -c "source ./scripts/php.sh"

EXPOSE 9312
