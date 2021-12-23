<?php // List available Tri Plugins on an admin page

function add_tri_menu() {
	add_theme_page( 'Tri Addons', 'Tri Addons', 'activate_plugins', 'tri-addons', 'tri_addons_page_add' );
}
add_action('admin_menu', 'add_tri_menu');


function tri_addons_page_add() { ?>
	<div class="wrap">
		<h1>Tri Theme Addons</h1>
		The following are available add-ons to extend the Tri themes functionality.
		<br />
		<br />
		<?php $tri_addons_array = get_tri_addons();
		if( ! empty( $tri_addons_array ) ) { ?>

			<div id="tri-available-addons">
				<?php foreach( $tri_addons_array['tri'] as $product ) :
					// Dont include Tri Theme
					if ( 'Tri Theme' == $product['title'] ) { continue; } ?>

					<div class="tri-addon">
						<a href="<?php echo esc_url( $product['link'] ); ?>" class="tri-addon-img-container" target="_blank"><img src="<?php echo esc_url( $product['thumbnail'] ); ?>" class="tri-addon-img" width="318" height="118"  /></a>
						<div class="tri-addon-inner">
							<h4 class="tri-addon-title"><?php echo esc_html( $product['title'] ); ?></h4>
							<p class="tri-addon-excerpt"><?php echo esc_html( wp_trim_words( $product['excerpt'], 21 ) ); ?></p>
							<a href="<?php echo esc_url( $product['link'] ); ?>" class="button-secondary tri-addon-btn" target="_blank">Get This Addon</a>
						</div>
					</div>

				<?php endforeach; ?>
			</div>

			<div style="overflow: hidden;width:100%;">
				<h2>Micellaneous Addons</h2>
				The following are addons that are not necessarily made to extend Tri but you can use them to enhance your website.
				<br />
				<br />
				<div id="tri-misc-addons">
					<?php foreach( $tri_addons_array['misc'] as $product ) :
						// Dont include Tri Theme
						if ( 'Tri Theme' == $product['title'] ) { continue; } ?>

						<div class="tri-addon">
							<a href="<?php echo esc_url( $product['link'] ); ?>" class="tri-addon-img-container" target="_blank"><img src="<?php echo esc_url( $product['thumbnail'] ); ?>" class="tri-addon-img" width="318" height="118"  /></a>
							<div class="tri-addon-inner">
								<h4 class="tri-addon-title"><?php echo esc_attr( $product['title'] ); ?></h4>
								<p class="tri-addon-excerpt"><?php echo esc_attr( wp_trim_words( $product['excerpt'], 21 ) ); ?></p>
								<a href="<?php echo esc_url( $product['link'] ); ?>" class="button-secondary tri-addon-btn" target="_blank">Get This Addon</a>
							</div>
						</div>

					<?php endforeach; ?>
				</div>
			</div>
		<?php } ?>
	</div>
<?php }

function get_tri_addons() {
	// Do we have this information in our transients already?
	$transient = get_transient( 'tri_addons' );

	// Yep!  Just return it and we're done.
	if( !empty( $transient ) ) {
		// The function will return here every time after the first time it is run, until the transient expires.
		return $transient;

	// Nope!  We gotta make a call.
	} else {

		// Get WP Absolutes list of products
		$url = 'https://wpabsolute.com/edd-api/products/';

		$request = wp_remote_get( $url );

		if( is_wp_error( $request ) ) {
			return false; // Bail early
		}

		$body = wp_remote_retrieve_body( $request );

		$data = json_decode($body);

		$trimmed_data = array();
		$tri_plugins = array();
		$misc_plugins = array();

		// Loop through plugins and sort
		foreach ($data->products as $product) {
			$product = $product->info;

			if ( isset( $product->tags ) ) {
				foreach ($product->tags as $tag) {
					if ('misc' == $tag->slug) {
						$misc_plugins[] = array(
							'link' => $product->link,
							'excerpt' => wp_trim_words( $product->content, 30 ),
							'thumbnail' => $product->thumbnail,
							'title' => $product->title
						);
						break;
					} elseif('tri' == $tag->slug) {
						$tri_plugins[] = array(
							'link' => $product->link,
							'excerpt' => wp_trim_words( $product->content, 30 ),
							'thumbnail' => $product->thumbnail,
							'title' => $product->title
						);
						break;
					}
				}
			}
		}

		$trimmed_data = array(
			'misc' => $misc_plugins,
			'tri' => $tri_plugins
		);
		// Save the API response so we don't have to call again until tomorrow.
		set_transient( 'tri_addons', $trimmed_data, 14 * DAY_IN_SECONDS );

		// Return the list of Tri Addons.
		// The function will return here the first time it is run, and then once again, each time the transient expires.
		return $trimmed_data;
	}
}
