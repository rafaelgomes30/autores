<?php
require_once("./toolsbag.php");
require_once("./autoresfuncoes.php");

$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'];
$salto=$_REQUEST['salto']+1;
iniciapagina(TRUE,"autores","Incluir");
montamenu('Autores','autores','Incluir',$salto);
switch (TRUE)
{
  case ( $bloco==1 ):
  { 
    printf("  <form action='autoresincluir.php' method='POST'>\n");
    printf("  <input type='hidden' name='bloco' value='2'>\n");
    printf("  <input type='hidden' name='salto' value='$salto'>\n");
    printf("  <table>\n");
    printf("   <tr><td>Código tudo da autores:</td>         <td>O código tudo do autores será gerado pelo Sistema</td></tr>\n"); 
  	printf("   <tr><td>Código do Autor:</td>          <td><input type='text' name='idautor' placeholder='' size=8 maxlength=8></td></tr>\n");
    printf("   <tr><td>Nome:</td>          <td><input type='text' name='txnomeautor' placeholder='' size=8 maxlength=8></td></tr>\n");
    printf("  </table>\n");
    /*
    printf("  <button type='submit'>Incluir</button>\n");
    printf("  <button type='reset'>Limpar</button>\n");
    printf("  <button onclick='history.go(-$menu)'>Abertura</button>\n");
    printf("  <button onclick='history.go(-$salto)'>Sair</button>\n");
	*/
	barrabotoes("Incluir",TRUE,FALSE,$salto);
    printf("  </form>\n");

    break;
  }
  case ( $bloco==2 ):
  { 
    $mostrar=FALSE;
    $tenta=TRUE;
    while ( $tenta )
    { 
      mysqli_query($con,"START TRANSACTION");
	
      $ultimacp=mysqli_fetch_array(mysqli_query($con,"SELECT MAX(idautor)+1 AS CpMAX FROM autores"));
      $CP=$ultimacp['CpMAX'];
      # Construção do comando de atualização.
      $cmdsql="INSERT INTO autores (idautor,txnomeautor,logradouroid,txcomplemento,txbairro,nucep,nutelefone,dtcadautor)
                      VALUES ('$CP',       
                               
                              '$_REQUEST[txnomeautor]',
                              '$_REQUEST[logradouroid]',
							  '$_REQUEST[txcomplemento]',
                '$_REQUEST[txbairro]',
                '$_REQUEST[nucep]',
                '$_REQUEST[nutelefone]',
                '$_REQUEST[dtcadautor]')";

                         
     
      mysqli_query($con,$cmdsql);
      if ( mysqli_errno($con)==0 )
      { 
        mysqli_query($con,"COMMIT");
        $tenta=FALSE;
        $mostrar=TRUE;
        $mens="Registro incluído!";
      }
      else
      {
        if ( mysqli_errno($con)==1213 )
        { 
          $tenta=TRUE;
        }
        else
        { 
          $tenta=FALSE;
          $mens=mysqli_errno($con)."-".mysqli_error($con);
        }
        mysqli_query($con,"ROLLBACK");
        $mostrar=FALSE;
      }
    }
    printf("$mens<br>\n");
    if ( $mostrar )
    { 
      mostraregistro("$CP",);
	}
    /*printf("<button type='button' onclick='history.go(-1)'>Voltar</button>\n");
    printf("<button type='button' onclick='history.go(-$menu)'>Abertura</button>\n");
    printf("<button type='button' onclick='history.go(-$salto)'>Sair</button>\n");
    barrabotoes($acao,$limpa,$volta,$salto) */
    barrabotoes('',FALSE,TRUE,$salto);
    break;
  }
}
terminapagina('Autores',"Incluir",'autoresincluir.php');
?>