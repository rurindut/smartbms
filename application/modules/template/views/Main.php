
<?php echo $head;?>

<body>


    <!-- Left Panel -->

    <?php echo $left_panel; ?>

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php echo $header; ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo $page_title;?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
            </div>
        </div>

        <div class="content mt-3">
            <?php echo $isi; ?>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    
    <?php echo $footer; ?>
    

</body>
</html>
