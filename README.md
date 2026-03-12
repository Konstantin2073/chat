Склонируйте репозиторий, 
Установите зависимости с помощью `composer install` и `npm install`. 
Создайте файл `.env`, скопировав его из `.env.example`, затем создайте новую базу данных (например, `laravel_app`) и укажите её параметры подключения в `.env` в полях `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`. 
Сгенерируйте ключ приложения командой `php artisan key:generate`, 
выполните миграции `php artisan migrate`, 
затем запустите сидеры `php artisan db:seed`. 
После этого запустите сервер командой `php artisan serve` и откройте проект в браузере по адресу http://127.0.0.1:8000.