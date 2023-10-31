# mega-sena-analise
Aplicação simples para ajudar a observar estatisticamente os resultados da mega-sena e montar uma estratégia de jogo.  

![preview](https://github.com/JoaoHamerski/mega-sena-analise/assets/32890601/bd573a44-9d9a-4e5b-a1c3-c58cd20eb763)


## Atualize os jogos
Use o comando `php artisan mega-sena:update` para verificar se há novos jogos, e se houver, inseri-los no banco de dados.

## Set up
<details>
  <summary>
  Ver setup da aplicação  
  </summary>
  
  1. Clone o repositório  
  ```
  git clone git@github.com:JoaoHamerski/mega-sena-analise.git
  ```
  
  2. Baixe as dependencias do npm e composer
  ```
  composer install && npm ci
  ```
  
  3. Dentro do diretório, copie o arquivo `.env.example` renomeando para `.env`   
  ```
  cp .env.example .env
  ```
  
  4. Gere uma chave para a aplicação.
  ```
  php artisan key:generate
  ```
  
  5. Altere as variáveis do arquivo `.env` de acordo com as suas configurações locais para se conectar ao banco de dados.
  ```
  ...
  DB_DATABASE=mega_analyses
  DB_USERNAME=root
  DB_PASSWORD=
  ...
  ```
  
  6. Rode os migrations.
  ```
  php artisan migrate
  ```
  
  
  7. Atualize as entradas dos jogos com o seguinte comando:
  ```
  php artisan mega-sena:update
  ```
  
  8. Inicie o servidor npm e php.
  ```
  npm run dev
</details>
```
```
php artisan ser
```

9. Acesse a aplicação na porta especificada pelo comando `php artisan ser`, geralmente `localhost:8000`.
