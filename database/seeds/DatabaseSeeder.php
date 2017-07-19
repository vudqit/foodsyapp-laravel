<?php

use App\User;
use App\Place;
use App\PlaceCategory;
use App\PlaceCategoryDetail;
use App\Product;
use App\ProductCategory;
use App\Order;
use App\OrderDetail;
use App\Comment;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//$this->call(UsersTableSeeder::class);


        //Create ADMIN 
        DB::table('users')->insert([
            'username' => 'foodsyadmin',
            'display_name' => 'admin', 
            'email' => 'fpolyduan2@gmail.com', 
            'password' => bcrypt('fpolyduan2'), 
            'phone_number' => '0909999999', 
            'address' => 'Di An, Binh Duong', 
            'photo' => 'male.png', 
            'gender' => User::GENDER_MALE, 
            'role' => User::ROLE_ADMIN, 
        ]);
        //Create OWNER
        DB::table('users')->insert([
            'username' => 'foodsyowner',
            'display_name' => 'ower', 
            'email' => 'fpolyduan2_ower@gmail.com', 
            'password' => bcrypt('fpolyduan2'), 
            'phone_number' => '0933396050', 
            'address' => 'Di An, Binh Duong', 
            'photo' => 'female.png', 
            'gender' => User::GENDER_FEMALE, 
            'role' => User::ROLE_OWNER,  
        ]);
        //Create USER
        DB::table('users')->insert([
            'username' => 'foodsyuser',
            'display_name' => 'user', 
            'email' => 'fpolyduan2_user@gmail.com', 
            'password' => bcrypt('fpolyduan2'), 
            'phone_number' => '0909878687', 
            'address' => 'Di An, Binh Duong', 
            'photo' => 'male.png', 
            'gender' => User::GENDER_MALE, 
            'role' => User::ROLE_USER, 
        ]);


        //Create static place categories
        DB::table('place_categories')->insert([
            'name' => 'Buffet',
            'description' => PlaceCategory::TO_EAT,
        ]);

        DB::table('place_categories')->insert([
            'name' => 'Nhà hàng',
            'description' => PlaceCategory::TO_EAT,
        ]);

        DB::table('place_categories')->insert([
            'name' => 'Cơm văn phòng',
            'description' => PlaceCategory::TO_EAT,
        ]); 

        DB::table('place_categories')->insert([
            'name' => 'Ăn vặt/vỉa hè',
            'description' => PlaceCategory::TO_EAT,
        ]);

        DB::table('place_categories')->insert([
            'name' => 'Quán ăn',
            'description' => PlaceCategory::TO_EAT,
        ]);

        DB::table('place_categories')->insert([
            'name' => 'Quán nhậu',
            'description' => PlaceCategory::TO_EAT,
        ]);  

        DB::table('place_categories')->insert([
            'name' => 'Beer Club',
            'description' => PlaceCategory::TO_ENTERTAIN,
        ]); 

        DB::table('place_categories')->insert([
            'name' => 'Khu vui chơi',
            'description' => PlaceCategory::TO_ENTERTAIN,
        ]);        

        DB::table('place_categories')->insert([
            'name' => 'Rạp chiếu phim', 
            'description' => PlaceCategory::TO_ENTERTAIN,
        ]);

        DB::table('place_categories')->insert([
            'name' => 'Cafe/Dessert',
            'description' => PlaceCategory::TO_DRINK,
        ]);

        DB::table('place_categories')->insert([
            'name' => 'Cafe/Entertain',
            'description' => PlaceCategory::TO_DRINK,
        ]);

        DB::table('place_categories')->insert([
            'name' => 'Cafe/Pet',
            'description' => PlaceCategory::TO_DRINK,
        ]);	


        // Create place with menu
        // <------------------------------------------------->
        // Place
		DB::table('places')->insert([
			'display_name' => 'Nhà Hàng Ngọc Sương Bến Thuyền', 
			'description'  => 'Từ lâu nhà hàng Ngọc Sương đã là địa điểm
được lựa chọn hàng đầu của quý thực khách sành ăn các món ăn từ hải sản.
Với phong cách riêng, độc đáo trong việc chế biến món ăn và phong cách
phục vụ, chăm sóc khách hàng, Ngọc Sương đã trở thành một thương hiệu ẩm
thực đẳng cấp. http://www.ngocsuong.com.vn/', 
			'address'      => '11 Cầu Công Lý, phường 15, Phú Nhuận, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',
			'phone_number' => '84 8 3844 3861', 
			'email'        => 'nsleisure@ngocsuong.com.vn',
			'photo'        => 'photo.png',
			'price_limit'  => '100.000-1.000.000',
			'time_open'    => '10', 
			'time_close'   => '21', 
			'wifi_password'=> 'ngocsuong123', 
			'latitude'     => '10.7919256',
			'longitude'    => '106.6811827',		
			'user_id'      => '1',
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 1, 
			'category_id'  => '2', 		
		]);
		//Product Category
		DB::table('product_categories')->insert([
            'name' => 'Gỏi & salad',
            'place_id' => '1',
        ]);//1	
        DB::table('product_categories')->insert([
            'name' => 'Món ăn nhẹ',
            'place_id' => '1',
        ]);//2	
        DB::table('product_categories')->insert([
            'name' => 'Sashimi',
            'place_id' => '1',
        ]);//3
        DB::table('product_categories')->insert([
            'name' => 'Hải sản tươi sống',
            'place_id' => '1',
        ]);//4
        DB::table('product_categories')->insert([
            'name' => 'Heo - gà - bò',
            'place_id' => '1',
        ]);//5
        DB::table('product_categories')->insert([
            'name' => 'Lẩu',
            'place_id' => '1',
        ]);//6
        DB::table('product_categories')->insert([
            'name' => 'Cơm - miến - rau',
            'place_id' => '1',
        ]);//7
        DB::table('product_categories')->insert([
            'name' => 'Món ăn phụ',
            'place_id' => '1',
        ]);//8
        DB::table('product_categories')->insert([
            'name' => 'Món tráng miệng',
            'place_id' => '1',
        ]);//9
        //Product
        DB::table('products')->insert([
			'name'  	   => 'Salad trộn dầu giấm',
			'price'		   => '85000',
			'type'		   => Product::TO_EAT,
			'description'  => 'Rau tươi trộn dầu giấm. Tốt cho sức khỏe',
			'category_id'  => '1',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Salad trộn cá hồi xông khói',
			'price'		   => '120000',
			'type'		   => Product::TO_EAT,
			'description'  => 'Cá hồi xông khói trộn rau',
			'category_id'  => '1',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cháo hàu hành gừng',
			'price'		   => '45000',
			'type'		   => Product::TO_EAT,
			'description'  => 'Hàu tươi',
			'category_id'  => '2',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Súp nấm hải sản',
			'price'		   => '55000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '2',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Mâm sashimi (1 - 2 người)',
			'price'		   => '185000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '3',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cá hồi xông khói cuốn phô mai kem',
			'price'		   => '139000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '3',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cá mú hấp nấm xì dầu (kg)',
			'price'		   => '680000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '4',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cua rang muối tiêu (kg)',
			'price'		   => '570000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '4',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Bò Úc cuốn phô mai kem',
			'price'		   => '175000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '5',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Gà ta nướng ống tre',
			'price'		   => '268000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '5',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Lẩu nấm hải sản',
			'price'		   => '540000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '6',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Lẩu hải sản Thái Lan',
			'price'		   => '380000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '6',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cơm chiên cá mặn',
			'price'		   => '105000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '7',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cơm hải sản chảo nóng',
			'price'		   => '155000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '7',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Bánh mì bơ tỏi',
			'price'		   => '25000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '8',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cơm trắng',
			'price'		   => '25000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '8',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Kem vani',
			'price'		   => '33000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '9',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Trái cây thập cẩm',
			'price'		   => '110000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '9',
		]);
		// <------------------------------------------------->
		//Place
		DB::table('places')->insert([
			'display_name' => 'Poodle House',	 
			'description'  => 'Mô hình cà phê thú cưng và đặc biệt quán chuyên về giống chó Poodle.',	
			'address'      => '179/5A Nguyễn Văn Trỗi, phường 11, Phú Nhuận, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',	
			'phone_number' => '84 122 306 1208',
			'email'        => 'poddlehouse@gmail.com', 
			'photo'        => 'photo.png', 
			'price_limit'  => '40.000-100.000',
			'time_open'    => '7', 
			'time_close'   => '22:30', 
			'wifi_password'=> 'poppycute',
			'latitude'     => '10.7917176', 
			'longitude'    => '106.6815269',			
			'user_id'      => '1',
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 2, 
			'category_id'  => '11', 		
		]);
		//Product category
		DB::table('product_categories')->insert([
            'name' => 'Phụ thu',
            'place_id' => '2',
        ]);//10
        DB::table('product_categories')->insert([
            'name' => 'Bánh',
            'place_id' => '2',
        ]);//11
        DB::table('product_categories')->insert([
            'name' => 'Coffee',
            'place_id' => '2',
        ]);//12
        DB::table('product_categories')->insert([
            'name' => 'Coffee đá xay',
            'place_id' => '2',
        ]);//13
        DB::table('product_categories')->insert([
            'name' => 'Coffee Ý',
            'place_id' => '2',
        ]);//14
        DB::table('product_categories')->insert([
            'name' => 'Đồ Ăn',
            'place_id' => '2',
        ]);//15
        //Product
        DB::table('products')->insert([
			'name'  	   => 'Phụ thu',
			'price'		   => '30000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '10',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Pizza Mini',
			'price'		   => '39000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '11',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Pateso',
			'price'		   => '39000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '11',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Bạc Xỉu',
			'price'		   => '40000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '12',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Sữa tươi café',
			'price'		   => '40000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '12',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Caramel Đá Xay',
			'price'		   => '64000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '13',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Hazelnut',
			'price'		   => '64000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '13',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Americano',
			'price'		   => '49000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '14',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Mocha nóng',
			'price'		   => '64000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '14',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Bò lúc lắc',
			'price'		   => '69000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '15',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Mỳ xào bò',
			'price'		   => '69000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '15',
		]);
		// <------------------------------------------------->
		//Place
		DB::table('places')->insert([
			'display_name' => 'BinBon\'s Shop Homemade food',
			'description'  => 'Chuyên các món ăn nhanh -ngon-rẻ-hợp VSATTP- giá cả hợp lí nhất ship tận nơi không lo mưa hay nắng ạ ',
			'address'      => '1162/45 Trường Sa, phường 12, Phú Nhuận, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',
			'phone_number' => '84 90 333 74 30',
			'email'        => 'bonbon@gmail.com', 
			'photo'        => 'photo.png', 
			'price_limit'  => '40.000-200.000',
			'time_open'    => '8', 
			'time_close'   => '20:30',
			'wifi_password'=> 'binbonshop123', 
			'latitude'     => '10.7915078', 
			'longitude'    => '106.6813895',			
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 3,  
			'category_id'  => '2', 		
		]);
		//Product category
		DB::table('product_categories')->insert([
            'name' => 'Menu',
            'place_id' => '3',
        ]);//16
        //Product
        DB::table('products')->insert([
			'name'  	   => 'Trà đào',
			'price'		   => '15000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '16',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Gà rán',
			'price'		   => '35000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '16',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Gà viên sốt phô mai',
			'price'		   => '35000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '16',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Gà xốt cay',
			'price'		   => '35000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '16',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Tokk lắc phô mai',
			'price'		   => '30000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '16',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Tokk sốt cay',
			'price'		   => '40000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '16',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cơm cuộn HQ',
			'price'		   => '30000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '16',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Tôm rang hột vịt muối',
			'price'		   => '35000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '16',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Xúc xích cuộn phô mai',
			'price'		   => '15000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '16',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cơm thêm',
			'price'		   => '5000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '16',
		]);
		// <------------------------------------------------->
		//Place
		DB::table('places')->insert([
			'display_name' => 'Matsu Sushi', 
			'description'  => 'Sushi tươi ngon', 
			'address'      => '886 Trường Sa, P. 13,  Quận 3, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',	
			'phone_number' => '84 128 612 0001',
			'email'        => 'matsusushivn@hotmail.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '50.000-300.000',
			'time_open'    => '11', 
			'time_close'   => '23', 
			'wifi_password'=> 'matsushushi', 
			'latitude'     => '10.7920685',
			'longitude'    => '106.6819988',		
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 4,  
			'category_id'  => '5', 		
		]);
		//Product category
		DB::table('product_categories')->insert([
            'name' => 'Maki',
            'place_id' => '4',
        ]);//17
        DB::table('product_categories')->insert([
            'name' => 'Matsu Menu',
            'place_id' => '4',
        ]);//18
        DB::table('product_categories')->insert([
            'name' => 'Nigiri Sushi',
            'place_id' => '4',
        ]);//19
        DB::table('product_categories')->insert([
            'name' => 'Obento',
            'place_id' => '4',
        ]);//20
        //Product
        DB::table('products')->insert([
			'name'  	   => 'Maki cá hồi',
			'price'		   => '35000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '17',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Aji furai',
			'price'		   => '40000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '18',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Kake udon',
			'price'		   => '50000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '18',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Nigi Sushi n12',
			'price'		   => '25000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '19',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Nigi Sushi n15',
			'price'		   => '30000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '19',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Mtsu sushi bento',
			'price'		   => '95000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '20',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Sashimi tem',
			'price'		   => '180000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '20',
		]);
		// <------------------------------------------------->
		//Place
		DB::table('places')->insert([
			'display_name' => 'Gallerie Cafe', 
			'description'  => 'Phong cách cổ điển, nhạc nhẹ.
Nước uống : Smoothie - Mojito - Juice - Coffee ...
Thức Ăn : Hủ tiếu xào hải sản - Cơm chiên dương châu - Bánh mỳ ốp la ...', 
			'address'      => '582 Trường Sa, quận Phú Nhuận, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',	
			'phone_number' => '090 816 92 99',
			'email'        => 'galleriecafe582truongsa@gmail.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '30.000-70.000',
			'time_open'    => '8', 
			'time_close'   => '22:30', 
			'wifi_password'=> 'galleriecafe582', 
			'latitude'     => '10.7921548',
			'longitude'    => '106.6822058',		
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 5, 
			'category_id'  => '11', 		
		]);
		//Product category
		DB::table('product_categories')->insert([
            'name' => 'Chilled Chilli',
            'place_id' => '5',
        ]);//21
        DB::table('product_categories')->insert([
            'name' => 'Coffee',
            'place_id' => '5',
        ]);//22
        DB::table('product_categories')->insert([
            'name' => 'Detox Tea',
            'place_id' => '5',
        ]);//23
        DB::table('product_categories')->insert([
            'name' => 'Choice Of Cake',
            'place_id' => '5',
        ]);//24
        DB::table('product_categories')->insert([
            'name' => 'Fruit Tea',
            'place_id' => '5',
        ]);//25
        //Product
        DB::table('products')->insert([
			'name'  	   => 'Spicy mango',
			'price'		   => '85000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '21',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Spicy sunrise',
			'price'		   => '74000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '21',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cafe đen',
			'price'		   => '41000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '22',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Cafe sữa',
			'price'		   => '49000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '22',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Trà detox',
			'price'		   => '60000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '23',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Black Forest',
			'price'		   => '74000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '24',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Coconut taro',
			'price'		   => '60000',
			'type'		   => Product::TO_EAT,
			'category_id'  => '24',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Lipton chanh đào',
			'price'		   => '41000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '25',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Trà xanh vải nha đam',
			'price'		   => '52000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '25',
		]);
		// <------------------------------------------------->
		//Place
		DB::table('places')->insert([
			'display_name' => 'Tous Les Jours', 
			'description'  => 'Cafe, lò bánh mì phong cách Pháp', 
			'address'      => '382 Nam Kỳ Khởi Nghĩa, phường 8, Quận 3, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',	
			'phone_number' => '84 93 401 55 12',
			'email'        => 'tourslesjours@gmail.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '25.000-300.000',
			'time_open'    => '7:30', 
			'time_close'   => '22', 
			'wifi_password'=> 'jourles', 
			'latitude'     => '10.79046',
			'longitude'    => '106.6833',		
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 6, 
			'category_id'  => '10', 		
		]);
		//Product category
		DB::table('product_categories')->insert([
            'name' => 'Coffee',
            'place_id' => '6',
        ]);//26
        DB::table('product_categories')->insert([
            'name' => 'Smothies and Juices',
            'place_id' => '6',
        ]);//27
        DB::table('product_categories')->insert([
            'name' => 'Tea and other beverages',
            'place_id' => '6',
        ]);//28
        //Product
        DB::table('products')->insert([
			'name'  	   => 'Aericano',
			'price'		   => '40000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '26',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Latte',
			'price'		   => '55000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '26',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Coffee Mocha',
			'price'		   => '59000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '26',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Sinh tố chanh dây',
			'price'		   => '45000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '27',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Sinh tố Oreo/trà xanh',
			'price'		   => '55000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '27',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Sinh tố coffee',
			'price'		   => '59000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '27',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Trà Tropical',
			'price'		   => '45000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '28',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Trà xanh Lotte',
			'price'		   => '55000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '28',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Trà thanh liên mật ong',
			'price'		   => '45000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '28',
		]);
		// <------------------------------------------------->
		//Place
		DB::table('places')->insert([
			'display_name' => 'Diệu Pháp Chay', 
			'description'  => 'Nhà hàng chay', 
			'address'      => '303 Nam Kỳ Khởi Nghĩa, phường 7, Quận 3, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',	
			'phone_number' => '84 90 558 89 98',
			'email'        => 'dieuphapchay@gmail.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '50.000-200.000',
			'time_open'    => '6:30', 
			'time_close'   => '21', 
			'wifi_password'=> 'dieuphapchay', 
			'latitude'     => '10.79030',
			'longitude'    => '106.6832',			
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 7, 
			'category_id'  => '2', 		
		]);
		//Product category
		DB::table('product_categories')->insert([
            'name' => 'Giải khát ',
            'place_id' => '7',
        ]);//29
        DB::table('product_categories')->insert([
            'name' => 'Smothies and Juices',
            'place_id' => '7',
        ]);//30
        DB::table('product_categories')->insert([
            'name' => 'Tea and other beverages',
            'place_id' => '7',
        ]);//31
        DB::table('product_categories')->insert([
            'name' => 'Tea and other beverages',
            'place_id' => '7',
        ]);//32
        DB::table('product_categories')->insert([
            'name' => 'Tea and other beverages',
            'place_id' => '7',
        ]);//33
		//Product
        DB::table('products')->insert([
			'name'  	   => 'Aericano',
			'price'		   => '40000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '26',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Latte',
			'price'		   => '55000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '26',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Coffee Mocha',
			'price'		   => '59000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '26',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Sinh tố chanh dây',
			'price'		   => '45000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '27',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Sinh tố Oreo/trà xanh',
			'price'		   => '55000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '27',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Sinh tố coffee',
			'price'		   => '59000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '27',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Trà Tropical',
			'price'		   => '45000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '28',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Trà xanh Lotte',
			'price'		   => '55000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '28',
		]);
		DB::table('products')->insert([
			'name'  	   => 'Trà thanh liên mật ong',
			'price'		   => '45000',
			'type'		   => Product::TO_DRINK,
			'category_id'  => '28',
		]);
		// <------------------------------------------------->
		DB::table('places')->insert([
			'display_name' => 'Cây trứng cá', 
			'description'  => 'Quán ăn', 
			'address'      => '384/9B Nam Kỳ Khởi Nghĩa, Bến Thành, Quận 3, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',	
			'phone_number' => '84 91 629 11 26',
			'email'        => 'caytrungca@gmail.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '69.000-1.950.000',
			'time_open'    => '16', 
			'time_close'   => '22', 
			'wifi_password'=> 'trungca321', 
			'latitude'     => '10.79124',
			'longitude'    => '106.683',		
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 8, 
			'category_id'  => '5', 		
		]);


		// <------------------------------------------------->
		DB::table('places')->insert([
			'display_name' => 'Café de Nam - Café Phố', 
			'description'  => 'Quán cafe', 
			'address'      => '459 Hoàng Sa, phường 8, Quận 3, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',	
			'phone_number' => '1900 1235',
			'email'        => 'caffePhoNam@caffenam.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '50.000-100.000',
			'time_open'    => '7', 
			'time_close'   => '22', 
			'wifi_password'=> 'cafeNam', 
			'latitude'     => '10.7896763',
			'longitude'    => '106.6816904',		
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 9, 
			'category_id'  => '11', 		
		]);


		// <------------------------------------------------->
		DB::table('places')->insert([
			'display_name' => 'May cafe', 
			'description'  => 'Quán cafe', 
			'address'      => '384/21c Nam Kỳ Khởi Nghĩa, phường 8, Quận 3, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',	
			'phone_number' => '84 93 937 93 47',
			'email'        => 'Maycaffee@hotmail.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '12.000 - 50.000',
			'time_open'    => '8', 
			'time_close'   => '22', 
			'wifi_password'=> 'maymay123', 
			'latitude'     => '10.7915124',
			'longitude'    => '106.6834033',		
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 10, 
			'category_id'  => '11', 		
		]);

		// <------------------------------------------------->
		DB::table('places')->insert([
			'display_name' => 'Trà chanh Wifi', 
			'description'  => 'Thư giản với cốc trà chanh', 
			'address'      => 'p. Dĩ An tx. Dĩ An, 5 Truông Tre, p. Dĩ An, Tx. Dĩ An, Bình Dương, Vietnam',
			'city'		   => 'Dĩ An',	
			'phone_number' => '84 93 702 20 60',
			'email'        => 'trasuawifi@gmail.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '12.000 - 50.000',
			'time_open'    => '8', 
			'time_close'   => '22', 
			'wifi_password'=> 'trachanh', 
			'latitude'     => '10.895444',
			'longitude'    => '106.76755',		
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 10, 
			'category_id'  => '11', 		
		]);


		// <------------------------------------------------->
		DB::table('places')->insert([
			'display_name' => 'Quán chay Thiện Bảo', 
			'description'  => 'Các món chay ngon', 
			'address'      => 'p. Dĩ An tx. Dĩ An, 5 Truông Tre, p. Dĩ An, Tx. Dĩ An, Bình Dương, Vietnam',
			'city'		   => 'Dĩ An',	
			'phone_number' => '84 90 40192 87',
			'email'        => 'comthienbao@gmail.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '12.000 - 50.000',
			'time_open'    => '8', 
			'time_close'   => '22', 
			'wifi_password'=> 'monchayngon', 
			'latitude'     => '10.895792',
			'longitude'    => '106.767944',		
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 10, 
			'category_id'  => '11', 		
		]);

		// <------------------------------------------------->
		DB::table('places')->insert([
			'display_name' => 'The S Caffe', 
			'description'  => 'thescaffe.vn', 
			'address'      => '115/3 Lê Văn Sỹ, phường 13, Phú Nhuận, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',	
			'phone_number' => '84 88 894 04 99',
			'email'        => 'SCaffee@hotmail.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '12.000 - 50.000',
			'time_open'    => '8', 
			'time_close'   => '22', 
			'wifi_password'=> 'thankyousomuch', 
			'latitude'     => '10.838781',
			'longitude'    => '106.737236',		
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 10, 
			'category_id'  => '11', 		
		]);
		// <------------------------------------------------->
		DB::table('places')->insert([
			'display_name' => 'Relax Garden', 
			'description'  => 'Nơi nghi chân thư giãn', 
			'address'      => '12AB Thanh Đa, phường 27, Cư xá Thanh Đa, phường 27, Bình Thạnh, Hồ Chí Minh, Vietnam',
			'city'		   => 'HCM',	
			'phone_number' => '84 88 894 04 99',
			'email'        => 'RG@gmail.com',
			'photo'        => 'photo.png', 
			'price_limit'  => '12.000 - 50.000',
			'time_open'    => '8', 
			'time_close'   => '22', 
			'wifi_password'=> 'garden111', 
			'latitude'     => '10.811108',
			'longitude'    => '106.720628',		
			'user_id'      => '1'
		]);
		DB::table('place_category_details')->insert([
			'place_id'     => 10, 
			'category_id'  => '11', 		
		]);



		// Hard data for order
		// DB::table('orders')->insert([
		// 	'phone_number' => '0909999999', 
		// 	'user_id'      => '1', 		
		// ]);
		// DB::table('order_details')->insert([
		// 	'order_id'     => '1', 
		// 	'product_id'   => '3',
		// 	'quantity' 	   => '4',
		// ]);

		// DB::table('orders')->insert([
		// 	'phone_number' => '0909999999', 
		// 	'user_id'      => '1', 		
		// ]);
		// DB::table('order_details')->insert([
		// 	'order_id'     => '2', 
		// 	'product_id'   => '1',
		// 	'quantity' 	   => '2',
		// ]);

		// DB::table('orders')->insert([
		// 	'phone_number' => '0933396050', 
		// 	'user_id'      => '2', 		
		// ]);
		// DB::table('order_details')->insert([
		// 	'order_id'     => '3', 
		// 	'product_id'   => '6',
		// 	'quantity' 	   => '4',
		// ]);

		// DB::table('orders')->insert([
		// 	'phone_number' => '0909878687', 
		// 	'user_id'      => '3', 		
		// ]);
		// DB::table('order_details')->insert([
		// 	'order_id'     => '4', 
		// 	'product_id'   => '5',
		// 	'quantity' 	   => '2',
		// ]);


		//Comment
		DB::table('comments')->insert([
			'message'      => 'Để ăn thử xem thế nào', 
			'photo'        => 'photo.png', 		
			'rating' 	   => 5,
			'like'         => '0',
			'user_id'      => '3',
			'place_id'     => '1',
		]);

		DB::table('comments')->insert([
			'message'      => 'Cũng không tệ!?', 
			'photo'        => 'photo.png', 		
			'rating' 	   => 2.5,
			'like'         => '0',
			'user_id'      => '2',
			'place_id'     => '1',
		]);
    }
}
