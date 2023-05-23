<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-text mx-3">Gestion de Club</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">

            <span>Dashboard Admin</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>Membre</span>
        </a>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Actions:</h6>
                <a class="collapse-item"  id="afficher-membre-btn" >Afficher les membres</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Plan Inscription</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Actions:</h6>
                <a class="collapse-item" data-toggle="modal" data-target="#modalAjouterPlanInscription" >Ajouter un Plan</a>
                
                <a class="collapse-item" id="btnafficherPlans">Afficher les Plans</a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGainUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gains</span>
        </a>
        <div id="collapseGainUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Actions:</h6>                
                <a class="collapse-item" id="btnafficherPlans">Gain entre deux dates: </a>
                <label class="ml-4" for="date1">Date 1: </label>
                <input class="form-control w-75 ml-4 " id="date1" type="date"/>
                <label class="ml-4 mt-2"   for="date2">Date 2: </label>
                <input class="form-control w-75 ml-4 " id="date2" type="date"/>
                <button class="btn btn-primary ml-4 mt-2 w-75" id="btnGain" >calculate</button>
                

            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Inscription" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
            <span>Inscriptions</span>
        </a>
        <div id="Inscription" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Actions:</h6>
                <a class="collapse-item" href="utilities-color.html">Gérer les inscriptions:</a>
            </div>
        </div>
    </li>
</ul>