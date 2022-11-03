<?php
namespace App\Helpers;
class MoneyHelpers {
   public static function format_money($money): string
   {
        if(!$money) {
            return "\$0.00";
        }

        $money = number_format($money, 2);

        if(str_contains($money, '-')) {
            $formatted = explode('-', $money);
            return "-\$$formatted[1]";
        }

        return "\$$money";
    }
}
