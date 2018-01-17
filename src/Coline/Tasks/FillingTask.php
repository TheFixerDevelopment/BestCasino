<?php

namespace Coline\Tasks;

use pocketmine\scheduler\PluginTask;

class FillingTask extends PluginTask{
     public function __construct(BestCasinoMain $plugin, int $frameNumber = 1) {
        $this->plugin = $plugin;
        $this->frame = $frameNumber;
        parent::__construct($plugin);
    }
    public function onRun(int $currentTick) {
        $frame = $this->frame;
        if($frame <= 9){
            
        /* @var $frameTile ItemFrame */
            
          $player = $this->plugin->gamevariables['player'];
          /* @var $player Player */
          if($frame <= 3){
              $player->getLevel()->addSound(new \pocketmine\level\sound\PopSound($player));
          }else if($frame <= 6 && $frame > 3 ){
              $player->getLevel()->addSound(new \pocketmine\level\sound\PopSound($player));
          }else if($frame <= 9 && $frame > 6 ){
              $player->getLevel()->addSound(new \pocketmine\level\sound\PopSound($player));
          }
              
          $frameData = $this->plugin->frames[$frame];
          $frameTile = $this->plugin->getTileByFrameID($frame);
         if($frameData['activated'] == FALSE){
            $this->plugin->frames[$frame]['activated'] = true;
             $frameTile->setItem(Item::get($this->plugin->items[mt_rand(1, count($this->plugin->items))]));
             $frameTile->setItemRotation(0);
             if($frame == 3 || $frame == 6){
                $this->plugin->getServer()->getScheduler()->scheduleDelayedTask(new FillingTask($this->plugin, $frame + 1), 0.7*20);
            }else{
             $this->plugin->getServer()->getScheduler()->scheduleDelayedTask(new FillingTask($this->plugin, $frame + 1), 0.5*20);
            }
            if($frame + 1 == 10){
                $this->plugin->end($this->plugin->gamevariables['player']);
            }
         }
        }
    }
}

