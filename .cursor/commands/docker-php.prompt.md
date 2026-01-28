---
description: Tạo Docker configuration cho PHP
---

Sử dụng rule @docker-generator để tạo cấu hình Docker cho PHP:

1. Tạo thư mục `Docker/php/` nếu chưa có
2. Tạo `Docker/php/Dockerfile` với image `php:latest`
   - Copy php.ini vào `/usr/local/etc/php/conf.d/custom.ini`
3. Tạo `Docker/php/php.ini` với các setting cơ bản (memory_limit, upload_max_filesize, error_reporting, timezone, opcache)
4. Tạo `Docker/php/README.md` hướng dẫn ngắn gọn
5. Thêm service php vào `Docker/docker-compose.yml` với volume mount php.ini
6. Thêm biến `PHP_INI_PATH` vào `.env.example`

**KHÔNG đặt docker-compose.yml trong thư mục php/**

Test command:
```bash
cd Docker && docker-compose up -d --build && docker exec php-app php -v
```
