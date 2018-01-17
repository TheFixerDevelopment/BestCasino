<?php

namespace Coline\Tasks;

use pocketmine\scheduler\PluginTask;

class ClearTask extends PluginTask{
    public function __construct(BestCasinoMain $plugin) {
        $this->plugin = $plugin;
        parent::__construct($plugin);
    }
    public function onRun(int $currentTick) {
        if( $this->plugin->gamevariables['started'] == FALSE){
            $this->plugin->clearALL();
            $this->plugin->preStart();
        }
    }
}

