<?php
require_once("./toolsbag.php");
require_once("./autoresfuncoes.php");
$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'];
$salto=$_REQUEST['salto']+1;
iniciapagina(TRUE,'autores','Excluir');
montamenu('Autores','autores','Excluir',$salto);
switch (TRUE)
{
  case ( $bloco==1 ):
  { 
    picklist('Excluir',$salto);
    break;
  }
  case ( $bloco==2 ):
  { 
    mostraregistro("$_REQUEST[cpautores]");
    printf("<form action='./autoresexcluir.php' method='POST'>\n");
    printf("<input type='hidden' name='bloco' value='3'>\n");
    printf("<input type='hidden' name='salto' value='$salto'>\n");
    printf("<input type='hidden' name='cpautores' value='$_REQUEST[cpautores]'>\n");
    /*printf("<button type='submit'>Confirmar Exclusão</button>\n");
    printf("<button type='button' onclick='history.go(-1);'>Voltar</button>\n");
    printf("<button type='button' onclick='history.go(-$menu);'>Abertura</button>\n");
    printf("<button type='button' onclick='history.go(-$salto);'>Sair</button>\n");*/
    barrabotoes('Confirmar Exclusão',FALSE,TRUE,$salto);
    printf("</form>\n");
    break;
  }
  case ( $bloco==3 ):
  { 
    printf("Tratatando a exclusão do registro $_REQUEST[cpautores]<br>\n");
    $cmdsql="DELETE FROM autores WHERE autores.cpautores='$_REQUEST[cpautores]'";
    $mostrar=FALSE;
    $tenta=TRUE;
    while ( $tenta )
    { 
      mysqli_query($con,"START TRANSACTION");
      mysqli_query($con,$cmdsql);
      if ( mysqli_errno($con)==0 )
      { 
        mysqli_query($con,"COMMIT");
        $tenta=FALSE;
        $mostrar=TRUE;
        $mens="Registro com código $_REQUEST[cpautores] excluído!";
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
	printf("$mens<br>");
    barrabotoes("",FALSE,FALSE,$salto);
    break;
  }
}
terminapagina('Autores',"Excluir",'autoresexcluir.php');

?>
