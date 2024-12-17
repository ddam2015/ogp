<?php
/**
 * Template Name: Calendar
 */
get_header();
// $g365_ad_info = g365_start_ads( $post->ID );

$default_profile_img = get_site_url() . '/wp-content/uploads/event-profiles/g365_blank-placeholder_100x100.png';

?>

<section id="content" class="grid-x grid-margin-x site-main large-padding-top xlarge-padding-bottom<?php if ( isset($g365_ad_info['go']) && $g365_ad_info['go'] ) echo $g365_ad_info['ad_section_class'];  ?>" role="main">
	<div class="cell small-12">
		<?php
    // if ( isset($g365_ad_info['go']) && $g365_ad_info['go'] ) echo $g365_ad_info['ad_before'] . $g365_ad_info['ad_content'] . $g365_ad_info['ad_after'];
		if ( have_posts() ) : while ( have_posts() ) : the_post();

			get_template_part( 'page-parts/content', get_post_type() );

		endwhile;
		// If no content, include the "No posts found" template.
		else : 

			get_template_part( 'page-parts/content', 'none' );

		endif;

    global $wp_query;
    //if we have a calendar, show it otherwise show the master
//     $group_data_package_id = isset($wp_query->query_vars['cl_id']) ? $wp_query->query_vars['cl_id'] : 342;
    $group_data_package = ( empty($wp_query->query_vars['cl_id']) ? 342 : $wp_query->query_vars['cl_id'] );
    
    
//     echo '<pre class="">';
//     print_r($group_data_package);
//     echo '</pre>';
    
    //get the package
//     $group_data_package = g365_get_groups_data( $group_data_package, 2 );
    $group_data_package = spp_fn(['fn_name'=>'g365_get_groups_data', 'arguments'=>[$group_data_package, 2]]);
//     echo '<pre class="">';
//     print_r($group_data_package);
//     echo '</pre>';
    
    //if we strike out with the package, then load the default
    if ( empty($group_data_package) || !is_object($group_data_package) || $group_data_package === null ) {
        $group_data_package = spp_fn(['fn_name'=>'g365_get_groups_data', 'arguments'=>[342, 2]]);
    }
    $current_time = date("Y-m-d");
//     echo '<pre class="">';
//     print_r($group_data_package);
//     echo '</pre>';

    //look into href for brands and 2bd funnc
    //if this is just a single calendar, then don't add the top navigation
    if( $group_data_package->groups == 1 ) : ?>
		<ul class="calendar-tabs-container tabs separate grid-x small-up-2 align-center text-center collapse" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-tabs id="event-tabs" role="tablist">
			<?php 
      foreach( $group_data_package->records as $dex => $group_data ) : if( empty($group_data->item_ids) ) continue;       
      $updated_string = str_replace("Events", "", $group_data->name);
      $updated_event_name = trim($updated_string); // To remove any leading or trailing spaces
// //       echo 'here: ' . $group_data->name . ' // ' . $updated_event_name; 
//           echo '<pre>';
//           print_r($group_data->records); // Print a readable version of each record
//           echo '</pre>';
      ?>
				<li class="tabs-title cell<?php echo ( $dex == 0 ) ? ' is-active large-expand' : ''; ?>">
					<a href="#<?php echo strtolower(preg_replace('/\s+|\.|-/', '', $group_data->name)); ?>" role="tab"><?php echo $updated_event_name; ?></a></li>
			<?php
      endforeach; 
      ?>
		</ul>
		<?php endif; ?>
		<div id="tables-container" class="tabs-content table-data table-reveal medium-padding-top gset-wrap-tabs" data-tabs-content="event-tabs">
			<?php foreach( ( $group_data_package->groups == 1 ? $group_data_package->records : array($group_data_package) ) as $dex => $group_data ) : if( empty($group_data->item_ids) ) continue;
				$group_data->handle = strtolower(preg_replace('/\s+|\.|-/', '', $group_data->name));
        $updated_event_header = str_replace("Events", "", $group_data->name);
        $updated_event_header = trim($updated_event_header);
        
			?>
			<div class="tabs-panel no-padding<?php echo ( $dex == 0 ) ? ' is-active' : 'hide'; ?>" id="<?php echo $group_data->handle; ?>" role="tabpanel">
				<div class="grid-x calendar__container">
					<h2 class="cell small-margin-bottom"><?php echo $updated_event_header; ?></h2>
					<div class="cell">

                
              <?php 
                $map = array();
                foreach( $group_data->records as $sub_dex => $sub_group_data ) :  //var_dump($sub_group_data);
                $event_time = date("Y-m-d", strtotime($sub_group_data->eventtime));
                if( intval($sub_group_data->enabled) !== 1 || $current_time >= $event_time || date("Y-m-d", strtotime($current_time . ' +1 year')) <= $event_time ) continue;   
                $event_time_sep = explode("-", $event_time);
                $event_month = (int)$event_time_sep[1];
                $dateObj   = DateTime::createFromFormat('!m', $event_month);
                $monthName = $dateObj->format('F'); // March
                if (!isset($map[$monthName])) {
                    $map[$monthName] = array();
                };
                $map[$monthName][] = $sub_group_data;
                ?>
            
                
							

							<?php endforeach; ?>

            
            <?php
                  $monthKeys = array_keys($map);
                  for ($i = 0; $i < count($map); $i++) {
                    $month = $monthKeys[$i];
                    echo "<div class='calendarMonthContainer'>";
                      echo "<div class='calendarHeaderContainer'><h3 class='calendarAccordian active'>{$month}</h3><p class='minusPlus active'>-</p><p class='plusMinus hide'>+</p></div>";
                      echo "<table class='calendarInfo'>";
                        echo "<thead>";
                          echo "<tr>";
                            echo "<th class='text-center'>EVENT</th>";
                            echo "<th class='text-center'>DATE</th>";
                            echo "<th class='text-center'>NAME</th>";
                            echo "<th class='text-center'>LOCATION</th>";
                          echo "</tr>";
                        echo "</thead>";
                        foreach($map[$month] as $event) {
//                           $eventDate = g365_build_dates($event->dates, 2);                         
                            if (strpos($event->dates, '|') !== false) {
                                // Split the dates string by the '|' delimiter
                                $dates_array = explode('|', $event->dates);

                                // Extract the month and year from the first date
                                $first_date = $dates_array[0];
                                $first_date_parts = explode(' ', $first_date);
                                $month = $first_date_parts[0];
                                $year = $first_date_parts[2];

                                // Extract the first and last day
                                $first_day = rtrim($first_date_parts[1], ','); // Assuming the format is "Month Day, Year"
                                $last_date = end($dates_array);
                                $last_day = rtrim(explode(' ', $last_date)[1], ','); // Assuming the format is "Month Day, Year"
                            } else {
                                // If there's only one date, return it in the "Month Day, Year" format
                                $date_parts = explode(' ', $event->dates);
                                $month = $date_parts[0];
                                $day = rtrim($date_parts[1], ','); // Remove the trailing comma
                                $year = $date_parts[2];
                            }
                          
                          $full_date = $month . ' ' . $first_day . '-' . $last_day . ', ' . $year;
//                           echo "result here {$full_date} : {$month} {$first_day}-{$last_day}, {$year} <br>"; 
//                           $eventDate = spp_fn(['fn_name'=>'g365_build_dates', 'arguments'=>[$event->dates, 2]]);
                          $eventLocation = implode('<br>', explode('|', $event->locations));
                          echo "<tr>";
                          echo "<td class='text-center'><a href='{$event -> link}'><img class='event-logo' src='{$event -> logo_img}' alt='{$event -> name} logo' /></a></td>";
                          echo "<td class='text-center'><a href='{$event -> link}'>{$full_date}</a></td>";
                          echo "<td class='text-center'><a href='{$event -> link}'>{$event->short_name}</a></td>";
                          echo "<td class='text-center event-location'><a href='{$event -> link}'>{$eventLocation}</a></td>";
                          echo "</tr>";
                         };
                      echo "</table>";
                    echo "</div>";
                   };
                ?>
            
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php
    //the endosed opporators will always be the same
//     $endorsed_event_operators = g365_get_groups_data( 46, 1 );
    if( !empty($endorsed_event_operators) ) : ?>
		<div id="endorsed-operators" class="xlarge-padding-bottom"></div>
		<h2 class="xlarge-margin-top medium-margin-bottom"><?php echo $endorsed_event_operators->name; ?></h2>
		<div class="grid-x small-up-2 medium-up-4 large-up-6 align-center text-center">
			<?php foreach( $endorsed_event_operators->records as $dex => $org ) : ?>
			<div class="cell medium-margin-bottom">
				<a href="<?php echo get_site_url(); ?>/club/<?php echo $org->nickname; ?>">
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/org-logos/<?php echo $org->profile_img; ?>" alt="<?php echo $org->name; ?> official logo" /><br>
					<?php echo $org->name; ?><br>
					<small>(<?php echo $org->city; ?>, <?php echo $org->state; ?>)</small>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?> 

<script>
  
    let accHead = document.getElementsByClassName("calendarAccordian");
    let accInfo = document.getElementsByClassName("calendarInfo");
    let accPlus = document.getElementsByClassName("plusMinus");
    let accMinus = document.getElementsByClassName("minusPlus");

    for (let i = 0; i < accHead.length; i++) {
        accHead[i].addEventListener("click", function() {
            this.classList.toggle("active");
            accPlus[i].classList.toggle("active");
            accMinus[i].classList.toggle("active");      
            accInfo[i].classList.toggle("hide");
            accPlus[i].classList.toggle("hide");
            accMinus[i].classList.toggle("hide"); 
        });
    }
  
    // Tab functionality
//     document.querySelectorAll('.tabs-title a').forEach(tab => {
// //         tab.addEventListener('click', function(event) {
// //             event.preventDefault();
// //             document.querySelectorAll('.tabs-title').forEach(tab => tab.classList.remove('is-active'));
// //             this.parentElement.classList.add('is-active');
// //             let targetPanel = this.getAttribute('href').substring(1);
// //             document.querySelectorAll('.tabs-panel').forEach(panel => {
// //                 if (panel.id === targetPanel) {
// //                     panel.classList.add('is-active');
// //                     panel.classList.remove('hide');
// //                 } else {
// //                     panel.classList.remove('is-active');
// //                     panel.classList.add('hide');
// //                 }
// //             });
// //         });
//     });
  
//   re-add menu fx
  
</script>
