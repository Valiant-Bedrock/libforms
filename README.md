# libforms
A small form library built for PocketMine-MP

## Installation
This library can be installed using Composer:

### Composer:
```
composer require valiant-bedrock/libforms
```

### Virion (Poggit):
Virion support can be accessed through Poggit using [this link](https://poggit.pmmp.io/ci/Valiant-Bedrock/libforms/~).

## Basic Example
Here is an example of how to use the library:

```php
$form = new \libforms\SimpleForm(
    title: "Hello, World!",
    content: "This is our simple, little form.",
    buttons: [
        new \libforms\buttons\Button(
            text: "Click me!",
            onClick: function (Player $player): void { $player->sendMessage("You clicked it!"); }
        ),
        new \libforms\buttons\ImageButton(
            text: "I'm shinier! Click me!",
            type: \libforms\buttons\image\ImageType::PATH(),
            source: "textures/items/diamond",
            onClick: function (Player $player): void {
                $player->sendMessage("Ooh! Shiny!");
                $player->getInventory()->add(VanillaItems::DIAMOND());
            }
        )
    ]
);

assert($player instanceof \pocketmine\player\Player);
$form->send($player);
```

## Wiki

To learn more about the library and how to use it, please consult the wiki using [this link](https://github.com/Valiant-Bedrock/libforms/wiki).

## Issues / Suggestions
Any issues or suggestions with the library can be reported [here](https://github.com/Valiant-Bedrock/libforms/issues).