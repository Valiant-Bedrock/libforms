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

class SimpleForm extends Form {

	/**
	 * @param string $title
	 * @param string $content
	 * @param array<int, Button> $buttons
	 * @param (Closure(Player): void)|null $onClose
	 */
	public function __construct(
		string $title,
		protected string $content = "",
		protected array $buttons = [],
		?Closure $onClose = null
	) {
		parent::__construct($title, $onClose);
		// Validate button indexes to prevent string keys.
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
		if (!is_int($data)) {
			return false;
		}
		$button = $this->buttons[$data] ?? null;
		$button?->handle($player);
		return $button !== null;
	}
}