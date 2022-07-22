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
use function array_values;
use function is_int;
use function var_export;

class Dropdown extends Element {

	/**
	 * @param array<int, string> $options - A list of strings to display in the dropdown.
	 * @param int $default - The index of the option to show when rendered.
	 * @param Closure(string): void|null $callable
	 */
	public function __construct(
		string $text,
		protected array $options = [],
		protected int $default = 0,
		?Closure $callable = null
	) {
		parent::__construct($text, $callable);
		// Validate dropdown options to prevent string keys.
		$this->options = array_values($options);
	}

	public function getType(): string {
		return "dropdown";
	}

	/**
	 * @return array{options: array<int, string>, default: int}
	 */
	public function getExtraData(): array {
		return [
			"options" => $this->options,
			"default" => $this->default
		];
	}

	/**
	 * @return array<int, string>
	 */
	public function getOptions(): array {
		return $this->options;
	}

	/**
	 * Checks if the data passed is an int and exists in the dropdown options.
	 * If validated, the data returned is the value at the received index.
	 */
	public function processData(mixed $data): string {
		if (!is_int($data) || !isset($this->options[$data])) {
			throw new FormValidationException("Invalid option selected: " . var_export($data, true));
		}
		return $this->options[$data];
	}
}