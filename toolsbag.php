<?php

function iniciapagina($fundo,$tab,$acao)
{
  printf("<!DOCTYPE html>\n");
  printf("<html>\n");
  printf("<head>\n");
  printf("<title>$tab-$acao</title>\n");
  printf("<link rel='stylesheet' type='text/css' href='./toolsbag.css'>\n");
  printf("</head>\n");
  printf($fundo ? " <body class='$acao'>\n" : " <body>\n");
}
function terminapagina($tab,$acao,$arqprg)
{
  printf("<hr>\n");
  printf("$tab - $acao | &copy; 2022-06-14 - NGC+FATEC-4ºADS | $arqprg\n");
  printf("</body>\n");
  printf("</html>\n");
}
function montamenu($tab,$tabname,$acao,$salto)
{ 
  printf("<div class='$acao'>\n");
  printf(" <div class='menu'>\n");
  printf(" <form action='' method='POST'>\n");
  printf("  <input type='hidden' name='salto' value='$salto'>$tab:\n");
  printf("  <button class='ins' type='submit' formaction='./".$tabname."incluir.php'>Incluir</button>\n");
  printf("  <button class='con' type='submit' formaction='./".$tabname."consultar.php'>Consultar</button>\n");
  printf("  <button class='alt' type='submit' formaction='./".$tabname."alterar.php'>Alterar</button>\n");
  printf("  <button class='exc' type='submit' formaction='./".$tabname."excluir.php'>Excluir</button>\n");
  printf("  <button class='lst' type='submit' formaction='./".$tabname."listar.php'>Listar</button>\n");
  printf(" </form>\n");
  printf("</div>\n");
  printf("<red>$acao</red><hr>\n");
  printf("</div>\n<br><br><br>\n");
}
function conectadb($servidor,$usuario,$senha,$nomedabase)
{
  global $con;
  $con=mysqli_connect($servidor, $usuario, $senha, $nomedabase);
}
function barrabotoes($acao,$limpa,$volta,$salto)
{
  $menu=$salto-1;
  printf($acao!="" ? "  <button type='submit'>$acao</button>\n" : "");
  printf($limpa ? "  <button type='reset'>Limpar</button>\n" : "");
  printf($volta ? "  <button type='button' onclick='history.go(-1)'>Voltar</button>\n" : "");
  printf("  <button type='button' onclick='history.go(-$menu)'>Abertura</button>\n");
  printf("  <button type='button' onclick='history.go(-$salto)'>Sair</button>\n");
}

conectadb('localhost','root','','ilp54020221');



