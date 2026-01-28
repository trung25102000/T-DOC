---
description: Tạo Docker configuration cho MySQL
---

Sử dụng rule @docker-generator để tạo cấu hình Docker cho MySQL:

1. Tạo thư mục `Docker/mysql/` nếu chưa có
2. Tạo `Docker/mysql/README.md` hướng dẫn ngắn gọn
3. Thêm service mysql vào `Docker/docker-compose.yml` với image `mysql:latest`

**KHÔNG đặt docker-compose.yml trong thư mục mysql/**

Test command:
```bash
cd Docker && docker-compose up -d && docker exec mysql-db mysql -uroot -proot -e "SELECT VERSION();"
```
