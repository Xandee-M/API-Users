# Api users

## Instalação:

Na raiz do projeto, abra o terminal e cole o comando: `composer install`

Após, configure seu arquivo .ENV com as credenciais do seu MYSQL (E crie seu banco de dados)

Execute a migrate do projeto: `php artisan migrate`

Execute a seeders do projeto(opcional): `php artisan db:seed`

Crie uma key para o seu projeto: `php artisan key:generate`

Inicie o servidor da sua aplicação: `php artisan serve`

> BASE_URL: http://127.0.0.1:8000/api/

> OBS: Necessário PHP +8.0

> Para facilitar o uso da API, foi disponibilizado um arquivo api_users.postman com todos os testes já salvos para uso dentro do POSTMAN.
> 
> ![image](https://repository-images.githubusercontent.com/605341851/d0976964-97a0-47e2-a44c-109a23238fe0)

## Exemplo de uso da aplicação


<h1 align="center">
Usuários
</h1>

### Listar todos os usuários
```
GET /api/listAll
```
#### Retorno
```
{
    "users": [
        {
            "id": 1,
            "name": "Otavio",
            "email": "2nqkSle44A@gmail.com",
            "password": "$2y$10$v0g8eqt0yaVp4gWkhnbh2uC7HrIjZNbJBNhuVP0mMvR6vLWTPZvpy",
            "created_at": null,
            "updated_at": "2023-02-23T00:04:52.000000Z"
        },
        {
            "id": 2,
            "name": "Alexandre Muniz",
            "email": "xandeeknd@gmail.com",
            "password": "$2y$10$VdzdGouxhat9E0Tf/UmkGO.X2fV69Vk4vpEpavmZNkw01hMppRi0W",
            "created_at": "2023-02-23T00:03:14.000000Z",
            "updated_at": "2023-02-23T00:03:14.000000Z"
        }
    ]
}
```

### Listar usuário por ID
```
POST /api/list
```
```
{
    "id": 1, 
}
```
#### Retorno
```
{
    "users": [
        {
            "id": 1,
            "name": "Otavio",
            "email": "2nqkSle44A@gmail.com",
            "password": "$2y$10$v0g8eqt0yaVp4gWkhnbh2uC7HrIjZNbJBNhuVP0mMvR6vLWTPZvpy",
            "created_at": null,
            "updated_at": "2023-02-23T00:04:52.000000Z"
        },
    ]
}
```


### Criar um usuário
```
POST /api/create
```
```
{
    "name": "Alexandre Muniz",
    "email": "xandeeknd@gmail.com",
    "password": "1234",
}
```



### Deletar um usuário
```
POST /api/delete
```
```
{
    "id": 1, 
}
```



### Atualizar um produto
```
POST /api/update
```
```
{
    "id": 1, 
    "name": "Pedro",
    "email": "",
    "password": "4321",
}
```
> OBS: Não é necessário todos os campos para atualização, apenas o ID é obrigatório.


