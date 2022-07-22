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
use libforms\elements\Dropdown;
use libforms\elements\Element;
use libforms\elements\Label;
use libforms\elements\StepSlider;
use pocketmine\form\FormValidationException;
use pocketmine\player\Player;
use pocketmine\utils\AssumptionFailedError;

class CustomForm extends Form {

	/**
	 * @param string $title
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

	/**
	 * @param Player $player
	 * @param mixed $data
	 * @return bool
	 */
	public function handleFormResponse(Player $player, mixed $data): bool {
		if (!is_array($data)) {
			return false;
		}
		foreach ($data as $index => $value) {
			$element = $this->elements[$index] ?? null;
			if ($element === null || $element instanceof Label) {
				continue;
			}
			$element->run(match (true) {
				$element instanceof Dropdown => $element->getOptions()[$value] ?? throw new FormValidationException("Invalid dropdown option index"),
				$element instanceof StepSlider => $element->getSteps()[$value] ?? throw new FormValidationException("Invalid step slider option index"),
				default => $value
			});
		}
		return true;
	}
}