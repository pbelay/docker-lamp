# Docker LAMP Stack

A complete LAMP (Linux, Apache, MySQL, PHP) development environment using Docker and Docker Compose.

## 🚀 Quick Start

1. **Clone the repository:**
   ```bash
   git clone https://github.com/pbelay/docker-lamp.git
   cd docker-lamp
   ```

2. **Copy environment variables:**
   ```bash
   cp .env.example .env
   ```

3. **Start the environment:**
   ```bash
   docker-compose up -d
   ```

4. **Access your application:**
   - **Web Server:** [http://localhost](http://localhost)
   - **phpMyAdmin:** [http://localhost:8080](http://localhost:8080)
   - **PHP Info:** [http://localhost/info.php](http://localhost/info.php)

## 📁 Project Structure

```
docker-lamp/
├── apache/                 # Apache configuration
│   ├── Dockerfile         # Apache + PHP container
│   ├── apache2.conf       # Main Apache config
│   └── sites-available/   # Virtual host configs
├── mysql/                 # MySQL configuration
│   └── init/              # Database initialization scripts
├── www/                   # Web application files
│   ├── index.php          # Sample homepage
│   └── info.php           # PHP information page
├── docker-compose.yml     # Docker Compose configuration
└── .env.example          # Environment variables template
```

## 🛠 Services

### Web Server (Apache + PHP)
- **Port:** 80
- **PHP Version:** 8.2
- **Extensions:** mysqli, pdo_mysql, gd, mbstring, xml, zip, opcache
- **Features:** mod_rewrite enabled, .htaccess support

### Database (MySQL)
- **Port:** 3306
- **Version:** MySQL 8.0
- **Default Database:** `lampdb`
- **Default User:** `lampuser` / `lamppass`
- **Root Password:** `rootpassword`

### phpMyAdmin
- **Port:** 8080
- **Purpose:** Database administration interface

## ⚙️ Configuration

### Environment Variables

Edit the `.env` file to customize your environment:

```env
# MySQL Database Configuration
MYSQL_ROOT_PASSWORD=rootpassword
MYSQL_DATABASE=lampdb
MYSQL_USER=lampuser
MYSQL_PASSWORD=lamppass

# Application Settings
APP_ENV=development
APP_DEBUG=true
```

### Adding Your Application

1. Place your PHP files in the `www/` directory
2. The `www/` directory is mounted to `/var/www/html` in the container
3. Your application will be accessible at [http://localhost](http://localhost)

### Database Connection

From within your PHP application, use these connection details:

```php
$host = 'db';           // Container name
$dbname = 'lampdb';     // Database name
$username = 'lampuser'; // Database user
$password = 'lamppass'; // Database password

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
```

## 🔧 Docker Commands

### Start the environment
```bash
docker-compose up -d
```

### Stop the environment
```bash
docker-compose down
```

### View logs
```bash
docker-compose logs
```

### Rebuild containers
```bash
docker-compose up -d --build
```

### Access container shell
```bash
# Web server container
docker-compose exec web bash

# Database container
docker-compose exec db mysql -u root -p
```

## 📊 Sample Database

The environment includes sample tables with test data:

- **users** table with sample user records
- **posts** table with sample blog posts

Access phpMyAdmin at [http://localhost:8080](http://localhost:8080) to explore the database.

## 🔒 Security Notes

This setup is intended for **development only**. For production use:

- Change all default passwords
- Use environment-specific configuration
- Enable SSL/HTTPS
- Implement proper security headers
- Use secrets management

## 📝 Development Tips

- Files in `www/` are automatically synced with the container
- No need to rebuild containers when changing PHP files
- Use `docker-compose restart web` to restart just the web server
- Database data persists in Docker volumes between restarts

## 🆘 Troubleshooting

### Port conflicts
If ports 80, 3306, or 8080 are already in use, modify `docker-compose.yml`:

```yaml
ports:
  - "8000:80"    # Use port 8000 instead of 80
  - "3307:3306"  # Use port 3307 instead of 3306
  - "8081:80"    # Use port 8081 for phpMyAdmin
```

### Permission issues
On Linux/macOS, you might need to fix file permissions:

```bash
sudo chown -R $USER:$USER www/
chmod -R 755 www/
```

### View container status
```bash
docker-compose ps
```

### Reset everything
```bash
docker-compose down -v  # Removes volumes (data will be lost!)
docker-compose up -d --build
```

## 📄 License

This project is open source and available under the [MIT License](LICENSE).
