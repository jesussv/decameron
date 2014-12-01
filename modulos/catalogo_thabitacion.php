<?php
    if(isset($_POST['btnGuardar'])){
        $nombre = $_POST['txtNombreTipo'];
        $precio = $_POST['txtPrecio'];
        mysql_query("INSERT INTO TIPO_HABITACION(nombre_tipo, precio) VALUES('$nombre','$precio')",$ln);
    }else if(isset($_GET['elim'])){
        $id = $_GET['id'];
        mysql_query("DELETE FROM TIPO_HABITACION WHERE id_tipo_habitacion='$id'",$ln);
    }
?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1>
            Tipo habitaci&oacute;n
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i> <a href='?m=home'> Inicio</a>
            </li>
            <li>
                <i class="fa fa-wrench"></i> <a href='?m=cat'> Catalogos</a>
            </li>
            <li class="active">
                <i class="fa fa-building"></i> Tipo habitaci&oacute;n
            </li>
        </ol>
    </div>
</div>

<!-- contenido -->
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-6">
        <form role="form" id="manto_form" action="" method="POST">
            <div class="panel panel-primary">
                <!-- titulo del form -->
                <div class="panel-heading">
                    <i class="fa fa-plus"></i>
                    Nuevo tipo de habitaci&oacute;n
                </div>
                
                <!-- Body del form -->
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-7">
                            <label class="control-label" > Nombre tipo de Habitaci&oacute;n *</label><br/>
                            <input class="form-control" placeholder="" name="txtNombreTipo" id="txtNombreTipo" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label class="control-label" > Precio de Habitaci&oacute;n *</label><br/>
                            <input class="form-control" placeholder="$" name="txtPrecio" id="txtPrecio" >
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="panel-footer">
                    <button class="btn btn-primary" type="submit" id="btnGuardar" name="btnGuardar">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                    <a class="btn btn-default" href="?m=cat">
                        <i class="fa fa-reply"></i>
                        Cancelar
                    </a>
                    <button name="btnLimpiar" class="btn btn-default" type="reset">
                        <i class="fa fa-eraser"></i>
                        Limpiar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-3">
        <ul class="list-group">
            <li class="list-group-item"><b>Opciones</b></li>
            <li class="list-group-item"><a href="?m=cathab"><i class="fa fa-hospital-o"></i> Habitaciones</a></li>
            <li class="list-group-item"><a href="?m=thab"><i class="fa fa-hospital-o"></i> Tipo de habitaci&oacute;n</a></li>
            <li class="list-group-item"><a href="?m=edi"><i class="fa fa-hospital-o"></i> Edificio</a></li>
        </ul>
    </div>
</div>

    <!-- Formulario editar -->
<div id="divEditarForm" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tipo Habitaci&oacute;n</h4>
            </div>
            <form role="form" id="editar_form" action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="accion" id="accion" value="mdo">
                    <input type="hidden" name="idEdit" id="idEdit" value="">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="control-label" > Nombre Tipo de Habitaci&oacute;n *</label><br/>
                            <input class="form-control" placeholder="" name="txtNombreTipoEdit" id="txtNombreTipoEdit" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label class="control-label" > Precio *</label><br/>
                            <input class="form-control" placeholder="$" name="txtPrecioEdit" id="txtPrecioEdit" >
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" name="btnGuardarEdit" id="btnGuardarEdit">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-6">
    <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr role="row">
                <th>Nombre Tipo</th>
                <th>Precio</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $qr = mysql_query("SELECT id_tipo_habitacion, nombre_tipo, precio FROM TIPO_HABITACION ORDER BY nombre_tipo ASC", $ln);
            while($row=mysql_fetch_array($qr)){
                echo "<tr>";
                echo "<td>".$row['nombre_tipo']."</td>";
                echo "<td> $".$row['precio']."</td>";
                echo "<td style='width:50px'>";
                echo "<div class='input-group-btn'>";
                echo "<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>";
                echo "<i class='fa fa-gear'></i> <span class='caret'></span>";
                echo "</button>";
                echo "<ul class='dropdown-menu pull-right' role='menu'>";
               echo "<li><a href='#' onClick=\"abrirEditarForm('".$row['id_tipo_habitacion']."')\">Modificar</a></li>";
                echo "<li><a href='?m=thab&elim=1&id=".$row['id_tipo_habitacion']."'>Eliminar</a></li>";
                echo "</ul>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="col-lg-2"></div>
</div>

<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#table1').dataTable();
    $("#btnGuardarEdit").click(function(){ guardarEditarForm(); });

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z," "]+$/i.test(value);
        }, "Campo valido solo para letras");

    $("#manto_form").validate({
        rules:{
            txtNombreTipo: { required: true, maxlength: 100, minlength: 6, lettersonly:true },
            
            txtPrecio: { required: true, number: true, maxlength: 10 }
            
        }
    });
} );



function abrirEditarForm(id){
    var url = "api/thabitaciones.php";
    var data = "accion=get&id="+id;
    $.ajax({
        url:url,
        type:'POST',
        data:data,
        success:function(res){
            var obj = jQuery.parseJSON(res);
            if(obj.success){
                $("#txtNombreTipoEdit").val(obj.nombre);
                $("#txtPrecioEdit").val(obj.precio);
                $("#idEdit").val(id);
            }
        }
    });

    $("#divEditarForm").modal('show');

}
function guardarEditarForm(id){
 var url = "api/thabitaciones.php";
 var data = $("#editar_form").serialize();
    $.ajax({
        url:url,
        type:'POST',
        data:data,
        success:function(res){
            var obj = jQuery.parseJSON(res);
            if(obj.success){
                $("#lean_overlay").trigger("click");
                window.location.href='?m=thab';
            }
        }
    });
}
</script>





