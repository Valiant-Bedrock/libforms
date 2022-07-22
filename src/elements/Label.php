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

namespace libforms\elements;

class Label extends Element {

	/**
	 * Given that labels are not intended to receive data, we can remove the `callable` parameter here.
	 *
	 * @param string $text
	 */
	public function __construct(string $text) {
		parent::__construct($text);
	}

	public function getType(): string {
		return "label";
	}

	/**
	 * @return array{}
	 */
	public function getExtraData(): array {
		return [];
	}

}