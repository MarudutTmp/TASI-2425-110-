Sebelum memulai, menjalankan website ini perlu :

1. instal PHP versi >= 8.1

2. install Composer (https://getcomposer.org/)

3. instal Node.js versi >= 18 

4. intall pnpm dev

5. install Laragon

6. pastikan kalua Git itu sudah ada untuk mempermudah pengerjaan 

7. perlu memperhatikan Ekstensi PHP yang diperlukan Laravel:

pdo_mysql

mbstring

openssl

tokenizer

xml

ctype

json

bcmath (jika diperlukan)



Cara menjalankan website kuisnya :

1. ekstrak file zipnya terlebih dahulu 

2. cd quiz-app

3. buka dan jalankan laragon yang terhubung ke website 

4. ketikan composer install atau composer install --ignore-platform-req=ext-sodium ke dalam terminal

5. php artisab db:seed 

6. php artisan migrate

7. ketik kan cp .env.example .env

8. php artisan key:generate

9. jalan kan website dengan membuka 2 terminal dimana 1 untuk menjalankan pnpm dev dan 1 lagi untuk php artisan serve

10. maka website dapat digunakan 