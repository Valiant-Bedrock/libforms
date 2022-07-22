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

namespace libforms;

use Closure;
use libforms\elements\Element;
use pocketmine\form\FormValidationException;
use pocketmine\player\Player;
use function is_array;

class CustomForm extends Form {

	/**
	 * @param array<Element> $elements
	 * @param (Closure(Player): void)|null $onClose
	 */
	public function __construct(
		string $title,
		protected array $elements = [],
		?Closure $onClose = null
	) {
		parent::__construct($title, $onClose);
	}

	public function getType(): string {
		return "custom_form";
	}

	/**
	 * @return array<Element>
	 */
	public function getContent(): array {
		return $this->elements;
	}

	/**
	 * @return array{}
	 */
	public function getExtraData(): array {
		return [];
	}

	public function handleFormResponse(Player $player, mixed $data): bool {
		if (!is_array($data)) {
			return false;
		}
		foreach ($data as $index => $value) {
			$element = $this->elements[$index] ?? null;
			if ($element === null) {
				throw new FormValidationException("Received null data for element at index $index");
			}
			$element->run($value);
		}
		return true;
	}
}