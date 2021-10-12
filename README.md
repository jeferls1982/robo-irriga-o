Passo a passo para a instalação:

1 - clone o repositório
2 - Altere o arquivo ".env.example" para ".env"
3 - Crie um banco de dados mysql , postgres ou o de sua preferência com nome "horta"
4 - Altere o arquivo ".env" com seus dados

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=horta
	DB_USERNAME=seu_username
	DB_PASSWORD=seu_password
	
5 - Rode o comando "php artisan key:generate" para gerar sua chave unica do sistema
6 - Rode o comando "php artisan migration" para criar suas tabelas no banco
7 - Rode o comando "php artisan serve" para rodar o sistema

8 - Acesse o endereço: "http://127.0.0.1:8000" para acessar o sistema.

9- Pronto!