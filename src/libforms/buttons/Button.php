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

namespace libforms\buttons;

use Closure;
use JsonSerializable;
use pocketmine\player\Player;

class Button implements JsonSerializable {

	/**
	 * @param (Closure(Player): void)|null $onClick
	 */
	public function __construct(
		protected string   $text,
		protected ?Closure $onClick = null
	)
	{
	}

	public function getText(): string {
		return $this->text;
	}

	public function handle(Player $player): void {
		if ($this->onClick !== null) {
			($this->onClick)($player);
		}
	}

	/**
	 * @return array<string, mixed>
	 */
	public function jsonSerialize(): array {
		return ["text" => $this->text];
	}
}