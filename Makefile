# make for windows http://gnuwin32.sourceforge.net/packages/make.htm
DC = docker-compose
COMPOSER = $(DC) exec app composer

##help			Shows this help
help:
	@cat makefile | grep "##." | sed '2d;s/##//;s/://'

##install			Initial setup of application with autostarting containers
install:
	$(DC) up -d --build
	$(COMPOSER) install
	cp phpunit.xml.dist phpunit.xml

##bash			Open the app container bash
bash:
	$(DC) exec app sh

##up			Up containers with rebuild
up:
	$(DC) up -d

##down			Down containers
down:
	$(DC) down -v

##test			Run tests
test:
	$(DC) exec app ./vendor/bin/phpunit

##load			Dump the autoloader
load:
	$(COMPOSER) dumpautoload

##ps			Show runned containers
ps:
	$(DC) ps

##require			Require composer dependency
require:
	$(COMPOSER) require $(filter-out $@,$(MAKECMDGOALS))

##remove			Remove composer dependency
remove:
	$(COMPOSER) remove $(filter-out $@,$(MAKECMDGOALS))