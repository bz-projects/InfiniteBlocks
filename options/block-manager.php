<?php

function ibBlockListFolders(){ 
    $pluginRoot = plugin_dir_path( __DIR__ ); 
    $pluginSub  = $pluginRoot.'packages'.'/';

    $DIR        = new RecursiveDirectoryIterator( $pluginSub );
    $Iterator   = new RecursiveIteratorIterator( $DIR );

    echo '<h2 class="ib__headline">Block Manager</h2>';
    echo '<p class="ib__content">Hier können Sie alle Blöcke aktivieren oder deaktivieren.</p>';
    echo '<fieldset class="ib__block-setting">';
        
        foreach( $Iterator as $file ) {
            $fileType       = pathinfo($file);
            $filePath       = $file->getPathname();
            $fileContent    = file( $filePath );
           
            if( $fileType['extension'] == 'php'){
                $comments           = [];
                $isBlockPackage     = array_search('Block Package', $comments );
                $fileContentstr     = implode(" ", $fileContent );
                $fileCommentString  = trim( $fileContentstr , "\**/");
                
                // Read Comment Block Package
                foreach ( explode(PHP_EOL, $fileCommentString) as $item ){
                    $itemData = explode(":",$item);
                
                    if ( count( $itemData ) == 2 ){
                        $comments[trim( $itemData[0] )] = trim($itemData[1]);
                    }
                }

                // Return Fields
                foreach ( $comments as $comment ){ 
                    $commentClean = preg_replace('/\s*/', '', $comment);
                    $commentClean = strtolower($commentClean); ?>

                    <section class="ib__block-field">
                        <label class="ib__block-label" for=<?= $commentClean; ?>><?= $comment; ?></label>
                        <input class="ib__block-input" id=<?= $commentClean; ?> type="checkbox" name=<?= $commentClean; ?>>
                    </section>
                <?php 
                }

            }
        }
    echo '</fieldset>';
}


/**
 * ibBlocksOptions
 * @depends ibBlocksRegisterOptions()
 * @return void
 */
function ibBlocksOptions(){ ?>
    <div class="ib__settings wrap">
	    <h1 class="ib__mainheadline">IB Blocks Settings</h1>
	    <form class="ib__form" method="post" action="options.php">
            <?php  
                ibBlockListFolders();
	            submit_button(); 
	        ?>          
	    </form>
    </div>

    <?php
}

/**
 * ibBlocksRegisterOptions
 *  
 * @return register WordPress Settings
 */
function ibBlocksRegisterOptions(){
    add_menu_page(  "IB Blocks", 
                    "IB Blocks", 
                    "manage_options", 
                    "ib-blocks", 
                    "ibBlocksOptions", null, 99);
}
add_action("admin_menu", "ibBlocksRegisterOptions");