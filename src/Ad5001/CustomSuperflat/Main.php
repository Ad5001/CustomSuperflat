<?php
namespace Ad5001\CustomSuperflat;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\math\Vector3;
use pocketmine\utils\TextFormat as C;
// use pocketmine\level\generator\Flat;
use pocketmine\Server;
use pocketmine\Player;


class Main extends PluginBase {


    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
        switch($cmd->getName()){
            case "superflat":
            $y = 0;
            $blocks = [];
            while($y <= 128) {
                $b = $sender->getLevel()->getBlock(new Vector3($sender->x, $y, $sender->z));
                // $this->getLogger()->info("Processing {$b->getId()}");
                array_push($blocks, $b->getId() . ":" . $b->getDamage());
                $y++;
            }
            if(isset($args[0])) {
                // $this->getLogger()->info("Preset: " . implode(",", $blocks) . ";");
                $this->getServer()->generateLevel($args[0], intval(sha1(rand(0, 999999))), "pocketmine\\level\\generator\\Flat", ["preset" => "128;" . implode(",", $blocks) . ";1;"]);
                $sender->sendMessage(C::GREEN . C::BOLD . C::ITALIC . "[" . C::RESET . C::BOLD . C::DARK_GREEN . "CustomSuperflat" . C::ITALIC . C::GREEN . "]" . C::RESET . C::WHITE . " Superflat world $args[0] generated !");
                return true;
            } else {
                return false;
            }
            break;
        }
     return false;
    }
}