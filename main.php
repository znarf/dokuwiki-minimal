<?php

if (!defined('DOKU_INC')) die();

if (!defined('H6E_CSS')) {
  if (file_exists(dirname(__FILE__) . '/h6e-minimal')) {
    define('H6E_CSS', DOKU_URL . 'lib/tpl/minimal');
  } else {
    define('H6E_CSS', 'http://h6e.net/css');
  }
}

if (empty($_REQUEST['do']) || in_array($_REQUEST['do'], array('revisions', 'show', 'edit'))) {
    $page_type = 'content-page';
} else {
    $page_type = 'do-page';
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
  <meta charset="utf-8" />
  <title><?php tpl_pagetitle() ?> - <?php echo strip_tags($conf['title']) ?></title>

  <link rel="stylesheet" media="screen" href="<?php echo H6E_CSS ?>/h6e-minimal/h6e-minimal.css" />

  <?php tpl_metaheaders() ?>

  <style type="text/css">
  <?php if (tpl_getConf('width') != 'auto') : ?>
  .h6e-main-content {
      width:<?php echo tpl_getConf('width') ?>;
      padding-left:2.5em;
      padding-right:2.5em;
  }
  <?php endif ?>
  .h6e-post-content {
      font-size:<?php echo tpl_getConf('font-size') ?>;
  }
  </style>

</head>

<body class="h6e-layout">

<div class="dokuwiki">

  <?php include dirname(__FILE__) . '/top.php' ?>

  <div class="<?php echo $page_type ?> h6e-main-content">

    <?php /* if($conf['breadcrumbs']){?>
    <div class="breadcrumbs">
      <?php tpl_breadcrumbs() ?>
    </div>
    <?php } */?>

    <h1 class="h6e-page-title">
    <?php tpl_link(wl(),$conf['title'],'name="dokuwiki__top" id="dokuwiki__top" accesskey="h" title="[ALT+H]"') ?>
    </h1>

    <?php if (class_exists('Ld_Ui') && method_exists('Ld_Ui', 'topNav')) { Ld_Ui::topNav(); } ?>

    <?php /*
    <ul class="h6e-tabs">
      <li><?php tpl_actionlink('history') ?></li>
      <li><?php tpl_actionlink('edit') ?></li>
    </ul>
    */ ?>

    <?php if (tpl_getConf('content-block')){?>
        <div class="h6e-block">
    <?php } else { ?>
        <div>
    <?php } ?>

    <?php if (!tpl_getConf('hide-entry-title')){?>
        <h2 class="h6e-entry-title">
        <?php tpl_pagetitle($ID) ?>
        </h2>
    <?php }?>

    <?php if($conf['youarehere']){?>
    <div class="breadcrumbs">
      <?php tpl_youarehere() ?>
    </div>
    <?php }?>

    <div id="wikipage" class="h6e-post-content">
        <?php tpl_content()?>
    </div>

    <?php if(empty($_REQUEST['do'])){?>

    <div class="pageinfo">
        <?php tpl_pageinfo()?>
    </div>

    <div class="actions actions-page">
        <?php tpl_button('edit')?>
        <?php tpl_button('history')?>
        <?php tpl_button('revert')?>
    </div>

    <?php }?>

    </div>

    <div class="h6e-simple-footer">

      <div class="actions actions-site">
          <div class="a">
              <?php tpl_button('recent')?>
              <?php tpl_button('index')?>
          </div>
          <div class="b">
              <?php tpl_searchform() ?>
          </div>
      </div>

      <p><?php echo tpl_getConf('footer-text') ?></p>

    </div>

  </div>

</div>

<div class="no"><?php /* provide DokuWiki housekeeping, required in all templates */ tpl_indexerWebBug()?></div>

</body>
</html>