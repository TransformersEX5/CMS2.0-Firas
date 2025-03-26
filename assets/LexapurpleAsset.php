<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LexapurpleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'lexa-ajax/layouts/purpel/assets/css/bootstrap.min.css',
        'lexa-ajax/layouts/purpel/assets/css/icons.min.css',
        'lexa-ajax/layouts/purpel/assets/css/app.min.css',
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css',
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css',
        'lexa-ajax/layouts/purpel/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css',

        'lexa-ajax/layouts/purpel/assets/libs/sweetalert2/sweetalert2.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',

    ];
    public $js = [
        'lexa-ajax/layouts/purpel/assets/libs/jquery/jquery.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/bootstrap/js/bootstrap.bundle.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/metismenu/metisMenu.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/simplebar/simplebar.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/node-waves/waves.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/jquery-sparkline/jquery.sparkline.min.js',

        'lexa-ajax/layouts/purpel/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js',


        //-- Required datatable js -->
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net/js/jquery.dataTables.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js',

        //-- Buttons examples -->
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/jszip/jszip.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/pdfmake/build/pdfmake.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/pdfmake/build/vfs_fonts.js',
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-buttons/js/buttons.html5.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-buttons/js/buttons.print.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js',

        //-- Responsive examples -->
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js',

        //-- Datatable init js -->
        'lexa-ajax/layouts/purpel/assets/js/pages/datatables.init.js',

        //-- App js -->
        'lexa-ajax/layouts/purpel/assets/js/app.js',
	'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',



        // --Morris Chart--
        'lexa-ajax/layouts/purpel/assets/libs/morris.js/morris.min.js',
        'lexa-ajax/layouts/purpel/assets/libs/raphael/raphael.min.js',



        'lexa-ajax/layouts/purpel/assets/js/pages/dashboard.init.js',
        'lexa-ajax/layouts/purpel/assets/js/app.js',

        //cms-alert hasFlash
        'lexa-ajax/layouts/purpel/assets/js/cms-alert.js',

        //cms-ajax-modal-popup
        'lexa-ajax/layouts/purpel//assets/js/cms-ajax-modal-popup.js',

        'lexa-ajax/layouts/purpel/assets/libs/sweetalert2/sweetalert2.min.js',
        'lexa-ajax/layouts/purpel/assets/js/pages/sweet-alerts.init.js'

    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}