<?php

/*
      _____         _                     
     | ____|_ __ __| | ___ _ __ ___       
     |  _| | '__/ _` |/ _ \ '_ ` _ \      
     | |___| | | (_| |  __/ | | | | |     
     |_____|_|  \__,_|\___|_| |_| |_|     
          ____ ____   __    ___           
          | ___| ___| / /_  / _ \         
          |___ \___ \| '_ \| | | |        
           ___) |__) | (_) | |_| |        
          |____/____/ \___/ \___/         
                                       
                                        */

namespace Erdem5560\Komut;

use pocketmine\{Player, Server};
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use Erdem5560\Menu\Menu;
use Erdem5560\Base;

class Komut extends PluginCommand{

    public function __construct(Base $plugin){
    $this->plugin = $plugin;
    parent::__construct("cek", $plugin);
    $this->setDescription("Çek Ekranı.");
    }

    public function execute(CommandSender $oyuncu, string $label, array $args){
	$oyuncu->sendForm(new Menu($oyuncu));
    }
  }
