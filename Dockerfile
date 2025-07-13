FROM richarvey/nginx-php-fpm:3.1.6

# Copy seluruh kode aplikasi
COPY . .

# Install Node.js dan build aset (Vite/Webpack)
RUN apk update \
 && apk add --no-cache npm \
 && npm install \
 && npm run build

# Install dependensi PHP via Composer tanpa dev, optimasi autoloader
RUN composer install --no-dev --optimize-autoloader

# Script start.sh akan otomatis dijalankan oleh parent image
CMD ["/start.sh"]

# Environment agar config dan skrip aktif
ENV RUN_SCRIPTS 1
