
<!-- Navbar ================================================== -->
<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
            <ul class="nav pull-left">
<!--        menu kiri        -->
            </ul>
                <p class="brand" style="margin-left: 35%; margin-bottom: 0;"> NOTARIS & PPAT </p> 

                <ul class="nav pull-right">
<!--          menu kanan          -->
                </ul>
        </div>
      </div>
    </div>
    
    
 <!-- Login Form
    ================================================== -->
  <div style="margin-top:5em;">
  <div class="container">
      <div class="content">
          <div class="row">
              <div class="span3 login" style="margin-left: 33%">
                <form id="login" method="post">
                    <div class="login-form">
                    <h2>Login</h2>
                        <fieldset>
                            <div>
                                <input type="text" placeholder="Username" id="username" name="username">
                            </div>
                            <div>
                                <input style="width:152px;" type="password" placeholder="Password" id="password" name="password">
                                <button class=" btn btn-primary" type="submit" style="margin-bottom:9px;">Login</button>
                            </div>

                        </fieldset>
                    </div>
                </form>
              </div>
         </div>
      </div>
  </div>
      <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
  <?php
    $keluar = "$('.alert').hide()";
    if (!empty($_GET['error'])) {
        if($_GET['error']=='salah') {
            echo '<br />';
            echo '<div style="margin-left:38%; margin-right:38%;" class="alert alert-block alert-error fade in" id="pesan_error">';
            echo '<button type="button" class="close" onclick='.$keluar.'>×</button>';
            echo 'username dan password salah';
            echo '</div>';
        }
  }
  ?>
      

  
  </div>
