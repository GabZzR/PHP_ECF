<?php

/**
 * Vérifies que $error_messages existe. S'il existe, c'est qu'il y a des messages d'erreurs à afficher
 */
if (isset($error_messages)) :
    foreach ($error_messages as $error => $messages) :
        foreach ($messages as $message) :
            ?>
            <div class="alert alert-<?= $error ?>"><?= $message ?></div>
        <?php
        endforeach;
    endforeach;
endif; ?>