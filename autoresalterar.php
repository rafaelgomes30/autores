<?php

require_once("./toolsbag.php");
require_once("./autoresfuncoes.php");
$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'];
$salto=$_REQUEST['salto']+1;
iniciapagina(TRUE, 'autores','Alterar');
montamenu('Autores','autores','Alterar',$salto);
switch (TRUE)
{
  case ( $bloco==1 ):
  { 
    picklist("Alterar",$salto);
    break;
  }
  case ( $bloco==2 ):
  { 
    $reglido=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM autores WHERE idautor='$_REQUEST[idautor]'"));
    printf("<form action='autoresalterar.php' method='POST'>\n");
    printf(" <input type='hidden' name='bloco' value='3'>\n");
    printf(" <input type='hidden' name='salto' value='$salto'>\n");
    printf(" <input type='hidden' name='idautor' value='$_REQUEST[idautor]'>\n");
    printf("<table>\n");
    printf("<tr><td>Código tudo da autores:</td>           <td>$reg[idautor]</td></tr>\n");
    printf("<tr><td>Código do autor:</td>                  <td>$reg[txnomeautor]</td></tr>\n");
    printf("<tr><td>Nome:</td>                   <td>$reg[logradouroid]</td></tr>\n");
    printf("<tr><td>Complemento:</td>              <td>$reg[txcomplemento]</td></tr>\n");
    printf("<tr><td>Bairro:</td>              <td>$reg[txbairro]</td></tr>\n");
    printf("<tr><td>Cep:</td>              <td>$reg[nucep]</td></tr>\n");
    printf("<tr><td>Numero telefone:</td>              <td>$reg[nutelefone]</td></tr>\n");
    printf("<tr><td>Data:</td>              <td>$reg[dtcadautor]</td></tr>\n");
    printf("</table>\n");
 
 
  }
  case ( $bloco==3 ):
  { # CASE 3: Tratamento de Transação para Gravar os dados que foram alterados no form.
    printf("Tratatando a Alteração do registro $_REQUEST[idautor]<br>\n");
    # construção do comando de atualização.
    $cmdsql="UPDATE autorias
                    SET txnomeautor        = '$_REQUEST[txnomeautor]',
                        logradouroid        = '$_REQUEST[logradouroid]',
                        txcomplemento     = '$_REQUEST[txcomplemento]',
                        txbairro     = '$_REQUEST[txbairro]',
                        nucep     = '$_REQUEST[nucep]',
                        nutelefone     = '$_REQUEST[nutelefone]',
                        dtcadautor     = '$_REQUEST[dtcadautor]',
                        
                    WHERE
                        idautor='$_REQUEST[idautor]'";
    $mostrar=FALSE;
    $tenta=TRUE;
    while ( $tenta )
    { # laço de controle de exec da trans.
      mysqli_query($con,"START TRANSACTION");
      # execução do cmd.
      mysqli_query($con,$cmdsql);
      # tratamento dos erros de exec do cmd.
      if ( mysqli_errno($con)==0 )
      { # trans pode ser concluída e não reiniciar
        mysqli_query($con,"COMMIT");
        $tenta=FALSE;
        $mostrar=TRUE;
        $mens="Registro com código $_REQUEST[idautor] Alterado!";
      }
      else
      {
        if ( mysqli_errno($con)==1213 )
        { # abortar a trans e reiniciar
          $tenta=TRUE;
        }
        else
        { # abortar a trans e NÃO reiniciar
          $tenta=FALSE;
          $mens=mysqli_errno($con)."-".mysqli_error($con);
        }
        mysqli_query($con,"ROLLBACK");
        $mostrar=FALSE;
      }
    }
	printf("$mens<br>");
	( $mostrar ) ? mostraregistro($_REQUEST['idautor']) : "";
    /*printf(" <button onclick='history.go(-1)'>Voltar</button>\n");
    printf(" <button type='button' onclick='history.go(-$menu);'>Abertura</button>\n");
    printf(" <button type='button' onclick='history.go(-$salto);'>Sair</button>\n");*/
    barrabotoes('',FALSE,TRUE,$salto);
    break;
  }
}

terminapagina('Autores',"Alterar",'autoresalterar.php');
?>