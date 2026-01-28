# Docker Generator

Dự án này sử dụng Cursor Rule và Commands để tự động tạo cấu hình Docker cho các công nghệ khác nhau.

## Cách sử dụng

### 1. Sử dụng Slash Commands (Khuyến nghị)

Trong Cursor, gõ `/` để mở menu commands, sau đó chọn:

| Command | Mô tả |
|---------|-------|
| `/docker-php` | Tạo Docker cho PHP + Apache + MySQL |
| `/docker-node` | Tạo Docker cho Node.js |
| `/docker-python` | Tạo Docker cho Python |
| `/docker-mysql` | Tạo Docker cho MySQL |
| `/docker-redis` | Tạo Docker cho Redis |

### 2. Hoặc gõ trực tiếp trong Agent:

```
docker php
```

hoặc

```
docker node
```

hoặc

```
docker python
```

### 2. Các công nghệ được hỗ trợ:

| Công nghệ | Lệnh | Port mặc định |
|-----------|------|---------------|
| PHP | `docker php` | 80/9000 |
| Node.js | `docker node` | 3000 |
| Python | `docker python` | 8000 |
| MySQL | `docker mysql` | 3306 |
| Redis | `docker redis` | 6379 |

### 3. Cấu trúc được tạo ra:

```
{technology}/
├── Dockerfile          # Image configuration
├── docker-compose.yml  # Multi-container setup
├── .env.example        # Environment variables
└── README.md           # Hướng dẫn sử dụng
```

### 4. Chạy Docker:

```bash
cd {technology}
docker-compose up -d
```

### 5. Kiểm tra service:

```bash
# PHP
docker exec php-container php -v

# Node
docker exec node-container node -v

# Python
docker exec python-container python --version
```

## Ví dụ: Tạo Docker cho PHP

Gõ trong Cursor: `docker php`

Kết quả:

```
php/
├── Dockerfile
├── docker-compose.yml
├── .env.example
└── README.md
```

Sau đó chạy:

```bash
cd php
docker-compose up -d
docker exec php-app php -v
# Output: PHP 8.2.x
```
