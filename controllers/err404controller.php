<?php
class Err404Controller extends ControllerBase {
    function controller() {
        if (empty($_GET['p']))
            $this->desired = '';
        else
            $this->desired = $_GET['p'];
            
    }
}