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

namespace Erdem5560\Menu;

use pocketmine\{Player, Server};
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat as TF;
use Form\{CustomForm, CustomFormResponse};
use Form\Element\{Label, Input};
use Erdem5560\Base;

class Menu extends CustomForm{

	public function __construct(Player $oyuncu){
	$param = EconomyAPI::getInstance()->myMoney($oyuncu);
	parent::__construct(
		"Çek Menüsü",
		[
    new Label("element0", TF::GRAY."Bu Menüden Çek Oluşturabilirsiniz.\n"),
    new Label("element2", TF::GRAY."Param: ".TF::RED."$param \n"),
	new Input("element1", TF::GRAY."Çek Miktarını Yazın", "Örn; 10000"),
		],
	function(Player $oyuncu,CustomFormResponse $dosya):void{
    $miktar = $dosya->getString("element1");
    if($miktar >= 1){
    if(is_numeric($miktar)){
    if(EconomyAPI::getInstance()->myMoney($oyuncu) >= $miktar){
    $inv = $oyuncu->getInventory();
	$çek = Item::get(Item::PAPER, 0, 1);
	$cekno = mt_rand(10000, 99999);
	$çek->setCustomName("§b {$miktar} TL §aPara Çeki\n §eÇek No: §7{$cekno}");
	$inv->addItem($çek);
    EconomyAPI::getInstance()->reduceMoney($oyuncu, $miktar);
	$oyuncu->sendMessage(TF::AQUA."{$miktar}TL".TF::GREEN." Çek Oluşturuldu.");
    }else{
    $oyuncu->sendMessage(TF::GOLD."{$miktar}TL".TF::RED." Çek Paranız Yetersiz Olduğu İçin Oluşturulamadı!");
        }
      }else{
    $oyuncu->sendMessage(TF::RED."Lütfen Sayısal Bir Değer Giriniz!");
               }
           }else{
    $oyuncu->sendMessage(TF::RED."Lütfen 1 ve 1'den Büyük Bir Değer Giriniz!");
        }
      });
    }
  }
