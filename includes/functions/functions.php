<?php 
    function product_json(&$order, &$shirts = 0, &$labels = 0) {
        $days = array(
            0 => 'one_day', 
            1 => 'complete_pass', 
            2 => 'two_days'
        );
        //change i for keys in the array $order
        $total_order = array_combine($days, $order);
        $json = array();
        foreach($total_order as $key => $order_change):
            if((int) $order_change['quantity'] > 0):
                $json[$key] = (int) $order_change['quantity'];
            endif;
        endforeach;
        $shirts = (int)$shirts;
        if($shirts > 0) $json['shirts'] = $shirts;
        $labels = (int)$labels;
        if($labels > 0) $json['labels'] = $labels;
        return json_encode($json);
    }
    function events_json(&$register_event) {
        $events_json = array();
        foreach($register_event as $event):
            $events_json['events'][] = $event;
        endforeach;
        return json_encode($events_json);
    } ?>