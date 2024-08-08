# docker/php/Dockerfile

FROM php:8.2-fpm
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    unzip \
    && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo pdo_mysql mysqli
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Erstellen Sie einen neuen Benutzer und eine Gruppe
RUN groupadd -g 1000 appgroup && \
    useradd -u 1000 -g appgroup -m appuser

# Erstellen Sie ein Arbeitsverzeichnis
WORKDIR /var/www/html

# Kopieren Sie die aktuellen Dateien in das Arbeitsverzeichnis
COPY --chown=appuser:appgroup . .

# Wechseln Sie den Benutzer zu 'appuser'
USER appuser

# Install the MinIO PHP SDK using Composer
RUN composer require aws/aws-sdk-php

# Install the Guzzle using Composer
RUN composer require guzzlehttp/guzzle

# Install the Elastic Search Client
RUN composer require elasticsearch/elasticsearch