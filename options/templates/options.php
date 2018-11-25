<?php
/**
 * <%= optionsname %>.
 *
 * @since   <%= version %>
 * @package <%= mainclassname %>
 */


/**
 * <%= optionsname %> class.
 *
 * @since <%= version %>
 */
class <%= classname %> {
	/**
	 * Parent plugin class.
	 *
	 * @var    <%= mainclassname %>
	 * @since  <%= version %>
	 */
	protected $plugin = null;

	/**
	 * Option key, and option page slug.
	 *
	 * @var    string
	 * @since  <%= version %>
	 */
	protected static $key = '<%= optionsprefix %>';

	/**
	 * Options page metabox ID.
	 *
	 * @var    string
	 * @since  <%= version %>
	 */
	protected static $metabox_id = '<%= optionsprefix %>_metabox';

	/**
	 * Options Page title.
	 *
	 * @var    string
	 * @since  <%= version %>
	 */
	protected $title = '';

	/**
	 * Options Page hook.
	 *
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Constructor.
	 *
	 * @since  <%= version %>
	 *
	 * @param  <%= mainclassname %> $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();

		// Set our title.
		$this->title = esc_attr__( '<%= optionsname %>', '<%= slug %>' );
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  <%= version %>
	 */
	public function hooks() {

		// Hook in our actions to the admin.
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
	}

	/**
	 * Register our setting to WP.
	 *
	 * @since  <%= version %>
	 */
	public function admin_init() {
		register_setting( self::$key, self::$key );
	}

	/**
	 * Add menu options page.
	 *
	 * @since  <%= version %>
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page(
			$this->title,
			$this->title,
			'manage_options',
			self::$key,
			array( $this, 'admin_page_display' )
		);
	}

	/**
	 * Admin page markup
	 *
	 * @since  <%= version %>
	 */
	public function admin_page_display() {
		?>
		<div class="wrap options-page <?php echo esc_attr( self::$key ); ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php // Your settings here. ?>
		</div>
		<?php
	}
}
