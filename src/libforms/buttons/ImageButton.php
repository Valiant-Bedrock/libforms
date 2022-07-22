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
use libforms\buttons\image\ImageType;
use pocketmine\player\Player;

class ImageButton extends Button {

	/**
	 * @param ImageType $type - Determines where to search for the image.
	 * @param string $source - The URL or path to the image.
	 * @param (Closure(Player): void)|null $onClick
	 */
	public function __construct(
		string $text,
		protected ImageType $type,
		protected string $source,
		?Closure $onClick = null
	) {
		parent::__construct($text, $onClick);
	}

	/**
	 * @return array<string, mixed>
	 */
	public function jsonSerialize(): array {
		return parent::jsonSerialize() + [
			"image" => [
				"type" => $this->type->name(),
				"data" => $this->source
			]
		];
	}
}