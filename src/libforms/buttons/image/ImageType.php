<?php

namespace libforms\buttons\image;

use pocketmine\utils\EnumTrait;

/**
 * @method static ImageType PATH()
 * @method static ImageType URL()
 */
class ImageType {
	use EnumTrait;

	protected static function setup(): void {
		self::register(new ImageType("path"));
		self::register(new ImageType("url"));
	}

}