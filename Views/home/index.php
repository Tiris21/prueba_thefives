<div class="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Home</li>
      </ol>

      <div class="row mb-3">
        <div class="col-9">
          <h1> <i class="fa fa-fw fa-list-alt"></i> Productos</h1>
        </div> 
        <div class="col-3 text-right">
          <a class="btn btn-outline-info" data-toggle="modal" role="button" aria-pressed="true" href="#" data-target="#agregarModal"> 
            <i class="fa fa-fw fa-plus"></i> Agregar Producto </a>
        </div>
      </div>

      <div class="row">      

      </div> <!-- row -->

      <div class="row">
        <div class="col-xl-12 col-sm-12 mb-3">
          <div class="table-responsive tablero">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Categoría</th>
                  <th>Precio de Venta</th>
                  <th>Precio de Compra</th>
                  <th>Cantidad</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              
              <tbody>

                <?php setlocale(LC_TIME,"es_MX");
                  foreach ($losproductos as $pro) {
                    $c = 'df';
                ?>
                  <tr>
                    <td> <?= $pro['nombre'] ?> </td>
                    <td>  <?= $pro['categoria'] ?> </td>
                    <td>$ <?= $pro['precio_venta'] ?> </td>
                    <td>$ <?= $pro['precio_compra'] ?> </td>
                    <td> <?= $pro['cantidad'] ?> </td>
                    <td>
                      <select class="custom-select acciones">
                        <option value="seleccionar" selected>Seleccionar..</option>
                        <option value="editar-<?=$pro['id_producto']?>">Editar</option>
                        <option value="eliminar-<?=$pro['id_producto']?>">Eliminar</option>
                      </select>
                    </td>
                  </tr>  
                  
                <?php 
                  }
                ?>

              </tbody>

            </table>
          </div>
        </div>
      </div> <!-- / row -->


    </div>




<script>

  $('.acciones').change(function() {
    var opcion = $(this).val();
    opcion = opcion.split('-');
    var opval = opcion[0];

    if(opval == "editar") {
        $('#editar-id').val(opcion[1]);
        $.ajax({ 
          type: "post",
          url:  '<?=URL?>home/ajaxProducto', 
          dataType: 'json',
          data: {
                id: opcion[1],
          },
          success: function(result){
            $('#nombreE').val(result.nombre);
            $('#categoriaE').val(result.categoria);
            $('#precio_ventaE').val(result.precio_venta);
            $('#precio_compraE').val(result.precio_compra);
            $('#cantidadE').val(result.cantidad);
          }
        });
        $('#editarModal').modal("show"); 

    }else if(opval == "eliminar") {
        $('#eliminar-id').val(opcion[1]);

        $.ajax({ 
          type: "post",
          url:  '<?=URL?>home/ajaxProducto', 
          dataType: 'json',
          data: {
                id: opcion[1],
          },
          success: function(result){
            $('#eliminar_nombre').html(result.nombre);
          }
        });

        $('#eliminarModal').modal("show"); 
    }

    $(this).val("seleccionar");
  });


 
  function validarEditar(){
    var validado = true;
    var elementos = new Array();
    var selects = new Array();
    elementos.push('#nombreE');    
    selects.push('#categoriaE');

    // VALIDACION DE INPUT TEXT
    for (var i = 0; i < elementos.length ; i++) {
      if ( $(elementos[i]).val() == '' || $(elementos[i]).val().length < 4) {
          $(elementos[i]).addClass('is-invalid');
          validado = false;
      }else{
         $(elementos[i]).removeClass('is-invalid');
      }
    }

    // VALIDACION DE SELECT
    for (var i = 0; i < selects.length ; i++) {
      if ( $(selects[i]).val().length == 0) {
          $(selects[i]).addClass('is-invalid');
          validado = false;
      }else{
         $(selects[i]).removeClass('is-invalid');
      }
    }

    // VALIDACION DE PRECIOS
    if ( parseFloat( $("#precio_ventaE").val() ) > 0  ) {
      $("#precio_ventaE").removeClass('is-invalid');
    }else{        
      $("#precio_ventaE").addClass('is-invalid');
      validado = false;
    }

    if ( parseFloat( $("#precio_compraE").val() ) > 0  ) {
      $("#precio_compraE").removeClass('is-invalid');
    }else{        
      $("#precio_compraE").addClass('is-invalid');
      validado = false;
    }
    
    //VALIDACION DE CANTIDAD
    if (parseInt($("#cantidadE").val()) > 0) {
      $("#cantidadE").removeClass('is-invalid');
    }else{        
      $("#cantidadE").addClass('is-invalid');
      validado = false;
    }

    // SI TODO ESTA BIEN SUBMITEAR EL FORMULARIO
    if (validado) {
        $('#form_editar').submit();
    }

  }

 
  function validarAgregar(){
    var validado = true;
    var elementos = new Array();
    var selects = new Array();
    elementos.push('#nombre');    
    selects.push('#categoria');

    // VALIDACION DE INPUT TEXT
    for (var i = 0; i < elementos.length ; i++) {
      if ( $(elementos[i]).val() == '' || $(elementos[i]).val().length < 4) {
          $(elementos[i]).addClass('is-invalid');
          validado = false;
      }else{
         $(elementos[i]).removeClass('is-invalid');
      }
    }

    // VALIDACION DE SELECT
    for (var i = 0; i < selects.length ; i++) {
      if ( $(selects[i]).val().length == 0) {
          $(selects[i]).addClass('is-invalid');
          validado = false;
      }else{
         $(selects[i]).removeClass('is-invalid');
      }
    }

    // VALIDACION DE PRECIOS
    if ( parseFloat( $("#precio_venta").val() ) > 0) {
      $("#precio_venta").removeClass('is-invalid');
    }else{        
      $("#precio_venta").addClass('is-invalid');
      validado = false;
    }


    if ( parseFloat( $("#precio_compra").val() ) > 0 ) {
      $("#precio_compra").removeClass('is-invalid');
    }else{        
      $("#precio_compra").addClass('is-invalid');
      validado = false;
    }
    
    //VALIDACION DE CANTIDAD
    if (parseInt( $("#cantidad").val() ) > 0 ) {
      $("#cantidad").removeClass('is-invalid');
    }else{        
      $("#cantidad").addClass('is-invalid');
      validado = false;
    }

    // SI TODO ESTA BIEN SUBMITEAR EL FORMULARIO
    if (validado) {
        $('#form_agregar').submit();
    }

  }
</script>

    <!-- Modal AGREGAR -->
    <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="<?=URL?>home/agregar" id="form_agregar">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
                <div class="invalid-feedback">Ingresa un nombre válido</div>
              </div>
              <div class="form-group">
                <label>Categoría</label>
                <select class="custom-select form-control" name="categoria" id="categoria">
                  <option value="">Selecciona...</option>
                  <option value="Alimentos">Alimentos</option>
                  <option value="Juguetes">Juguetes</option>
                  <option value="Medicamentos">Medicamentos</option>
                  <option value="Ropa">Ropa</option>
                </select>
                <div class="invalid-feedback">Ingresa un valor válido</div>
              </div>
              <div class="form-group">
                <label>Precio de Venta</label>
                <input type="number" class="form-control" min="0.01" id="precio_venta" step=".01" name="precio_venta">
                <div class="invalid-feedback">Ingresa un valor válido</div>
              </div>
              <div class="form-group">
                <label>Precio de Compra</label>
                <input type="number" class="form-control" min="0.01" id="precio_compra" step=".01" name="precio_compra">
                <div class="invalid-feedback">Ingresa un valor válido</div>
              </div>             
              <div class="form-group">
                <label>Cantidad</label>
                <input type="number" class="form-control" min="0" id="cantidad" step="1" name="cantidad">
                <div class="invalid-feedback">Ingresa un valor válido</div>
              </div>      
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" type="button" onclick="validarAgregar()">Aceptar</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal EDITAR -->
    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="<?=URL?>home/editar" id="form_editar">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" id="nombreE" name="nombre">
                <div class="invalid-feedback">Ingresa un nombre válido</div>
              </div>
              <div class="form-group">
                <label>Categoría</label>
                <select class="custom-select form-control" name="categoria" id="categoriaE">
                  <option value="Alimentos">Alimentos</option>
                  <option value="Juguetes">Juguetes</option>
                  <option value="Medicamentos">Medicamentos</option>
                  <option value="Ropa">Ropa</option>
                </select>
                <div class="invalid-feedback">Ingresa un valor válido</div>
              </div>
              <div class="form-group">
                <label>Precio de Venta</label>
                <input type="number" class="form-control" min="0.01" id="precio_ventaE" step=".01" name="precio_venta">
                <div class="invalid-feedback">Ingresa un valor válido</div>
              </div>
              <div class="form-group">
                <label>Precio de Compra</label>
                <input type="number" class="form-control" min="0.01" id="precio_compraE" step=".01" name="precio_compra">
                <div class="invalid-feedback">Ingresa un valor válido</div>
              </div>             
              <div class="form-group">
                <label>Cantidad</label>
                <input type="number" class="form-control" min="0" id="cantidadE" step="1" name="cantidad">
                <div class="invalid-feedback">Ingresa un valor válido</div>
              </div>      
              <input type="hidden" id="editar-id" name="id">
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" type="button" onclick="validarEditar()">Aceptar</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- Eliminar Modal-->
    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmar acción</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="post" action="<?=URL?>home/eliminar">
          <div class="modal-body">
            ¿Estas seguro de eliminar <strong><em><span id="eliminar_nombre"> asdfasdfsa </span></em></strong> de la lista de productos?
            <input type="hidden" id="eliminar-id" name="id">
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" type="submit" >Aceptar</button>
          </div>
        </form>
        </div>
      </div>
    </div>