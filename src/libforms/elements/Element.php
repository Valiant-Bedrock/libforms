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
use JsonSerializable;

abstract class Element implements JsonSerializable {

	/**
	 * @param string $text
	 * @param Closure|null $callable
	 */
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
	 * Attempts to run the associated callable with the returned value
	 *
	 * @param mixed $data
	 * @return void
	 */
	public function run(mixed $data): void {
		if ($this->callable !== null) {
			($this->callable)($data);
		}
	}


	/**
	 * @return array{text: string, type: string}
	 */
	public function jsonSerialize(): array {
		return [
			"text" => $this->text,
			"type" => $this->getType()
		];
	}
}