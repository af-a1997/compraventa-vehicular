<?php
    /* Handler for formatting price display. Pass money, symbol and position value.
     *
     * Example: PRI_FormatCost(5000,"$U",1);
     * Returns: [5000 $U]
     */

    function PRI_FormatCost($money, $currency_symbol, $pos = 0){
        $formatted_price = "";

        // Place the symbol of the currency before or after the value, based on the $pos parameter value (0 = before | 1 = after).
        if($pos == 0 || ($pos != 0 && $pos != 1))
            $formatted_price = $currency_symbol." ".$money;
        else if($pos == 1)
            $formatted_price = $money." ".$currency_symbol;

        return $formatted_price;
    }
?>