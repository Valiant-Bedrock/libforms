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

class Toggle extends Element {

	/**
	 * @param string $text
	 * @param bool $default
	 * @param Closure(bool): void|null $callable
	 */
	public function __construct(
		string $text,
		protected bool $default = false,
		?Closure $callable = null
	) {
		parent::__construct($text, $callable);
	}

	public function getType(): string {
		return "toggle";
	}

	/**
	 * @return array<string, mixed>
	 */
	public function jsonSerialize(): array {
		return parent::jsonSerialize() + [
			"default" => $this->default
		];
	}
}