<?php

namespace libforms\elements;

use Closure;
use JsonSerializable;

abstract class Element implements JsonSerializable {

	public function __construct(
		protected string   $text,
		protected ?Closure $callable = null
	)
	{
	}

	/**
	 * This abstract method denotes the type of element (text, button, etc.)
	 *
	 * @return string
	 */
	public abstract function getType(): string;


	/**
	 * @return array{type: string}
	 */
	public function jsonSerialize(): array {
		return [
			"type" => $this->getType()
		];
	}
}