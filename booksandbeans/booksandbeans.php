<? 
/*
Plugin Name: Books & Beans
Plugin URI: http://www.booksandbeans.de/
Description: Renders articles and makes ePubs out of it.
Version: 1.0
Author: Michael Schneider
Author URI: http://www.booksandbeans.de/
Update Server: http://www.booksandbeans.de/ePub/wp/
Min WP Version: 1.5
Max WP Version: 2.0.4
*/


class  booksbeans{

function getTitleandPost($content) {


global $post;

			// If we didn't get a post parameter then use the global one.
			if (!isset($thispost))
			{
				$thispost = $post;
			}
			else
			{
				// In general, $thispost will only contain the ID and Title and we need more
				// So get it now.
				$thispost = get_post($thispost->ID);
			}
				
				$output = $thispost->post_content;
				$output = nl2br($output);
				
				$title = $thispost->post_title;
			#$output2 = htmlspecialchars($output);
			#$output2 = preg_replace('/<[^>]+>/','',$output);
			
				/*
				 * Links werden aussortiert, um keine Probleme zu machen.
				 * 
				 */
			#	$output2 = preg_replace('/<a[^>]+>/','',$output);
		#		$output2 = preg_replace('/<\/a>/','',$output2);
	#			$output2 = preg_replace('/<img[^>]+>/','Bild',$output2);
			
			
			
			$output = str_replace("'","&rsquo;",$output);
				
		
			$uri = $_SERVER['HTTP_REFERER'] ;
			
			
			$form = $output. "<br><bR> 
							<form action='http://www.booksandbeans.de/bb/default.php' method='post' target='_blank'>
							<input type='hidden' name='txt' value='<h1>".$title."</h1>".$output."'>
							<input type='hidden' name='title' value='".$title."'>
							
							
							<input type='hidden' name='uid' value='1'>
							<input type='hidden' name='bookit' value='1'>
							
							<input type='image' src='./wp-content/plugins/booksandbeans/images/bb_icon.gif' alt='Absenden'>
							</form>";
			
			return $form;
		}	
}

$booksandbeans = new booksbeans();

add_filter('the_content', array(&$booksandbeans, 'getTitleandPost'));


?>