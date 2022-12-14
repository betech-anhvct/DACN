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

        if (DB::table('images')) {
            DB::table('images')->truncate();
        }
        $sql = "INSERT INTO `images` (`id`, `id_product`, `name`, `status`, `created_at`, `updated_at`) VALUES
        (11, '4', 'ISKlA0yNbMF6gxyUovY0uI4ploaHrO59YyYwgpm5.jpg', '1', '2022-11-14 02:24:33', '2022-11-14 02:24:33'),
        (12, '5', 'V0UzbgESrFIpbtfV406jRTbiBzf6nJdDi8q8qeSo.jpg', '1', '2022-11-15 03:27:38', '2022-11-15 03:27:38'),
        (13, '6', '5YoGwsasAIUzLEtQtFge8CtyThC6hYXTBhQYNqQM.jpg', '1', '2022-11-15 03:27:50', '2022-11-15 03:27:50'),
        (14, '39', 'hZGSJQo3AcXn2ossJfvRTPfYD9Es01snfcTc0adk.jpg', '1', '2022-11-15 03:31:10', '2022-11-15 03:31:10'),
        (15, '2', '2uYzO7DO5cFVrAIBkel29j7lgLgK1Hr57t5B63KG.jpg', '1', '2022-11-15 03:31:22', '2022-11-15 03:31:22'),
        (16, '3', 'L1RFHUydPVETOeCYPxBpRwLP2AdSco7G10XeBSKA.jpg', '1', '2022-11-15 03:31:29', '2022-11-15 03:31:29'),
        (17, '7', 'uSQKY6UEUxCzuRq7O7d7MvohFiwqICOOZjX5SmMl.jpg', '1', '2022-11-15 03:37:32', '2022-11-15 03:37:32'),
        (18, '8', 'PtZcvGgNwL6OLTFYSIVMTpLQaMfSvMOZuoOr1CA7.jpg', '1', '2022-11-15 03:39:32', '2022-11-15 03:39:32'),
        (19, '9', 'm2TA0JukkCyJfdCqYFHMHsO3AYwAAqJUPtAEvFvY.jpg', '1', '2022-11-15 03:39:41', '2022-11-15 03:39:41'),
        (20, '10', 'PeJKWi3Uz0yS9vLuOQVwGokwcAPqCm3SrJGRxhyW.jpg', '1', '2022-11-15 03:39:52', '2022-11-15 03:39:52'),
        (21, '11', 'kj79GuC7Jfmd8HpMgStEN0I1FNt5uPv2820glaJM.jpg', '1', '2022-11-15 03:40:03', '2022-11-15 03:40:03'),
        (23, '18', '6DsYNXfn1W73djppEOn5j2FlHvr4hWt4woJyAJ3j.jpg', '1', '2022-11-15 03:42:33', '2022-11-15 03:42:33'),
        (24, '13', 'LSP4boYU9ozC96EWnK0DwSYjl79Cim31asPHXQbF.jpg', '1', '2022-11-15 03:42:55', '2022-11-15 03:42:55'),
        (25, '14', 'REqypiyqqyb98jjmjHULFSPDwSTSbQKuYQFNC2DR.jpg', '1', '2022-11-15 03:43:03', '2022-11-15 03:43:03'),
        (28, '16', '7aKXsPLON4Xpwb07xuMG4qbCISDzLmc2KcJRUWZV.jpg', '1', '2022-11-15 03:43:44', '2022-11-15 03:43:44'),
        (29, '17', 'RUZ5kgd6GIJBO5lsgP8OZ7eT6aVBomiVAWhrPNUE.jpg', '1', '2022-11-15 03:43:45', '2022-11-15 03:43:45'),
        (30, '15', 'GRaEmMbRNzOXg2KFZKL0rMMzabUWNz1Nu9TkOK3d.jpg', '1', '2022-11-15 03:44:20', '2022-11-15 03:44:20'),
        (31, '12', 'ZJFRa93CVniawYgfHNgW0eoycsHYHUU9xuxl7GdY.jpg', '1', '2022-11-15 03:44:30', '2022-11-15 03:44:30'),
        (32, '19', '4U0im9QfrLPzoZTmGLgrNJOWdTxDax4wPu4OvPRo.jpg', '1', '2022-11-15 03:46:47', '2022-11-15 03:46:47'),
        (33, '20', 'daN5EyML4xBRV2t6L8GIgU6xz4EbDClKN8Q0FflI.jpg', '1', '2022-11-15 03:46:52', '2022-11-15 03:46:52'),
        (34, '21', 'hPGBoSEk8x8lEwLfxsf6Q7VUICuEjhTF26hO9ifz.jpg', '1', '2022-11-15 03:46:57', '2022-11-15 03:46:57'),
        (35, '22', 'FyEoz4omYri0iViovmhBku4fmj9NXaO2pG3vRSaD.jpg', '1', '2022-11-15 03:47:03', '2022-11-15 03:47:03'),
        (36, '23', 'mkqsTvvLxpAl36hnRooLfoT0KrgocuO3bGHsQEH0.jpg', '1', '2022-11-15 03:47:11', '2022-11-15 03:47:11'),
        (37, '24', '2AxT0EUdxSIgFgFtWLHB2tx6yzpX0sZVKXbt9Ib1.jpg', '1', '2022-11-15 03:47:15', '2022-11-15 03:47:15'),
        (38, '25', 'UmWLRy8iumF9cyz1BeLcX4lC9ZLr6fiSa925CrdN.jpg', '1', '2022-11-15 03:49:48', '2022-11-15 03:49:48'),
        (39, '26', 'z988T3sYk5j5ybSpIKljhHmzQo4FLQ7C6KBnEiBU.jpg', '1', '2022-11-15 03:49:54', '2022-11-15 03:49:54'),
        (40, '27', 'NM0X458ejuNmetPkLrcjElZXdeGAjOFC2WEfnmIC.jpg', '1', '2022-11-15 03:49:58', '2022-11-15 03:49:58'),
        (41, '28', '7DiVkwYdOQCXrEXgIm81gs7OrU8rDcgDhFGY7CoP.jpg', '1', '2022-11-15 03:50:02', '2022-11-15 03:50:02'),
        (42, '29', 'UAG9Ex5GkJsKfSc7rkhk0otGrt2eP5y4upRMA2ws.jpg', '1', '2022-11-15 03:50:07', '2022-11-15 03:50:07'),
        (43, '30', '1F5VvImUB3583QDTZOit09gcNlauQhybShBeW1f7.jpg', '1', '2022-11-15 03:50:13', '2022-11-15 03:50:13'),
        (44, '31', 'KcoFJ3AWA5zZuM8d9NY0Pzph6zgEwIxVG8gavbv9.jpg', '1', '2022-11-15 03:51:11', '2022-11-15 03:51:11'),
        (45, '32', 'SB3uyN2jVgaReqhDb31fythnvazpZUEURbl5zs0P.jpg', '1', '2022-11-15 03:51:15', '2022-11-15 03:51:15'),
        (46, '33', 'lozt7hPeleNRuKr91MJ52oeWk3Nhtkid3ZOyt0pK.jpg', '1', '2022-11-15 03:51:19', '2022-11-15 03:51:19'),
        (47, '34', 'EEaNKSUHl2Xg8zijUnqJ8H9u73oQFWYgaf3f3P12.jpg', '1', '2022-11-15 03:51:23', '2022-11-15 03:51:23'),
        (48, '35', 'UZkfeig4wHhQlKhd2cm4RwcfrmDTKQ9KCtxYgZSz.jpg', '1', '2022-11-15 03:51:28', '2022-11-15 03:51:28'),
        (49, '36', 'eiZHeBnctgbPmhlGkW8fRyubF2eiSEAoddlp2Dn8.jpg', '1', '2022-11-15 03:51:33', '2022-11-15 03:51:33'),
        (50, '37', '444xKH2YAGaDyYpP5Z5kMq9IE0CluEzY3uc9g1kP.jpg', '1', '2022-11-15 03:51:47', '2022-11-15 03:51:47');";
        DB::statement($sql);

        if (DB::table('vouchers')) {
            DB::table('vouchers')->truncate();
        }
        $sql = "INSERT INTO `vouchers` (`id`, `name`, `code`, `condition`, `product_list`, `discount`, `description`, `quantity`, `begin_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
        (1, 'Mã giảm giá 20k', 'lf2yRxC5vZ', '1', '0', '20000', NULL, '10', '2022-11-16 14:57:00', '2023-01-31 14:59:00', '1', '2022-11-16 00:59:12', '2022-11-16 08:24:23'),
        (2, 'Mã giảm giá 50k', 'fR0N9Eb3b4', '1', '0', '50000', NULL, '10', '2022-11-16 01:11:00', '2022-12-16 15:21:00', '1', '2022-11-16 08:20:43', '2022-11-16 08:21:37');";
        DB::statement($sql);
    }
}
