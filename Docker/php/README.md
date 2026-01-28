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
```

## Tùy chỉnh php.ini

Chỉnh sửa file `php/php.ini` và restart container:

```bash
docker-compose restart php
```
