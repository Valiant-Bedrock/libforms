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
use pocketmine\utils\AssumptionFailedError;

class Slider extends Element {

	/**
	 * @param string $text
	 * @param int|float $minimum
	 * @param int|float $maximum
	 * @param int|float $step
	 * @param int|float|null $default
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
	 * @return array<string, mixed>
	 */
	public function jsonSerialize(): array {
		return parent::jsonSerialize() + [
			"min" => $this->minimum,
			"max" => $this->maximum,
			"step" => $this->step,
			"default" => $this->default ?? throw new AssumptionFailedError("Slider default value is null"),
		];
	}
}