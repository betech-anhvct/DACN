<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        if (DB::table('users')) {
            DB::table('users')->truncate();
        }
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail',
                'password' => Hash::make('123456'),
                'address' => '180 Cao Lỗ',
                'phone' => '0123456789',
                'role' => '1',
                'status' => '1',
            ],
            [
                'name' => 'User1',
                'email' => 'user1@gmail',
                'password' => Hash::make('123456'),
                'address' => '180 Cao Lỗ',
                'phone' => '0123456789',
                'role' => '0',
                'status' => '1',
            ]
        ]);

        if (DB::table('products')) {
            DB::table('products')->truncate();
        }
        $sql = ("INSERT INTO `products` (`id`, `id_category`, `name`, `description`, `price`, `status`, `created_at`, `updated_at`) VALUES
        (2, '6', 'Gà sốt BBQ Hàn Quấc', 'Gà rán vỏ giòn rưới sốt BBQ của Hàn Quấc', '83000', '1', NULL, NULL),
        (3, '6', 'Gà Không xương style popeyes', 'Gà rán giòn không xương 3 miếng 1 phần', '80000', '1', NULL, NULL),
        (4, '6', 'Gà sốt cay Hàn Quốc', 'Gà rán rưới sốt cay cấp độ 1', '82000', '1', NULL, NULL),
        (5, '6', 'Gà sốt siêu cay hàn quốc', 'Gà rán rưới sốt cay cấp độ 2', '82000', '1', NULL, NULL),
        (6, '6', 'Gà cay bóng đêm Hàn Quốc', 'Gà rán rưới sốt cay cấp độ 3', '82000', '1', NULL, NULL),
        (7, '1', 'Burger bò cơ bản', 'Burger bò với phần nhân bò dày 1cm', '59000', '1', NULL, NULL),
        (8, '1', 'Burger tôm', 'Burger với phần nhân tôm cùng sốt hải sản', '63000', '1', NULL, NULL),
        (9, '1', 'Burger gà', 'Burger với phần nhân gà không xương tẩm bột chiên giòn', '59000', '1', NULL, NULL),
        (10, '1', 'Burger chay', 'Burger bới phần nhân từ nấm và bông cải xanh', '47000', '1', NULL, NULL),
        (11, '1', 'Burger bò big size', 'Burger bới phần nhân từ nấm và bông cải xanh', '82000', '1', NULL, NULL),
        (12, '1', 'Burger Thanh long Việt Nam', 'Vỏ burger chế biến cùng thanh long đặc biệt chỉ có ở việt nam và phần nhân bò từ bò nội địa', '62000', '1', NULL, NULL),
        (13, '2', 'Pizza cơ bản', 'Pizza với phần đế bình thường và topping bao gồm thịt nguội xúc xích phô mai sốt cà chua', '80000', '1', NULL, NULL),
        (14, '2', 'Pizza Bò', 'Pizza với phần đế cơ bản với topping là bò xay sốt cà chua phô mai cùng với thơm', '86000', '1', NULL, NULL),
        (15, '2', 'Pizza đế nhồi xúc xích', 'Pizza với phần đế nhồi phô mai và phần topping bao gồm thịt nguội xúc xích phô mai', '59000', '1', NULL, NULL),
        (16, '2', 'Pizza chay Bông cải xanh', 'Pizza chay với topping bông cải xanh nấm đông cô thơm trái olive phô mai chay ngũ cốc', '77000', '1', NULL, NULL),
        (17, '2', 'Pizza big size kiểu ý', 'Pizza truyền thống kiểu ý với đường kính 60 cm cùng nguyên liệu hương vị chuẩn ý', '200000', '1', NULL, NULL),
        (18, '2', 'Pizza thanh long việt Nam', 'Sản phẩm thuộc loại đồ ngọt với phần vỏ bánh chế biến cùng với thanh long việt nam phần topping gồm các loại trái cây nhiệt đới', '77000', '1', NULL, NULL),
        (19, '3', 'Salad gà cơ bản', 'Sadlad có phần topping là gà rán viên giòn', '59000', '1', NULL, NULL),
        (20, '3', 'Salad Tôm', 'Salad có phần topping là tôm chiên giòn', '69000', '1', NULL, NULL),
        (21, '3', 'Salad hoa quả', 'Salad thuần chay với phần topping quả nhiệt đới', '59000', '1', NULL, NULL),
        (22, '3', 'Salad kiểu nga', 'Salad truyền thống của nga', '80000', '1', NULL, NULL),
        (23, '3', 'Salad bơ', 'Salad sốt bơ', '46000', '1', NULL, NULL),
        (24, '3', 'Salad Thanh Long Việt Nam', 'Sản phẩm ngọt với salad và thanh long Việt nam', '62000', '1', NULL, NULL),
        (25, '4', 'Tacos truyền thống', 'Phần gồm 2 chiếc tacos nhân bò', '59000', '1', NULL, NULL),
        (26, '4', 'Tacos Hải sản', 'Phần gồm 2 chiếc Tacos 1 nhân tôm và 1 nhân cua', '63000', '1', NULL, NULL),
        (27, '4', 'Tacos nhân gà', 'Phần gồm 2 chiếc với nhân gà ướp', '59000', '1', NULL, NULL),
        (28, '4', 'Tacos chay avocado', 'Tacos với phần nhân gồm bơ ngũ cốc', '47000', '1', NULL, NULL),
        (29, '4', 'Tacos Thanh Long việt Nam', 'Gồm 2 chiếc Tacos có phần vỏ làm cùng với thanh long ruột đỏ của việt nam và phần nhân truyền thống', '82000', '1', NULL, NULL),
        (30, '4', 'Tacos kiểu ấn', 'Phần nhân bánh có hương vị cà ri của ấn độ', '42000', '1', NULL, NULL),
        (31, '5', 'PepSi', 'PepSi lon', '12000', '1', NULL, NULL),
        (32, '5', 'Trà Dâu', 'Ly 500ml', '28000', '1', NULL, NULL),
        (33, '5', 'Trà ô long', 'ly 500ml', '23000', '1', NULL, NULL),
        (34, '5', 'Trà Dâu tằm', 'Ly 500ml', '23000', '1', NULL, NULL),
        (35, '5', 'Milo', 'Milo lon', '15000', '1', NULL, NULL),
        (36, '5', 'Nước Ép Thanh Long', 'Ly 500ml', '32000', '1', NULL, NULL),
        (37, '5', 'Coca Cola', 'Nước giải khát Coca Cola', '15000', '1', NULL, NULL),
        (39, '6', 'Gà truyền thống', 'Gà rán vỏ giòn truyền thống', '79000', '1', NULL, NULL);
        ");
        DB::statement($sql);

        if (DB::table('categories')) {
            DB::table('categories')->truncate();
        }
        $sql = "INSERT INTO `categories` (`id`, `name`) VALUES
        (1, 'Bugger'),
        (2, 'Pizza'),
        (3, 'Salad'),
        (4, 'Tacos'),
        (5, 'Đồ uống'),
        (6, 'Gà rán')";
        DB::statement($sql);


    }
}
