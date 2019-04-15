<?php

namespace Batuhan337tr\StaffMenu;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\CommandExecutor;
use pocketmine\utils\TextFormat;
use jojoe77777\FormAPI;

class Main extends PluginBase{

	public function onEnable() : void{
		$this->getLogger()->info("StaffMenu Plugin Succesfuly Activated by Batuhan337tr");
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		$player = $sender->getPlayer();
		switch($command->getName()){
			case "staffmenu":
				if($sender->hasPermission("staffmenu.perm")){
				$this->langMenu($player);	
			}
			else{
			$sender->sendMessage("§cBu komutu kullanmak için gerekli yetkiye sahip değilsiniz!");
		}
			return true;
		}
	}
	public function langMenu(Player $player){

		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function (Player $sender, array $data){
				if(isset($data[0])){
				$player = $sender->getPlayer();
				$result = $data[0];					
					if($result === null){						
					}
					switch($data[0]){
						case 0:
						$this->staffMenuTR($player);
						break;
						case 1:
						$this->staffMenuEN($player);
						break;
						case 2:
						$this->getServer()->getCommandMap()->dispatch($sender, "");
						break;
					}
					
				}
			});
			$form->setTitle("§fStaffMenu §cSelect Language");
			$form->setContent("§7» Please select your language on this form.");
			$form->addButton("§4Türkçe");
			$form->addButton("§4English");
			$form->addButton("§cClose Menu / Menüyü Kapat");
			$form->sendToPlayer($player);			
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function staffMenuEN(Player $player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function (Player $sender, array $data){
				if(isset($data[0])){
				$player = $sender->getPlayer();
				$result = $data[0];					
					if($result === null){						
					}
					switch($data[0]){
						case 0:
							$player->setHealth(20);
    						$sender->sendMessage("§aYou're healthed!");
    					break;
						case 1:
							$player->setFood(20);
							$sender->sendMessage("§aYou're feeded!");
						break;
						case 2:
						$this->adminModuEN($player);
						break;
						case 3:
						$this->banPlayerEN($player);
						break;
						case 4:
						$this->pardonPlayerEN($player);
						break;
						case 5:
						$this->kickPlayerEN($player);
						break;
						case 6:
						$this->langMenu($player);
						break;
					}
					
				}
			});
			$form->setTitle("§fStaff §cMenu");
			$form->setContent("§7» Do what you want.");
			$form->addButton("§aHeal", 0, "textures/items/apple");
			$form->addButton("§aFeed", 0, "textures/items/bread");
			$form->addButton("§aAdmin Mode", 0, "textures/items/diamond_pickaxe");
			$form->addButton("§aBan Player", 0, "textures/items/diamond_sword");
			$form->addButton("§aUn-Ban Player", 0, "textures/items/gold_sword");
			$form->addButton("§aKick Player", 0, "textures/items/bowl");		
			$form->addButton("§cBack");
			$form->sendToPlayer($player);			
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function staffMenuTR(Player $player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function (Player $sender, array $data){
				if(isset($data[0])){
				$player = $sender->getPlayer();
				$result = $data[0];					
					if($result === null){						
					}
					switch($data[0]){
						case 0:
							$player->setHealth(20);
    						$sender->sendMessage("§aCanınız Fullendi!");
    					break;
						case 1:
							$player->setFood(20);
							$sender->sendMessage("§aAçlığınız Giderildi!");
						break;
						case 2:
						$this->adminModuTR($player);
						break;
						case 3:
						$this->banPlayerTR($player);
						break;
						case 4:
						$this->pardonPlayerTR($player);
						break;
						case 5:
						$this->kickPlayerTR($player);
						break;
						case 6:
						$this->langMenu($player);
						break;
					}
					
				}
			});
			$form->setTitle("§fYetkili §cMenü");
			$form->setContent("§7» İstediğiniz İşlemi Gerçekleştirebilirsiniz.");
			$form->addButton("§aCan Fulle", 0, "textures/items/apple");
			$form->addButton("§aAçlık Fulle", 0, "textures/items/bread");
			$form->addButton("§aAdmin Modu", 0, "textures/items/diamond_pickaxe");
			$form->addButton("§aOyuncu Ban", 0, "textures/items/diamond_sword");
			$form->addButton("§aOyuncu Ban Kaldır", 0, "textures/items/gold_sword");
			$form->addButton("§aOyuncu Tekmele", 0, "textures/items/bowl");		
			$form->addButton("§cGeri Dön");
			$form->sendToPlayer($player);			
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function banPlayerTR(Player $player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            if($api === null || $api->isDisabled()){
            }
            $form = $api->createCustomForm(function(Player $sender, array $data){
              $result = $data[0];
              if($result != null){
                $command = "ban ".$result." ".$data[1];
                $this->getServer()->getCommandMap()->dispatch($sender->getPlayer(), $command);
              }
			});
			$form->setTitle(TextFormat::BLUE."Oyuncu Banla");
            $form->addInput("Oyuncu Adı");
            $form->addInput("Sebep");
            $form->sendToPlayer($player);
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function banPlayerEN(Player $player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            if($api === null || $api->isDisabled()){
            }
            $form = $api->createCustomForm(function(Player $sender, array $data){
              $result = $data[0];
              if($result != null){
                $command = "ban ".$result." ".$data[1];
                $this->getServer()->getCommandMap()->dispatch($sender->getPlayer(), $command);
              }
			});
			$form->setTitle(TextFormat::BLUE."Player Ban");
            $form->addInput("Player Name");
            $form->addInput("Reason");
            $form->sendToPlayer($player);
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function pardonPlayerTR(Player $player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            if($api === null || $api->isDisabled()){
            }
            $form = $api->createCustomForm(function(Player $sender, array $data){
              $result = $data[0];
              if($result != null){
                $command = "pardon ".$result;
                $this->getServer()->getCommandMap()->dispatch($sender->getPlayer(), $command);
              }
			});
			$form->setTitle(TextFormat::RED."Oyuncu Ban Kaldır");
            $form->addInput("Oyuncu Adı");
            $form->sendToPlayer($player);
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function pardonPlayerEN(Player $player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            if($api === null || $api->isDisabled()){
            }
            $form = $api->createCustomForm(function(Player $sender, array $data){
              $result = $data[0];
              if($result != null){
                $command = "pardon ".$result;
                $this->getServer()->getCommandMap()->dispatch($sender->getPlayer(), $command);
              }
			});
			$form->setTitle(TextFormat::RED."Un-Ban Player");
            $form->addInput("Player Name");
            $form->sendToPlayer($player);
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function kickPlayerEN(Player $player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            if($api === null || $api->isDisabled()){
            }
            $form = $api->createCustomForm(function(Player $sender, array $data){
              $result = $data[0];
              if($result != null){
                $command = "kick ".$result." ".$data[1];
                $this->getServer()->getCommandMap()->dispatch($sender->getPlayer(), $command);
              }
			});
			$form->setTitle(TextFormat::GREEN."Kick Player");
            $form->addInput("Player Name");
            $form->addInput("Reason");
            $form->sendToPlayer($player);
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function kickPlayerTR(Player $player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            if($api === null || $api->isDisabled()){
            }
            $form = $api->createCustomForm(function(Player $sender, array $data){
              $result = $data[0];
              if($result != null){
                $command = "kick ".$result." ".$data[1];
                $this->getServer()->getCommandMap()->dispatch($sender->getPlayer(), $command);
              }
			});
			$form->setTitle(TextFormat::GREEN."Oyuncu Tekmele");
            $form->addInput("Oyuncu Adı");
            $form->addInput("Sebep");
            $form->sendToPlayer($player);
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function adminModuTR(Player $player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function (Player $sender, array $data){
				if(isset($data[0])){
				$player = $sender->getPlayer();
				$result = $data[0];					
					if($result === null){						
					}
					switch($data[0]){
						case 0:
							$player->setGamemode(3);
							$sender->sendMessage("§aAdmin Modu Açık !");
    					break;
						case 1:
							$player->setGamemode(0);
							$sender->sendMessage("§aAdmin Modu Kapalı !");
						break;
						case 2:
						$this->staffMenuTR($player);
						break;
					}
					
				}
			});
			$form->setTitle("§bAdmin Modu");
			$form->setContent("§7» Ayarlarınızı yapınız.");
			$form->addButton("§aAç");
			$form->addButton("§4Kapat");
			$form->addButton("§cGeri Dön");	
			$form->sendToPlayer($player);			
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function adminModuEN(Player $player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function (Player $sender, array $data){
				if(isset($data[0])){
				$player = $sender->getPlayer();
				$result = $data[0];					
					if($result === null){						
					}
					switch($data[0]){
						case 0:
							$player->setGamemode(3);
							$sender->sendMessage("§aAdmin mode is now active !");
    					break;
						case 1:
							$player->setGamemode(0);
							$sender->sendMessage("§aAdmin mode is now deactive !");
						break;
						case 2:
						$this->staffMenuEN($player);
						break;
					}
					
				}
			});
			$form->setTitle("§bAdmin Mode");
			$form->setContent("§7» Make your settings.");
			$form->addButton("§aActive");
			$form->addButton("§4Deactive");
			$form->addButton("§cBack");	
			$form->sendToPlayer($player);			
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
	public function onDisable() : void{
		$this->getLogger()->info("StaffMenu Plugin Succesfuly DeActivated by Batuhan337tr");
	}
}
