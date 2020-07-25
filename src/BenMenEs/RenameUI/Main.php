<?php

namespace BenMenEs\RenameUI;

use BenMenEs\RenameUI\command\Rename;
use BenMenEs\RenameUI\event\PlayerItemRenameEvent;
use BenMenEs\RenameUI\form\RenameForm;
use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\Player;

class Main extends PluginBase{

    /** @var Config */
    protected $config;

    /**
     * @return void
     */
    public function onLoad() : void{
        $this->getServer()->getCommandMap()->register("rename", new Rename($this));
    }

    /**
     * @return void
     */
    public function onEnable() : void{
        $this->saveDefaultConfig();
        $this->config = $this->getConfig()->getAll();
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function openRenameForm(Player $player) : void{
        return new RenameForm($this, $player);
    }

    /**
     * @param Player $player
     * @param Item $item
     * @param string $oldName
     * @param string $newName
     * @return void
     */
    public function rename(Player $player, Item $item, string $oldName, string $newName) : void{
        $this->getServer()->getPluginManager()->callEvent($ev = new PlayerItemRenameEvent($player, $item, $oldName, $newName, str_replace(["{OLDNAME}", "{NEWNAME}"], [$oldName, $newName], $this->config['rename-message'])));
        if($ev->isCancelled()){
            return;
        }
        $item->setCustomName($newName);
        $player->sendMessage($ev->getRenameMessage());
    }
}
