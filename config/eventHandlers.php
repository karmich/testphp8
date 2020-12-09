<?php
return [
    'App\EventHandlers\TestBeforeResponseHandler',
    ...require_once ('../src/Bundles/UserBundle/config/eventHandlers.php')
];