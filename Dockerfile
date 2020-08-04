FROM php:7.2-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

# PGSQL extensions
RUN apt-get update -y
RUN apt-get install -y libpq-dev && docker-php-ext-install pdo_pgsql

# INSTALL INTL PHP EXTENSION
RUN apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
#RUN groupadd -g 1000 www
#RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
#COPY --chown=www:www . /var/www
#RUN chown -R www:www /var/www

# Change current user to www
#USER www

#RUN chown -R www-data:www-data /var/www
RUN chmod -R 777 ./storage

#Install npm 
RUN apt update
RUN apt install -y build-essential apt-transport-https lsb-release ca-certificates curl
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN apt-get install -y nodejs

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
