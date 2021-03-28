  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?=URL?>Home">Prueba The Fives</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarResponsive">
      
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
          <a class="nav-link" href="<?=URL?>Home">
            <i class="fa fa-fw fa-list-alt"></i>
            <span class="nav-link-text">Productos</span>
          </a>
        </li>

      </ul>

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
  


 <!--  header -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <span class="nav-link ml-6">
            <i class="fa fa-fw fa-user"></i> <?=$_SESSION['nombre']?>
          <span>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Cerrar Sesión</a>
        </li>

      </ul>
    </div>
  </nav>


<script>

  var step = 100;
  $('#innerScroll').bind('mousewheel', function(e) {
      if(e.originalEvent.wheelDelta / 120 > 0) {
          $("#innerScroll").animate({
            scrollTop: "-=" + step + "px"
           });
      } else {
          $("#innerScroll").animate({
            scrollTop: "+=" + step + "px"
          });
      }
  });


</script>