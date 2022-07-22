<?php

namespace libforms;

use Closure;
use pocketmine\player\Player;
use libforms\buttons\Button;

class SimpleForm extends Form {

	/**
	 * @param string $title
	 * @param string $content
	 * @param array<Button> $buttons
	 * @param (Closure(Player): void)|null $onClose
	 */
	public function __construct(
		string $title,
		protected string $content = "",
		protected array $buttons = [],
		?Closure $onClose = null
	) {
		parent::__construct($title, $onClose);
		// Validate button indexes
		$this->buttons = array_values($buttons);
	}

	public function getType(): string {
		return "form";
	}

	public function getContent(): string {
		return $this->content;
	}

	/**
	 * Returns a list of string-encoded buttons
	 *
	 * @return array<string, array<Button>>
	 */
	public function getExtraData(): array {
		return ["buttons" => $this->buttons];
	}

	public function handleFormResponse(Player $player, mixed $data): bool {
		if(!is_int($data)) {
			return false;
		}
		$button = $this->buttons[$data] ?? null;
		$button?->handle($player);
		return $button !== null;
	}
}