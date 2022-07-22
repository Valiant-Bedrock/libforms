<?php

namespace libforms\buttons;


use Closure;
use JsonSerializable;
use pocketmine\player\Player;

class Button implements JsonSerializable {

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