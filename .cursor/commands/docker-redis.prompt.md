---
description: Tạo Docker configuration cho Redis
---

Sử dụng rule @docker-generator để tạo cấu hình Docker cho Redis:

1. Tạo thư mục `Docker/redis/` nếu chưa có
2. Tạo `Docker/redis/README.md` hướng dẫn ngắn gọn
3. Thêm service redis vào `Docker/docker-compose.yml` với image `redis:latest`

**KHÔNG đặt docker-compose.yml trong thư mục redis/**

Test command:
```bash
cd Docker && docker-compose up -d && docker exec redis-cache redis-cli ping
```
