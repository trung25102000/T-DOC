FROM nginx:alpine

# Create directories
RUN mkdir -p /var/log/nginx /etc/nginx/ssl

# Expose ports
EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]
