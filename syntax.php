<?php
/**
 * DokuWiki Plugin Heatmap (Syntax Component: heatmap)
 *
 * Render Heatmap for post counts.
 *
 * @license GPLv3 https://www.gnu.org/licenses/gpl-3.0.html
 * @author  H.-H. PENG (Hsins) <hsinspeng@gmail.com>
 */

// must be run within Dokuwiki
if ( !defined( 'DOKU_INC' ) ) die();

/**
 * Class syntax_plugin_heatmap
 */
class syntax_plugin_heatmap extends DokuWiki_Syntax_Plugin {
    
    public function getType() {
        return 'substition';
    }

    public function getPType() {
        return 'block';
    }

    public function getSort() {
        return 32;
    }

    public function connectTo( $mode ) {
        $this->Lexer->addSpecialPattern( '<heatmap\b[^>]*>', $mode, 'plugin_heatmap' );
    }

    public function handle( $match, $state, $pos, Doku_Handler $handler ) {
        $data = [];
        preg_match_all('/\b(\w+)=([\w-]+)/', $match, $matches, PREG_SET_ORDER);
        foreach ( $matches as $m ) {
            $data[strtolower($m[1])] = $m[2];
        }

        // Set default values
        $data['ns'] = $data['ns'] ?? '';
        $data['year'] = $data['year'] ?? date('Y');
        dbglog($data['ns']);

        // Generate unique ID
        $data['id'] = 'heatmap-' . uniqid();

        return $data;
    }

    public function render($mode, Doku_Renderer $renderer, $data) {
        if ( $mode === 'xhtml' ) {
            $helper = plugin_load( 'helper', 'heatmap' );

            $pages = $helper->search_pages( $data['ns'], $data['year']);
            $json_data = $helper->parse_data( $data['year'], $pages );

            // Render the div with the unique ID
            $renderer->doc .= '<script type="application/json" id="data-' . $data['id'] . '">' . $json_data . '</script>';
            $renderer->doc .= '<div id="' . $data['id'] . '" style="max-width: 800px; height: 200px; margin: 0 auto;"></div>';
        }
        return true;
    }
}
?>
