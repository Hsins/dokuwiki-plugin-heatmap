<?php
if (!defined('DOKU_INC')) die();

class helper_plugin_heatmap extends DOKUWIKI_Plugin {
    public function search_pages( $namespace, $year ) {
        global $conf;
        require_once( DOKU_INC . 'inc/search.php' );

        $ns = cleanID ($namespace);
        $result = [];

        $ns_pattern = $ns ? "/^$ns:?.*/" : "";
        $since_ts = strtotime("$year-01-01");
        $until_ts = strtotime("$year-12-31");

        search($result, $conf['datadir'], 'search_universal', [
            'depth' => 0,
            'listfiles' => true,
            'listdirs'  => false,
            'pagesonly' => true,
            'skipacl' => false,
            'filematch' => "",
            'meta' => true,
            'ns' => 'til',
        ]);

        // filter with namespace and mtime
        $result = array_filter($result, function($item) use ($ns_pattern, $since_ts, $until_ts) {
            if ($ns_pattern) {
                return preg_match($ns_pattern, $item['ns']) && $item['mtime'] >= $since_ts && $item['mtime'] <= $until_ts;    
            } else {
                return $item['mtime'] >= $since_ts && $item['mtime'] <= $until_ts;
            }
        });

        dbglog($result);

        return $result;
    }

    public function parse_data( $year, $posts ) {
        $postCount = [];
        $postMap = [];

        // Iterate over the array to populate postCount and postMap
        foreach ($posts as $post) {
            $meta = p_get_metadata($post['id']);
            $date = date('Y-m-d', $meta['date']['created']);
            // $date = date('Y-m-d', $post['mtime']);
            
            // Update postCount
            if (!isset($postCount[$date])) {
                $postCount[$date] = 0;
            }
            $postCount[$date]++;
            
            // Update postMap
            if (!isset($postMap[$date])) {
                $postMap[$date] = [];
            }

            $postMap[$date][] = [
                'title' => $meta['title'],
                'url' => wl($post['id'], '', true)
            ];
        }

        // Format postCount as a 2D array
        $postCountFormatted = [];
        foreach ($postCount as $date => $count) {
            $postCountFormatted[] = [$date, $count];
        }

        // Convert postMap to a JSON-friendly structure
        $postMapFormatted = new stdClass();
        foreach ($postMap as $date => $posts) {
            $postMapFormatted->$date = $posts;
        }

        // Encode to JSON
        $result = json_encode([
            'dateRange' => [ "$year-01-01", "$year-12-31" ],
            'postCount' => $postCountFormatted,
            'postMap' => $postMapFormatted
        ]);

        return $result;
    }
}

?>
