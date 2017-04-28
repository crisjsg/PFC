<?php

function iniciar_sesion() {
    if (!session_start()) {
        session_start();
    }
}

iniciar_sesion();

?>