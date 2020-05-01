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

namespace Erdem5560;

use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use Erdem5560\Menu\Menu;
use Erdem5560\Event\Event;
use Erdem5560\Komut\Komut;

class Base extends PluginBase implements Listener{
    
    public function onEnable(){
    $this->getServer()->getLogger()->info("Çek Aktif Edildi");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getServer()->getCommandMap()->register("cek", new Komut($this));
	$this->getServer()->getPluginManager()->registerEvents(new Event($this), $this);
    }
  }
