<?php

  // sitemap array
  $sitemap    = array(
                  'domu','onas','sluzby','dokumenty','kontakt',
                  'en' => array('home','about','services','documents','contact'),
                  // 'de' => array(),
                  'ru' => array('home','about','services','documents','contact'),
                  // 'it' => array(),
                );

  // parse request string to path
  $request    = str_replace("/spediceBrno/web/", "", $_SERVER['REQUEST_URI']);
  $folder     = str_replace($request, "", $_SERVER['REQUEST_URI']);
  $temp       = ltrim($request,'/');
  $temp       = explode('?',$temp);

  // parse path to sections
  $sections   = explode('/',$temp[0]);
  // echo $sections[0]."-";
  // echo $sections[1]."-";
  // echo $sections[count($sections)-1];
  // check language

    // default variables
    $lng      = 'cs';
    $site     = $sitemap[0];
    $path     = $site;

    // parse sections in sitemap
    if(in_array($sections[count($sections)-1],$sitemap)) {

      // set site
      $site   = $sections[count($sections)-1];

      // set path
      $path   = $site;

    } elseif(array_key_exists($sections[0], $sitemap)) {

      // set language
      $lng    = $sections[0];

      // check for site

      // default site
      $site   = $sitemap[$lng][0];

      // set requested site
      if(in_array($sections[count($sections)-1], $sitemap[$lng])) {
        $site = $sections[count($sections)-1];
      }

      // set path
      $path   = $lng."/".$site;

    }

?>

<!DOCTYPE html>
<html lang="<?php echo $lng; ?>">
  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php 
        if(is_file($lng.'/meta/'.$site.'_meta.php')) include($lng.'/meta/'.$site.'_meta.php');
      ?>
      <link rel="icon" type="image/png" href="/img/favicon.png" />
      <link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/css/style.css" />
      <link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/css/flexslider.css" type="text/css">
      <script src="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/js/jquery.min.js"></script>
      <script src="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/js/jquery.flexslider-min.js"></script>
      <script src="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/js/easing.js"></script>
      <script src="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/js/jquery.icheck.min.js"></script>
      <script src="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/js/main.js"></script>
      <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <!--[if lt IE 7]>
        <script src="js/lte-ie7.js"></script>
      <![endif]-->
      <meta name="google-site-verification" content="iKc5rhaZnUpxMiRf-LnRFfeVtHG7zXNn1Hzq0s0RPrM" />
      <script>

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-42885692-1', 'spedicebrno.cz');
        ga('send', 'pageview');

      </script>
    </head>
    <body>
        <div id="container">
          <section itemscope itemtype="http://schema.org/LocalBusiness" class="">
            <div class="pre-header">
              <div class="two-third">
                <ul class="top-links">
                  <li><a itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" href="http://mapy.cz/s/7VT1" class="icon-location"><span itemprop="streetAddress">Borodinova 311/8</span>, <span itemprop="postalCode">62300</span> <span itemprop="addressLocality">Brno</span></a></li>
                  <li><a itemprop="telephone" href="tel:+420725992791" class="icon-phone">+420 725 992 790</a></li>
                  <li><a itemprop="email" href="mailto:info@spedicebrno.cz" class="icon-mail">info@spedicebrno.cz</a></li>
                </ul>
              </div>
              <div class="one-third last">
                <ul class="social-links lang-switch">
                  <li><a href="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>" <?php if($lng=='cs') echo "class='active'" ?>>cz</a></li>
                  <li><a href="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/en" <?php if($lng=='en') echo "class='active'" ?>>en</a></li>
                  <!-- <li><a href="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/de" <?php if($lng=='de') echo "class='active'" ?>>de</a></li> -->
                  <li><a href="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/ru" <?php if($lng=='ru') echo "class='active'" ?>>ru</a></li>
                  <!-- <li><a href="http://<?php echo $_SERVER['SERVER_NAME'].$folder;?>/it" <?php if($lng=='it') echo "class='active'" ?>>it</a></li> -->
                </ul>
              </div>
            </div>
            <?php 
              if (is_file($lng."/src/header.php")) {
                include($lng."/src/header.php");
              }
            ?>
          </section>
          <?php 
            if (is_file($path.".php")) {
              include($path.".php");
            } else {
              include("src/404.php");
            }
          ?>
          <?php 
            if (is_file($lng."/src/footer.php")) {
              include($lng."/src/footer.php");
            }
          ?>
        </div>
    </body>
</html>