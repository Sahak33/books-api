Installation steps

1. composer i

required packages`

composer require orm
composer require --dev orm-fixtures
composer require --dev doctrine/doctrine-fixtures-bundle
composer require symfony/maker-bundle --dev
composer require symfony/console
composer require symfony/maker-bundle --dev
composer require fzaninotto/faker

make migrations 

1. php bin/console make:migration
2. php bin/console doctrine:migration:migrate

seed db

1. php bin/console doctrine:fixtures:load

endpoints in routes.yaml file
