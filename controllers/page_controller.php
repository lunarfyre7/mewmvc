<?php
class page_controller extends ControllerBase {
    public $pagename;
    function controller() {
        global $CONF;
        $this->title = $this->page;
        $this->site_title = $CONF['site']['title'].'::'.$this->title;
        $this->body = "Page body";
    }
}