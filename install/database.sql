-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2021 at 07:02 PM
-- Server version: 10.3.32-MariaDB-log-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nemosofts_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_active_log`
--

CREATE TABLE `tbl_active_log` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date_time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`, `user_status`) VALUES
(1, 'admin', 'admin', 'infi.nemosofts@gmail.com', 'profile.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_album`
--

CREATE TABLE `tbl_album` (
  `aid` int(11) NOT NULL,
  `artist_ids` varchar(255) DEFAULT NULL,
  `album_name` varchar(255) NOT NULL,
  `album_image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `cat_id` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artist`
--

CREATE TABLE `tbl_artist` (
  `id` int(11) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `artist_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `bid` int(11) NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `banner_sort_info` varchar(500) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `banner_songs` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favourite`
--

CREATE TABLE `tbl_favourite` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mp3`
--

CREATE TABLE `tbl_mp3` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `mp3_type` varchar(255) NOT NULL,
  `mp3_title` varchar(100) NOT NULL,
  `mp3_url` text NOT NULL,
  `mp3_thumbnail` varchar(255) NOT NULL,
  `mp3_duration` varchar(255) NOT NULL,
  `mp3_artist` text NOT NULL,
  `mp3_description` text NOT NULL,
  `total_rate` int(11) NOT NULL DEFAULT 0,
  `rate_avg` int(11) NOT NULL DEFAULT 0,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `total_download` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mp3_views`
--

CREATE TABLE `tbl_mp3_views` (
  `view_id` bigint(20) NOT NULL,
  `mp3_id` bigint(20) NOT NULL,
  `views` bigint(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `nid` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `notification_msg` varchar(255) NOT NULL,
  `notification_title` varchar(255) NOT NULL,
  `update_by` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_playlist`
--

CREATE TABLE `tbl_playlist` (
  `pid` int(11) NOT NULL,
  `playlist_name` varchar(255) NOT NULL,
  `playlist_image` varchar(255) NOT NULL,
  `playlist_songs` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `rate` int(11) NOT NULL,
  `dt_rate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `envato_buyer_name` varchar(200) NOT NULL,
  `envato_purchase_code` text NOT NULL,
  `envato_buyer_email` varchar(150) NOT NULL,
  `envato_purchased_status` int(1) NOT NULL DEFAULT 0,
  `package_name` varchar(150) NOT NULL,
  `app_api_key` varchar(255) NOT NULL,
  `onesignal_app_id` varchar(500) NOT NULL,
  `onesignal_rest_key` varchar(500) NOT NULL,
  `email_from` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_version` varchar(255) NOT NULL,
  `app_author` varchar(255) NOT NULL,
  `app_contact` varchar(255) NOT NULL,
  `app_website` varchar(255) NOT NULL,
  `app_description` text NOT NULL,
  `app_developed_by` varchar(255) NOT NULL,
  `app_privacy_policy` text NOT NULL,
  `api_latest_limit` int(3) NOT NULL DEFAULT 15,
  `api_cat_order_by` varchar(255) NOT NULL DEFAULT 'cid',
  `api_cat_post_order_by` varchar(255) NOT NULL DEFAULT 'ASC',
  `api_home_latest_cat_id` varchar(255) NOT NULL,
  `publisher_id` varchar(500) NOT NULL,
  `banner_ad` varchar(20) NOT NULL DEFAULT 'false',
  `banner_ad_type` varchar(30) NOT NULL DEFAULT 'admob',
  `banner_ad_id` varchar(500) NOT NULL,
  `banner_facebook_id` text NOT NULL,
  `banner_startapp_id` text NOT NULL,
  `banner_unity_id` text NOT NULL,
  `banner_iron_id` text NOT NULL,
  `banner_size` varchar(255) NOT NULL DEFAULT 'BANNER',
  `banner_size_fb` varchar(255) NOT NULL DEFAULT 'BANNER_HEIGHT_50',
  `banner_size_iron` varchar(255) NOT NULL DEFAULT 'BANNER_HEIGHT_50',
  `interstital_ad` varchar(20) NOT NULL DEFAULT 'false',
  `interstital_ad_type` varchar(30) NOT NULL DEFAULT 'admob',
  `interstital_ad_id` varchar(500) NOT NULL,
  `interstital_facebook_id` text NOT NULL,
  `interstital_startapp_id` text NOT NULL,
  `interstital_unity_id` text NOT NULL,
  `interstital_iron_id` text NOT NULL,
  `interstital_ad_click` int(10) NOT NULL DEFAULT 5,
  `native_ad` varchar(20) NOT NULL DEFAULT 'false',
  `native_ad_type` varchar(30) NOT NULL DEFAULT 'admob',
  `native_ad_id` text NOT NULL,
  `native_facebook_id` text NOT NULL,
  `native_startapp_id` text NOT NULL,
  `native_unity_id` text NOT NULL,
  `native_iron_id` text NOT NULL,
  `native_position` int(10) NOT NULL DEFAULT 5,
  `isUpdate` varchar(255) NOT NULL DEFAULT 'true',
  `version` text NOT NULL,
  `version_name` text NOT NULL,
  `description` text NOT NULL,
  `url` text NOT NULL,
  `isRTL` varchar(255) NOT NULL DEFAULT 'false',
  `isSongDownload` varchar(255) NOT NULL DEFAULT 'true',
  `isMoviePromote` varchar(255) NOT NULL DEFAULT 'true',
  `isNews` varchar(255) NOT NULL DEFAULT 'true',
  `isAppMaintenance` varchar(255) NOT NULL DEFAULT 'false',
  `isScreenshot` varchar(255) NOT NULL DEFAULT 'false',
  `facebook_login` varchar(255) NOT NULL DEFAULT 'true',
  `google_login` varchar(255) NOT NULL DEFAULT 'true',
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `app_name`, `app_logo`, `envato_buyer_name`, `envato_purchase_code`, `envato_buyer_email`, `envato_purchased_status`, `package_name`, `app_api_key`, `onesignal_app_id`, `onesignal_rest_key`, `email_from`, `app_email`, `app_version`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `api_latest_limit`, `api_cat_order_by`, `api_cat_post_order_by`, `api_home_latest_cat_id`, `publisher_id`, `banner_ad`, `banner_ad_type`, `banner_ad_id`, `banner_facebook_id`, `banner_startapp_id`, `banner_unity_id`, `banner_iron_id`, `banner_size`, `banner_size_fb`, `banner_size_iron`, `interstital_ad`, `interstital_ad_type`, `interstital_ad_id`, `interstital_facebook_id`, `interstital_startapp_id`, `interstital_unity_id`, `interstital_iron_id`, `interstital_ad_click`, `native_ad`, `native_ad_type`, `native_ad_id`, `native_facebook_id`, `native_startapp_id`, `native_unity_id`, `native_iron_id`, `native_position`, `isUpdate`, `version`, `version_name`, `description`, `url`, `isRTL`, `isSongDownload`, `isMoviePromote`, `isNews`, `isAppMaintenance`, `isScreenshot`, `facebook_login`, `google_login`, `status`) VALUES
(1, 'TamilAudioPro', 'logo.png', '', '', '', 0, '', '', '', '', '', 'info.nemosofts@gmail.com', '4.0.0', 'nemosofts', '+4524410510', 'nemosofts.com', '<pre>\r\nLove this app? Let us Know in the Google Play Store how we can make it even better</pre>\r\n', 'nemosofts', '<p><strong>Privacy Policy</strong></p>\r\n\r\n<p>nemosofts built the Nemosofts App app as a Free app. This SERVICE is provided by nemosofts at no cost and is intended for use as is.</p>\r\n\r\n<p>This page is used to inform visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service.</p>\r\n\r\n<p>If you choose to use our Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that we collect is used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.</p>\r\n\r\n<p>The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at Nemosofts App unless otherwise defined in this Privacy Policy.</p>\r\n\r\n<p><strong>Information Collection and Use</strong></p>\r\n\r\n<p>For a better experience, while using our Service, we may require you to provide us with certain personally identifiable information. The information that we request will be retained by us and used as described in this privacy policy.</p>\r\n\r\n<p>The app does use third party services that may collect information used to identify you.</p>\r\n\r\n<p>Link to privacy policy of third party service providers used by the app</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://www.google.com/policies/privacy/\" target=\"_blank\">Google Play Services</a></li>\r\n	<li><a href=\"https://support.google.com/admob/answer/6128543?hl=en\" target=\"_blank\">AdMob</a></li>\r\n	<li><a href=\"https://firebase.google.com/policies/analytics\" target=\"_blank\">Google Analytics for Firebase</a></li>\r\n	<li><a href=\"https://firebase.google.com/support/privacy/\" target=\"_blank\">Firebase Crashlytics</a></li>\r\n	<li><a href=\"https://www.facebook.com/about/privacy/update/printable\" target=\"_blank\">Facebook</a></li>\r\n	<li><a href=\"https://onesignal.com/privacy_policy\" target=\"_blank\">One Signal</a></li>\r\n</ul>\r\n\r\n<p><strong>Log Data</strong></p>\r\n\r\n<p>We want to inform you that whenever you use our Service, in a case of an error in the app we collect data and information (through third party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol (&ldquo;IP&rdquo;) address, device name, operating system version, the configuration of the app when utilizing our Service, the time and date of your use of the Service, and other statistics.</p>\r\n\r\n<p><strong>Cookies</strong></p>\r\n\r\n<p>Cookies are files with a small amount of data that are commonly used as anonymous unique identifiers. These are sent to your browser from the websites that you visit and are stored on your device&#39;s internal memory.</p>\r\n\r\n<p>This Service does not use these &ldquo;cookies&rdquo; explicitly. However, the app may use third party code and libraries that use &ldquo;cookies&rdquo; to collect information and improve their services. You have the option to either accept or refuse these cookies and know when a cookie is being sent to your device. If you choose to refuse our cookies, you may not be able to use some portions of this Service.</p>\r\n\r\n<p><strong>Service Providers</strong></p>\r\n\r\n<p>We may employ third-party companies and individuals due to the following reasons:</p>\r\n\r\n<ul>\r\n	<li>To facilitate our Service;</li>\r\n	<li>To provide the Service on our behalf;</li>\r\n	<li>To perform Service-related services; or</li>\r\n	<li>To assist us in analyzing how our Service is used.</li>\r\n</ul>\r\n\r\n<p>We want to inform users of this Service that these third parties have access to your Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</p>\r\n\r\n<p><strong>Security</strong></p>\r\n\r\n<p>We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</p>\r\n\r\n<p><strong>Links to Other Sites</strong></p>\r\n\r\n<p>This Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by us. Therefore, we strongly advise you to review the Privacy Policy of these websites. We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>\r\n\r\n<p><strong>Children&rsquo;s Privacy</strong></p>\r\n\r\n<p>These Services do not address anyone under the age of 13. We do not knowingly collect personally identifiable information from children under 13 years of age. In the case we discover that a child under 13 has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do necessary actions.</p>\r\n\r\n<p><strong>Changes to This Privacy Policy</strong></p>\r\n\r\n<p>We may update our Privacy Policy from time to time. Thus, you are advised to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page.</p>\r\n\r\n<p>This policy is effective as of 2021-05-21</p>\r\n\r\n<p><strong>Contact Us</strong></p>\r\n\r\n<p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us at info.nemosofts@gmail.com.</p>\r\n', 15, 'cid', 'ASC', '3', 'ca-app-pub-3940256099942544', 'true', 'admob', 'ca-app-pub-3940256099942544/6300978111', '', '', '', '', 'BANNER', 'BANNER_HEIGHT_50', 'BANNER_HEIGHT_90', 'true', 'admob', 'ca-app-pub-3940256099942544/1033173712', '', '', '', '', 5, 'true', 'admob', 'ca-app-pub-3940256099942544/2247696110', '', '', '', '', 5, 'false', '4', '4.0.0', 'new update', 'https://play.google.com/store/apps/details?id=nemosofts.tamilaudiopro.mp3', 'false', 'true', 'true', 'true', 'false', 'false', 'true', 'true', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smtp_settings`
--

CREATE TABLE `tbl_smtp_settings` (
  `id` int(5) NOT NULL,
  `smtp_type` varchar(20) NOT NULL DEFAULT 'server',
  `smtp_host` varchar(150) NOT NULL,
  `smtp_email` varchar(150) NOT NULL,
  `smtp_password` text NOT NULL,
  `smtp_secure` varchar(20) NOT NULL,
  `port_no` varchar(10) NOT NULL,
  `smtp_ghost` varchar(150) NOT NULL,
  `smtp_gemail` varchar(150) NOT NULL,
  `smtp_gpassword` text NOT NULL,
  `smtp_gsecure` varchar(20) NOT NULL,
  `gport_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_smtp_settings`
--

INSERT INTO `tbl_smtp_settings` (`id`, `smtp_type`, `smtp_host`, `smtp_email`, `smtp_password`, `smtp_secure`, `port_no`, `smtp_ghost`, `smtp_gemail`, `smtp_gpassword`, `smtp_gsecure`, `gport_no`) VALUES
(1, 'server', '', '', '', 'ssl', '465', '', '', '', 'tls', 587);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_song_suggest`
--

CREATE TABLE `tbl_song_suggest` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `song_title` varchar(500) NOT NULL,
  `song_image` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'Normal',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `auth_id` varchar(255) NOT NULL DEFAULT '0',
  `registered_on` varchar(200) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video_list`
--

CREATE TABLE `tbl_video_list` (
  `id` int(11) NOT NULL,
  `video_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_image_thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `total_share` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_web_settings`
--

CREATE TABLE `tbl_web_settings` (
  `id` int(2) NOT NULL,
  `admin_panel` text NOT NULL,
  `site_name` text NOT NULL,
  `site_description` text NOT NULL,
  `site_keywords` text NOT NULL,
  `copyright_text` text NOT NULL,
  `web_logo_1` text NOT NULL,
  `web_logo_2` text NOT NULL,
  `web_favicon` text NOT NULL,
  `header_code` longtext NOT NULL,
  `footer_code` longtext NOT NULL,
  `contact_page_title` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(60) NOT NULL,
  `contact_email` varchar(60) NOT NULL,
  `android_app_url` text NOT NULL,
  `ios_app_url` text NOT NULL,
  `facebook_url` text NOT NULL,
  `twitter_url` text NOT NULL,
  `youtube_url` text NOT NULL,
  `instagram_url` text NOT NULL,
  `about_page_title` varchar(150) NOT NULL,
  `about_content` longtext NOT NULL,
  `about_status` varchar(10) NOT NULL DEFAULT 'true',
  `privacy_page_title` varchar(150) NOT NULL,
  `privacy_content` longtext NOT NULL,
  `privacy_page_status` varchar(10) NOT NULL DEFAULT 'true',
  `terms_of_use_page_title` varchar(150) NOT NULL,
  `terms_of_use_content` longtext NOT NULL,
  `terms_of_use_page_status` varchar(10) NOT NULL DEFAULT 'true',
  `envato_buyer_name` varchar(200) NOT NULL,
  `envato_purchase_code` text NOT NULL,
  `envato_purchased_status` int(1) NOT NULL DEFAULT 0,
  `envato_verification_status` int(1) NOT NULL DEFAULT 0,
  `web_settings_status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_web_settings`
--

INSERT INTO `tbl_web_settings` (`id`, `admin_panel`, `site_name`, `site_description`, `site_keywords`, `copyright_text`, `web_logo_1`, `web_logo_2`, `web_favicon`, `header_code`, `footer_code`, `contact_page_title`, `address`, `contact_number`, `contact_email`, `android_app_url`, `ios_app_url`, `facebook_url`, `twitter_url`, `youtube_url`, `instagram_url`, `about_page_title`, `about_content`, `about_status`, `privacy_page_title`, `privacy_content`, `privacy_page_status`, `terms_of_use_page_title`, `terms_of_use_content`, `terms_of_use_page_status`, `envato_buyer_name`, `envato_purchase_code`, `envato_purchased_status`, `envato_verification_status`, `web_settings_status`) VALUES
(1, 'https://nemosofts.com/', 'Tamilaudiopro', 'Tamilaudiopro - Music streaming platform', 'music, streaming, platform', 'Copyright &copy; 2021 TamilAudioPro - Music Web Application, All rights reserved.', '', '', '96513_07122021093616.png', '', '', 'Contact Us', 'Nemosofts velanai east jaffna velanai 4 4000 Sri Lanka', '+947545313', 'info.nemosofts@gnail.com', 'https://play.google.com/store/apps/details?id=nemosofts.tamilaudiopro.mp3', 'https://www.apple.com/app-store/', 'https://www.facebook.com/', 'https://twitter.com', 'https://www.youtube.com/', 'https://www.instagram.com/', 'About Us', '<p>nemosofts built the Nemosofts App app as a Free app. This SERVICE is provided by nemosofts at no cost and is intended for use as is.</p>\r\n\r\n<p>This page is used to inform visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service.</p>\r\n\r\n<p>If you choose to use our Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that we collect is used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.</p>\r\n\r\n<p>The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at Nemosofts App unless otherwise defined in this Privacy Policy.</p>\r\n', 'true', 'Privacy Policy', '<h3>What personal data we collect and why we collect it</h3>\r\n\r\n<p><strong>Comments</strong></p>\r\n\r\n<p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&rsquo;s IP address and browser user agent string to help spam detection.</p>\r\n\r\n<p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p>\r\n\r\n<h3><strong>Media</strong></h3>\r\n\r\n<p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>\r\n\r\n<h3><strong>Contact forms</strong></h3>\r\n\r\n<h3><strong>Cookies</strong></h3>\r\n\r\n<p>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p>\r\n\r\n<p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p>\r\n\r\n<p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &ldquo;Remember Me&rdquo;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p>\r\n\r\n<p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p>\r\n\r\n<h3><strong>Embedded content from other websites</strong></h3>\r\n\r\n<p>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p>\r\n\r\n<p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p>\r\n\r\n<h3><strong>Analytics</strong></h3>\r\n\r\n<h3><strong>Who we share your data with</strong></h3>\r\n\r\n<h3><strong>How long we retain your data</strong></h3>\r\n\r\n<p>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p>\r\n\r\n<p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p>\r\n\r\n<h3><strong>What rights you have over your data</strong></h3>\r\n\r\n<p>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>\r\n\r\n<h3><strong>Where we send your data</strong></h3>\r\n\r\n<p>Visitor comments may be checked through an automated spam detection service.</p>\r\n', 'true', 'Terms &amp; Services', '<p>Introduction</p>\r\n\r\n<p>This document (the &ldquo;Terms&rdquo;) together with the&nbsp;U.S. Privacy Policy&nbsp;(collectively the &ldquo;Agreement&rdquo;) sets out the terms and conditions governing visits, access and use of the service by the end user (&ldquo;you&rdquo;). The term &ldquo;you&rdquo; includes additional registered users whenever permitted under the applicable subscription, visitors, and others who access or use any of the Services.</p>\r\n\r\n<p>The &ldquo;Services&rdquo; means the service branded our site, that are compatible for similarly situated digital music services. These may include, but are not limited to websites and applications for desktops, tablets and mobile handsets, set-top boxes and stereo equipment. The Services also include your ability to edit certain Service Content.</p>\r\n\r\n<h3>Content restrictions</h3>\r\n\r\n<p>The Services contains content, such as sound recordings, audiovisual works, other video or audio works, clips, images, graphics, text, software, works of authorship, files, documents, applications, artwork, trademarks, trade names, metadata, album titles, sound recording titles, artist names, intellectual property, or materials relating thereto or any other materials, and their selection, coordination and arrangement (collectively, the &ldquo;Service Content&rdquo;). The Service Content is the property of our site and/or third parties and is protected by copyright under both United States and foreign laws.&nbsp;</p>\r\n\r\n<h3>User content</h3>\r\n\r\n<p>To the extent allowed by the Services, any musical works (sound recordings and underlying musical compositions), audiovisual works (including but not limited to MTV style premium music videos, clips and so called &ldquo;behind the scenes&rdquo; audiovisual content), other video or audio works, images, graphics, text, works of authorship, files, documents, applications, artwork, trademarks, trade names, metadata, album titles, sound recording titles, artist names, intellectual property, or materials relating thereto or any other materials that you submit to the Service (&ldquo;User Content&rdquo;) are generated, owned and controlled solely by you and/or your licensees. We do not claim any intellectual property ownership rights in any User Content. After directly sending (&ldquo;submitting&rdquo;) your User Content to the Services, you continue to retain any intellectual property ownership rights that you may have in your User Content, subject to the license below.&nbsp;</p>\r\n', 'true', '', '', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_active_log`
--
ALTER TABLE `tbl_active_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_album`
--
ALTER TABLE `tbl_album`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tbl_artist`
--
ALTER TABLE `tbl_artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_favourite`
--
ALTER TABLE `tbl_favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mp3`
--
ALTER TABLE `tbl_mp3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mp3_views`
--
ALTER TABLE `tbl_mp3_views`
  ADD PRIMARY KEY (`view_id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_playlist`
--
ALTER TABLE `tbl_playlist`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_song_suggest`
--
ALTER TABLE `tbl_song_suggest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_video_list`
--
ALTER TABLE `tbl_video_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_web_settings`
--
ALTER TABLE `tbl_web_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_active_log`
--
ALTER TABLE `tbl_active_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_album`
--
ALTER TABLE `tbl_album`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_artist`
--
ALTER TABLE `tbl_artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_favourite`
--
ALTER TABLE `tbl_favourite`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_mp3`
--
ALTER TABLE `tbl_mp3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_mp3_views`
--
ALTER TABLE `tbl_mp3_views`
  MODIFY `view_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_playlist`
--
ALTER TABLE `tbl_playlist`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_song_suggest`
--
ALTER TABLE `tbl_song_suggest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_video_list`
--
ALTER TABLE `tbl_video_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_web_settings`
--
ALTER TABLE `tbl_web_settings`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;