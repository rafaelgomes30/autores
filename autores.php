<?php

require_once("./toolsbag.php");
$salto=(ISSET($_REQUEST['salto'])) ? $_REQUEST['salto']:1;
iniciapagina(TRUE,"autores","Abertura");
montamenu('Autores','autores','Abertura',$salto);
printf(" <class='corpotxt'>");
   printf(" Nome: Rafael Gomes<br>");
   printf(" RA: 0210482023006<br>");
   printf(" <br>");
   printf(" Este sistema faz o gerenciamento de dados da tabela autores.<br>");
   printf(" O menu acima corresponde as funcionalidades do sistema.<br>");
   printf(" <br>");
   printf(" Em cada tela são apresentados os seguintes acessos:");
   printf(" <ul>");
   printf(" <li>Voltar: Volta uma tela na navegação das funcionalidades;</li>");
   printf(" <li>Abertura: Esta página;</li>");
   printf(" <li>Sair: Sai do sistema;</li>");
   printf(" <li>Limpar: Limpa os campos do formulário;</li>");
   printf(" <li>Ação: Completa uma funcionalidade escolhida;</li>");
   printf(" </ul>");
   printf(" </p>");

   printf("<button onclick='history.go(-$salto)'>Sair</button>");
terminapagina('Autores',"Abertura",'autores.php');
?>
