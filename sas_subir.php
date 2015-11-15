<?php

require './clases/AutoCarga.php';

$id_us = Request::post("id_us");
$array = FileUpload::uploadMulti($_FILES['imagen'], "../../imagenes", $id_us);

$i=0;
$j=false;
foreach ($array as $value) {
    if($value[0]==0){
        $i++;
        $j=true;
    }
    else{
        echo "Archivo no subido: (Error ".$value[0]." ".$value[1].")<br>";
    }
    
    if($j==true){
        echo "<h3>Se ha/n subido ".$i." archivos satisfactoriamente</h3>";
    }
}

echo $id_us;
for($cont=0; $cont>=count($array); $cont++)
{
    $trozos=  pathinfo($array[$cont]);
$extension = $trozos["extension"];
if($extension=="jpg"){
    header("content-type: image/jpeg");
}elseif($extension=="gif"){
    header("content-type: image/gif");
}elseif($extension=="png"){
    header("content-type: image/png");
}

}

$imagenes=new FiltrarLista();
        
        foreach($imagenes->getLista('imagenes') as $key=>$value){
            if($value!="." && $value!=".." && strpos($value, "jpg")>0 && strstr($imagenes->getNombre($value), $id_us)){      
           echo "<tr><td><img src='sas_subir.php?imagenes=".$imagenes->getNombre($value)."'/></td>";      
            }
                  
            
        }  