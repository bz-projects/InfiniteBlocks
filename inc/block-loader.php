<?php

/**
 *  Gutenberg Block Loader
 *  @param $folder (Type String) add subfolder name
 *  @uses plugin_dir_path
 *  @return include all php files from subfolder
 */

function ib_block_loader( $folder = 'packages' ){

    // Get Plugin URL
    $pluginRoot = plugin_dir_path( __DIR__ ); 
    $pluginSub  = $pluginRoot.$folder;

    // List all Files from all sub-folders with PHP 
    $DIR        = new RecursiveDirectoryIterator( $pluginSub );
    $Iterator   = new RecursiveIteratorIterator( $DIR );
    $Files      = new RegexIterator( $Iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH );

    // Load PHP File by Subfolder
    foreach( $Files as $file ) {
        require $file[0];
    }
}
ib_block_loader();