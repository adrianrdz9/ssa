<?php

namespace App\Traits;

use SM\Factory\FactoryInterface;

trait Statable
{

    protected $stateMachine;


    public function stateMachine(){
        if(!$this->stateMachine){
            $this->stateMachine = app(FactoryInterface::class)->get($this, self::SM_CONFIG);
        }
        return $this->stateMachine;
    }

    public function stateIs($state = null){
        if($state != null){
            return $this->stateMachine()->getState() == $state;
        }
        return $this->stateMachine()->getState();
    }

    public function transition($transition){
        $this->stateMachine()->apply($transition);
        return $this->save();    
    }



}