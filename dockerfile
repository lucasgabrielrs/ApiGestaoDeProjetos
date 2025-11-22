ARG PHP_VERSION=8.2-fpm
FROM php:${PHP_VERSION}

ARG workDir=/var/www/
ARG dirApp=./app
ARG entrypoint=./docker/entrypoint.sh
ARG customIni=./docker/php/custom.ini
ARG user=lucasrs
ARG uid=1000

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar configuração personalizada do PHP
COPY ${customIni} /usr/local/etc/php/conf.d/custom.ini

# Criar usuário
RUN groupadd -g ${uid} ${user} && \
    useradd -u ${uid} -ms /bin/bash -g ${user} ${user}

# Definir diretório de trabalho
WORKDIR ${workDir}

# Copiar aplicação
COPY ${dirApp} ${workDir}

# Copiar e configurar entrypoint
COPY ${entrypoint} /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Ajustar permissões
RUN chown -R ${user}:${user} ${workDir}

# Expor porta 9000
EXPOSE 9000

USER ${user}

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]