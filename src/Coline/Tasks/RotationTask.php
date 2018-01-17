<?php
namespace Coline\Tasks;

use pocketmine\scheduler\PluginTask;

class RotationTask extends PluginTask{
    public function __construct(BestCasinoMain $plugin) {
        $this->plugin = $plugin;
        parent::__construct($plugin);
    }
    public function onRun(int $currentTick) {
        foreach ($this->plugin->frames as $frame => $data){
            if($frame != 10){
               
            $frameTile = $this->plugin->getTileByFrameID($frame);
            $frameData = $this->plugin->frames[$frame];
            $frameRotation = $frameTile->getItemRotation();
            if($frameData['activated'] == FALSE){
                 if($frameRotation == 4){
                    $frameTile->setItemRotation(0);
                } else {
                    $frameTile->setItemRotation($frameRotation + 1);
                }
                $this->plugin->getServer()->getScheduler()->scheduleDelayedTask(new RotationTask($this->plugin), 1*20);
            }
         }
        }
    }
    
}