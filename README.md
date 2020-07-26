# RenameUI
 Simple rename item plugin with forms for PocketMine-MP (PMMP)

 [FormAPI](https://github.com/jojoe77777/FormAPI) - Need to work

## API
- public static function getInstance() - return plugin
- public function openRenameForm(Player $player) - opens rename form
- public function rename(Player $player, Item $item, string $oldName, string $newName) - rename function

## Events
PlayerItemRenameEvent (BenMenEs\RenameUI\event\PlayerItemRenameEvent)
- getPlayer() : Player - return event player
- getItem() : Item - return event item
- getOldName() : string - return event item oldname
- getNewName() : string - return event item new name
- getRenameMessage() : string - return event message
- setRenameMessage(string $message) : void - set event message
- Event implements Cancellable

### Version:
- 0.0.1

### API-version:
- 3.0.0-3.14.2
