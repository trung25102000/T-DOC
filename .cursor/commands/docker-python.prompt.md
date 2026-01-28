---
description: Tạo Docker configuration cho Python
---

Sử dụng rule @docker-generator để tạo cấu hình Docker cho Python:

1. Tạo thư mục `Docker/python/` nếu chưa có
2. Tạo `Docker/python/Dockerfile` với image `python:latest`
3. Tạo `Docker/python/README.md` hướng dẫn ngắn gọn
4. Thêm service python vào `Docker/docker-compose.yml`

**KHÔNG đặt docker-compose.yml trong thư mục python/**

Test command:
```bash
cd Docker && docker-compose up -d --build && docker exec python-app python --version
```
