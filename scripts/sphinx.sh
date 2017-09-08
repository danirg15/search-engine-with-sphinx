#!/bin/bash

sudo apt-get update

sudo apt-get install sphinxsearch -y

sudo cp /vagrant/conf/sphinxsearch /etc/default/sphinxsearch 

sudo cp /vagrant/conf/sphinx.conf /etc/sphinxsearch/sphinx.conf

sudo service sphinxsearch stop

sudo indexer --all

sudo service sphinxsearch start

