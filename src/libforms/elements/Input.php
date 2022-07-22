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

class Input extends Element {

	/**
	 * @param string $text
	 * @param string $placeholder
	 * @param string $default
	 * @param Closure(string): void|null $callable
	 */
	public function __construct(
		string           $text,
		protected string $placeholder,
		protected string $default = "",
		?Closure         $callable = null
	) {
		parent::__construct($text, $callable);
	}

	public function getType(): string {
		return "input";
	}

	/**
	 * @return array{placeholder: string, default: string}
	 */
	public function getExtraData(): array {
		return [
			"placeholder" => $this->placeholder,
			"default" => $this->default,
		];
	}

}