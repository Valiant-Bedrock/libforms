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
	 * Any associated data that is needed to successfully render the element.
	 *
	 * @return array<string, mixed>
	 */
	public abstract function getExtraData(): array;

	/**
	 * Allows an element to process and modify the data before it is forwarded to the callback function.
	 * By default, this method does nothing but return the data as-is.
	 *
	 * @param mixed $data
	 * @return mixed
	 */
	public function processData(mixed $data): mixed {
		return $data;
	}

	/**
	 * Attempts to run the associated callable with the returned value
	 *
	 * @param mixed $data
	 * @return void
	 */
	public function run(mixed $data): void {
		if ($this->callable !== null) {
			// Process the data before passing it to the callback function
			$processed = $this->processData($data);
			($this->callable)($processed);
		}
	}


	/**
	 * @return array<string, mixed>
	 */
	public function jsonSerialize(): array {
		return [
			"text" => $this->text,
			"type" => $this->getType()
		] + $this->getExtraData();
	}
}