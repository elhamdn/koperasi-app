## How to start

-   di cmd ketik git clone https://github.com/elhamdn/koperasi-app.git
-   masuk ke folder koperasi-app (masih memakai cmd) (caranya ketik cd koperasi-app)
-   ketik composer install
-   rename file .env.example menjadi .env
-   buat db di phpmyadmin dengan nama 'db_koperasi'
-   run php artisan key:generate
-   di cmd ketik php artisan migrate
-   di cmd ketik php artisan db:seed
-   untuk menjalankan ketik php artisan serve
