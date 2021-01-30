<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link" style="text-align:center">
        <span class="brand-text font-weight-light">GDLWebCamp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="admin-edit.php?id=<?php echo $_SESSION['id_admin']; ?>" class="d-block"><?php echo $_SESSION['name_admin']; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admin-area.php" class="nav-link margin-left">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Events -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>Eventos<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="event-list.php" class="nav-link margin-left">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>Ver Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=event-add.php class="nav-link margin-left">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Category Event -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Categoría Eventos<i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="category-list.php" class="nav-link margin-left">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>Ver Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="category-add.php" class="nav-link margin-left">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Registers -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Registrados<i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="user-list.php" class="nav-link margin-left">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>Ver Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user-add.php" class="nav-link margin-left">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Guests -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Invitados<i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="guests-list.php" class="nav-link margin-left">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>Ver Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="guests-add.php" class="nav-link margin-left">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php if($_SESSION['level'] !== 0) { ?>
                    <!-- Admins -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>Administradores<i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="admin-list.php" class="nav-link">
                                    <i class="fas fa-list-ul nav-icon margin-left"></i>
                                    <p>Ver Todos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href=admin-add.php class="nav-link">
                                    <i class="fas fa-plus nav-icon margin-left"></i>
                                    <p>Agregar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <!-- Testimonials -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-comments"></i>
                        <p>Testimoniales<i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link margin-left">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>Ver Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link margin-left">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <pre><?php var_dump($_SESSION); ?></pre>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>