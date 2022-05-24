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

class StepSlider extends Element {

	/**
	 * @param string $text
	 * @param array<string> $steps
	 * @param int $default
	 * @param Closure|null $callable
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
	 * @return array<string, mixed>
	 */
	public function jsonSerialize(): array {
		return parent::jsonSerialize() + [
			"steps" => $this->steps,
			"default" => $this->default
		];
	}
}