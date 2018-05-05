<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
          aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="../../index.html"class="navbar-brand">Home</a>
      </div>
  
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <?php
          $file = scandir("."); 
          for($i=2; $i < count($file); $i++){
            echo "<li>";
            echo "<a href={$file[$i]}>{$file[$i]}</a>";
            echo "</li>";
          }?>
            
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php  echo $_SESSION['display_name'];?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="../logout.php">Logout</a>
            </li>
            <li>
              <a href="#">User Settings</a>
            </li>
          </ul>
        </li>
        
      </ul>
  
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>