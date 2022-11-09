
![Logo](https://github.com/Asyraf-wa/recrud/blob/main/webroot/img/ReCRUD.jpg)


Re-CRUD enable the developer to create the fundamental web application functions, create, read, update and delete including the other features such as searching, reporting, audit trail and others. Re-CRUD is based on the CakePHP framework with integrated useful plugins.

## 🚀 Authors

- [@Asyraf Wahi Anuar](https://github.com/Asyraf-wa)


## License

[MIT](https://choosealicense.com/licenses/mit/)


## Framework and Plugin Acknowledgements

 - [CakePHP](https://cakephp.org)
 - [Bootstrap](https://getbootstrap.com)
 - [Sneat Template](https://themewagon.com/themes/free-responsive-bootstrap-5-html5-admin-template-sneat/)
 - [jQuery](https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js)
 - [Search Plugin](https://github.com/FriendsOfCake/search)
 - [Tools Plugin](https://github.com/dereuromark/cakephp-tools)
 - [Upload Plugin](https://github.com/FriendsOfCake/cakephp-upload)
 - [CakePDF Plugin](https://github.com/FriendsOfCake/CakePdf)
 - [CSVview Plugin](https://github.com/FriendsOfCake/cakephp-csvview)
 - [Authentication Plugin](https://github.com/cakephp/authentication)
 - [README Generator](https://readme.so/editor)

## Features

- [x] CRUD with [Sneat] Bootstrap 5 template
- [x] User management and profile
- [x] Search / Filter
- [x] QR Code for sharing
- [x] Audit Trail
- [x] FAQ
- [x] To Do list / task
- [x] Site Configuration
- [x] Contact us
- [ ] Light/dark mode toggle [coming soon]
- [ ] ReCrudZero [coming soon]
- [ ] Archived [coming soon]
- [x] Notification bar
- [x] Promotion Ribbon


## Screenshots

![App Screenshot](https://github.com/Asyraf-wa/recrud/blob/main/webroot/img/ss/ss_login.jpg)

![App Screenshot](https://github.com/Asyraf-wa/recrud/blob/main/webroot/img/ss/ss_profile.jpg)


## Roadmap

- Additional records management features
- More details reporting pages
- Add more integrations


## Contributing

Contributions are always welcome!

See `contributing.md` for ways to get started.

Please adhere to this project's `code of conduct`.


## Documentation

[Documentation](https://codethepixel.com) (Coming Soon)


## Installation

Clone Re-CRUD repo

```bash
  composer create-project recrud/recrud
```
or
```bash
  git clone https://github.com/Asyraf-wa/recrud.git
```

Run composer update

```bash
  composer update
```

## Configuration

Rename file `app_local_example.php` to  `app_local.php` in `config` folder

Create database in `phpmyadmin`

Configure database
```bash
    'Datasources' => [
        'default' => [
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'root',
            'password' => '',
            'database' => 'recrud',
            'url' => env('DATABASE_URL', null),
        ],
```

Database migration

```bash
  bin/cake migrations migrate
```

Database seeding

```bash
  bin/cake migrations seed
```
    
## 🛠 Requirements

PHP 8+

intl extension

Table should contain attribute: status(int) 1 with default value 1. This is used to tag active records as active(1), disabled(0) and archived(2). It also will be used for reporting charts.


## 🔗 Webserver Links

[![XAMPP](https://img.shields.io/badge/XAMPP-000?style=for-the-badge&logoColor=white)](https://www.apachefriends.org/download.html)
[![WAMP](https://img.shields.io/badge/WAMP-0A66C2?style=for-the-badge&logoColor=white)](https://www.wampserver.com/en/)
[![MAMP](https://img.shields.io/badge/MAMP-1DA1F2?style=for-the-badge&logoColor=white)](https://www.mamp.info/en/windows/)


## Usage/Examples

Generate CRUD with ReCrud features:

```php
bin/cake bake all tableName
```

Generate CRUD without ReCrud features:

```php
bin/cake bake all tableName --theme ReCrudZero
```


## Badges

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)


## Demo

Coming Soon

