<?php
function picklist($acao,$salto)
{ 
  $cmdsql="SELECT idautor, dtcadautor FROM autores ORDER BY idautor";
  global $con;
  $execsql=mysqli_query($con,$cmdsql);
  $prg=( $acao=="Consultar" ) ? 'autoresconsultar.php' : (( $acao=="Excluir" ) ? 'autoresexcluir.php' : 'autoresalterar.php') ; 
  printf("<form action='./$prg' method='POST'>\n");
   
  printf(" <input type='hidden' name='bloco' value='2'>\n");
  printf(" <select name='idautor'>\n");
  while ( $reg=mysqli_fetch_array($execsql) )
  {
    printf("  <option value='$reg[idautor]'>$reg[dtcadautor]-($reg[idautor]) </option>\n");
  }
  printf(" </select>\n");
  barrabotoes($acao,TRUE,FALSE,$salto);
  printf("</form>\n");
}
function mostraregistro($id)
{
  $cmdsql="SELECT * FROM autores WHERE idautor='$id'";
  global $con;
  $execsql=mysqli_query($con,$cmdsql);
  $reg=mysqli_fetch_array($execsql);
  printf("<table>\n");
  printf("<tr><td>Código tudo da Autores:</td>           <td>$reg[idautor]</td></tr>\n");
  printf("<tr><td>Código do Nome:</td>             <td>$reg[txnomeautor]</td></tr>\n");
  printf("<tr><td>Código do Autor:</td>    <td>$reg[logradouroid]</td></tr>\n");
  printf("<tr><td>Complemento:</td>            <td>$reg[txcomplemento]</td></tr>\n");
  printf("<tr><td>Cidigo bairro:</td>            <td>$reg[txbairro]</td></tr>\n");
  printf("<tr><td>Codigo cep:</td>            <td>$reg[nucep]</td></tr>\n");
  printf("<tr><td>Codigo numero telefone:</td>            <td>$reg[nutelefone]</td></tr>\n");
  printf("<tr><td>Codigo da data:</td>            <td>$reg[dtcadautor]</td></tr>\n");
   
  printf("</table>\n");
}
?>

 