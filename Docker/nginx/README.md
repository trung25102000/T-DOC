# Nginx Docker (Production-Ready)

## Cấu trúc

```
Docker/
├── docker-compose.yml
└── nginx/
    ├── Dockerfile
    ├── nginx.conf              # Cấu hình chính
    ├── conf.d/                 # HTTP configs (load tất cả *.conf)
    │   └── default.conf        # HTTP server block
    ├── ssl/                    # SSL configs & certificates
    │   ├── ssl.conf.example    # HTTPS server block (mẫu)
    │   └── .gitkeep            # Certificates (cert.pem, key.pem)
    ├── logs/                   # Nginx logs
    └── README.md
```

**Lưu ý:**
- `conf.d/` - Load tất cả `*.conf` cho HTTP configs
- `ssl/` - Load tất cả `*.conf` cho HTTPS configs và chứa certificates

## Tính năng Production

✅ **Performance**
- Worker processes auto
- Gzip compression
- Static file caching (1 năm)
- FastCGI caching ready

✅ **Security**
- Security headers (X-Frame-Options, X-Content-Type-Options, X-XSS-Protection)
- Rate limiting (10 req/s general, 30 req/s API)
- Hide nginx version
- SSL/TLS ready (TLSv1.2, TLSv1.3)
- HSTS header

✅ **Optimization**
- Client max body size: 100MB
- Timeouts configured
- Connection pooling
- Sendfile enabled

## Chạy

```bash
cd Docker
docker-compose up -d --build
```

## Test

```bash
# Kiểm tra version
docker exec nginx-app nginx -v

# Kiểm tra cấu hình
docker exec nginx-app nginx -t

# Test HTTP
curl http://localhost

# Xem logs
docker logs nginx-app
```

## Kiểm tra cấu hình

```bash
# Xem nginx.conf đã load
docker exec nginx-app nginx -T

# Kiểm tra worker processes
docker exec nginx-app ps aux | grep nginx

# Xem server blocks
docker exec nginx-app cat /etc/nginx/conf.d/default.conf
```

## Logs

```bash
# Access logs
docker exec nginx-app tail -f /var/log/nginx/access.log

# Error logs
docker exec nginx-app tail -f /var/log/nginx/error.log

# Xem logs realtime
docker logs -f nginx-app
```

## SSL/HTTPS Setup

### 1. Tạo self-signed certificate (cho dev)

```bash
# Vào thư mục ssl
cd Docker/nginx/ssl

# Tạo certificate
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
  -keyout key.pem -out cert.pem \
  -subj "/C=VN/ST=HN/L=Hanoi/O=Dev/CN=localhost"
```

### 2. Enable SSL config

```bash
# Copy file mẫu
cd Docker/nginx/ssl
cp ssl.conf.example ssl.conf

# Restart nginx
docker-compose restart nginx
```

### 3. Test HTTPS

```bash
curl -k https://localhost
```

## Tối ưu Performance

### 1. Kiểm tra worker connections

```bash
docker exec nginx-app cat /proc/sys/net/core/somaxconn
```

### 2. Xem status

```bash
# Thêm vào default.conf
location /nginx_status {
    stub_status on;
    access_log off;
    allow 127.0.0.1;
    deny all;
}

# Xem status
docker exec nginx-app curl http://localhost/nginx_status
```

### 3. Cache configuration

Thêm vào `nginx.conf`:

```nginx
# FastCGI cache
fastcgi_cache_path /var/cache/nginx levels=1:2 keys_zone=PHPCACHE:100m inactive=60m;
fastcgi_cache_key "$scheme$request_method$host$request_uri";
```

## Rate Limiting

Cấu hình hiện tại:
- **General**: 10 requests/giây (burst 20)
- **API**: 30 requests/giây

Tùy chỉnh trong `nginx.conf`:

```nginx
limit_req_zone $binary_remote_addr zone=general:10m rate=10r/s;
limit_req_zone $binary_remote_addr zone=api:10m rate=30r/s;
```

## Gzip Compression

```bash
# Test gzip
curl -H "Accept-Encoding: gzip" -I http://localhost

# Xem gzip types
docker exec nginx-app grep -A 10 "gzip" /etc/nginx/nginx.conf
```

## Tích hợp PHP-FPM

Cấu hình mặc định đã kết nối với PHP container `app:9000`.

```bash
# Test PHP
docker exec nginx-app curl http://app:9000/index.php
```

## Debug

```bash
# Vào container
docker exec -it nginx-app sh

# Xem toàn bộ config
nginx -T

# Reload config
nginx -s reload

# Test config syntax
nginx -t

# Xem error log live
tail -f /var/log/nginx/error.log
```

## Troubleshooting

### 1. Connection refused to PHP

```bash
# Kiểm tra PHP container đang chạy
docker ps | grep php

# Test kết nối
docker exec nginx-app ping app
```

### 2. Permission denied

```bash
# Kiểm tra quyền
docker exec nginx-app ls -la /var/www/html
```

### 3. 502 Bad Gateway

```bash
# Xem error log
docker exec nginx-app cat /var/log/nginx/error.log

# Kiểm tra PHP-FPM
docker exec php-app php-fpm -t
```

## Tùy chỉnh

### Thay đổi port

Chỉnh trong `.env`:

```env
NGINX_PORT_HTTP=8080
NGINX_PORT_HTTPS=8443
```

### Thêm HTTP server block

Tạo file mới trong `conf.d/`:

```bash
cd Docker/nginx/conf.d
nano api.conf
```

### Thêm HTTPS server block

Tạo file mới trong `ssl/`:

```bash
cd Docker/nginx/ssl
nano api-ssl.conf
```

### Reload config

```bash
docker-compose restart nginx
# hoặc
docker exec nginx-app nginx -s reload
```

## Production Checklist

- [ ] Cấu hình SSL certificates
- [ ] Enable HSTS header
- [ ] Cấu hình firewall
- [ ] Setup log rotation
- [ ] Enable monitoring
- [ ] Cấu hình backup
- [ ] Test rate limiting
- [ ] Enable OCSP stapling
- [ ] Configure CDN (nếu cần)
- [ ] Setup health checks
