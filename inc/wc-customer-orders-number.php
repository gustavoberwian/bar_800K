<?php
function current_customer_month_count( $user_id=null ) {
    if ( empty($user_id) ){
        $user_id = get_current_user_id();
    }
    // Date calculations to limit the query
    $today_year = date( 'Y' );
    $today_month = date( 'm' );
    $day = date( 'd' );
    if ($today_month == '01') {
        $month = '12';
        $year = $today_year - 1;
    } else{
        $month = $today_month - 1;
        $month = sprintf("%02d", $month);
        $year = $today_year - 1;
    }

    // ORDERS FOR LAST 30 DAYS (Time calculations)
    $now = strtotime('now');
    // Set the gap time (here 30 days)
    $gap_days = 30;
    $gap_days_in_seconds = 60*60*24*$gap_days;
    $gap_time = $now - $gap_days_in_seconds;

    // The query arguments
    $args = array(
        // WC orders post type
        'post_type'   => 'shop_order',
        // Only orders with status "completed" (others common status: 'wc-on-hold' or 'wc-processing')
        'post_status' => array( 'wc-completed' ),
        // all posts
        'numberposts' => -1,
        // for current user id
        'meta_key'    => '_customer_user',
        'meta_value'  => $user_id,
        'date_query' => array(
            //orders published on last 30 days
            'relation' => 'OR',
            array(
                'year' => $today_year,
                'month' => $today_month,
            ),
            array(
                'year' => $year,
                'month' => $month,
            ),
        ),
    );

    // Get all customer orders
    $customer_orders = get_posts( $args );
    $count = 0;
    $total = 0;
    $no_orders_message = __('No orders this month.', 'mytheme');
    if (!empty($customer_orders)) {
        $customer_orders_date = array();
        // Going through each current customer orders
        foreach ( $customer_orders as $customer_order ){
            // Conveting order dates in seconds
            $customer_order_date = strtotime($customer_order->post_date);
            // Only past 30 days orders
            if ( $customer_order_date > $gap_time ) {
                $customer_order_date;
                $order = new WC_Order( $customer_order->ID );
                $order_items = $order->get_items();
                $total += $order->get_total();
                // Going through each current customer items in the order
                foreach ( $order_items as $order_item ){
                    $count++;
                }
            }
        }
        $number = floatval( preg_replace( '#[^\d.]#', '', $total, $count ) );
        setlocale(LC_MONETARY,"en_US");
        $formated_number = money_format("The price is %i", $number);
        return $formated_number;
    } else {
        return $no_orders_message;
    }
}