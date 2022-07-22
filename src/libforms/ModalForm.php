<?php

namespace libforms;

use Closure;
use pocketmine\player\Player;
use libforms\buttons\Button;

class ModalForm extends Form {

	/**
	 * @param string $title
	 * @param string $content
	 * @param Button $primaryButton
	 * @param Button $secondaryButton
	 * @param (Closure(Player): void)|null $onClose
	 */
	public function __construct(
		string $title,
		protected string $content,
		protected Button $primaryButton,
		protected Button $secondaryButton,
		?Closure $onClose = null
	) {
		parent::__construct($title, $onClose);
	}

	public function getType(): string {
		return "modal";
	}

	public function getContent(): string {
		return $this->content;
	}

	/**
	 * @return array<string, string>
	 */
	public function getExtraData(): array {
		return [
			"button1" => $this->primaryButton->getText(),
			"button2" => $this->secondaryButton->getText()
		];
	}

	public function handleFormResponse(Player $player, mixed $data): bool {
		if(!is_bool($data)) {
			return false;
		}
		$button = $data ? $this->primaryButton : $this->secondaryButton;
		$button->handle($player);
		return true;
	}
}