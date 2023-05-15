 <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href=""><img src="admin/assets/images/logo.png" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="admin/assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('add_doctor_view')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Ajouter docteur</span>
            </a>
          </li>

        

           <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('liste_docteur')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Tous les docteurs</span>
            </a>
          </li>

           <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('liste_rdv')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Liste des rendez-vous</span>
            </a>
          </li>
         
        </ul>
      </nav>