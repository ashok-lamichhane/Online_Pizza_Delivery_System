    <header class="header" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        
        <div class="header__img">
            <img src="assetsForSideBar/img/perfil.jpg" alt="">
        </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="index.php" class="nav__logo">
                    <i class='bx bx-layer nav__logo-icon'></i>
                    <span class="nav__logo-name">Pizza Delivery System</span>
                </a>

                <div class="nav__list">
                    <a href="index.php" class="nav__link nav-home">
                      <i class='bx bx-grid-alt nav__icon' ></i>
                      <span class="nav__name">Home</span>
                    </a>
                    <a href="index.php?page=orderEdit" class="nav-orderEdit nav__link ">
                      <i class='bx bx-bar-chart-alt-2 nav__icon' ></i>
                      <span class="nav__name">Orders</span>
                    </a>
                    <a href="index.php?page=restaurantEdit" class="nav__link nav-restaurantEdit">
                      <i class='bx bx-folder nav__icon' ></i>
                      <span class="nav__name">Restaurant List</span>
                    </a>
                    <a href="index.php?page=menuEdit" class="nav__link nav-menuEdit">
                      <i class='bx bx-message-square-detail nav__icon' ></i>
                      <span class="nav__name">Pizza Menu</span>
                    </a>
                    <a href="index.php?page=contactEdit" class="nav__link nav-contactEdit">
                      <i class="fas fa-hands-helping"></i>
                      <span class="nav__name">Customer Feedback</span>
                    </a>
                    <a href="index.php?page=userEdit" class="nav__link nav-userEdit">
                      <i class='bx bx-user nav__icon' ></i>
                      <span class="nav__name">Users</span>
                    </a>
                    <a href="index.php?page=systemEdit" class="nav__link nav-systemEdit">
                      <i class="fas fa-cogs"></i>
                      <span class="nav__name">System Settings</span>
                    </a>
                </div>
            </div>
            <a href="components/logOut.php" class="nav__link">
              <i class='bx bx-log-out nav__icon' ></i>
              <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>  
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    <?php error_reporting(0); $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
	  $('.nav-<?php error_reporting(0); echo $page; ?>').addClass('active')
</script>
   