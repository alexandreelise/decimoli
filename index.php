<?php
declare(strict_types=1);
/**
 * @package       index
 * @author        Alexandre ELISÉ <contact@alexapi.cloud>
 * @copyright (c) 2009 -  . Alexandre ELISÉ . Tous droits réservés.
 * @license       Apache License 2.0
 * @link          https://alexapi.cloud
 */
require_once __DIR__ . '/compute.php';
decimoli([
			'n' => (int) ($_SERVER['APP_NUMERATOR'] ?? 1),
			'd' => (int) ($_SERVER['APP_DENOMINATOR'] ?? 3),
		]
);
