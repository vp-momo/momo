<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Game;
use App\Models\GameMode;
use App\Models\Rank;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EventDaySeeder::class);
        Game::truncate();
        $CLTX = "CLTX";
        $CLTX2 = "CLTX2";
        $TONGSO = "S";
        $MOTPHANBA = "1P3";
        $GAPBA = "G3";
        $LO = "LO";
        $H3 = "H3";
        $XIEN = "XIEN";
        $VANMAY = "VANMAY";
        $DOANSO = "DX";

        Game::insert([
            [
                "ma_game" => $CLTX,
                "KQ" => "2|4|6|8",
                "comment" => "A",
                "h_key" => "a",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $CLTX,
                "KQ" => "1|3|5|7",
                "comment" => "B",
                "h_key" => "b",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $CLTX,
                "KQ" => "1|2|3|4",
                "comment" => "E",
                "h_key" => "c",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $CLTX,
                "KQ" => "5|6|7|8",
                "comment" => "Q",
                "h_key" => "d",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $CLTX2,
                "KQ" => "0|2|4|6|8",
                "comment" => "A2",
                "h_key" => "a",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $CLTX2,
                "KQ" => "1|3|5|7|9",
                "comment" => "B2",
                "h_key" => "b",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $CLTX2,
                "KQ" => "0|1|2|3|4",
                "comment" => "E2",
                "h_key" => "c",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $CLTX2,
                "KQ" => "5|6|7|8|9",
                "comment" => "Q2",
                "h_key" => "d",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $TONGSO,
                "KQ" => "9|19",
                "comment" => "S",
                "h_key" => "a",
                "type" => 0,
                "number" => 3
            ],
            [
                "ma_game" => $TONGSO,
                "KQ" => "6|16",
                "comment" => "S",
                "h_key" => "b",
                "type" => 0,
                "number" => 3
            ],
            [
                "ma_game" => $TONGSO,
                "KQ" => "4|14|24",
                "comment" => "S",
                "h_key" => "c",
                "type" => 0,
                "number" => 3
            ],
            [
                "ma_game" => $MOTPHANBA,
                "KQ" => "0",
                "comment" => "0",
                "h_key" => "a",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $MOTPHANBA,
                "KQ" => "1|2|3",
                "comment" => "1",
                "h_key" => "b",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $MOTPHANBA,
                "KQ" => "4|5|6",
                "comment" => "2",
                "h_key" => "c",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $MOTPHANBA,
                "KQ" => "7|8|9",
                "comment" => "3",
                "h_key" => "d",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $GAPBA,
                "KQ" => "02|13|17|19|21|29|35|37|45|46|51|54|57|62|63|74|83|91",
                "comment" => "G3",
                "h_key" => "a",
                "type" => 1,
                "number" => 2
            ],
            [
                "ma_game" => $GAPBA,
                "KQ" => "06|24|23",
                "comment" => "G3",
                "h_key" => "b",
                "type" => 1,
                "number" => 2
            ],
            [
                "ma_game" => $GAPBA,
                "KQ" => "123|234|456|678|789",
                "comment" => "G3",
                "h_key" => "c",
                "type" => 1,
                "number" => 2
            ],
            [
                "ma_game" => $LO,
                "KQ" => "01|03|12|19|23|24|30|33|39|48|54|55|60|61|71|81|82|83|67|88|76|64",
                "comment" => "LO",
                "h_key" => "a",
                "type" => 1,
                "number" => 2
            ],
            [
                "ma_game" => $H3,
                "KQ" => "3",
                "comment" => "H3",
                "h_key" => "a",
                "type" => 2,
                "number" => 2
            ],
            [
                "ma_game" => $H3,
                "KQ" => "6",
                "comment" => "H3",
                "h_key" => "b",
                "type" => 2,
                "number" => 2
            ],
            [
                "ma_game" => $H3,
                "KQ" => "9",
                "comment" => "H3",
                "h_key" => "c",
                "type" => 2,
                "number" => 2
            ],
            [
                "ma_game" => $XIEN,
                "KQ" => "0|2|4",
                "comment" => "CX",
                "h_key" => "a",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $XIEN,
                "KQ" => "5|7|9",
                "comment" => "LT",
                "h_key" => "b",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $XIEN,
                "KQ" => "6|8",
                "comment" => "CT",
                "h_key" => "c",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $XIEN,
                "KQ" => "1|3",
                "comment" => "LX",
                "h_key" => "d",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $VANMAY,
                "KQ" => "123|345|567|789",
                "comment" => "TIEN",
                "h_key" => "a",
                "type" => 1,
                "number" => 3
            ],
            [
                "ma_game" => $VANMAY,
                "KQ" => "987|765|543|321",
                "comment" => "LUI",
                "h_key" => "b",
                "type" => 1,
                "number" => 3
            ],
            [
                "ma_game" => $VANMAY,
                "KQ" => "0000|1111|2222|3333|4444|5555|6666|7777|8888|9999",
                "comment" => "TUQUY",
                "h_key" => "c",
                "type" => 1,
                "number" => 4
            ],
            [
                "ma_game" => $DOANSO,
                "KQ" => "0",
                "comment" => "D0",
                "h_key" => "a",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $DOANSO,
                "KQ" => "1",
                "comment" => "D1",
                "h_key" => "b",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $DOANSO,
                "KQ" => "2",
                "comment" => "D2",
                "h_key" => "c",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $DOANSO,
                "KQ" => "3",
                "comment" => "D3",
                "h_key" => "d",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $DOANSO,
                "KQ" => "4",
                "comment" => "D4",
                "h_key" => "e",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $DOANSO,
                "KQ" => "5",
                "comment" => "D5",
                "h_key" => "f",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $DOANSO,
                "KQ" => "6",
                "comment" => "D6",
                "h_key" => "g",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $DOANSO,
                "KQ" => "7",
                "comment" => "D7",
                "h_key" => "h",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $DOANSO,
                "KQ" => "8",
                "comment" => "D8",
                "h_key" => "i",
                "type" => 1,
                "number" => 1
            ],
            [
                "ma_game" => $DOANSO,
                "KQ" => "9",
                "comment" => "D9",
                "h_key" => "k",
                "type" => 1,
                "number" => 1
            ]
        ]);

        Device::truncate();
        Device::insert([
           [
               "device" => "SM-G532F",
               "hardware" => "mt6735",
               "facture" => "samsung",
               "MODELID" => "samsung sm-g532gmt6735r58j8671gsw",
           ],
           [
               "device" => "SM-A102U",
               "hardware" => "a10e",
               "facture" => "Samsung",
               "MODELID" => "Samsung SM-A102U",
           ],
           [
               "device" => "SM-A305FN",
               "hardware" => "a30",
               "facture" => "Samsung",
               "MODELID" => "Samsung SM-A305FN",
           ],
           [
               "device" => "HTC One X9 dual sim",
               "hardware" => "htc_e56ml_dtul",
               "facture" => "HTC",
               "MODELID" => "HTC One X9 dual sim",
           ],
           [
               "device" => "HTC 7060",
               "hardware" => "cp5dug",
               "facture" => "HTC",
               "MODELID" => "HTC HTC_7060",
           ],
           [
               "device" => "HTC D10w",
               "hardware" => "htc_a56dj_pro_dtwl",
               "facture" => "HTC",
               "MODELID" => "HTC htc_a56dj_pro_dtwl",
           ],
           [
               "device" => "Oppo realme X Lite",
               "hardware" => "RMX1851CN",
               "facture" => "Oppo",
               "MODELID" => "Oppo RMX1851",
           ],
           [
               "device" => "MI 9",
               "hardware" => "equuleus",
               "facture" => "Xiaomi",
               "MODELID" => "Xiaomi equuleus",
           ],
        ]);

        User::truncate();
        User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("admin12!@"),
            "status" => 1,
            "level" => 1
        ]);
        $this->seedGameMode();
        $this->seedTop();
    }

    protected function seedGameMode(){
        GameMode::truncate();
        GameMode::insert([
            [
                "mode" => "CLTX",
                "name" => "Chẵn lẻ - Tài xỉu",
                "description" => "<p>- <strong>Chẵn lẻ, Tài Xỉu</strong> là một game tính kết quả bằng <strong>1 số cuối mã random</strong>.</p>  <p><strong>- Mỗi game có hạn mức khác nhau nên anh em chú ý</strong></p>",
                "status" => 1
            ],
            [
                "mode" => "CLTX2",
                "name" => "Chẵn lẻ 2 - Tài xỉu 2",
                "description" => "<p><strong>- CHẴN LẺ 2, Tài Xỉu 2 l</strong>à game tính kết quả bằng <strong>số cuối mã random </strong></p>  <p><strong>Mỗi game có hạn mức khác nhau nên anh em chú ý </strong></p>",
                "status" => 1
            ],
            [
                "mode" => "TX",
                "name" => "Tài xỉu",
                "description" => "<p>- <strong>Tài Xỉu</strong> là một game tính kết quả bằng <strong>1 số cuối mã random</strong>.</p> <p>- <strong>Mỗi game có hạn mức khác nhau nên anh em chú ý</strong></p>",
                "status" => 0
            ],
            [
                "mode" => "TX2",
                "name" => "Tài xỉu 2",
                "description" => "<p><strong>- Tài xỉu 2 l</strong>à game tính kết quả bằng <strong>số cuối mã random </strong></p> <p> </p> <p><strong>Mỗi game có hạn mức khác nhau nên anh em chú ý</strong> </p>",
                "status" => 0
            ],
            [
                "mode" => "S",
                "name" => "Tổng 3 Số",
                "description" => "<p>- <strong>Tổng 3 số</strong> là game vô cùng dễ lấy <strong>Tổng 3 số cuối mã random </strong>làm kết quả </p> <p><strong>Mỗi game có hạn mức khác nhau nên anh em chú ý .</strong></p>",
                "status" => 1
            ],
            [
                "mode" => "1P3",
                "name" => "1 phần 3",
                "description" => "<p>- <strong>1 phần 3</strong> là một game tính kết quả bằng 1 <strong>số cuối mã random </strong></p> <p><strong>Mỗi game có hạn mức khác nhau nên anh em chú ý .</strong></p>",
                "status" => 1
            ],
            [
                "mode" => "G3",
                "name" => "Gấp 3",
                "description" => "<p>- <strong>Gấp 3</strong> là một game vô cùng dễ, tính kết quả bằng <strong>2 số cuối mã random</strong>.</p> <p><strong>Mỗi game có hạn mức khác nhau nên anh em chú ý .</strong></p>",
                "status" => 1
            ],
            [
                "mode" => "LO",
                "name" => "Lô",
                "description" => "<p>- <strong>Lô</strong> là một game tính kết quả bằng <strong>2 số cuối mã random</strong>.</p> <p><strong>Mỗi game có hạn mức khác nhau nên anh em chú ý .</strong></p> <p> </p>",
                "status" => 1
            ],
            [
                "mode" => "H3",
                "name" => "H3",
                "description" => "<p>- <strong>H3</strong> là một game tính kết quả bằng <strong>hiệu 2 số cuối mã random</strong>.</p> <p>- Nếu mã giao dịch có hiệu của 2 số <strong>(số trước trừ số sau)</strong> trùng 1 trong những số trên bạn sẽ chiến thắng.</p>",
                "status" => 1
            ],
            [
                "mode" => "XIEN",
                "name" => "Xiên",
                "description" => "<p><strong>- Xiên </strong>là một game tính kết quả bằng 1 số cuối mã random.</p>",
                "status" => 1
            ],
            [
                "mode" => "DX",
                "name" => "Đoán số",
                "description" => "<p>- <strong>Đoán Số</strong> là một game tính kết quả bằng <strong>1 số cuối mã random</strong>.</p>  <p><strong>- Mỗi game có hạn mức khác nhau nên anh em chú ý</strong></p>",
                "status" => 1
            ],
//            [
//                "mode" => "VANMAY",
//                "name" => "Vận may",
//                "description" => "<p><strong>- Vận May </strong> là Game Dự Vào Sự MAy Mắn Của Bạn thân để rinh về những phần quà hấp dẫn</p>",
//                "status" => 1
//            ]
        ]);
    }

    protected function seedTop(){
        Rank::truncate();
        Rank::insert([
            [
                "name" => "1",
                "thuong" => 200000,
                "heso" => 45222302,
            ],
            [
                "name" => "2",
                "thuong" => 150000,
                "heso" => 15223648,
            ],
            [
                "name" => "3",
                "thuong" => 100000,
                "heso" => 58524,
            ],
            [
                "name" => "4",
                "thuong" => 70000,
                "heso" => 28524,
            ],
            [
                "name" => "5",
                "thuong" => 50000,
                "heso" => 18524,
            ],
        ]);
    }
}
