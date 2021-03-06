<!doctype html> 
<html>
<head>
<meta charset="utf-8">
<title>Reserva</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!---- Bootstrap---->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="js/validaciones.js"></script>

</head>
<body>
<br/>

<div class="container">
  <div class="row">
  <br/> <br/> <br/> 

    <?php 
include("includes/conexion.php");
$from = $_POST['from'];
$to = $_POST['to'];
$n_habitaciones = $_POST['n_habitaciones'];
$t_hab = $_POST['t_hab'];


$sq1 = "SELECT COUNT(id_reserva_habitacion) FROM RESERVA_HABITACION WHERE fecha_inicio >= $from AND fecha_fin <= $to AND fk_id_tipo_habitacion=$t_hab";
$sq2 = "SELECT COUNT(id_habitacion) FROM HABITACION WHERE fk_id_tipo_habitacion =$t_hab AND estado_habitacion='d'";

$qr1=mysql_query($sq1,$ln);
$row_reserva=mysql_fetch_array($qr1);
$resultado_reserva=$row_reserva[0];

$qr2=mysql_query($sq2,$ln);
$row_habitacion=mysql_fetch_array($qr2);
$resultado_habitacion=$row_habitacion[0];
/*
echo "$resultado_reserva";
echo "$resultado_habitacion";
echo "$sq1";
echo "$sq2";
*/
if($resultado_reserva>=$resultado_habitacion){
  echo "No tenemos habitaciones disponibles para las fechas seleccionadas. Favor de escoger otras fechas";
} else {
  echo "Si tenemos habitaciones disponibles para las fechas seleccionadas.";
}
?> 
</div>
</div>

<div class="container">
  <div class="row"> 
    <nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <?php include('includes/nav.php');?>
    </nav>

    <!-- **********************************FORMULARIO********************************************* -->  
    <form id="reserva" name="reserva" action="insert_reserva.php" method="post">
<br/><br/>
     <table class="table table-striped table-bordered" cellspacing="1" >
        <thead>
          <tr class="info">
            <th>Entrada :</th>
            <th>Salida :</th>
            <th>Tipo de habitacion :</th>
            <th>Cama extra :</th>
            <th>Tipo de balcon :</th>
            <th># huespedes :</th>
            <th>PRECIO TOTAL :</th>
          </tr>
      </thead>
      <tbody>
        <tr>
          <td ><input id="entrada" type="text" readonly style="width:100px"></td>
          <td ><input id="salida" type="text" readonly style="width:100px"></td>
          <td ><input id="hab" type="text" readonly style="width:100px"></td>
          <td ><input id="c_extra" type="text" readonly style="width:100px"></td>
          <td ><input id="tbal" type="text" readonly style="width:100px"></td>
          <td ><input id="thues" name="thues" type="text" readonly style="width:100px"></td>
          <td><input id="preciototal" name="preciototal" type="text" readonly style="width:100px"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div> 


<div class="container">
 <div class="row">               
 <!-- ***************************************************FORMULARIO********************************************* -->  
          <h4>1. Fechas de reserva</h4>
           <input type="submit" id="con1" value="Ver condiciones"/> 
           <br/><br/>

		       <label class ="control-label">Fecha de entrada :</label><br/>
            <input id="from1" name="from1" type="datepicker" value="<?php echo date('d/m/y'); ?>" readonly>
            <br/><br/>
            <label class ="control-label">Fecha de salida :</label><br/>
            <input id="to1" name="to1" type="datepicker" value="<?php echo date('d/m/y'); ?>" readonly>
            <br/><br/>
            <h4>2. Detalles de habitacion</h4>
            <input type="submit" id="con2" value="Ver condiciones"/> 
            <br/><br/>

	          <label class ="control-label">Tipo de habitacion :</label><br/>
		        <select id="t_hab" name="t_hab" style="height:30px" required=""/>
            <option value="">Elejir...</option>
            <option value="sencilla">Sencilla (1 cama king)</option>
            <option value="doble">Doble (2 camas dobles)</option>
            </select>
            <br/><br/>

	         <label class ="control-label">Deseas adicionar una cama/cuna extra? :</label><br/>
		        <select id="n_cama" name="c_extra" style="height:30px">
            <option value="">Ninguna...</option>
		        <option value="cama">Una cama adicional</option>
            <option value="cuna">Una cuna adicional</option>
            </select>
            <br/><br/>

           <label class ="control-label">Tipo de balcon :</label><br/>
		        <select id="t_balcon" name="t_balcon" style="height:30px" required=""/>
            <option value="">Elejir...</option>
            <option value="1">Vista a la piscina</option>
            <option value="2">Vista al jardin</option>
            </select>
            <br/><br/>

          <h4>3. Detalle de Huespedes</h4>
          <input type="button" id="con3" value="Ver condiciones"/> 
          </script><br/><br/>

    <!-- ACOMPANANTES -->
    <script type="text/javascript" language="JavaScript">
    function toggleFields() {

    var i = $("#acomp").val();
  
    switch (i) {

  case "1":
  $("#reg1Acomp").show();
  $("#reg2Acomp").hide();
  $("#reg3Acomp").hide();
  $("#reg4Acomp").hide();
  $( "input[name='nom_acom_2']" ).val( "firstname" );
  $( "input[name='ape_acom_2']" ).val( "firstname" );
  $( "input[name='edad_acom_2']" ).val( "1" );
  $( "input[name='nom_acom_3']" ).val( "firstname" );
  $( "input[name='ape_acom_3']" ).val( "firstname" );
  $( "input[name='edad_acom_3']" ).val( "2" );
  $( "input[name='nom_acom_4']" ).val( "firstname" );
  $( "input[name='ape_acom_4']" ).val( "firstname" );
  $( "input[name='edad_acom_4']" ).val( "2" );
  break;

  case "2":
  $("#reg2Acomp").show();
  $("#reg1Acomp").show();
  $("#reg3Acomp").hide();
  $("#reg4Acomp").hide();
  $( "input[name='nom_acom_3']" ).val( "firstname" );
  $( "input[name='ape_acom_3']" ).val( "firstname" );
  $( "input[name='edad_acom_3']" ).val( "1" );
  $( "input[name='nom_acom_4']" ).val( "firstname" );
  $( "input[name='ape_acom_4']" ).val( "firstname" );
  $( "input[name='edad_acom_4']" ).val( "1" );
  break;

  case "3":
  $("#reg3Acomp").show();
  $("#reg1Acomp").show();
  $("#reg2Acomp").show();
  $("#reg4Acomp").hide();
  $( "input[name='nom_acom_4']" ).val( "firstname" );
  $( "input[name='ape_acom_4']" ).val( "firstname" );
  $( "input[name='edad_acom_4']" ).val( "1" );
  break;

  case "4":
  $("#reg4Acomp").show();
  $("#reg1Acomp").show();
  $("#reg2Acomp").show();
  $("#reg3Acomp").show();
  break;

  default:
  $("#reg1Acomp").hide();
  $("#reg2Acomp").hide();
  $("#reg3Acomp").hide();
  $("#reg3Acomp").hide();

  }
}
</script>
<!-- ****************************************************************************************************-->

      <label class ="control-label">Huespedes a registar en habitacion :</label><br/>
	    <select id="acomp" name="n_acomp" style="height:30px" onchange="totalreserva()" required=""/>
      <option value="">Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      </select><br/><br/>
      
    <div id="reg1Acomp" style="display: none">
      <h4> Datos huesped 1 :</h4>
      <label class ="control-label">Nombres :</label><br/>
      <input type="text" name="nom_acom_1" class="input_letras" maxlength="30" placeholder="Nombres" required=""/>
      <br/><br/>
      <label class ="control-label">Apellidos :</label><br/>
      <input type="text" name="ape_acom_1" class="input_letras" maxlength="30" placeholder="Apellidos" required=""/>
      <br/><br/>
      <label class ="control-label">Genero :</label><br/>
      <input type="radio" name="genero1" value="Hombre" checked="checked">Hombre
      <input type="radio" name="genero1" value="Mujer">Mujer
      <br/><br/>

      <label class ="control-label">Tipo de documento :</label><br/>
      <select name="cmbTipoDocumento1" id="cmbTipoDocumento" style="height:30px">
          <option value=""> Seleccione una opci&oacute;n</option>
          <?php
              $qr = mysql_query("SELECT id_tipo_documento, tipo_documento FROM TIPO_DOCUMENTO ORDER BY tipo_documento ASC",$ln);
              while($row = mysql_fetch_array($qr)){
                  echo "<option value='".$row['id_tipo_documento']."'>".$row['tipo_documento']."</option>";
              }
          ?>
      </select>
      <br/><br/>
      <label class ="control-label"># de documento :</label><br/>
      <input type="text" name="num_documento_acomp_1" class="input_alphanum" maxlength="10" placeholder="# de documento">
       <br/><br/>
      <label class ="control-label">Edad :</label><br/>
      <select id="edad_acom_1" name="edad_acom_1" style="height:30px" onchange="totalreserva()">
            <option value="">Elejir...</option>
            <option value="1">Niño/a de 3 a 11 años</option>
            <option value="2">Adulto</option>
      </select>
    </div>

    <div id="reg2Acomp" style="display: none">
      <h4> Datos huesped 2 :</h4>
      <label class ="control-label">Nombres :</label><br/>
      <input type="text" name="nom_acom_2" class="input_letras" maxlength="30" placeholder="Nombre" required=""/>
      <br/><br/>
      <label class ="control-label">Apellidos :</label><br/>
      <input type="text" name="ape_acom_2" class="input_letras" maxlength="30" placeholder="Apellidos" required=""/>
      <br/><br/>
      <label class ="control-label">Genero :</label><br/>
      <input type="radio" name="genero2" value="Hombre" checked="checked">Hombre
      <input type="radio" name="genero2" value="Mujer">Mujer
      <br/><br/>
      <label class ="control-label">Tipo de documento :</label><br/>
      <select name="cmbTipoDocumento2" id="cmbTipoDocumento" style="height:30px">
          <option value=""> Seleccione una opci&oacute;n</option>
          <?php
              $qr = mysql_query("SELECT id_tipo_documento, tipo_documento FROM TIPO_DOCUMENTO ORDER BY tipo_documento ASC",$ln);
              while($row = mysql_fetch_array($qr)){
                  echo "<option value='".$row['id_tipo_documento']."'>".$row['tipo_documento']."</option>";
              }
          ?>
      </select>
      <br/><br/>
      <label class ="control-label"># de documento :</label><br/>
      <input type="text" name="num_documento_acomp_2" class="input_alphanum" maxlength="10" placeholder="# de documento">
       <br/><br/>
      <label class ="control-label">Rango de edad :</label><br/>
      <select id="edad_acom_2" name="edad_acom_2" style="height:30px" onchange="totalreserva()">
            <option value="">Elejir...</option>
            <option value="1">Niño/a de 3 a 11 años</option>
            <option value="2">Adulto</option>
      </select>
    </div>

    <div id="reg3Acomp" style="display: none">
      <h4> Datos huesped 3 :</h4>
      <label class ="control-label">Nombres :</label><br/>
      <input type="text" name="nom_acom_3" class="input_letras" maxlength="30" placeholder="Nombre" required=""/>
      <br/><br/>
      <label class ="control-label">Apellidos :</label><br/>
      <input type="text" name="ape_acom_3" class="input_letras" maxlength="30" placeholder="Apellidos" required=""/>
      <br/><br/>
      <label class ="control-label">Genero :</label><br/>
      <input type="radio" name="genero3" value="Hombre" checked="checked">Hombre
      <input type="radio" name="genero3" value="Mujer">Mujer
      <br/><br/>
      <label class ="control-label">Tipo de documento :</label><br/>
      <select name="cmbTipoDocumento3" id="cmbTipoDocumento" style="height:30px">
          <option value=""> Seleccione una opci&oacute;n</option>
          <?php
              $qr = mysql_query("SELECT id_tipo_documento, tipo_documento FROM TIPO_DOCUMENTO ORDER BY tipo_documento ASC",$ln);
              while($row = mysql_fetch_array($qr)){
                  echo "<option value='".$row['id_tipo_documento']."'>".$row['tipo_documento']."</option>";
              }
          ?>
      </select>
      <br/><br/>
      <label class ="control-label"># de documento :</label><br/>
      <input type="text" name="num_documento_acomp_3" class="input_alphanum" maxlength="10" placeholder="# de documento">
       <br/><br/>
      <label class ="control-label">Rango de edad :</label><br/>
      <select id="edad_acom_3" name="edad_acom_3" style="height:30px" onchange="totalreserva()">
            <option value="">Elejir...</option>
            <option value="1">Niño/a de 3 a 11 años</option>
            <option value="2">Adulto</option>
      </select>
    </div>
  
<div id="reg4Acomp" style="display: none">
      <h4> Datos huesped 4 :</h4>
      <label class ="control-label">Nombres :</label><br/>
      <input type="text" name="nom_acom_4" class="input_letras" maxlength="30" placeholder="Nombre" required=""/>
      <br/><br/>
      <label class ="control-label">Apellidos :</label><br/>
      <input type="text" name="ape_acom_4" class="input_letras" maxlength="30" placeholder="Apellidos" required=""/>
      <br/><br/>
      <label class ="control-label">Genero :</label><br/>
      <input type="radio" name="genero4" value="Hombre" checked="checked">Hombre
      <input type="radio" name="genero4" value="Mujer">Mujer
      <br/><br/>
      <label class ="control-label">Tipo de documento :</label><br/>
      <select name="cmbTipoDocumento4" id="cmbTipoDocumento" style="height:30px">
          <option value=""> Seleccione una opci&oacute;n</option>
          <?php
              $qr = mysql_query("SELECT id_tipo_documento, tipo_documento FROM TIPO_DOCUMENTO ORDER BY tipo_documento ASC",$ln);
              while($row = mysql_fetch_array($qr)){
                  echo "<option value='".$row['id_tipo_documento']."'>".$row['tipo_documento']."</option>";
              }
          ?>
      </select>
      <br/><br/>
      <label class ="control-label"># de documento :</label><br/>
      <input type="text" name="num_documento_acomp_4" class="input_alphanum" maxlength="10" placeholder="# de documento">
       <br/><br/>
      <label class ="control-label">Rango de edad :</label><br/>
      <select id="edad_acom_4" name="edad_acom_4" style="height:30px" onchange="totalreserva()">
            <option value="">Elejir...</option>
            <option value="1">Niño/a de 3 a 11 años</option>
            <option value="2">Adulto</option>
      </select>
    </div>
<br/>
<input type="submit" value="Realizar reservacion" style="font-face: 'Comic Sans MS'; font-size: larger; color: white; background-color: #289510; border: 5pt ridge lightgrey">
<br/><br/>
</form>
    </div> 
 <!-- **********************************FORMULARIO********************************************* -->  
 
     </div>
<!-- jQuery Version 1.11.1 -->
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/validaciones.js"></script>
<!-- jQuery Version 1.11.1 -->

</body>
</html>
