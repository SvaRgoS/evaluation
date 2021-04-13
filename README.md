# Laravel + Vue Evaluation Task: Contact List

# Setup
  - run ```composer install```
  - run ```./vendor/bin/sail up```
  - run ```./vendor/bin/sail migrate```
  - run ```./vendor/bin/sail db:seed```
---
- http://localhost/ - mainpage
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
