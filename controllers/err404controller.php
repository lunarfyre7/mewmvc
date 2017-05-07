<?php
class Err404Controller extends ControllerBase {
    function controller() {
        $this->desired = $_GET['p'];
    }
}