<?php
if (! function_exists('handleMenuOpen')) {
    function handleMenuOpen($url): string
    {
        $input = '/[a-z0-9A-Z]?+';
        $result = preg_match('#' . $url . $input . '#', url()->current() . '/' );
        if($result) return 'menu-is-opening menu-open';
        return '';
    }
}

if (! function_exists('handleMenuActive')) {
    function handleMenuActive($url): string
    {
        $input = '/[a-z0-9A-Z]?+';
        $result = preg_match('#' . $url . $input . '#', url()->current() . '/' );
        if($result) return 'active';
        return '';
    }
}
if (! function_exists('generateRandom')) {
    function generateRandom($length = 20): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
if (! function_exists('generateRandomString')) {
    function generateRandomString($length = 20): string
    {
        $characters = '0123456789abcdef';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
if (! function_exists('generateImei')) {
    function generateImei(): string
    {
        return generateRandomString(8) . '-' . generateRandomString(4) . '-' . generateRandomString(4) . '-' . generateRandomString(4) . '-' . generateRandomString(12);
    }
}
if (! function_exists('get_TOKEN')) {
    function get_TOKEN(): string
    {
        return  generateRandom(22) . ':' . generateRandom(9) . '-' . generateRandom(20) . '-' . generateRandom(12) . '-' . generateRandom(7) . '-' . generateRandom(7) . '-' . generateRandom(53) . '-' . generateRandom(9) . '_' . generateRandom(11) . '-' . generateRandom(4);
    }
}
if (! function_exists('get_SECUREID')) {
    function get_SECUREID($length = 17): string
    {
        $characters = '0123456789abcdef';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
if(!function_exists('chuyendoi')){
    function chuyendoi($type)
    {
        $data = array(
            "0162" => "032",
            "0163" => "033",
            "0164" => "034",
            "0165" => "035",
            "0166" => "036",
            "0167" => "037",
            "0168" => "038",
            "0169" => "039",
            "0120" => "070",
            "0121" => "079",
            "0122" => "077",
            "0126" => "076",
            "0128" => "078",
            "0123" => "083",
            "0124" => "084",
            "0125" => "085",
            "0127" => "081",
            "0129" => "082",
            "0188" => "058",
            "0186" => "056",
            "0199" => "059"
        );
        return $data[$type];
    }
}
if(!function_exists('chuyendoiso')){
    function chuyendoiso($phone)
    {
        if (strlen($phone) > 10 && strlen($phone) <= 11) {
            $heso = chuyendoi(substr($phone, 0, 4));
            if (!empty($heso)) {
                return $heso . substr($phone, 4);
            } else {
                return "0522983013";
            }
        } else if (strlen($phone) >= 10 && strlen($phone) < 11) {
            return $phone;
        } else {
            return "0522983013";
        }
    }
}
if(!function_exists('getStatusHistory')){
    function getStatusHistory($type){
        switch ($type) {
            case 0:
                $text = "<font color='red'>Thua cuộc</font>";
                break;
            case 1:
                $text = "<font color='green'>Chiến thắng</font>";
                break;
            case 2:
                $text = "<font color='red'>CHiến Thắng (Chờ tt)</font>";
                break;
            case 3:
                $text = "<font color='green'>Hoàn trả</font>";
                break;
            case 4:
                $text = "<font color='orange'>Sai nội dung</font>";
                break;
            case 5:
                $text = "<font color='red'>Sai hạn mức</font>";
                break;
            case 6:
                $text = "Lỗi Thanh Toán (Lh: admin)";
                break;
            case 7:
                $text = "Chờ lấy kết quả random!";
                break;
            default:
                $text = "Không xác định";
                break;
        }
        return $text;
    }
}
if(!function_exists('tinhtong')){
    function tinhtong($n)
    {

        $total = substr($n, 0, 1);
        for ($i = 1; $i < strlen($n); $i++) {
            $so = substr($n, $i, 1);
            $total = $total + $so;
        }
        return $total;
    }
}
if(!function_exists('tinhhieu')){
    function tinhhieu($n)
    {

        $total = substr($n, 0, 1);
        for ($i = 1; $i < strlen($n); $i++) {
            $so = substr($n, $i, 1);
            $total = $total - $so;
        }
        return $total;
    }
}
if(!function_exists('so_nguyen')){
    function so_nguyen($price)
    {
        return str_replace(",", "", number_format($price));
    }
}
if(!function_exists('xoakhoangchong')){
    function xoakhoangchong($data)
    {
        $text = html_entity_decode(trim(strip_tags($data)), ENT_QUOTES, 'UTF-8');
//        $text = str_replace(" ", "%20", $text);
        return strtolower($text);
    }
}
