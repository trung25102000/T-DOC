# PHP Docker

## Cấu trúc

```
Docker/
├── docker-compose.yml   # Chạy từ đây
└── php/
    ├── Dockerfile       # Cấu hình PHP image
    ├── php.ini          # Cấu hình PHP
    └── README.md
```

## Chạy

```bash
cd Docker
docker-compose up -d --build
```

## Test

```bash
docker exec php-app php -v
```

## Kiểm tra cấu hình PHP

```bash
# Xem php.ini đã load
docker exec php-app php -i | grep "Loaded Configuration File"

# Xem các setting
docker exec php-app php -i | grep memory_limit
docker exec php-app php -i | grep upload_max_filesize
docker exec php-app php -i | grep post_max_size
docker exec php-app php -i | grep max_execution_time
```

## Kiểm tra Timezone

```bash
# Xem timezone hiện tại
docker exec php-app php -r "echo date_default_timezone_get();"

# Xem timezone từ php.ini
docker exec php-app php -i | grep date.timezone

# Xem timezone của container
docker exec php-app date
```

## Kiểm tra Extensions

```bash
# Xem tất cả extensions đã cài
docker exec php-app php -m

# Kiểm tra extension cụ thể
docker exec php-app php -m | grep mysqli
docker exec php-app php -m | grep pdo
docker exec php-app php -m | grep gd
```

## Kiểm tra Composer

```bash
# Version
docker exec php-app composer --version

# Kiểm tra packages
docker exec php-app composer show
```

## Logs

```bash
# Xem logs container
docker logs php-app

# Xem logs realtime
docker logs -f php-app

# Xem PHP error log
docker exec php-app tail -f /var/log/php-error.log
```

## Tùy chỉnh php.ini

Chỉnh sửa file `php/php.ini` và restart container:

```bash
docker-compose restart php
```

## Debug

```bash
# Vào container
docker exec -it php-app bash

# Xem toàn bộ phpinfo
docker exec php-app php -i

# Kiểm tra PHP syntax
docker exec php-app php -l /var/www/html/index.php
```
