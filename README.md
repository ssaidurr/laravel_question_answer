Installation

	1.Download the code by clicking Code, Download ZIP. Or if you have Git install in your machine, you can run this in your teminal.

	git clone https://github.com/ssaidurr/laravel_question_answer.git

	2.Change directory to your local copy of laravel-qa in your terminal. Then install composer dependencies.

	composer install

	3.Copy .env file from .env.example. In NIX machine you can use this command.

	cp .env.example .env

	4.Prepare a database. Create a new database in Mysql using question_answer name.

	5.Configure your database settings in .env

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=question_answer
	DB_USERNAME=root
	DB_PASSWORD=

	6.Migrate database tables and seed them with fake data

	php artisan migrate --seed

	7.Generate a key for you application

	php artisan key:generate

	8.Install frontend dependencies.

	npm install

	9.Run laravel mix

	npm run watch

Your local copy of question_answer is ready to access in your browser ;)