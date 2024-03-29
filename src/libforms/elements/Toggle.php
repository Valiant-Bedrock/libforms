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
use function is_bool;
use function var_export;

class Toggle extends Element {

	/**
	 * @param bool $default - If true, the toggle will be rendered as on. Otherwise, it will be rendered as off.
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
	 * @return array{default: bool}
	 */
	public function getExtraData(): array {
		return [
			"default" => $this->default
		];
	}

	/**
	 * Ensures that the data is a boolean.
	 */
	public function processData(mixed $data): bool {
		if (!is_bool($data)) {
			throw new FormValidationException("Received non-bool data for toggle element: " . var_export($data, true));
		}
		return $data;
	}
}