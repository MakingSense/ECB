<header class="component--header">
  <div class="top-container desktop-only">
    <!-- build:include includes/top-bar/top-bar.php --><!-- /build -->
  </div>

  <div class="nav-container">
    <a href="/">
      <figure>
        <img class="desktop-only logo logo-white" src="<?php echo get_template_directory_uri(); ?>/img/logo-inline-white.svg" alt="Ecocity Builders" />
        <img class="desktop-only logo logo-black" src="<?php echo get_template_directory_uri(); ?>/img/logo-inline-black.svg" alt="Ecocity Builders" />
        <img class="mobile-only logo" src="<?php echo get_template_directory_uri(); ?>/img/logo-stacked-black.svg" alt="Ecocity Builders" />
      </figure>
    </a>

    <nav class="main-menubar desktop-only" role="navigation">
      <!-- build:include includes/menu/menu.php --><!-- /build -->
    </nav>

    <button class="mobile-only menu-button">
      <span class="ms-icon menu-opener icon-hamburger-menu"></span>
    </button>

    <div class="mobile-menubar mobile-only">
      <div class="menu-head">
        <a href="/">
          <figure>
            <img class="mobile-only logo" src="<?php echo get_template_directory_uri(); ?>/img/logo-stacked-white.svg" alt="Ecocity Builders" />
          </figure>
        </a>
        <button class="mobile-only menu-button">
          <span class="ms-icon menu-opener icon-close"></span>
        </button>
      </div>
      <div class="menu-content">
        <!-- build:include includes/menu/menu.php --><!-- /build -->
        <!-- build:include includes/top-bar/top-bar.php --><!-- /build -->
      </div>
    </div>

  </div>
</header>
