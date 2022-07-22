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

class StepSlider extends Element {

	/**
	 * @param string $text
	 * @param array<int, string> $steps - A list of strings to display for each step of the slider.
	 * @param int $default - The index of the step to display when rendered.
	 * @param Closure(string): void|null $callable
	 */
	public function __construct(
		string $text,
		protected array $steps = [],
		protected int $default = 0,
		?Closure $callable = null
	) {
		parent::__construct($text, $callable);
		// Validate slider steps to prevent string keys.
		$this->steps = array_values($steps);
	}

	public function getType(): string {
		return "step_slider";
	}

	/**
	 * @return array<int, string>
	 */
	public function getSteps(): array {
		return $this->steps;
	}

	/**
	 * @return array{steps: array<int, string>, default: int}
	 */
	public function getExtraData(): array {
		return [
			"steps" => $this->steps,
			"default" => $this->default
		];
	}

	/**
	 * Ensures that the value is a valid int and exists in the element's steps.
	 * If validated, the data returned is the value at the received index.
	 *
	 * @param mixed $data
	 * @return string
	 */
	public function processData(mixed $data): string {
		if (!is_int($data)) {
			throw new FormValidationException("Received non-integer data for step-slider element: " . var_export($data, true));
		}
		if (!isset($this->steps[$data])) {
			throw new FormValidationException("Index $data does not exist in step-slider element");
		}
		return $this->steps[$data];
	}
}