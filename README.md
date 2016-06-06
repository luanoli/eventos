# eventos

## Criar banco de dados (MySQL)

Utilizar o arquivo eventos.sql no diretório raiz da aplicação (/eventos) para gerar o banco

No arquivo database.php (/eventos/rest/libs/database.php), alterar as linhas abaixo para informar as credencias do banco:

```
  $dbuser = "root";
  $dbpass = "root";
```

## Instalação

No diretório raiz da aplicação (... /eventos), rodar o comando:

```
  bower install
```

No diretório de serviço da aplicação (... /eventos/rest), rodar o comando:

```
  composer install
```
