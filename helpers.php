<?php
function header404() { //404 handler
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
}