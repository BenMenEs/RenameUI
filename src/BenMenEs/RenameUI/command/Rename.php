<?php

namespace BenMenEs\RenameUI\command;

use BenMenEs\RenameUI\Main;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\plugin\Plugin;

class Rename extends Command implements PluginIdentifiableCommand{

    /** @var Main */
    private $main;

    public function __construct(Main $main){
        parent::__construct("rename", "Rename item");
        $this->setPermission("rename.cmd");
        $this->main = $main;
    }
    
    /**
     * @return Plugin
     */
    public function getPlugin() : Plugin{
    	return $this->main;
    }

    /**
     * @param CommandSender $sender
     * @param string $label
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, string $label, array $args) : bool{
        if(!$this->testPermission($sender)){
            return false;
        }
        if($sender->getInventory()->getItemInHand()->getId() == 0){
            $sender->sendMessage($this->main->config['iteminhand']);
            return false;
        }
        $this->main->openRenameForm($sender);
        return true;
    }
}
