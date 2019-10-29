# Laravel Multi-Tenant 
Multi-Tenant is a Laravel package that can be used to create, migrate and seed different databases dynamiclly without having to change your app connection.

This is useful for web applications that stores data of each tenant in different database. 


## Installing
You can install the package via composer:
```
composer require mk-devs/multi-tenant
```
The package will register itself automatically.



## Usage
Installing the packege on your Laravel project will add MultiTenant class as well as helpful artisan commands.

#### Artisan Commands
1. `php artisan tenant:create database connection`
2. `php artisan tenant:migrate database connection --path`
3. `php artisan tenant:refresh database connection`
4. `php artisan tenant:rollback database connection`
5. `php artisan tenant:seed database connection --class`

#### Available Methods
1. `create` Create a new database `params: [database, connection]`
2. `migrate` Run migrate for specific database `params: [database, connection, path]`
3. `refresh` Reset and re-run all migrations `params: [database, connection]`
4. `rollback` Rollback the last database migration `params: [database, connection]`
5. `seed` Run seed for specific database `params: [database, connection, class]`
6. `set` Change app database connection in run time `params: [database, connection]`
 

#### Params
| Param         | Required  | Default               |
|------------   |---------- |--------------------   |
| database      | true      | null                  |
| connection    | false     | Current connection    |
| class         | false     | null                  |
| path          | false     | null                  |


#### Use Cases

```php
// Simple examples
MultiTenant::migrate('database_name');

MultiTenant::create('database_name')->migrate();

MultiTenant::seed([
    'database' => 'database_name',
    'connection' => 'mysql',
    'class' => 'CustomersTableSeed'
]);

MultiTenant::set([
    'database' => 'database_name',
    'connection' => 'mysql',
]);

// Advanced example
MultiTenant::migrate([
    'database' => 'database_name',
    'connection' => 'mysql',
    'path' => '/database/migrations/tenant'
])->seed(['class' => 'CustomersTableSeed'])->set();

```

## License
Multi-Tenant is open-sourced software licensed under the [MIT](https://choosealicense.com/licenses/mit/)
