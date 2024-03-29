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
use function array_keys;
use function array_values;
use function gettype;
use function is_int;
use function var_export;

class Dropdown extends Element {

	/**
	 * @param string $text - The text to display next to the dropdown.
	 * @param array<string> $options - A list of strings to display in the dropdown.
	 * @param int $default - The index of the option to show when rendered.
	 * @param (Closure(($callWithKey is true ? array-key : string)): void)|null $callable
	 * @param bool $callWithKey - Whether to call the callable with the key of the selected option rather than the value.
	 */
	public function __construct(
		string $text,
		protected array $options = [],
		protected int $default = 0,
		?Closure $callable = null,
		protected bool $callWithKey = false
	) {
		parent::__construct($text, $callable);
	}

	public function getType(): string {
		return "dropdown";
	}

	/**
	 * @return array{options: array<int, string>, default: int}
	 */
	public function getExtraData(): array {
		return [
			"options" => array_values($this->options),
			"default" => $this->default
		];
	}

	/**
	 * @return array<string>
	 */
	public function getOptions(): array {
		return $this->options;
	}

	/**
	 * @return array-key
	 */
	private function fetchKeyFromIndex(int $index): int|string {
		$keys = array_keys($this->options);
		return $keys[$index];
	}

	/**
	 * Checks if the data passed is an int and exists in the dropdown options.
	 * If validated, the data returned is the value at the received index.
	 */
	public function processData(mixed $data): int|string {
		if (!is_int($data)) {
			throw new FormValidationException("Expected int, got " . gettype($data));
		}
		$key = $this->fetchKeyFromIndex($data);
		if (!isset($this->options[$key])) {
			throw new FormValidationException("Invalid option selected: " . var_export($data, true));
		}
		return $this->callWithKey ? $key : $this->options[$key];
	}
}