# Laravel + Vue Evaluation Task: Contact List

# Setup
  - run ```composer install```
  - run ```./vendor/bin/sail up```
  - open another console and run ```./vendor/bin/sail artisan migrate --seed```
  - wait for the message "Starting Laravel development server: http://0.0.0.0:80
    " in the console
  - open  http://localhost/
  - Sign Up
  - Sign In
  - Check Application

---
- http://localhost/ - main page
- http://localhost:8025/ - MailHog


# Local Environment (Sail)
```bash
# start
./vendor/bin/sail up

# stop
./vendor/bin/sail down

# container console
./vendor/bin/sail shell

# container tinker
./vendor/bin/sail tinker

# artisan commands
./vendor/bin/sail artisan

```
More detail see at https://laravel.com/docs/8.x/sail


# Working with frontend

```bash
# run watcher
./vendor/bin/sail yarn watch

# build
./vendor/bin/sail yarn build

```


# Working with test

``` 
# run test
./vendor/bin/sail test 
```
