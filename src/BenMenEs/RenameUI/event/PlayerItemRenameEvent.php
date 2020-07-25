<?php

namespace BenMenEs\RenameUI\event;

use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\event\Cancellable;
use pocketmine\event\plugin\PluginEvent;

class PlayerItemRenameEvent extends PluginEvent implements Cancellable{

    /** @var Player */
    private $player;

    /** @var Item */
    private $item;

    /** @var string */
    private $oldName;

    /** @var string */
    private $newName;

    /** @var string */
    private $message;

    public function __construct(Player $player, Item $item, string $oldName, string $newName, string $message){
        $this->player = $player;
        $this->item = $item;
        $this->oldName = $oldName;
        $this->newName = $newName;
        $this->message = $message;
    }

    /**
     * @return Player
     */
    public function getPlayer() : Player{
        return $this->player;
    }

    /**
     * @return Item
     */
    public function getItem() : Item{
        return $this->item;
    }

    /**
     * @return string
     */
    public function getOldName() : string{
        return $this->oldName;
    }

    /**
     * @return string
     */
    public function getNewName() : string{
        return $this->newName;
    }

    /**
     * @return string
     */
    public function getRenameMessage() : string{
        return $this->message;
    }

    /**
     * @return void
     */
    public function setRenameMessage(string $message) : void{
        $this->message = $message;
    }
}
