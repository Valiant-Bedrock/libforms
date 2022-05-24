<?php

namespace libforms;

use Closure;
use libforms\elements\Element;
use libforms\elements\Label;
use pocketmine\player\Player;

class CustomForm extends Form {

	/**
	 * @param string $title
	 * @param array<Element> $elements
	 * @param Closure|null $onClose
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
		if(is_array($data)) {
			foreach($data as $index => $value) {
				$element = $this->elements[$index] ?? null;
				if($element === null || $element instanceof Label) {
					continue;
				}
				$element->run($value);
			}
			return true;
		}
		return false;
	}
}