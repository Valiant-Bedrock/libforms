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

class StepSlider extends Element {

	/**
	 * @param string $text
	 * @param array<string> $steps
	 * @param int $default
	 * @param Closure(string): void|null $callable
	 */
	public function __construct(
		string $text,
		protected array $steps = [],
		protected int $default = 0,
		?Closure $callable = null
	) {
		parent::__construct($text, $callable);
	}

	public function getType(): string {
		return "step_slider";
	}

	/**
	 * @return array<string>
	 */
	public function getSteps(): array {
		return $this->steps;
	}

	/**
	 * @return array{steps: array<string>, default: int}
	 */
	public function getExtraData(): array {
		return [
			"steps" => $this->steps,
			"default" => $this->default
		];
	}
}