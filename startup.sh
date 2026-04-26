#!/bin/bash
set -e

echo "Starting Laravel setup..."

# Set nginx config
cat > /etc/nginx/sites-available/default <<'EOF'
server {
    listen 8080;
    listen [::]:8080;

    root /home/site/wwwroot/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.git {
        deny all;
    }
}
EOF

echo "Reloading nginx..."

nginx -t
service nginx restart

echo "Starting PHP-FPM..."

php-fpm -D

echo "Starting nginx..."

nginx -g "daemon off;"