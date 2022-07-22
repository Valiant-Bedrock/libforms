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
use libforms\buttons\Button;
use pocketmine\player\Player;
use function is_bool;

class ModalForm extends Form {

	/**
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
		if (!is_bool($data)) {
			return false;
		}
		$button = $data ? $this->primaryButton : $this->secondaryButton;
		$button->handle($player);
		return true;
	}
}