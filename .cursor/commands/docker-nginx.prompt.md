---
description: Tạo Docker configuration cho Nginx (production-ready)
---

Sử dụng rule @docker-generator để tạo cấu hình Docker cho Nginx:

1. Tạo thư mục `Docker/nginx/` nếu chưa có
2. Tạo `Docker/nginx/Dockerfile` với image `nginx:latest` hoặc `nginx:alpine`
3. Tạo `Docker/nginx/nginx.conf` - Cấu hình nginx chính (production-ready):
   - Worker processes, connections
   - Gzip compression
   - Client max body size
   - Timeout settings
   - Logging
4. Tạo `Docker/nginx/conf.d/default.conf` - Server block mặc định:
   - Server block cơ bản
   - Security headers
   - Static files caching
   - PHP-FPM proxy (nếu cần)
   - Access/error logs
5. Tạo `Docker/nginx/conf.d/ssl.conf` - SSL configuration (optional):
   - SSL protocols và ciphers
   - SSL session cache
   - HSTS header
6. Tạo thư mục `Docker/nginx/ssl/` cho certificates
7. Tạo `Docker/nginx/README.md` hướng dẫn chi tiết
8. Thêm service nginx vào `Docker/docker-compose.yml`:
   - Port 80, 443
   - Volume mount nginx.conf, conf.d/, ssl/, logs/
   - Depends on PHP service (nếu có)
9. Thêm biến môi trường vào `.env.example`:
   - NGINX_PORT_HTTP
   - NGINX_PORT_HTTPS
   - NGINX_CONTAINER_NAME

**Cấu hình production bao gồm:**
- ✅ Gzip compression
- ✅ Security headers (X-Frame-Options, X-Content-Type-Options, etc.)
- ✅ Rate limiting
- ✅ Client body size limits
- ✅ Timeout settings
- ✅ Access/error logs
- ✅ Static file caching
- ✅ SSL/TLS ready
- ✅ Worker processes optimization

**KHÔNG đặt docker-compose.yml trong thư mục nginx/**

Test command:
```bash
cd Docker && docker-compose up -d --build && docker exec nginx-app nginx -v && docker exec nginx-app nginx -t
```
