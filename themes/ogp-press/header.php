<?php
/**
 * The template for displaying the header
 * @package OGP  Press
 * @since OGP 1.0.0
 */
$ogp_layout_settings = get_option( 'ogp_layout' );
switch( $ogp_layout_settings['menu_layout']['type'] ) {
  case 'mega':
    $ogp_nav_body_class = 'mega-top';
    break;
  case 'side_slide':
    $ogp_nav_body_class = 'side-slide-top';
    break;
  default:
    $ogp_nav_body_class = '';
}
$hero_video = get_post_meta($post->ID, 'hero-video', true);
?>

<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <style>html{visibility: hidden;opacity:0;}</style>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="Orange County Basketball Tournaments, Orange County Club Basketball, Orange County Youth Basketball, Orange County Basketball Camps, Orange County Basketball Training, Orange County Basketball Leagues, Orange County Travel Basketball, Southern California Basketball Tournaments, SoCal Basketball Tournaments">
    <meta property="og:image" content="https://opengympremier.com/wp-content/uploads/2020/01/OPG1019_logoPREMIER_solid.png" />
    <title><?php wp_title(' ') ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
<!--<link rel="publisher" href="googlePlus Page"/> -->
    <?php if(!strpos(get_site_url(), 'dev.')): ?>
      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-YQPJMME7JG">
      </script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-YQPJMME7JG');
      </script>
    <?php endif; ?>
    <?php wp_head();?>
</head>

<body itemscope="itemscope" itemtype="http://schema.org/WebSite" <?php body_class( $ogp_nav_body_class ); ?>>
	<div id="page"<?php if( !empty( $hero_video ) ) echo ' class="relative"'; ?>>
		<!-- Start Top Bar -->
		<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
      <?php 
        if( is_cart() || is_checkout() || is_account_page() ) $ogp_layout_settings['menu_layout']['type'] = 'minimal';
        switch( $ogp_layout_settings['menu_layout']['type'] ) :
          case 'minimal':
      ?>
			<div id="mastInsert" class="grid-x header-bg">
				<div class="cell">
					<div id="site-logo-bar" class="grid-x align-justify">
            <div class="grid-x">
						<a class="ogp-logo main-logo title-logos current-site cell shrink has-tip" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
              <img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/open_gym_premier_tiny_dk.png" alt="<?php bloginfo( 'name' ); ?> Official Logo" /><span class="show-for-sr"><?php bloginfo( 'name' ); ?> Official Site</span></a>
            <!-- the menu  -->
            <nav  id="site-navigation-new" class="main-navigation hide-for-small-only" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
              <?php ogp_new_dropdown_nav(); ?>
            </nav>
            </div>
            <nav id="site-header-menu" class="site-header-menu header-bg hide-for-small-only" role="navigation" aria-label="Partners and Title Navigation">
              <?php ogp_title_nav(); ?>
            </nav>
            <!-- the trigger -->
            <div id="site-header-menu" class="site-header-menu cell shrink show-for-small-only" data-side-slide-menu-button>
              <div class="input-group small-padding-right no-margin-bottom pointer menu-container">
                <div class="input-group-label">
                  Menu 
                </div>
                <div class="input-group-button">
                  <div class="side-slide-menu-button-toggle">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        <nav  id="site-navigation" class="main-navigation side-slide-menu-wrapper show-for-small-only" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
          <?php ogp_side_slide_nav(); ?>
          <?php ogp_title_nav(); ?>
        </nav>
					<!--description-->
					<h3 itemprop="description" class="show-for-sr"><?php echo get_bloginfo( 'description' )?></h3>
					<!--skip to content-->
					<div class="show-on-focus skip-link"><a href="#content" title="Skip to content"><?php _e( 'Skip to content', 'ogp-press' ) ?></a></div>
				</div>
      </div>
      <?php
          break;
          case 'mega':
      ?>
			<div id="mastInsert" class="grid-x white header-bg">
				<!--logo -->
				<div class="cell shrink">
					<div id="site-logo-bar" class="grid-x collapse">
						<a class="ogp-logo main-logo title-logos current-site cell shrink has-tip" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/open_gym_premier_tiny_dk.png" alt="<?php bloginfo( 'name' ); ?> Official Logo" /><span class="show-for-sr"><?php bloginfo( 'name' ); ?> Official Site</span></a>
						<a class="secondary-logo title-logos cell shrink has-tip" href="http://elitebasketballcircuit.com" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/ebc_tiny_dk.png" alt="Elite Basketball Circuit Official Logo" /><span class="show-for-sr">Elite Basketball Circuit Official Site</span></a>
						<a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://grassroots365.com" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/grassroots_365_tiny_dk-stroke.png" alt="Open Gym Premier Official Logo" /><span class="show-for-sr">Grassroots 365 Official Site</span></a>
						<a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://pulsevolleyball.com/" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/logo-pulse-no-circle-pink.png" alt="Pulse Official Logo" /><span class="show-for-sr">Pulse Volleyball Official Site</span></a>
            <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://sportsboardroom.com/" target="_blank"><img src="https://opengympremier.com/wp-content/uploads/2021/09/sports-boardroom.png" alt="Sports Boardroom Official Logo" /><span class="show-for-sr">Sports Boardroom Official Site</span></a>
                        <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://thestagecircuit.com/" target="_blank"><img src="https://opengympremier.com/wp-content/uploads/2022/01/The-Stage-Logo-tiny.png" alt="The Stage Circuit Official Logo" /><span class="show-for-sr">The Stage Circuit Official Site</span></a>
					</div>
					<!--description-->
					<h3 itemprop="description" class="show-for-sr"><?php echo get_bloginfo( 'description' )?></h3>
					<!--skip to content-->
					<div class="show-on-focus skip-link"><a href="#content" title="Skip to content"><?php _e( 'Skip to content', 'ogp-press' ) ?></a></div>
				</div>
        <div class="cell auto"></div>
        <!-- the trigger -->
        <div id="site-header-menu" class="site-header-menu cell shrink" data-curtain-menu-button>
          <div class="input-group tiny-padding-top small-padding-right no-margin-bottom input-group-all-button">
            <div class="input-group-label">
              Menu 
            </div>
            <div class="input-group-button">
              <div class="curtain-menu-button-toggle">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- the menu  -->
        <div class="curtain-menu">
          <div class="curtain"></div>
          <div class="curtain"></div>
          <div class="curtain"></div>
          <nav  id="site-navigation" class="main-navigation curtain-menu-wrapper" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
            <div class="grid-container medium-padding">
              <?php ogp_mega_nav(); ?>
            </div>
          </nav>
        </div>
      </div>

      <?php
          break;
      case 'new':
      ?>
			<div id="mastInsert" class="grid-x header-bg">
				<div class="cell">
					<div id="site-logo-bar" class="grid-x align-justify">
            <div class="grid-x">
						<a class="ogp-logo main-logo title-logos current-site cell shrink has-tip" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
              <img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/open_gym_premier_tiny_dk.png" alt="<?php bloginfo( 'name' ); ?> Official Logo" /><span class="show-for-sr"><?php bloginfo( 'name' ); ?> Official Site</span></a>
            <!-- the menu  -->
            <nav  id="site-navigation-new" class="main-navigation hide-for-small-only" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
              <?php ogp_new_dropdown_nav(); ?>
            </nav>
            </div>
            <nav id="site-header-menu" class="site-header-menu header-bg hide-for-small-only" role="navigation" aria-label="Partners and Title Navigation">
              <?php ogp_title_nav(); ?>
              <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></a>
            </nav>
            <!-- the trigger -->
            <div id="site-header-menu" class="site-header-menu cell shrink show-for-small-only" data-side-slide-menu-button>
              <div class="input-group small-padding-right no-margin-bottom pointer menu-container">
                <div class="input-group-label">
                  Menu
                </div>
                <div class="input-group-button">
                  <div class="side-slide-menu-button-toggle">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
        <nav  id="site-navigation" class="main-navigation side-slide-menu-wrapper" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
          <?php ogp_title_nav(); ?>
          <?php ogp_side_slide_nav(); ?>
          <a class="cart-customlocation-mobile" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></a>
        </nav>
					<!--description-->
					<h3 itemprop="description" class="show-for-sr"><?php echo get_bloginfo( 'description' )?></h3>
					<!--skip to content-->
					<div class="show-on-focus skip-link"><a href="#content" title="Skip to content"><?php _e( 'Skip to content', 'ogp-press' ) ?></a></div>
				</div>
      </div>
<!--       <div class="container__secondary-logos">
          <a class="secondary-logo title-logos cell shrink has-tip" href="http://elitebasketballcircuit.com" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/ebc_tiny_dk.png" alt="Elite Basketball Circuit Official Logo" /><span class="show-for-sr">Elite Basketball Circuit Official Site</span></a>
          <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://grassroots365.com" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/grassroots_365_tiny_dk-stroke.png" alt="Open Gym Premier Official Logo" /><span class="show-for-sr">Grassroots 365 Official Site</span></a>
          <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://pulsevolleyball.com/" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/logo-pulse-no-circle-pink.png" alt="Pulse Official Logo" /><span class="show-for-sr">Pulse Volleyball Official Site</span></a>
          <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://sportsboardroom.com/" target="_blank"><img src="https://opengympremier.com/wp-content/uploads/2021/09/sports-boardroom.png" alt="Sports Boardroom Official Logo" /><span class="show-for-sr">Sports Boardroom Official Site</span></a>
          <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://thestagecircuit.com/" target="_blank"><img src="https://opengympremier.com/wp-content/uploads/2022/01/The-Stage-Logo-tiny.png" alt="The Stage Circuit Official Logo" /><span class="show-for-sr">The Stage Circuit Official Site</span></a>
          <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://scholasticseries.com/" target="_blank"><img src="https://scholasticseries.com/wp-content/themes/scscholastic-press/assets/tiny-logos/Scholastic-Series-400x300.png" alt="Scholastic Series Official Logo" /><span class="show-for-sr">Scholastic Series Official Site</span></a>
      </div> -->
      <?php
          break;
        case 'side_slide':
      ?>
<!--       this one -->
<!--       OLD -->
      <!--logo -->
			<div id="mastInsert" class="grid-x header-bg">
				<div class="cell">
					<div id="site-logo-bar" class="grid-x align-justify">
<!--             <div class="container__secondary-logos">
              <a class="secondary-logo title-logos cell shrink has-tip" href="http://elitebasketballcircuit.com" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/ebc_tiny_dk.png" alt="Elite Basketball Circuit Official Logo" /><span class="show-for-sr">Elite Basketball Circuit Official Site</span></a>
              <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://grassroots365.com" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/grassroots_365_tiny_dk-stroke.png" alt="Open Gym Premier Official Logo" /><span class="show-for-sr">Grassroots 365 Official Site</span></a>
              <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://pulsevolleyball.com/" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/logo-pulse-no-circle-pink.png" alt="Pulse Official Logo" /><span class="show-for-sr">Pulse Volleyball Official Site</span></a>
              <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://sportsboardroom.com/" target="_blank"><img src="https://opengympremier.com/wp-content/uploads/2021/09/sports-boardroom.png" alt="Sports Boardroom Official Logo" /><span class="show-for-sr">Sports Boardroom Official Site</span></a>
              <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://thestagecircuit.com/" target="_blank"><img src="https://opengympremier.com/wp-content/uploads/2022/01/The-Stage-Logo-tiny.png" alt="The Stage Circuit Official Logo" /><span class="show-for-sr">The Stage Circuit Official Site</span></a>
              <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://scholasticseries.com/" target="_blank"><img src="https://scholasticseries.com/wp-content/themes/scscholastic-press/assets/tiny-logos/Scholastic-Series-400x300.png" alt="Scholastic Series Official Logo" /><span class="show-for-sr">Scholastic Series Official Site</span></a>
            </div> -->
						<a class="ogp-logo main-logo title-logos current-site cell shrink has-tip" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/open_gym_premier_tiny_dk.png" alt="<?php bloginfo( 'name' ); ?> Official Logo" /><span class="show-for-sr"><?php bloginfo( 'name' ); ?> Official Site</span></a>
            <!-- the trigger -->
            <div id="site-header-menu" class="site-header-menu cell shrink" data-side-slide-menu-button>
              <div class="input-group small-padding-right no-margin-bottom pointer menu-container">
                <div class="input-group-label">
                  Menu 
                </div>
                <div class="input-group-button">
                  <div class="side-slide-menu-button-toggle">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
					<!--description-->
					<h3 itemprop="description" class="show-for-sr"><?php echo get_bloginfo( 'description' )?></h3>
					<!--skip to content-->
					<div class="show-on-focus skip-link"><a href="#content" title="Skip to content"><?php _e( 'Skip to content', 'ogp-press' ) ?></a></div>
				</div>
        <!-- the menu  -->
        <nav  id="site-navigation" class="main-navigation side-slide-menu-wrapper" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
          <?php ogp_side_slide_nav(); ?>
        </nav>
      </div>
<!--       end OLD -->
      <?php
          break;
        default:
      ?>

      <div id="mastInsert" class="grid-x">
				<!--logo -->
				<div class="cell small-12 medium-7 small-order-2 medium-order-1 header-bg">
					<div id="site-logo-bar" class="grid-x collapse">
						<a class="ogp-logo main-logo title-logos current-site cell shrink has-tip" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/open_gym_premier_tiny_dk.png" alt="<?php bloginfo( 'name' ); ?> Official Logo" /><span class="show-for-sr"><?php bloginfo( 'name' ); ?> Official Site</span></a>
						<a class="secondary-logo title-logos cell shrink has-tip" href="http://elitebasketballcircuit.com" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/ebc_tiny_dk.png" alt="Elite Basketball Circuit Official Logo" /><span class="show-for-sr">Elite Basketball Circuit Official Site</span></a>
						<a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://grassroots365.com" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/grassroots_365_tiny_dk-stroke.png" alt="Open Gym Premier Official Logo" /><span class="show-for-sr">Grassroots 365 Official Site</span></a>
            <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://pulsevolleyball.com/" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/tiny-logos/logo-pulse-no-circle-pink.png" alt="Pulse Official Logo" /><span class="show-for-sr">Pulse Volleyball Official Site</span></a>
            <a class="secondary-logo g365-logo title-logos cell shrink has-tip" href="https://sportsboardroom.com/" target="_blank"><img src="https://opengympremier.com/wp-content/uploads/2021/09/sports-boardroom.png" alt="Sports Boardroom Official Logo" /><span class="show-for-sr">Sports Boardroom Official Site</span></a>
					</div>
					<!--description-->
					<h3 itemprop="description" class="show-for-sr"><?php echo get_bloginfo( 'description' )?></h3>
					<!--skip to content-->
					<div class="show-on-focus skip-link"><a href="#content" title="Skip to content"><?php _e( 'Skip to content', 'ogp-press' ) ?></a></div>
				</div>
				<nav id="site-header-menu" class="site-header-menu cell small-12 medium-5 small-order-1 medium-order-2 header-bg" role="navigation" aria-label="Partners and Title Navigation">
					<?php ogp_title_nav(); ?>
          <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></a>
				</nav><!-- .title-navigation -->
				<nav id="site-navigation" class="main-navigation cell small-12 small-order-3" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<a class="show-for-small-only button menuButton" data-toggle="main-nav-drawer"><span class="fi-list"></span> Menu</a>
					<div id="main-nav-drawer" class="nav-drawer" style="display: none;" data-toggler data-closable="slide-out-left" data-animate="slide-in-left">
						<button class="close-button show-for-small-only" data-close>&times;</button>
						<a class="main-logo-menu main-logo ogp-logo show-for-small-only" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ogp-press/assets/ogp-logo.png" alt="<?php bloginfo( 'name' ); ?>" /><span class="show-for-sr"><?php bloginfo( 'name' ); ?></span></a>
						<?php ogp_main_nav(); ?>
					</div>
				</nav><!-- .main-navigation -->
			</div>
        <?php
          endswitch;
        ?>
		</header>	
		<!-- End Top Bar -->
    <div class="nav-spacer"></div>
    <!-- Start Content Area -->
    <?php
      if ( !is_front_page() && !is_product() && ( has_post_thumbnail( $post->ID ) || is_archive() || !empty( $hero_video ) ) ) {
        $continue_process = true;
        if( is_archive() ) {
//           echo '<h1>' . get_the_archive_title( $post->ID ) . '</h1>';
          switch( get_the_archive_title( $post->ID ) ){
            case 'Archives: Careers at OGP':
              $arc_img = wp_get_attachment_image( 746, 'full');
              break;
            default:
              $continue_process = false;
          }
        }
        if( $continue_process ) {
          echo '<div class="hero-img">';
          if( !empty( $hero_video ) ) echo '<div class="hero-video-wrapper"><div><iframe class="hero-video" frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" title="YouTube video player" width="2000" height="1200" src="https://www.youtube.com/embed/' . $hero_video . '?autohide=1&autoplay=1&controls=0&enablejsapi=1&disablekb=1&fs=0&iv_load_policy=3&loop=1&modestbranding=1&playsinline=1&rel=0&showinfo=0&origin=' . urlencode( get_site_url() ) . '&widgetid=1&mute=1&playlist=' . $hero_video . '"></iframe></div></div>';
          if( !empty( $arc_img ) ) {
            echo $arc_img;
          } else {
            the_post_thumbnail( $post->ID );
          }
          echo '</div>';
          if( !empty( $hero_video ) ) echo '<div class="hero-video-shield"></div>';
        }
      }

      if( !is_front_page() || $ogp_layout_settings['front_layout']['type'] !== 'tiles' ) echo '<div class="grid-container">';
    ?>