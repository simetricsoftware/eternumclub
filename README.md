# larablog

Larablog is a web platform that allows you to install a complete system for managing a blog.

[TOC]

## Characteristic

- Online registration of users.

- Management of roles and permissions.

- Forms with rich text.

- Voting system and I like you.

- Possibility of interacting through comments.

## Minimum requirements
The system is a platform that uses modern web technologies, so it requires the following requirements to work properly:

- PHP v7.2 or higher
- Nginx v1.19 or higher
- MySQL 8.0.12 or higher
- Docker v20.10 or higher (Optional if you want to run the available image)

Alternatively, a Dockerfile is included that allows you to build a Docker image to be launched from a container.

## Facility

### Local Installation

- Clone the repository

```sh
git clone git@gitlab.com:chrisalban/larablog.git
cd larablog
```

- Install dependencies

```shell
composer install
```

- Configure access to the database and mail client

- Configure the `.env` file, the project includes an example configuration file `.env.example` from which you can copy the basic configurations.

```shell
cp .env.example .env
```

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=larablog //Put the name of the database
DB_USERNAME=larablog_dev //Put the database username
DB_PASSWORD=larablog_dev //Set the database password
```

Optionally place the username and password of the email client

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io // Set the mail client server
MAIL_PORT=2525 // Set the port of the mail client
MAIL_USERNAME=null // Put the username of the mail client
MAIL_PASSWORD=null // Put the password of the mail client
MAIL_ENCRYPTION=null // Set the encryption type
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```
- Run the migrations and load the app with test data

```shell
php artisan migrate --seed
```

- Generate application key

```shell
php artisan key:generate
php artisan passport:install
```

**Note**: For the project to work correctly, you must configure a virtual host pointing to the `public` folder and add it to the host redirection file of the operating system, in case of using the Nginx web server you can use the configuration found inside the `docker/nginx/cond.d` folder, and modify the `app.conf` file.

```nginx
...
root /var/www/public # Change the path to the project path
...
fastcgi_pass larablog:9000 # Switch to php interpreter example 127.0.0.1:9000 or unix:/var/run/php/php7.4-fpm.sock
```

### Install from Docker image

To facilitate deployment and ensure proper application operation, a Docker image is available that contains all the necessary configurations and dependencies of the project.

- Clone the repository

```shell
git clone git@gitlab.com:chrisalban/larablog.git
cd larablog
```
- Copy the configuration files

```shell
cp docker-compose.example.yml docker-compose.yml
cp nginx.example.conf nginx.conf
```

- Run the `docker-compose.yml` configuration file using the `docker-compose` command.

```shell
docker-compose up -d
```

- The image will start to be built and all the containers will be executed, it must be entered inside the `larablog-php` container to execute the migration of the database.

```shell
docker exec -it larablog-php bash
```

- Install dependencies

```shell
composer install
```

**NOTE:** The database should not be configured, the default configuration should be left.

- Configure the `.env` file, the project includes an example configuration file `.env.example` which must be copied.

```shell
cp .env.example .env
```

- Optionally place the username and password of the email client

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io // Set the mail client server
MAIL_PORT=2525 // Set the port of the mail client
MAIL_USERNAME=null // Put the username of the mail client
MAIL_PASSWORD=null // Put the password of the mail client
MAIL_ENCRYPTION=null // Set the encryption type
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```
- Inside the container run the migration command.

```shell
php artisan migrate --seed
```

- Generate application key

```shell
php artisan key:generate
php artisan passport:install
```

- Configure the virtual host `/etc/hosts`, on the machine, not in the container
```shell
echo "192.168.0.242 larablog.test" | sudo tee -a /etc/hosts
```

### Default users

After running the migration with the `--seed` switch to feed the database with test data, you can login with the following credentials
cials.

- **Administrator**:

   Email: admin@admin.com

   Password: admin

- **Moderator**

   Email: moderator@moderator.com

   Password: moderator

- **Writer**

   Email: writer@writer.com

   Password: writer
  
- **Guest**

   Email: guest@guest.com

   Password: guest


## Captures

![Categories](screenshots/categories.png)

![Editor](screenshots/editor.png)

![Permissions](screenshots/permissions.png)

![Post](screenshots/post.png)

![Posts](screenshots/posts.png)

![Wellcome](screenshots/wellcome.png)