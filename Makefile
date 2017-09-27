start:
	bin/console server:start 0.0.0.0:8000

stop:
	bin/console server:stop

run:
	bin/console server:run 0.0.0.0:8000

autoload-refresh:
	php composer.phar dump-autoload

create-bundle:
	bin/console generate:bundle