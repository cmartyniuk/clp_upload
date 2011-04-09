<?php

$prefix = 'clp_upload';

Router::connect("/{$prefix}/:controller", array('action' => 'index', 'plugin' => 'clp_upload', $prefix => true));
Router::connect("/{$prefix}/:controller/:action/*", array('plugin' => 'clp_upload', $prefix => true));
