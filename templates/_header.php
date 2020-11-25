<?php echo get_component_slot('header') ?>

<?php echo get_component('default', 'updateCheck') ?>

<?php echo get_component('default', 'privacyMessage') ?>

<?php if ($sf_user->isAuthenticated()): ?>
  <div id="top-bar">
    <nav>
      <?php echo get_component('menu', 'userMenu') ?>
      <?php echo get_component('menu', 'quickLinksMenu') ?>
      <?php echo get_component('menu', 'changeLanguageMenu') ?>
      <?php echo get_component('menu', 'mainMenu', array('sf_cache_key' => $sf_user->getCulture().$sf_user->getUserID())) ?>
    </nav>
  </div>
<?php endif; ?>

<div id="header">

  <div class="container">

    <div id="header-lvl1">
      <div class="row">
        <div class="span12">
     
          <ul id="header-nav" class="nav nav-pills">

        <li><?php echo link_to(__('Home'), '/') ?></li>
		  <li><?php echo link_to(__('Information'), array('module' => 'staticpage', 'slug' => 'information')) ?></li>
          <li><?php echo link_to(__('About'), array('module' => 'staticpage', 'slug' => 'about')) ?></li>
 				
          	<?php if (!$sf_user->isAuthenticated()): ?>
              <li><?php echo link_to(__('Log in'), array('module' => 'user', 'action' => 'login')) ?></li>
            <?php endif; ?>
  
          </ul>

        </div>
      </div>
    </div>

    <div id="header-lvl2">
      <div class="row">

        <div id="logo-and-name" class="span6">
          <h1><?php echo link_to(image_tag('/plugins/arVPlugin/images/logo.png', array('alt' => __('ERC VINCULUM project database'))), '/', array('rel' => 'home')) ?></h1>
          </div>

        <div id="header-search" class="span6">
          <?php echo get_component('search', 'box') ?>
        
          <?php echo get_component('menu', 'clipboardMenu') ?>
                     
        </div>

      </div>
    </div>

  </div>

</div>
