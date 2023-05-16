<?php

if ( ! class_exists( 'Answerable' ) ) {
	/**
	 * Answerable class.
	 */
	final class Answerable {

		/**
		 * Main function.
		 *
		 * @return void
		 */
		public static function start(): void {
			self::includes();
			session_start();
			self::start_debugger();
		}

		/**
		 * Start debugger.
		 *
		 * @return void
		 */
		private static function start_debugger(): void {
			ini_set( 'display_errors', '1' );
			ini_set( 'display_startup_errors', '1' );
			error_reporting( E_ALL );
		}

		/**
		 * Includes all classes.
		 *
		 * @return void
		 */
		private static function includes():void {
			require_once 'classes/AlertManager.php';
			require_once 'classes/Database.php';
			require_once 'classes/Component.php';
			require_once 'core/connection-helpers.php';
			require_once 'core/session-helpers.php';
		}

	}
}
