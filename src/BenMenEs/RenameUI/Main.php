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
    public $config;
    
    /** @var Main */
    private static $instance;

    /**
     * @return void
     */
    public function onLoad() : void{
    	self::$instance = $this;
        $this->getServer()->getCommandMap()->register("rename", new Rename($this));
    }

    /**
     * @return void
     */
    public function onEnable() : void{
        $this->saveDefaultConfig();
        $this->config = $this->getConfig()->getAll();
    }
  
    private static function getInstance(){
    	return self::$instance;
    }

    /**
     * @param Player $player
     * @return void
     */
    public function openRenameForm(Player $player) : RenameForm{
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
        $player->getInventory()->setItemInHand($item);
        $player->sendMessage($ev->getRenameMessage());
    }
}
