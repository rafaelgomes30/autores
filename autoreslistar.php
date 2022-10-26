<?php
require_once("./toolsbag.php");
require_once("./autoresfuncoes.php");
$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'];
$menu=$_REQUEST['salto'];
$salto=$_REQUEST['salto']+1;
$cordefundo=($bloco<3) ? TRUE : FALSE;
iniciapagina($cordefundo,"Autores","autores","Listar");
switch (TRUE)
{
  case ( $bloco==1 ):
  {
    montamenu("Listar",$salto);
    printf(" <form action='./autoreslistar.php' method='post'>\n");
    printf("  <input type='hidden' name='bloco' value=2>\n");
    printf("  <input type='hidden' name='salto' value='$salto'>\n");
    printf("  <table>\n");
    printf("   <tr><td colspan=2>Escolha a <negrito>ordem</negrito> como os dados serão exibidos no relatório:</td></tr>\n");
    printf("   <tr><td>Código do Autor.:</td><td>(<input type='radio' name='ordem' value='D.idautor'>)</td></tr>\n");
    printf("   <tr><td>Nome.:</td><td>(<input type='radio' name='ordem' value='D.txnomeautor'>)</td></tr>\n");
    printf("   <tr><td>Nome...:</td><td>(<input type='radio' name='ordem' value='D.logradouroid' checked>)</td></tr>\n");
    printf("   <tr><td colspan=2>Escolha valores para seleção de <negrito>dados</negrito> do relatório:</td></tr>\n");
    printf("   <tr><td>Escolha uma area do autor:</td><td>");
    $cmdsql="SELECT idautor FROM autores ORDER BY idautor";
    $execcmd=mysqli_query($numconex,$cmdsql);
    printf("<select name='idautor'>");
    printf("<option value='TODAS'>Todas</option>");
    while ( $reg=mysqli_fetch_array($execsql) )
    {
      printf("<option value='$reg[idautor]'>$reg[idautor]</option>");
    }
    printf("<select>\n");
    printf("</td></tr>\n");
    
    printf("   <tr><td></td><td>");
    
    barrabotoes(TRUE,TRUE,TRUE,FALSE,"L");
    printf("</td></tr>\n");
    printf("  </table>\n");
    printf("</form>\n");
    break;
  }
  case ( $bloco==2 or $bloco==3 ):
  { 
    $selecao=( $_REQUEST['logradouroid']!='TODAS' ) ? $selecao." AND D.logradouroid='$_REQUEST[logradouroid]'" : $selecao ;
    $cmdsql="SELECT * FROM autores AS D".$selecao." ORDER BY $_REQUEST[ordem]";
    $execsql=mysqli_query($con,$cmdsql);
    ($bloco==2) ? montamenu("Listar","$salto") : "";
    printf("<table border=1 style=' border-collapse: collapse; '>\n");
    printf(" <tr><td valign=top rowspan=2>Código do autor:</td>\n");
    printf("     <td valign=top rowspan=2>Nome:</td>\n");
    printf("     <td valign=top rowspan=2>Complemento:</td>\n");
    printf("     <td valign=top rowspan=2>Bairro:</td>\n");
    printf("     <td valign=top rowspan=2>Cep:</td>\n");
    printf("     <td valign=top rowspan=2>Numero telefone:</td>\n");
    printf("     <td valign=top rowspan=2>Data:</td>\n");
	$corlinha="White";
    while ( $le=mysqli_fetch_array($execsql) )
    {
      printf("<tr bgcolor=$corlinha><td>$le[idautor]</td>\n");
      printf("   <td valign=top>$le[txnomeautor]</td>\n");
      printf("   <td valign=top>$le[logradouroid]</td>\n");
      printf("   <td valign=top>$le[txcomplemento]</td>\n");
      printf("   <td valign=top>$le[txbairro]</td>\n");
      printf("   <td valign=top>$le[nucep]</td>\n");
      printf("   <td valign=top>$le[nutelefone]</td>\n");
      printf("   <td valign=top>$le[dtcadautor]</td>\n");
     $corlinha=( $corlinha=="White" ) ? "Navajowhite" : "White";
    }
    printf("</table>\n");
    if ( $bloco==2 )
    {
      printf("<form action='./segurolistar.php' method='POST' target='_NEW'>\n");
      printf(" <input type='hidden' name='bloco' value=3>\n");
      printf(" <input type='hidden' name='salto' value='$salto'>\n");
      printf(" <input type='hidden' name='logradouroid' value=$_REQUEST[logradouroid]>\n");
      printf(" <input type='hidden' name='ordem' value=$_REQUEST[ordem]>\n");
      # <button type='submit'>Impressão</button>
      /*printf(" <button type='submit'>Gerar cópia para Impressão</button>\n");
      printf(" <button type='button' onclick='history.go(-1)'>Voltar</button>\n");
      printf(" <button type='button' onclick='history.go(-$menu)'>Abertura</button>\n");
      printf(" <button type='button' onclick='history.go(-$salto)'>Sair</button>\n");*/
      barrabotoes(TRUE,TRUE,TRUE,FALSE,"L");
      printf("</form>\n");
    }
    else
    {
      printf("<hr>\n<button type='submit' onclick='window.print();'>Imprimir</button> - Corte a folha na linha acima .\n");
    }
    break;
  }
}
terminapagina('Autores',"Listar",'autoreslistar.php');
?>
