# Documentação reddit-app

Utilizei o PHP/MySQL como linguagem para o desenvolvimento pois é a linguagem em que tenho maior fluidez atualmente e considerei que executaria a tarefa mais rapidamente por causa disso. Não utilizei nenhum framework específico pois optei pela construção mais simples possível do projeto.

Para testar a aplicação localmente recorri ao uso do XAMPP como suporte pra emular o servidor PHP.
O XAMPP oferece um console phpMyAdmin pra configurar o banco de dados MySQL. 

Criei um database chamado <b>reddit</b> pra incluir a tabela. Segue o comando MySQL correspondente: 
<pre><b>CREATE DATABASE api_example CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;</b></pre>

Criei a tabela <b>reddit.post</b>. Segue o comando MySQL correspondente: 
<pre><b>CREATE TABLE reddit.post (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    author_fullname VARCHAR(100) NOT NULL,
    ups INT NOT NULL,
    num_comments INT NOT NULL,
    created_utc INT NOT NULL
) ENGINE=INNODB;
</b></pre>


