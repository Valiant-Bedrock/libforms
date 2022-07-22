<?php
/**
 *  _ _ _      __
 * | (_) |    / _|
 * | |_| |__ | |_ ___  _ __ _ __ ___  ___
 * | | | '_ \|  _/ _ \| '__| '_ ` _ \/ __|
 * | | | |_) | || (_) | |  | | | | |a\__ \
 * |_|_|_.__/|_| \___/|_|  |_| |_| |_|___/
 *
 * This library is free software licensed under the MIT license.
 * For more information about the license, visit the link below:
 *
 * https://opensource.org/licenses/MIT
 *
 * Copyright (c) 2022 Matthew Jordan
 */
declare(strict_types=1);

namespace libforms\elements;

use Closure;
use pocketmine\form\FormValidationException;
use pocketmine\utils\AssumptionFailedError;

class Slider extends Element {

	/**
	 * @param string $text
	 * @param int|float $minimum - The minimum value of the slider.
	 * @param int|float $maximum - The maximum value of the slider.
	 * @param int|float $step - The amount to increment/decrement by when the slider is moved.
	 * @param int|float|null $default - The default value of the slider to display. If null, the slider will default to the minimum value.
	 * @param Closure(int|float): void|null $callable
	 */
	public function __construct(
		string                   $text,
		protected int|float      $minimum,
		protected int|float      $maximum,
		protected int|float      $step,
		protected int|float|null $default = null,
		?Closure                 $callable = null
	) {
		$this->default = $default ?? $minimum;
		parent::__construct($text, $callable);
	}

	public function getType(): string {
		return "slider";
	}

	/**
	 * @return array{min: int|float, max: int|float, step: int|float, default: int|float}
	 */
	public function getExtraData(): array {
		return [
			"min" => $this->minimum,
			"max" => $this->maximum,
			"step" => $this->step,
			"default" => $this->default ?? throw new AssumptionFailedError("Slider default value is null"),
		];
	}

	/**
	 * Ensures that a value is an integer/float and within the range of the slider.
	 *
	 * @param mixed $data
	 * @return int|float
	 */
	public function processData(mixed $data): int|float {
		//
		if (!is_int($data) && !is_float($data)) {
			throw new FormValidationException("Received non-numeric data for slider: " . var_export($data, true));
		}
		if ($data < $this->minimum && $data > $this->maximum) {
			throw new FormValidationException("Received data out of range for slider: " . var_export($data, true));
		}
		// Ensure that the value is cast to the proper numerical type.
		return floor($data) === $data ? (int) $data : (float) $data;
	}
}