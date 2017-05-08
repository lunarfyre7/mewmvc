<?php //the default/index controller
class default_controller extends ControllerBase {
    function controller() {
        global $CONF;
        $this->title = "Default title";
        $this->site_title = $CONF['site']['title'].'::'.$this->title;
        $this->body = "Default body";
    }
}