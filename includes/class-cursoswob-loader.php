<?php

class CursosWob_Loader{
    
    protected $actions;
    
    protected $filters;
    
    protected $shortcodes;
    
    public function __construct() {
        $this->actions = array();
        $this->filters = array();
        $this->shortcodes = array();
    }
    
    public function add_action($hook, $component, $callback){
        $this->actions = $this->add($this->actions, $hook, $component, $callback);
    }
    
    public function add_filter($hook, $component, $callback){
        $this->filters = $this->add($this->filters, $hook, $component, $callback);
    }
    
    public function add_shortcode($hook, $component, $callback){
        $this->shortcodes = $this->add($this->shortcodes, $hook, $component, $callback);
    }
    
    private function add($hooks, $hook, $component, $callback){
        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,            
        );
        
        return $hooks;
    }
    
    public function run(){
        foreach ($this->filters as $hook):
            add_filter($hook['hook'], array($hook['component'], $hook['callback']));
        endforeach;
        foreach ($this->actions as $hook):
            add_action($hook['hook'], array($hook['component'], $hook['callback']));
        endforeach;
        foreach ($this->shortcodes as $hook):
            add_shortcode($hook['hook'], array($hook['component'], $hook['callback']));
        endforeach;
    }
    
}