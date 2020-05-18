<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">Catalogo de Produtos - Adição/Edição via Planilha</p>

<p>Foi desenvolvida uma API RESTful em Laravel para gerenciar um catálogo de produtos.<p>


Para executar a aplicação, além do comando "php artisan serve" é preciso deixar uma fila "escutando" as requisições a serem executadas:

    $ php artisan queue:listen
    
Ou então, para uma melhor performance da aplicação, outro comando pode ser usado para esta tarefa seria:

    $ php artisan queue:work connection --daemon


<h2>Funcionamento da Aplicação</h2>


A adição/edição de produtos só pode ser feita via planilha Excel (extensão xlsx), que será enviada através do endpoint abaixo:

  - |POST| http://127.0.0.1:8000/api/importar

<p>Possíveis retornos:</p>
<p>Sucesso:</p>

    {
        "data": {
            "tracking_code": "1589814050",
            "msg": "O arquivo foi importado com sucesso!"
        }
    }  
  
É possível também recuperar todos os produtos cadastrados ou recuperar um produto específico, passando seu id como parâmetro.
Além de ser possível deletar um produto. Segue abaixo, os respectivos endpoints:

   - |GET| http://127.0.0.1:8000/api/produtos

<p>Possíveis retornos:</p>

    {
        "data": [
            {
                "id": 1,
                "nome": "",
                "quantidade": 1,
                "created_at": "Y-M-d H:i:s",
                "updated_at": ""
            },
            {
                "id": 2,
                "nome": "",
                "quantidade": 1,
                "created_at": "Y-M-d H:i:s",
                "updated_at": "Y-M-d H:i:s"
            },
            ...
        ]
    }
       
   - |GET| http://127.0.0.1:8000/api/produtos/{id}

<p>Possíveis retornos:</p>
<p>Sucesso:</p>

    {
        "data": {
            "id": 1,
            "nome": "",
            "quantidade": 1,
            "created_at": "Y-M-d H:i:s",
            "updated_at": "Y-M-d H:i:s"
        }
    }
    
<p>Produto não encontrado:</p>

    {
        "data": {
            "msg": "Produto não encontrado!"
        }
    }    
       
   - |DELETE| http://127.0.0.1:8000/api/produtos/{id}
   
<p>Sucesso:</p>

    {
        "data": {
            "msg": "Produto deletado com sucesso!"
        }
    }   
   
   
Os produtos adicionados/editados via planilha entrarão em um fila de processamento, para então efetuar o registro destes produtos no banco de dados.
Para conferir se o procesamento ocorreu com sucesso ou houve algum problema, basta fazer uma requisição ao endpoint abaixo, passando o atributo 'tracking_code', que é retornado no endpoint de importar a planilha (http://127.0.0.1:8000/api/importar):

   - |GET| http://127.0.0.1:8000/api/processamento/{tracking_code}
   
<p>Possíveis retornos:</p>
<p>Sucesso:</p>

    {
        "data": {
            "msg": "A planilha foi processada com sucesso!"
        }
    }
    
<p>Erro:</p>

    {
        "data": {
            "msg": "Houve um erro ao processsar a planilha!"
        }
    }
    
<p>Em processamento:</p>

    {
        "data": {
            "msg": "Planilha na fila para processamento!"
        }
    }        
               
