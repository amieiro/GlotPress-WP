<?php

class GP_Local_Own_Translator {

	public function __construct() {
		add_filter( 'gp_projects', array( $this, 'add_installed_plugins' ), 10, 2 );
		add_filter( 'gp_projects', array( $this, 'add_installed_themes' ), 10, 2 );
		add_filter( 'gp_link_project_edit_get', array( $this, 'remove_edit_link' ), 10, 1 );
		add_filter( 'gp_link_project_delete_get', array( $this, 'remove_delete_link' ), 10, 1 );
	}

	/**
	 * Adds the installed plugins to the translation list.
	 *
	 * @param array $projects
	 * @param int   $project_id
	 *
	 * @return array
	 */
	public function add_installed_plugins( array $projects, int $project_id ): array {
		$plugins = $projects;
		if ( get_option( 'gp_local_translator' ) ) {
			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}
			$local_plugins = get_plugins();
			foreach ( $local_plugins as $local_plugin ) {
				if ( empty( $local_plugin['TextDomain'] ) ) {
					$local_plugin['TextDomain'] = sanitize_title( $local_plugin['Name'] );
				}
				$plugin       = new GP_Project();
				$plugin->name = __( 'Plugin: ' ) . $local_plugin['Name'];
				$plugin->slug = $local_plugin['TextDomain'];
				$plugin->path = $local_plugin['TextDomain'];

				$plugins[] = $plugin;
			}
		}

		return $plugins;
	}


	/**
	 * Adds the installed themes to the translation list.
	 *
	 * @param array $projects
	 * @param int   $project_id
	 *
	 * @return array
	 */
	public function add_installed_themes( array $projects, int $project_id ): array {
		$themes = $projects;
		if ( get_option( 'gp_local_translator' ) ) {
			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/theme.php';
			}
			$local_themes = wp_get_themes();
			foreach ( $local_themes as $local_theme ) {
				if ( empty( $local_theme['TextDomain'] ) ) {
					$local_theme['TextDomain'] = sanitize_title( $local_theme['Name'] );
				}
				$theme       = new GP_Project();
				$theme->name = __( 'Theme: ' ) . $local_theme['Name'];
				$theme->slug = $local_theme['TextDomain'];
				$theme->path = $local_theme['TextDomain'];

				$themes[] = $theme;
			}
		}

		return $themes;
	}

	/**
	 * Removes the edit link from the project list.
	 *
	 * @param GP_Project $project
	 *
	 * @return null
	 */
	public function remove_edit_link( GP_Project $project ) {
		return null;
	}

	/**
	 * Removes the delete link from the project list.
	 *
	 * @param GP_Project $project
	 *
	 * @return null
	 */
	public function remove_delete_link( GP_Project $project ) {
		return null;
	}
}

new GP_Local_Own_Translator();
