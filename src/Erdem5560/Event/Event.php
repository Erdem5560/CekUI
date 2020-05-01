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

namespace Erdem5560\Event;

use pocketmine\{Player, Server};
use onebone\economyapi\EconomyAPI;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use Erdem5560\Base;

class Event implements Listener{

	public function Boz(PlayerInteractEvent $event){
	$oyuncu = $event->getPlayer();
	$el = $oyuncu->getInventory()->getItemInHand();
	if($el->getId() == 339){
	$isim = $el->getCustomName();
	$ayir = explode(" ", $isim);
	if($ayir[0] == "§b"){
    EconomyAPI::getInstance()->addMoney($oyuncu, $ayir[1]);
    $oyuncu->getInventory()->removeItem($oyuncu->getInventory()->getItemInHand());
    $oyuncu->sendMessage(TF::AQUA."{$ayir[1]}TL".TF::GREEN." Çek Bozduruldu.");
	      }else{
	    }
	  }
	}
  }
