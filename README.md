cat > ~/socialnet-project/README.md << 'EOF'
# SocialNet Project

## Tech Stack
- PHP 8.3
- MySQL
- Nginx
- Ubuntu Linux

## Setup Instructions

### 1. Install required packages
```bash
sudo apt update
sudo apt install nginx mysql-server php8.3-fpm php8.3-mysql php8.3-mbstring -y
```

### 2. Import database
```bash
sudo mysql < db.sql
```

### 3. Set MySQL root password (if needed)
```bash
sudo mysql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '123456';
FLUSH PRIVILEGES;
EXIT;
```

### 4. Copy files to web root
```bash
sudo cp -r socialnet /var/www/html/
sudo cp -r admin /var/www/html/
sudo chmod -R 755 /var/www/html/socialnet
sudo chmod -R 755 /var/www/html/admin
```

### 5. Configure Nginx
```bash
sudo nano /etc/nginx/sites-available/socialnet
```
Paste this config:
```nginx
server {
    listen 80;
    server_name _;
    root /var/www/html;
    index index.php index.html;

    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
    }
}
```
Then enable it:
```bash
sudo ln -s /etc/nginx/sites-available/socialnet /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo systemctl restart nginx php8.3-fpm
```

### 6. Update database password in db.php
Edit `socialnet/db.php` and set your MySQL password.

## Pages
| Page | URL |
|------|-----|
| Admin - Create User | /admin/newuser.php |
| Sign In | /socialnet/signin.php |
| Home | /socialnet/index.php |
| Profile | /socialnet/profile.php |
| Setting | /socialnet/setting.php |
| About | /socialnet/about.php |
| Sign Out | /socialnet/signout.php |

## First Steps
1. Go to `/admin/newuser.php` to create the first account
2. Login at `/socialnet/signin.php`
EOF
