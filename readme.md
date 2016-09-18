## Laravel API Boilerplate (JWT Edition)

Laravel API Boilerplate is a ready-to-use "starting pack" that you can use to build your first API in seconds. As you can easily imagine, it is built on top of the awesome Laravel Framework.

It also benefits from three pacakages:

* JWT-Auth - [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
* Dingo API - [dingo/api](https://github.com/dingo/api)
* Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)

With a similar foundation is really easy to get up and running in no time. I just made an "integration" work, adding here and there something that I found useful.

## Installation

```bash
$ composer create-project francescomalatesta/laravel-api-boilerplate-jwt
```

## Usage

I wrote a couple of articles on this project that explain how to write an entire sample application with this boilerplate. You can find it on Sitepoint:

* [How to Build an API-Only JWT-Powered Laravel App](https://www.sitepoint.com/how-to-build-an-api-only-jwt-powered-laravel-app/)
* [How to Consume Laravel API with AngularJS](https://www.sitepoint.com/how-to-consume-laravel-api-with-angularjs/)

## Main Features

### A Ready-To-Use AuthController

I've put an "AuthController" in _App\Api\V1\Controllers_. It supports the four basic authentication/password recovery operations:

* _login()_;
* _signup()_;
* _recovery()_;
* _reset()_;

In order to work with them, you just have to make a POST request with the required data.

You will need:

* _login_: just email and password;
* _signup_: whatever you like: you can specify it in the config file;
* _recovery_: just the user email address;
* _reset_: token, email, password and password confirmation;

### A Separate File for Routes

You can specify your routes in the `api_routes.php` file, that will be automatically loaded. In this file you will find many examples of routes.

### Secrets Generation

Every time you create a new project starting from this repository, the _php artisan jwt:generate_ command will be executed.

## Configuration

As I already told before, this boilerplate is based on _dingo/api_ and _tymondesigns/jwt-auth_ packages. So, you can find many informations about configuration <a href="https://github.com/tymondesigns/jwt-auth/wiki/Configuration" target="_blank">here</a> and <a href="https://github.com/dingo/api/wiki/Configuration">here</a>.

However, there are some extra options that I placed in a _config/boilerplate.php_ file.

* **signup_fields**: you can use this option to specify what fields you want to use to create your user;
* **signup_fields_rules**: you can use this option to specify the rules you want to use for the validator instance in the signup method;
* **signup_token_release**: if "true", an access token will be released from the signup endpoint if everything goes well. Otherwise, you will just get a _201 Created_ response;
* **reset_token_release**: if "true", an access token will be released from the signup endpoint if everything goes well. Otherwise, you will just get a _200_ response;
* **recovery_email_subject**: here you can specify the subject for your recovery data email;

## Creating Endpoints

You can create endpoints in the same way you could to with using the single _dingo/api_ package. You can <a href="https://github.com/dingo/api/wiki/Creating-API-Endpoints" target="_blank">read its documentation</a> for details.

After all, that's just a boilerplate! :)

## Cross Origin Resource Sharing

If you want to enable CORS for a specific route or routes group, you just have to use the _cors_ middleware on them.

Thanks to the _barryvdh/laravel-cors_ package, you can handle CORS easily. Just check <a href="https://github.com/barryvdh/laravel-cors" target="_blank">the docs at this page</a> for more info.

## Notes

I currently removed the _VerifyCsrfToken_ middleware from the _$middleware_ array in _app/Http/Kernel.php_ file. If you want to use it in your project, just use the route middleware _csrf_ you can find, in the same class, in the _$routeMiddleware_ array.

## Feedback

I currently made this project for personal purposes. I decided to share it here to help anyone with the same needs. If you have any feedback to improve it, feel free to make a suggestion, or open a PR!
# Laravel-jwt-api


============================ Selim ========================================
https://www.sitepoint.com/how-to-build-an-api-only-jwt-powered-laravel-app/
git clone https://github.com/francescomalatesta/laravel-api-boilerplate-jwt Laravel-Api
cd Laravel-Api
composer install
$ php artisan clear-compiled
$ php artisan optimize
$ cat .env|grep -i key
$ php artisan key:generate
$ cat .env|grep -i key
$ php artisan jwt:generate
$ cat config/jwt.php |egrep '=>'
$ cat config/boilerplate.php |egrep '=>'
$ php artisan migrate
$ php artisan serve

you will find the above few commands in the composer.json file

"scripts": {
        "post-root-package-install": [
            "php -r \"copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "php artisan key:generate"
        ],
        "post-install-cmd": [
            "Illuminate\\Foundation\\ComposerScripts::postInstall",
            "php artisan optimize",
            "php artisan key:generate",
            "php artisan jwt:generate"
        ],
        "post-update-cmd": [
            "Illuminate\\Foundation\\ComposerScripts::postUpdate",
            "php artisan optimize"
        ]
    },

Route information is in the App\Providers\RouteServiceProvider:
protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/api_routes.php');
            require app_path('Http/routes.php');
        });
    }
$ php artisan api:routes 
//this will provide bunch of api routes

http://localhost:8000/api/auth/signup
{"message":"405 Method Not Allowed","status_code":405}
//that is because we didn't provide required fields. in the config/boilerplate.php
signup_fields_rules' => [
    	'name' => 'required',
    	'email' => 'required|email|unique:users',
    	'password' => 'required|min:6'
    ]

$ pwd
/Users/mohammadselimmiah/Sites/Api/Laravel
curl -X POST -F 'name=davidwalsh' -F 'email=davidwalsh@test.com' -F 'password=something' http://localhost:8000/api/auth/signup
//passing form data name, email and password

$ curl -X POST -F 'name=davidwalsh' -F 'email=davidwalsh@test.com' -F 'password=something' http://localhost:8000/api/auth/signup
{"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL3NpZ251cCIsImlhdCI6MTQ3NDE2MzkwMywiZXhwIjoxNDc0MTY3NTAzLCJuYmYiOjE0NzQxNjM5MDMsImp0aSI6IjE2NDQ5YzExZTU5Yjc5NzBmZTg0MjI1NmY3ZDNkYzFjIn0.mp3n0MO5nXSD2_7XIvsp4fw0PtJu4njfTuPftV9MPRQ"}

curl -X POST -F 'email=davidwalsh@test.com' -F 'password=something' http://localhost:8000/api/auth/login
curl -X POST -F 'email=selimcse98@gmail.com' -F 'password=123456' http://localhost:8000/api/auth/login

$ curl -X POST -F 'email=davidwalsh@test.com' -F 'password=something' http://localhost:8000/api/auth/login
{"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDc0MTY0ODQyLCJleHAiOjE0NzQxNjg0NDIsIm5iZiI6MTQ3NDE2NDg0MiwianRpIjoiYmVjMjc2NDUxYjViYmZhYjVlOTU0ODYwZjgwMGYxM2YifQ.sNoh--wvdGH12DgTyCttmz4O2mh4_Sc-cF9uOiclfRI"}

$ php artisan make:migration create_books_table --create=books

Schema::create('books', function (Blueprint $table) {
        $table->increments('id');

		// adding specific fields here...
        $table->string('title');
        $table->string('author_name');
        $table->integer('pages_count');

        $table->integer('user_id')->index();

        $table->timestamps();
    });

php artisan migrate
======================== database ========================
$ mysql -u root -p
Enter password: root
mysql> show databases;
mysql> use jwtAPI;
mysql> show tables;
mysql> show create table books;
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pages_count` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

mysql> desc books;
+-------------+------------------+------+-----+---------+----------------+
| Field       | Type             | Null | Key | Default | Extra          |
+-------------+------------------+------+-----+---------+----------------+
| id          | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| title       | varchar(255)     | NO   |     | NULL    |                |
| author_name | varchar(255)     | NO   |     | NULL    |                |
| pages_count | int(11)          | NO   |     | NULL    |                |
| user_id     | int(11)          | NO   | MUL | NULL    |                |
| created_at  | timestamp        | YES  |     | NULL    |                |
| updated_at  | timestamp        | YES  |     | NULL    |                |
+-------------+------------------+------+-----+---------+----------------+
7 rows in set (0.01 sec)

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci 


$ php artisan make:model Book

Now, we have to edit our User model in order to define the relationship we will need to retrieve their related books. In app\User.php we add the following method:

public function books()
{
    return $this->hasMany('App\Book');
}

$ php artisan make:controller BookController

to create a new resource controller. Laravel will create it in the app/Http/Controllers folder. We will move it to app/Api/V1/Controllers.

We also change the namespace:

namespace App\Api\V1\Controllers;

http://localhost:8000/api/auth/book/store
{"message":"404 Not Found","status_code":404} //we have to fill the fillable data

curl -X POST -F 'title="My First Book"' -F 'author_name="Mohammad Miah"' -F 'pages_count=232' http://localhost:8000/api/book/store?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDc0MTY0ODQyLCJleHAiOjE0NzQxNjg0NDIsIm5iZiI6MTQ3NDE2NDg0MiwianRpIjoiYmVjMjc2NDUxYjViYmZhYjVlOTU0ODYwZjgwMGYxM2YifQ.sNoh--wvdGH12DgTyCttmz4O2mh4_Sc-cF9uOiclfRI

$ curl -X POST -F 'title="My First Book"' -F 'author_name="Mohammad Miah"' -F 'pages_count=232' http://localhost:8000/api/book/store?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDc0MTY0ODQyLCJleHAiOjE0NzQxNjg0NDIsIm5iZiI6MTQ3NDE2NDg0MiwianRpIjoiYmVjMjc2NDUxYjViYmZhYjVlOTU0ODYwZjgwMGYxM2YifQ.sNoh--wvdGH12DgTyCttmz4O2mh4_Sc-cF9uOiclfRI

Response:
{"message":"Undefined property: app\\Api\\V1\\Controllers\\BookController::$response","status_code":500}

$ curl -X POST -F 'title=Second_book' -F 'author_name=Mursaleen_Selim' -F 'pages_count=432' http://localhost:8000/api/book/store?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDc0MTg4MDA1LCJleHAiOjE0NzQxOTE2MDUsIm5iZiI6MTQ3NDE4ODAwNSwianRpIjoiMjFkZWIyZjZkZTI5ODBiMWM1YWRjNWM2MTgzOGZlNDEifQ.9A5kdzxIAZo27ZNjpkWyv7szq8zo8v_L45GI9LKfn_o

Response:
{"message":"Undefined property: app\\Api\\V1\\Controllers\\BookController::$response","status_code":500}

curl -X POST -F 'title=Third book' -F 'author_name=Nuzhat Selim' -F 'pages_count=532' http://localhost:8000/api/book/store?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDc0MTg4MDA1LCJleHAiOjE0NzQxOTE2MDUsIm5iZiI6MTQ3NDE4ODAwNSwianRpIjoiMjFkZWIyZjZkZTI5ODBiMWM1YWRjNWM2MTgzOGZlNDEifQ.9A5kdzxIAZo27ZNjpkWyv7szq8zo8v_L45GI9LKfn_o

curl --request GET http://localhost:8000/api/book?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDc0MTY0ODQyLCJleHAiOjE0NzQxNjg0NDIsIm5iZiI6MTQ3NDE2NDg0MiwianRpIjoiYmVjMjc2NDUxYjViYmZhYjVlOTU0ODYwZjgwMGYxM2YifQ.sNoh--wvdGH12DgTyCttmz4O2mh4_Sc-cF9uOiclfRI

$ curl --request GET http://localhost:8000/api/book?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDc0MTY0ODQyLCJleHAiOjE0NzQxNjg0NDIsIm5iZiI6MTQ3NDE2NDg0MiwianRpIjoiYmVjMjc2NDUxYjViYmZhYjVlOTU0ODYwZjgwMGYxM2YifQ.sNoh--wvdGH12DgTyCttmz4O2mh4_Sc-cF9uOiclfRI

Response:
[{"id":1,"title":"\"My First Book\"","author_name":"\"Mohammad Miah\"","pages_count":232,"user_id":2,"created_at":"2016-09-18 03:04:09","updated_at":"2016-09-18 03:04:09"}]

$ curl --request GET http://localhost:8000/api/book?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDc0MTY0ODQyLCJleHAiOjE0NzQxNjg0NDIsIm5iZiI6MTQ3NDE2NDg0MiwianRpIjoiYmVjMjc2NDUxYjViYmZhYjVlOTU0ODYwZjgwMGYxM2YifQ.sNoh--wvdGH12DgTyCttmz4O2mh4_Sc-cF9uOiclfRI

Response: 
{"message":"Token has expired","status_code":401}
//(App/Config/jwt.php we configured ttl => 60 that means token will expire after an hour, we can change the vale for one day 60*24)
//So, the user need to login again using username and password and a new token will be generated after valid login

$ php artisan api:routes

$ curl --request GET http://localhost:8000/api/protected?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDc0MTg4MDA1LCJleHAiOjE0NzQxOTE2MDUsIm5iZiI6MTQ3NDE4ODAwNSwianRpIjoiMjFkZWIyZjZkZTI5ODBiMWM1YWRjNWM2MTgzOGZlNDEifQ.9A5kdzxIAZo27ZNjpkWyv7szq8zo8v_L45GI9LKfn_o

Response:
{"users":[{"id":1,"name":"Mohammad Miah","email":"selimcse98@gmail.com","created_at":"2016-09-18 01:17:58","updated_at":"2016-09-18 01:17:58"},{"id":2,"name":"davidwalsh","email":"davidwalsh@test.com","created_at":"2016-09-18 01:58:22","updated_at":"2016-09-18 01:58:22"}]}

http://localhost:8000/api/free 
//this url is not protected so it will generate the same result when put it into browser
$api->get('free', function() {
		return \App\User::all();
	});

$ curl --request GET http://localhost:8000/api/book?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDc0MTkyNjE5LCJleHAiOjE0NzQxOTYyMTksIm5iZiI6MTQ3NDE5MjYxOSwianRpIjoiMWIwNDdkYWMxZWI4YTY3NzM4ZjAyZjhmOWM1YzJjY2YifQ.dOMW6AtpuVzXLmjY5FCVa_dBvLdta00J_j1i20V45HU

Response:
[]
//which is an empty json array indicating this user didn't store any books




============================= Github ================================

$ git remote -v
origin	https://github.com/francescomalatesta/laravel-api-boilerplate-jwt (fetch)
origin	https://github.com/francescomalatesta/laravel-api-boilerplate-jwt (push)
$ git remote ?
error: Unknown subcommand: ?
usage: git remote [-v | --verbose]
   or: git remote add [-t <branch>] [-m <master>] [-f] [--tags | --no-tags] [--mirror=<fetch|push>] <name> <url>
   or: git remote rename <old> <new>
   or: git remote remove <name>
   or: git remote set-head <name> (-a | --auto | -d | --delete | <branch>)
   or: git remote [-v | --verbose] show [-n] <name>
   or: git remote prune [-n | --dry-run] <name>
   or: git remote [-v | --verbose] update [-p | --prune] [(<group> | <remote>)...]
   or: git remote set-branches [--add] <name> <branch>...
   or: git remote get-url [--push] [--all] <name>
   or: git remote set-url [--push] <name> <newurl> [<oldurl>]
   or: git remote set-url --add <name> <newurl>
   or: git remote set-url --delete <name> <url>

    -v, --verbose         be verbose; must be placed before a subcommand

$ git remote remove origin

$ git remote add origin https://github.com/Selimcse98/Laravel-jwt-api.git

$ git remote -v
origin	https://github.com/Selimcse98/Laravel-jwt-api.git (fetch)
origin	https://github.com/Selimcse98/Laravel-jwt-api.git (push)

$ git status
$ git add .
$ git push -u origin master    

$ git add .env
The following paths are ignored by one of your .gitignore files:
.env
Use -f if you really want to add them.
Mohammads-MacBook-Air:Laravel mohammadselimmiah$ git add -f .env
Mohammads-MacBook-Air:Laravel mohammadselimmiah$ git status

=============================== .env start ===================================
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:ozkWG7EUCS7dnnurHqqHofK629rfLwiTpgN1lK0hJMI=


DB_HOST=localhost:8889
DB_DATABASE=jwtAPI
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=localhost
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=wahida.moon80@gmail.com
MAIL_PASSWORD=Nuzxxxxxx
MAIL_ENCRYPTION=tls


API_PREFIX=api
API_VERSION=v1
API_STRICT=false
API_DEBUG=false

API_SIGNUP_TOKEN_RELEASE=true
API_RESET_TOKEN_RELEASE=true
API_RECOVERY_EMAIL_SUBJECT=example@domain.com

=============================== .env end ===================================
===================== version of BookController.php =======================

<?php
namespace app\Api\V1\Controllers;
use Dingo\Api\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use JWTAuth;
use App\Book;
use Dingo\Api\Routing\Helpers as Helpers;
use App\Http\Controllers\Controller;
class BookController extends Controller
{
    public function index()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        return $currentUser
            ->books()
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
    }
    public function store(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $book = new Book;
        $book->title = $request->get('title');
        $book->author_name = $request->get('author_name');
        $book->pages_count = $request->get('pages_count');
        if($currentUser->books()->save($book))
            return $this->response->created();
        else
            return $this->response->error('could_not_create_book', 500);
    }
    public function show($id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $book = $currentUser->books()->find($id);
        if(!$book)
            throw new NotFoundHttpException;
        return $book;
    }
    public function update(Request $request, $id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $book = $currentUser->books()->find($id);
        if(!$book)
            throw new NotFoundHttpException;
        $book->fill($request->all());
        if($book->save())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_update_book', 500);
    }
    public function destroy($id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $book = $currentUser->books()->find($id);
        if(!$book)
            throw new NotFoundHttpException;
        if($book->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_delete_book', 500);
    }
}

====== final version ==================
<?php
namespace App\Api\V1\Controllers;
use JWTAuth;
use App\Book;
use App\Http\Requests;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class BookController extends Controller
{
    use Helpers;
    public function index()
    {
        return $this->currentUser()
            ->books()
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
    }
    public function show($id)
    {
        $book = $this->currentUser()->books()->find($id);
        if(!$book)
            throw new NotFoundHttpException;
        return $book;
    }
    public function store(Request $request)
    {
        $book = new Book;
        $book->title = $request->get('title');
        $book->author_name = $request->get('author_name');
        $book->pages_count = $request->get('pages_count');
        if($this->currentUser()->books()->save($book))
            return $this->response->created();
        else
            return $this->response->error('could_not_create_book', 500);
    }
    public function update(Request $request, $id)
    {
        $book = $this->currentUser()->books()->find($id);
        if(!$book)
            throw new NotFoundHttpException;
        $book->fill($request->all());
        if($book->save())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_update_book', 500);
    }
    public function destroy($id)
    {
        $book = $this->currentUser()->books()->find($id);
        if(!$book)
            throw new NotFoundHttpException;
        if($book->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_delete_book', 500);
    }
    private function currentUser() {
        return JWTAuth::parseToken()->authenticate();
    }
}

