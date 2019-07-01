<?php


/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt,
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'lethucvinh' );

/** Username của database */
define( 'DB_USER', 'lethucvinh' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '@Nothing20152017' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         't!?^Y6X_2<@h;+SF2(^`Y6j(LiUaVe/6enKr3HB`F4)NsE(5]nf0z[^-)e6fLQMY' );
define( 'SECURE_AUTH_KEY',  '80qp.UE{I_;xlHd{}c6MS62E)/HJkcJ8[8O l/E^Q;=ulY#`b_6cM!#%(Zk<6bH?' );
define( 'LOGGED_IN_KEY',    'S7PD3Ix];^J0*QFvP NMO+V_h#wb*aOqkBDFg+3#CB Wi_RupV=F=Z$Y`:{C~tdC' );
define( 'NONCE_KEY',        '&cT2?7A/b~nHr+P#p{muZ&}&}WE]9>OJvQ(vdEPg(dp5^G-7GX5PDKuaVA&oWtp]' );
define( 'AUTH_SALT',        'm:>CK_fYKRST]r~aKKgoI2}ShEe,L33zpEK4Fzz|*n~$;_)7b$(uB.73#F@ISKl9' );
define( 'SECURE_AUTH_SALT', '|Geh7[wBh<7ficP..)aNiR>>(h]BRU!4rDDh2_oo,.Z{Z??*M2R<fOjcm|^Era)f' );
define( 'LOGGED_IN_SALT',   'oK2y)h1W/RPem-U?Z4l`Q4andMsy]QrXX4>EcbE-,2R)C|XlJRBod],hf$Xey<~)' );
define( 'NONCE_SALT',       'Z`1D!>xyQ+eN<Lc!J;{g 0a1!q1rmG(V5!-jYF,O _mL:l8xG8_3S=J_AV} {s!Z' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'zkv_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('WP_POST_REVISIONS', 1);
define('AUTOMATIC_UPDATER_DISABLED',false);
/*define('DISABLE_WP_CRON',false);
define('DISALLOW_FILE_EDIT',true);
define('DISALLOW_FILE_MODS',true);*/

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
