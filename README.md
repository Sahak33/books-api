Installation steps

1. `composer i`
2. `composer u`

copy `.env.example` file and make `.env` and `.env.test` files

Warning, you have to create also test database for unit tests `yourdbname_test`

make migrations for common db

1. `php bin/console make:migration`
2. `php bin/console doctrine:migration:migrate`

make migration for test db

1. `php bin/console doctrine:migrations:migrate --env=test`

seed db

1. `php bin/console doctrine:fixtures:load`

seed test db

1. `php bin/console doctrine:fixtures:load --env=test`

Unit test command `./vendor/bin/phpunit` if command not running try this commands

1. `composer require --dev phpunit/phpunit` if not worked `composer require --dev symfony/browser-kit`
2. `composer i`

Run project with symfony server
1. `composer global require symfony/cli`
2. `export PATH="$PATH:$HOME/.composer/vendor/bin"`

Make sure that symfony CLI installed successfully with running this command `symfony --version`, if you see the version
try to run the project with this command `symfony server:start` if want to stop the server run this `symfony server:stop`
