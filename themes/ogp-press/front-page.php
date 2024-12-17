<?php
/**
 * The front page template
 * @package OGP  Press
 * @since OGP 1.0.0
 */

// News query for the slider
$news_feat = new WP_Query( array( 'category_name' => 'Featured', 'posts_per_page' => 6 ) );

//https://dev.grassroots365.com/wp-content/uploads/display-assets/event-promo-ogp.jpg
//https://dev.grassroots365.com/wp-content/uploads/2017/11/ogp-posts-banner.jpg
get_header();

//see if we need a splash display
$ogp_ad_info = ogp_start_ads( $post->ID );

$default_img = get_site_url() . '/wp-content/themes/ogp-press/ogp_default_placeholder.gif';

$ogp_layout_type = get_option( 'ogp_layout' );
if( $ogp_layout_type['front_layout']['type'] === 'tiles' && count($news_feat->posts) === 6 ){
  //trigger for tile video support
  $tile_vid = false;
  $tile_video_settings = [];

  //get tile banner
	$ogp_tile_banner = get_option( 'ogp_display' );
	//reassign to focus on tile banner
	$ogp_tile_banner = $ogp_tile_banner['site_4'];
  $ogp_tile_banner_build = '';
  //build tile banner from global settings if we have data
  if ( !empty($ogp_tile_banner['title']) ) {
    if ( !empty($ogp_tile_banner['link']) ) {
      $ogp_tile_banner_build .= '<h2 class="no-margin"><a href="' . $ogp_tile_banner['link'] . '">' . $ogp_tile_banner['title'] . '</a></h2>';
    } else {
      $ogp_tile_banner_build .= '<h2 class="no-margin">' . $ogp_tile_banner['title'] . '</h2>';
    }
  }
  if ( !empty($ogp_tile_banner['sub_title']) ) $ogp_tile_banner_build .= '<p class="no-margin">' . $ogp_tile_banner['sub_title'] . '</p>';
  function ogp_tile_template( $target_num, $news_feat, $classes ) {
    $tile_type = get_post_meta($news_feat->posts[$target_num]->ID, 'video_head', true);
    if( empty($tile_type) ) {
      $tile_type = '<img src="' . (( has_post_thumbnail($news_feat->posts[$target_num]->ID) ) ? get_the_post_thumbnail_url( $news_feat->posts[$target_num]->ID, "featured-tile" ) : get_site_url() . "/wp-content/themes/ogp-press/assets/ogp_blank-placeholder_640x640.jpg") . '" alt="' . $news_feat->posts[$target_num]->post_title . '" />';
    } else {
      $video_settings = explode(":", $tile_type);
      if( $video_settings[0] === 'youtube' ) {
        global $tile_vid;
        global $tile_video_settings;
        $tile_type = '<div id="tile_player_' . $news_feat->posts[$target_num]->ID . '"></div>';
        $tile_vid = true;
        $tile_video_settings[] = (object) [
          'id' => 'tile_player_' . $news_feat->posts[$target_num]->ID,
          'data'=> (object)[
            'height' => '640.125',
            'width' => '1138',
            'videoId' => $video_settings[1],
            'playerVars' => (object)[
              'controls' => 0,
              'fs'  => 0,
              'modestbranding'  => 1,
              'enablejsapi' => 1
            ]
          ]
        ];
        $classes .= ' responsive-embed';
//         $tile_type = '<iframe type="text/html" width="1138" height="640.125"
// src="https://www.youtube.com/embed/' . $video_settings[1] . '?autoplay=1&controls=0&enablejsapi=1&loop=1&modestbranding=1&fs=0" frameborder="0"></iframe>';
//         $classes .= ' responsive-embed';
      }
    }
    return '        <div id="news-' . $news_feat->posts[$target_num]->ID . '" class="white-border thick-border tile relative maximum-height">
          <a href="' . get_permalink($news_feat->posts[$target_num]->ID) . '" class="' . $classes . '">' . $tile_type . '</a>
          <h1 class="article-info">
            <a href="' . get_permalink($news_feat->posts[$target_num]->ID) . '">' . $news_feat->posts[$target_num]->post_title . '</a>' . 
            (( !empty($news_feat->posts[$target_num]->post_excerpt) ) ? "<p class=\"no-margin cute orange text-lowercase\">" . $news_feat->posts[$target_num]->post_excerpt . "</p>" : "") . 
          '</h1>
        </div>';
  } ?>
<section class="hero relative medium-margin-bottom">
  <a href="https://www.hoagorthopedicinstitute.com/press-center/press-releases/2024/open-gym-premier-ladera-ranch-pens-exclusive-spo/">
    <img class="hero__img hide-for-small-only" src="https://opengympremier.com/wp-content/uploads/2024/10/HOAG-HERO-IMAGE.png" alt="OGP OC">
    <img class="hero__img show-for-small-only" src="https://opengympremier.com/wp-content/uploads/2024/10/HOAG-HERO-IMAGE.png" alt="OGP OC">
  </a>
<!--     <img class="hero__img" src="https://opengympremier.com/wp-content/uploads/2024/09/hero.png" alt="OGP OC"/> -->

<!--   <div class="hero__info fadeIn--Up">
    <div class="hero__buttons">
      <a href="https://opengympremier.com/store/playerclub/elevate/" class="button secondary small-padding">Elevate Your Game</a>
    </div>
  </div>  -->
<!--   <img class="hero__logo fadeIn--Up" src="https://opengympremier.com/wp-content/uploads/2023/03/OGP-Newport.png" alt="OGP Shield"> -->
<!--   <div class="hero__img-container">
      <img src="https://opengympremier.com/wp-content/uploads/2022/11/Ladera-logo.png" />
      <img src="https://opengympremier.com/wp-content/uploads/2022/11/Anaheim-logo.png" />
      <img src="https://opengympremier.com/wp-content/uploads/2022/11/Kings-logo.png" />
  </div> -->
</section> 
<!--
<section class="site-main width-hd hero-tiles hide<?php if ( $ogp_ad_info['go'] ) echo $ogp_ad_info['ad_section_class']; ?>">
  <?php if ( $ogp_ad_info['go'] ) echo $ogp_ad_info['ad_before'] . $ogp_ad_info['ad_content'] . $ogp_ad_info['ad_after']; ?>
  <div class="grid-x white-border thick-border">
    <div class="cell medium-8">
      <div class="grid-y grid-frame small-block">
        <div class="cell auto">
          <div class="grid-x maximum-height">
            <div class="cell small-6 maximum-height">
              <?php echo ogp_tile_template( 0, $news_feat, 'tile-image' ); ?>
            </div>
            <div class="cell small-6 maximum-height">
              <?php echo ogp_tile_template( 1, $news_feat, 'tile-image' ); ?>
            </div>
          </div>
        </div>
        <?php if( $ogp_tile_banner_build !== '' ) : ?>
        <div class="cell shrink">
          <div class="grid-x maximum-height">
            <div class="cell small-12 text-center small-small-padding large-padding callout secondary no-margin white-border thick-border">
              <?php echo $ogp_tile_banner_build; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <div class="cell auto">
          <div class="grid-x maximum-height">
            <div class="cell small-6 maximum-height">
              <?php echo ogp_tile_template( 2, $news_feat, 'tile-image' ); ?>
            </div>
            <div class="cell small-6 maximum-height">
              <?php echo ogp_tile_template( 3, $news_feat, 'tile-image' ); ?>
            </div>
          </div>
        </div>
      </div>
    </div>  
    <div class="cell medium-4">
      <div class="grid-x">
        <div class="cell small-6 medium-12">
          <?php echo ogp_tile_template( 4, $news_feat, 'tile-image' ); ?>
        </div>
        <div class="cell small-6 medium-12">
          <?php echo ogp_tile_template( 5, $news_feat, 'tile-image' ); ?>
        </div>
      </div>
    </div>
  </div>
</section>
-->
<!-- new -->
<section class="site-main width-hd hero-tiles<?php if ( $ogp_ad_info['go'] ) echo $ogp_ad_info['ad_section_class']; ?>">
  <?php if ( $ogp_ad_info['go'] ) echo $ogp_ad_info['ad_before'] . $ogp_ad_info['ad_content'] . $ogp_ad_info['ad_after']; ?>
  <div class="grid-x white-border thick-border" style="overflow-x:scroll; flex-wrap: nowrap;">
  
            <div class="cell small-4 maximum-height">
              <?php echo ogp_tile_template( 0, $news_feat, 'tile-image' ); ?>
            </div>
<!--             <div class="cell small-4 maximum-height">
              <?php echo ogp_tile_template( 1, $news_feat, 'tile-image' ); ?>
            </div> -->
<!--             <div class="cell small-4 maximum-height">
              <?php echo ogp_tile_template( 2, $news_feat, 'tile-image' ); ?>
            </div> -->
            <div class="cell small-4 maximum-height">
              <?php echo ogp_tile_template( 3, $news_feat, 'tile-image' ); ?>
            </div>
             <div class="cell small-4">
              <?php echo ogp_tile_template( 4, $news_feat, 'tile-image' ); ?>
            </div>
<!--             <div class="cell small-4">
              <?php echo ogp_tile_template( 5, $news_feat, 'tile-image' ); ?>
            </div> -->
        <?php if( $ogp_tile_banner_build !== '' ) : ?>
        <div class="cell shrink">
          <div class="grid-x maximum-height">
            <div class="cell small-12 text-center small-small-padding large-padding callout secondary no-margin white-border thick-border">
              <?php echo $ogp_tile_banner_build; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>
  </div>
  
<div class="hide" style="text-align: right; margin-right: 2rem;">

<button class="button slider-btn" id="newsLeft" disabled><</button>
<button class="button slider-btn" id="newsRight">></button>
</div>
</section>
<?php
  //$featured_events_arr = g365_conn( 'g365_display_events', [65, 6] );
  $ogp_potm = get_post_meta($post->ID, 'ogp_potm', true);
  $ogp_ctotm = get_post_meta($post->ID, 'ogp_ctotm', true);
  if( !empty( $ogp_potm ) || !empty( $ogp_ctotm ) || !empty( $featured_events_arr ) ) :
?>
<section class="site-main small-padding-top xlarge-padding-bottom grid-container">
  <div class="grid-x grid-margin-x">
    <div id="main" class="small-12 cell">
      <?php if( !empty($featured_events_arr) ) : ?>
      <div class="tiny-padding gset no-border">
        <h2 class="entry-title text-center screen-reader-text"><a href="/calendar">Featured Events</a></h2>
      </div>
      <div class="widget-wrapper medium-margin-bottom">
        <div class="grid-x small-up-2 medium-up-3 large-up-6 text-center profile-feature profile-widget">
          <?php foreach( $featured_events_arr as $dex => $obj ) : ?>
          <div class="cell">
            <div class="small-margin-bottom">
              <a href="<?php echo $obj->link; ?>" target="_blank">
                <img src="<?php echo (!empty($obj->logo_img)) ? $obj->logo_img : $default_event_img ?>" alt="<?php echo $obj->name; ?> official logo" />
                <p>
                  <?php echo ( empty($obj->short_name) ) ? $obj->name : $obj->short_name; ?><br>	
                  <small class="tiny-margin-top block"><?php echo ogp_build_dates($obj->dates); ?></small>
                </p>
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <a class="button expanded no-margin-bottom" href="/calendar">Full Calendar</a>
      </div>
      <?php endif;
      if( !empty($ogp_potm) ) : ?>
      <div class="widget-wrapper medium-margin-bottom">
        <div class="grid-x">
          <div class="cell">
            <img src="<?php echo $ogp_potm; ?>" alt="Players of the month by region. <?php the_modified_date(); ?>" />
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if( !empty($ogp_ctotm) ) : ?>
      <div class="widget-wrapper medium-margin-bottom">
        <div class="grid-x">
          <div class="cell">
            <img src="<?php echo $ogp_ctotm; ?>" alt="Club Team of the month. <?php the_modified_date(); ?>" />
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; //end ptom section ?>

<?php } else { //end tile layout hero section, begin standard featured post rotator ?>

<section class="site-main small-padding-top xlarge-padding-bottom grid-container<?php if ( $ogp_ad_info['go'] ) echo $ogp_ad_info['ad_section_class']; ?>">
  <?php if ( $ogp_ad_info['go'] ) echo $ogp_ad_info['ad_before'] . $ogp_ad_info['ad_content'] . $ogp_ad_info['ad_after']; ?>
  <div class="grid-x grid-margin-x">
    <div id="main" class="small-12 medium-8 cell">
      <div class="tiny-padding gset no-border">
        <h2 class="entry-title"><a href="/category/news/">News</a></h2>
      </div>
      <div id="slider-wrapper" class="tiny-padding gset no-border medium-margin-bottom">
        <div class="grid-x collapse">
          <div class="small-12 medium-12 large-9 cell">
            <div id="news_rotator">

              <!-- News Slides	 -->
              <?php if ( $news_feat -> have_posts() ) : while ( $news_feat -> have_posts() ) : $news_feat -> the_post(); ?>

              <div id="news-<?php echo $post->ID; ?>" class="green-border tab-slider relative">
                <a href="<?php echo get_permalink(); ?>">
                  <img src="<?php echo ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'featured-home' ) : 'http://image.mlive.com/home/mlive-media/width960/img/kalamazoogazette/photo/2016/12/22/-c8733c1e608c238b.JPG'; ?>" alt="<?php echo get_the_title(); ?>" />
                </a>
                <h4 class="article-info">
                  <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
                </h4>
              </div>

              <?php endwhile; wp_reset_postdata(); endif; ?>

            </div>
          </div>
          <div class="small-12 medium-12 large-3 cell">
            <div class="tabs tabs-vertical vertical flex-container flex-dir-column green-border slide-thumbs maximum-height" id="news_nav">

            <?php if ( $news_feat -> have_posts() ) : while ( $news_feat -> have_posts() ) : $news_feat -> the_post(); ?>

              <div class="tabs-title flex-child-auto flex-container flex-dir-column">
                <a class="flex-child-auto" href="#news<?php echo $post->ID; ?>"><?php echo get_the_title(); ?></a>
              </div>

            <?php endwhile; wp_reset_postdata(); endif; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="side" class="small-12 medium-4 cell">
      <div class="tiny-padding gset no-border">
        <h2 class="entry-title text-center screen-reader-text"><a href="/calendar">Featured Events</a></h2>
      </div>
      <div class="widget-wrapper medium-margin-bottom">
        <div class="grid-x small-up-2 text-center profile-feature profile-widget">
          <?php //$featured_events_arr = g365_conn( 'g365_display_events', [65, 6] );
          if( !empty($featured_events_arr) ) foreach( $featured_events_arr as $dex => $obj ) : 
          ?>
          <div class="cell">
            <div class="small-margin-bottom">
              <a href="<?php echo $obj->link; ?>" target="_blank">
                <img src="<?php echo (!empty($obj->logo_img)) ? $obj->logo_img : $default_event_img ?>" alt="<?php echo $obj->name; ?> official logo" />
                <p>
                  <?php echo ( empty($obj->short_name) ) ? $obj->name : $obj->short_name; ?><br>	
                  <small class="tiny-margin-top block"><?php echo ogp_build_dates($obj->dates); ?></small>
                </p>
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <a class="button expanded no-margin-bottom" href="/calendar">Full Calendar</a>
      </div>
      <?php $ogp_potm = get_post_meta($post->ID, 'ogp_potm', true);
      if( !empty($ogp_potm) ) : ?>
      <div class="widget-wrapper medium-margin-bottom">
        <div class="grid-x">
          <div class="cell">
            <img src="<?php echo $ogp_potm; ?>" alt="Players of the month by region. <?php the_modified_date(); ?>" />
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php $ogp_ctotm = get_post_meta($post->ID, 'ogp_ctotm', true);
      if( !empty($ogp_ctotm) ) : ?>
      <div class="widget-wrapper medium-margin-bottom">
        <div class="grid-x">
          <div class="cell">
            <img src="<?php echo $ogp_ctotm; ?>" alt="Club Team of the month. <?php the_modified_date(); ?>" />
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php } //end default hero featured image section ?>

<section id="content" class="site-main small-padding-top xlarge-padding-bottom grid-container">
  
<?php //if we have page content
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php the_content(); ?>

<?php endwhile; endif; ?>

</section>

<?php
//if we have a splash graphic, add  the elements to support, part 1
if( !empty($ogp_ad_info['splash']) ) echo $ogp_ad_info['splash'];

get_footer();

//if we have a splash graphic, initialize it now that foundation() has started, part 2
if( !empty($ogp_ad_info['splash']) ) echo '<script type="text/javascript">
    var ogp_closed = localStorage.getItem("ogp_close_today");
    var ogp_closed_date = localStorage.getItem("ogp_close_today_date");
    var ogp_now_date = new Date();
    if( ogp_closed_date !== null && new Date(ogp_closed_date).getDate() !== ogp_now_date.getDate() ) {
      localStorage.removeItem("ogp_close_today");
      localStorage.removeItem("ogp_close_today_date");
      ogp_closed = null;
    }
    if( ogp_closed === null ) {
      (function($){$("#ogp_home_reveal").foundation("open");})(jQuery);
    }
  </script>';

if( $tile_vid ) {
  print_r(
    '<script>
      var tag = document.createElement("script");
      tag.src = "https://youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName("script")[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      var tile_players = ' . json_encode( $tile_video_settings) . ';
      function onYouTubeIframeAPIReady() {
        tile_players.forEach( function( vid_settings, dex ) {
          vid_settings.data.events = {
            "onReady": onPlayerReady,
            "onStateChange": onPlayerStateChange
          };
          tile_players[dex]["video_ref"] = new YT.Player( vid_settings.id, vid_settings.data);
        });
      }
       function onPlayerReady(event) {
         event.target.playVideo();
         event.target.mute();
       }
       function onPlayerStateChange(event) {
        if( event.data === 0 ){
         event.target.playVideo();
        }
       }
    </script>'
  );
}

    
    
    
?>