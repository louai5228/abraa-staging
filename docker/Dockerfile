FROM php:8.1  as php
#FROM php:8.1 as php
USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-source delete
RUN apt-get update && \
    apt-get install --yes --no-install-recommends \
    openssh-client \
    git \
    && apt-get clean
RUN pecl install redis \
    && docker-php-ext-enable redis
RUN apt install sudo

COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer clear-cache

COPY . .
#RUN composer install
#RUN  php artisan migrate
#RUN php artisan key:generate
#CMD  php artisan serve --host=0.0.0.0 --port=80


#RUN curl -vk http://localhost:80
USER root
#RUN chown -R www-data:www-data /var/www/html \
 #   && a2enmod rewrite

#RUN mkdir -p -m 0777 ~/.ssh && \
 #   ssh-keyscan -H github.com bitbucket.org >> ~/.ssh/known_hosts
#RUN  echo "    IdentityFile ~/.ssh" >> ~/.ssh/id_rsa

#ARG SSH_PRIVATE_KEY

#RUN echo "${SSH_PRIVATE_KEY}" > ~/.ssh/id_rsa
#RUN chmod 777 ~/.ssh/id_rsa


#ADD  /Users/ramaazinformationtechnology/.ssh/codecommit_rsa  ~/.ssh/codecommit_rsa

#ADD  /Users/ramaazinformationtechnology/.ssh/codecommit_rsa /root/.ssh/codecommit_rsa
#RUN chmod 777/root/.ssh/codecommit_rsa

#RUN touch ~/.ssh/known_hosts
#RUN ssh-keyscan bitbucket.org >> ~/.ssh/known_hosts

#RUN mkdir -p -m 0600 ${HOME}/.ssh && \
 #   ssh-keyscan -H bitbucket.org >> ~/.ssh/known_hosts

#RUN echo " IdentityFile ~/.ssh" >> ~/.ssh/ssh_config

#RUN echo " IdentityFile ~/.ssh" >> ~/.ssh/known_hosts
#RUN echo "PermitRootLogin yes" >> ~/.ssh//codecommit_rsa



#CMD  .docker/start_script.sh

#ENTRYPOINT ["sh","-itd",  ".docker/start_script.sh" ]
#RUN eval $(ssh-agent -s)
#RUN ssh-add -k ~/.ssh/codecommit_rsa
#php artisan key:generate
COPY . .
EXPOSE 80
