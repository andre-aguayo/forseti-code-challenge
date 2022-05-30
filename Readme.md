# Forseti

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <h3 align="center">Forseti</h3>

  <p align="center">
    Esta é uma API contruida utilizando o laravel para a realização do teste para a Forseti.
    <br />
    <a href="https://www.postman.com/iurruu/workspace/forseti/documentation/17815923-a068be89-b802-408c-9e08-602fb969de38"><strong>Documentação da api.</strong></a>
    <br />
  </p>
</div>

<!-- ABOUT THE PROJECT -->
## Sobre o projeto

Este é um projeto desenvolvido em laravel para a realização do teste para a Forseti. 

Escolhi o framework laravel pela fácil implementação e criação de API, não escolhi o lumen, pois, pensando na escalabilidade do projeto seria facil implementar uma interface gráfica, utilizando VUE, React ou mesmo o próprio blade e Javascript vanilla para listar as noticias. 


A API foi construída pensando em Services e Interfaces. 
Toda a documentação das classes de serviços está nas interfaces ficando apenas funções privadas documentadas na própria classe. 

<p align="right">(<a href="#top">back to top</a>)</p>


### Funcionalidades

Existe uma funcionalidade adicional, além da importação utilizando as rotas, também é possível importar as notícias utilizando o comando: 
* Importar
  ```sh
  php artisan command:import-news
  ```
Este comando importa todas as ultimas 5 páginas de notícias, porém, com a facilidade de implementação em um serviço como o CRON ou qualquer outro job no servidor para importação automatizada das notícias. 

### Prerequisitos

Comandos necessarios.

Instalar as dependências.
* composer
  ```sh
  composer install
  ```

Criar as tabelas.
* artisan
  ```sh
  php artisan migrate
  ```
  
  <p align="right">(<a href="#top">back to top</a>)</p>
