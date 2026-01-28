---
description: Tạo Docker configuration cho Node.js
---

Sử dụng rule @docker-generator để tạo cấu hình Docker cho Node.js:

1. Tạo thư mục `Docker/node/` nếu chưa có
2. Tạo `Docker/node/Dockerfile` với image `node:latest`
3. Tạo `Docker/node/README.md` hướng dẫn ngắn gọn
4. Thêm service node vào `Docker/docker-compose.yml`

**KHÔNG đặt docker-compose.yml trong thư mục node/**

Test command:
```bash
cd Docker && docker-compose up -d --build && docker exec node-app node -v
```
