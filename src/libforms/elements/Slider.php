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
use pocketmine\utils\AssumptionFailedError;

class Slider extends Element {

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