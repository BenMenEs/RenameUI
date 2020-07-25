<?php

namespace BenMenEs\RenameUI;

use BenMenEs\RenameUI\Main;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\Player;

class RenameForm{

    public function __construct(Main $main, Player $player){
        $form = new CustomForm(function(){});
        $form->setTitle($main->config['title']);
        $form->addLabel($main->config['description']);
        $form->addInput($main->config['input'], $main->config['sub-input']);
        $form->setCallable(function(Player $player, $data) use($main){
            if($data === null && !is_array($data)){
                return;
            }
            if(empty($data[1])){
                $player->sendMessage($main->config['empty-name']);
                return;
            }
            $main->rename($player, $player->getInventory()->getItemInHand(), $player->getInventory()->getItemInHand()->name, $data[1]);
        }
        $form->sendToPlayer($player);
    }
}
