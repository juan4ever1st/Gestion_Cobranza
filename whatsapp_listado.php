<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Whatsapp Web - Cobranzas</title>
	<link rel="stylesheet" href="estilo.css">
	<script>
			window.onload = function(){

				//---Función de realizar la búsqueda
				function searchInText( word, html ) {

				    //---Eliminar los spans
				    html = html.replace(/<span class="finded">(.*?)<\/span>/g, "$1");

				    //---Crear la expresión regular que buscará la palabra
				    var reg = new RegExp(word.replace(/[\[\]\(\)\{\}\.\-\?\*\+]/, "\\$&"), "gi");
				    var htmlreg = /<\/?(?:a|b|br|em|font|img|p|span|strong)[^>]*?\/?>/g;

				    //---Añadir los spans
				    var array;
				    var htmlarray;
				    var len = 0;
				    var sum = 0;
				    var pad = 28 + word.length;

				    while ((array = reg.exec(html)) != null) {

				    	htmlarray = htmlreg.exec(html);
				 
				    	//---Verificar si la búsqueda coincide con una etiqueta html
				        if(htmlarray != null && htmlarray.index < array.index && htmlarray.index + htmlarray[0].length > array.index + word.length){

			        		reg.lastIndex = htmlarray.index + htmlarray[0].length;

			        		continue;

			        	}

			        	len = array.index + word.length;

				        html = html.slice(0, array.index) + "<span class='finded'>" + html.slice(array.index, len) + "</span>" + html.slice(len, html.length);

				        reg.lastIndex += pad;

				        if(htmlarray != null) htmlreg.lastIndex = reg.lastIndex;
				        
				        sum++;

				    }

				    return {total: sum, html: html};

				}

				//---Al presionar el botón de buscar
				document.getElementById("button").addEventListener("click", function(){

					var search = document.getElementById("search").value;

					if(search.length == 0) return;

				    var props = searchInText( search, document.getElementById("content").innerHTML );
				    
				    document.getElementById("results").innerHTML = (props.total > 0) ? "Veces encontradas: " + props.total : "No se ha encontrado";
				    
				    if(props.total > 0) document.getElementById("content").innerHTML = props.html;

				});

			}
		</script>
</head>
<body style="background-color:#ccff00">

<header>
	  <section class="wrapper">
			<nav>
				<ul>
					<li><a href="#">Buscar Cliente</a></li>
					<li><a href="#"></a>
					
			<div class="controls">
				<input id="search" type="text" />
				<button id="button">Buscar</button>
				<span id="results"></span>
			</div>
					
					</li>
					<li><a href="#">Ingresar Celular</a></li>
					<li><a href="#"></a></li>
					<li><a href="#">Enviar Mensaje</a></li>
				</ul>
		    </nav>
	    </section>
	</header>

<section class="contenido wrapper">
<h1 align="center"><font face="Calibri" size="" color="#ff0000">RIBEIRO Cobranzas</font></h1>
<h2><font face="Calibri" size="" color="#33cc00">Whatsapp Web - Corte 04-09-19</font></h2>
<?php
require_once 'PHPExcel/Classes/PHPExcel.php';
$archivo = "Mora 31a60 4.9.19.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
?>

<table align="center" style="background-color:#66ff99" width="100%" border="1" cellpadding="1" cellspacing="0">
<tr>
	<td width="5%"></td>
	<td>
	
<table style="background-color:#66ff99" width="100%" border="1" cellpadding="1" cellspacing="0">
<tr align="center">
		<td><font face="Calibri"><strong>Num</strong></font></td>
        <td><font face="Calibri"><strong>Cliente</strong></font></td>
        <td><font face="Calibri"><strong>Nombre</strong></font></td>
        <td><font face="Calibri"><strong>Celular</strong></font></td>
        <td><font face="Calibri"><strong>Fecha_corte</strong></font></td>
        <td><font face="Calibri"><strong>Dias de Mora</strong></font></td>
        <td><font face="Calibri"><strong>Deuda Vencida</strong></font></td>
        <td><font face="Calibri"><strong>Deuda Total</strong></font></td>
		<td><font face="Calibri"><strong>Mensaje</strong></font></td>
		<td><font face="Calibri"><strong>Estado</strong></font></td>
    </tr>
<?php
for ($row = 2; $row <= $highestRow; $row++){
	echo '<tr><td align="center">'.($row-1).'</td>';
	echo '<td align="center">'.$sheet->getCell("C".$row)->getValue().'</td>';
	echo '<td>'.$sheet->getCell("D".$row)->getValue(). '</td>';
	echo '<td align="center">'.$sheet->getCell("F".$row)->getValue(). '</td>';
	echo '<td align="center">'.$sheet->getCell("G".$row)->getValue(). '</td>';
	echo '<td align="center">'.$sheet->getCell("H".$row)->getValue(). '</td>';
	echo '<td align="center">'.$sheet->getCell("I".$row)->getValue(). '</td>';
	echo '<td align="center">'.$sheet->getCell("J".$row)->getValue(). '</td>';


	if($sheet->getCell("O".$row)->getValue() == ''){
		echo ('<td align="center">'."-".'</td>');
		}else{
			echo ('<td align="center">'."<a href='".$sheet->getCell("O".$row)->getValue()."' target='_blank'>Enviar mensaje.</a>".'</td>');
		}

	echo '<td align="center">'.'<input type="checkbox" name="1" value="1">&nbsp;&nbsp;Trabajado?'.'</td>';
	'</tr>';
	}
?>
</table>
	
	</td>
	<td width="5%"</td>
</tr>
<td colspan=10 align="right"><br><br><font face="Calibri" color="#3300ff"><a href="https://api.whatsapp.com/send?phone=5493884294625&text=Hola Juan Carlos: " target="new_blank">by Olazo Juan</a></font></td>
</table>
<br><br>
</section>
</body>
</html>