<?php

namespace libforms;

use Closure;
use pocketmine\form\FormValidationException;
use pocketmine\player\Player;

abstract class Form implements \pocketmine\form\Form {

	/**
	 * @param string $title
	 * @param (Closure(Player): void)|null $onClose
	 */
	public function __construct(
		protected string   $title,
		protected ?Closure $onClose = null
	)
	{
	}

	/**
	 * Returns the type of form (form, modal, or custom_form)
	 *
	 * @return string
	 */
	public abstract function getType() : string;

	/**
	 * Returns the content for the form (buttons, text, etc.)
	 *
	 * @return mixed
	 */
	public abstract function getContent(): mixed;

	/**
	 * Returns any extra data needed to be sent with the form
	 *
	 * @return array<string, mixed>
	 */
	public abstract function getExtraData(): array;

	/**
	 * This method is called when the player first receives data from the form
	 *
	 * @param Player $player
	 * @param mixed $data
	 * @return bool - If handled, the response should return true
	 */
	public abstract function handleFormResponse(Player $player, mixed $data): bool;

	/**
	 * @param Player $player - The player that submitted the form
	 * @param mixed $data - Data received from the form
	 * @return void
	 */
	final public function handleResponse(Player $player, mixed $data): void {
		$this->handleFormResponse($player, $data);
		if($this->onClose !== null) {
			($this->onClose)($player);
		}
	}

	public function send(Player $player): void {
		$player->sendForm($this);
	}

	/**
	 * This method encodes the basic structure for a form
	 *
	 * @return array<string, mixed>
	 */
	public function jsonSerialize(): array {
		return [
			"title" => $this->title,
			"content" => $this->getContent(),
			"type" => $this->getType()
		] + $this->getExtraData();
	}
}