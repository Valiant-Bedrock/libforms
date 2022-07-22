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

class Dropdown extends Element {

	/**
	 * @param string $text
	 * @param array<int, string> $options
	 * @param int $default
	 * @param Closure(string): void|null $callable
	 */
	public function __construct(
		string $text,
		protected array $options = [],
		protected int $default = 0,
		?Closure $callable = null
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
}