# Documentação reddit-app

Utilizei o PHP/MySQL como linguagem para o desenvolvimento pois é a linguagem em que tenho maior fluidez atualmente. Normalmente usaria o framework Laravel (framework que mais utilizei no meu último emprego) para fazer um projeto, mas optando pela construção mais simples possível, não utilizei nenhum framework específico. Apesar da maior rapidez de desenvolvimento, senti falta de algumas features que o framework me ofereceria mais facilmente como o módulo de tarefas agendadas (cron) e obviamente uma estruturação mais clara dos arquivos e código.

Para testar a aplicação localmente recorri ao uso do XAMPP como suporte pra emular o servidor PHP.
O XAMPP oferece um console phpMyAdmin pra configurar o banco de dados MySQL. 

Criei um database chamado <b>reddit</b> pra incluir a tabela. Segue o comando MySQL correspondente: 
<pre>CREATE DATABASE api_example CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;</pre>

Criei a tabela <b>reddit.post</b>. Segue o comando MySQL correspondente: 
<pre>CREATE TABLE reddit.post (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    author_fullname VARCHAR(100) NOT NULL,
    ups INT NOT NULL,
    num_comments INT NOT NULL,
    created INT NOT NULL
) ENGINE=INNODB;
</pre>

Populei o banco de dados usando o método <b>curl</b> do PHP.

Para criar o REST defini dois endpoints segundo as especificações.

// return posts between dates by order
<pre>GET /post/{initial_date}/{final_date}/{order}</pre>

// return authors by order
<pre>GET /author/{order}</pre>


