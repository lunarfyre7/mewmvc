<?php
class ControllerBase { //controller base and template renderer
    private $tpl;
    public function __construct ($template) {
        global $CONF;
        $this->tpl = 'tpl/'.$template;
        //variables for templates to use
        $this->site_title = $CONF['site']['title'];
    }
    function controller() {} //controller code here
    function render() {
        $this->controller();
        include (''.$this->tpl.'.phtml');
    }
    //helpers
    function linkurl($name) { //url for page paths
        return "$_SERVER[HTTP_HOST]$p=$name";
    }
    function link($linkname, $pagename) { //link html
        return "<a href='{linkurl($pagename)}'>$linkname</a>";
    }
}