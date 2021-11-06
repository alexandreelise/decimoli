<?php
declare(strict_types=1);
/**
 * @package       compute
 * @author        Alexandre ELISÉ <contact@alexapi.cloud>
 * @copyright (c) 2009 -  . Alexandre ELISÉ . Tous droits réservés.
 * @license       Apache License 2.0
 * @link          https://alexapi.cloud
 */
if (!function_exists('decimoli'))
{
	/**
	 * Recursive function to compute patterns of decimal places when
	 * denominator is a repetition of 1 or more '3'
	 * and that the numerator is not divisible by the denominator.
	 * The decimal places "pattern" has as much digits than the denominator
	 * and repeats itself many times.
	 * I can't prove it yet but hopefully someone has already found this
	 * fun math puzzle
	 *
	 * @param   array  $storage  output as array
	 *                           n: numerator,
	 *                           d: demonimator
	 *                           c: computedDigitsNumerator
	 *                           r: result of each recursion step
	 *
	 */
	function decimoli(array $storage = ['n' => 1, 'd' => 3])
	{
		if ($storage['n'] === 0)
		{
			throw new InvalidArgumentException('Numerator must not be 0', 422);
		}
		if ($storage['d'] === 0)
		{
			throw new InvalidArgumentException('Denominator must not be 0', 422);
		}
		if (((int) $storage['n'] % (int) $storage['d']) === 0)
		{
			throw new InvalidArgumentException('Numerator must not be divisible by Denominator', 422);
		}
		
		if (!function_exists('cleanNumber'))
		{
			$cleanNumber = function (int $number): string {
				return trim(strval($number), '\s_,.+EeOxBbUuOo');
			};
		}
		
		if ($storage['n'] < 1)
		{
			throw new UnexpectedValueException('Processing only positive integers greater or equal to 1', 422);
		}
		$stringNumerator           = $cleanNumber($storage['n']);
		$howManyDigitsForNumerator = mb_strlen($stringNumerator);
		$computedDigitsNumerator   = (int) ($storage['c'] ?? $howManyDigitsForNumerator);
		if ($computedDigitsNumerator === 0)
		{
			debug_print_backtrace();
			exit;
		}
		
		$computedNumerator = (int) $stringNumerator;
		
		// we want the integer value after repeating the
		// "3" n many numerator digits time
		$computedDenominator = (int) str_repeat('3', $computedDigitsNumerator);
		
		// we want to reduce the possibilities at each recursion step
		$computedDigitsNumerator = $computedDigitsNumerator - 1;
		$storage                 = [
			'n' => $computedNumerator,
			'd' => $computedDenominator,
			'c' => $computedDigitsNumerator,
			'r' => ($computedNumerator / $computedDenominator),
		];
		
		return decimoli($storage);
	}
}
