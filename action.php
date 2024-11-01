<?php
// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class action_plugin_heatmap extends DokuWiki_Action_Plugin {
    private static $initialized = false;

    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook( 'DOKUWIKI_STARTED', 'BEFORE', $this, 'setup_options' );
        $controller->register_hook( 'TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'load_scripts' );
    }

    public function setup_options(Doku_Event $event, $param) {
        if (self::$initialized) return;

        global $JSINFO;
        if (!isset($JSINFO['plugin']['postHeatmap'])) {
            $JSINFO['plugin']['postHeatmap'] = [];
        }

        self::$initialized = true;
    }

    public function load_scripts(Doku_Event $event, $param) {
        $event->data['script'][] = array(
            'defer' => true,
            'src'   => "https://cdn.jsdelivr.net/npm/echarts@5.3.0/dist/echarts.min.js",
        );
    }
}
?>
