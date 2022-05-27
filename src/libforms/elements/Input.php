<?php
/**
 *
 * Copyright (C) 2020 - 2022 | Matthew Jordan
 *
 * This program is private software. You may not redistribute this software, or
 * any derivative works of this software, in source or binary form, without
 * the express permission of the owner.
 *
 * @author sylvrs
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
	 * @return array<string, mixed>
	 */
	public function jsonSerialize(): array {
		return parent::jsonSerialize() + [
			"placeholder" => $this->placeholder,
			"default" => $this->default,
		];
	}
}