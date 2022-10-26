<?php

require_once("./toolsbag.php");
require_once("./autoresfuncoes.php");
$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'];
$salto=$_REQUEST['salto']+1;
iniciapagina(TRUE,'autores','Consultar');
montamenu('Autores','autores','Consultar',$salto);
switch (TRUE)
{
  case ( $bloco==1 ):
  {
    picklist("Consultar",$salto);    
    break;
  }
  case ( $bloco==2 ):
  {     
    mostraregistro("$_REQUEST[idautor]");
    barrabotoes("",FALSE,TRUE,$salto);
    break;
  }
}

terminapagina('Autorias',"Consultar",'autoresconsultar.php');
?>