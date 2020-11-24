<div id="homepage-hero" class="row">

  <?php $cacheKey = 'homepage-nav-'.$sf_user->getCulture() ?>
  <?php if (!cache($cacheKey)): ?>
    <div class="span8" id="homepage-nav">
      
    <p><?php echo __('Browse by') ?></p>
      <ul>
        <?php $icons = array(
		  'browseInformationObjects' => '/images/icons-large/icon-archival.png',
          'browseActors' => '/images/icons-large/icon-people.png',
          'browseRepositories' => '/images/icons-large/icon-institutions.png',
          'browseSubjects' => '/images/icons-large/icon-subjects.png',
          'browseFunctions' => '/images/icons-large/icon-functions.png',
          'browsePlaces' => '/images/icons-large/icon-places.png',
          'browseDigitalObjects' => '/images/icons-large/icon-media.png') ?>
        <?php $browseMenu = QubitMenu::getById(QubitMenu::BROWSE_ID) ?>
        <?php if ($browseMenu->hasChildren()): ?>
          <?php foreach ($browseMenu->getChildren() as $item): ?>
            <li>
              <a href="<?php echo url_for($item->getPath(array('getUrl' => true, 'resolveAlias' => true))) ?>">
                <?php if (isset($icons[$item->name])): ?>
                  <?php echo image_tag($icons[$item->name], array('width' => 42, 'height' => 42, 'alt' => '')) ?>
                <?php endif; ?>
                <?php echo esc_specialchars($item->getLabel(array('cultureFallback' => true))) ?>
              </a>
            </li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>
 
    </div>
    <?php cache_save($cacheKey) ?>
  <?php endif; ?>

</div>

<div id="homepage" class="row">

</div>
