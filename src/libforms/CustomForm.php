<?php

namespace libforms;

use pocketmine\player\Player;

class CustomForm extends Form {

	public function getType(): string {
		return "custom_form";
	}

	/**
	 * @return array{}
	 */
	public function getContent(): array {
		return [];
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
		return true;
	}
}