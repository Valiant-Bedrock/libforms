<?php

namespace libforms\buttons;

use Closure;
use libforms\buttons\image\ImageType;

class ImageButton extends Button {

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