-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: mysql
-- Üretim Zamanı: 29 Oca 2025, 17:44:55
-- Sunucu sürümü: 5.7.44
-- PHP Sürümü: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `newpannel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contents`
--

CREATE TABLE `contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `contents`
--

INSERT INTO `contents` (`id`, `page_id`, `name`, `value`, `locale`) VALUES
(1, 1, 'media', NULL, 'tr'),
(2, 1, 'gallery', NULL, 'tr'),
(3, 1, 'desc', NULL, 'tr'),
(4, 1, 'show_menu', NULL, 'tr'),
(5, 1, 'is_sub', NULL, 'tr'),
(6, 1, 'media', NULL, 'en'),
(7, 1, 'gallery', NULL, 'en'),
(8, 1, 'desc', NULL, 'en'),
(9, 1, 'show_menu', NULL, 'en'),
(10, 1, 'is_sub', NULL, 'en'),
(11, 1, 'category_id', NULL, 'tr'),
(12, 1, 'sort_id', '1', 'tr'),
(13, 1, 'is_active', '1', 'tr'),
(14, 1, 'title', 'Ana Sayfa', 'tr'),
(15, 1, 'body', NULL, 'tr'),
(16, 1, 'front_view', 'show', 'tr'),
(17, 1, 'front_layout', 'content', 'tr'),
(18, 1, 'back_view', 'page', 'tr'),
(19, 1, 'back_layout', 'content', 'tr'),
(20, 1, 'is_visible', '1', 'tr'),
(21, 1, 'page_id', '1', 'en'),
(22, 1, 'locale', 'en', 'en'),
(23, 1, 'name', 'is_sub', 'en'),
(24, 2, 'media', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"title\":null,\"alt\":null}}', 'tr'),
(25, 2, 'gallery', '[{\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"title\":null,\"alt\":null,\"id\":null},\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null,\"id\":null}},{\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"title\":null,\"alt\":null,\"id\":null},\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null,\"id\":null}}]', 'tr'),
(26, 2, 'desc', 'asda', 'tr'),
(27, 2, 'show_menu', 'on', 'tr'),
(28, 2, 'is_sub', NULL, 'tr'),
(29, 2, 'media', NULL, 'en'),
(30, 2, 'gallery', NULL, 'en'),
(31, 2, 'desc', NULL, 'en'),
(32, 2, 'show_menu', NULL, 'en'),
(33, 2, 'is_sub', NULL, 'en'),
(34, 2, 'category_id', NULL, 'tr'),
(35, 2, 'sort_id', '1', 'tr'),
(36, 2, 'is_active', '1', 'tr'),
(37, 2, 'title', 'Biz Kimiz?', 'tr'),
(38, 2, 'body', '<p>sdasdasdadasdasd</p>', 'tr'),
(39, 2, 'front_view', 'show', 'tr'),
(40, 2, 'front_layout', 'content', 'tr'),
(41, 2, 'back_view', 'page', 'tr'),
(42, 2, 'back_layout', 'content', 'tr'),
(43, 2, 'is_visible', '1', 'tr'),
(44, 2, 'page_id', '2', 'en'),
(45, 2, 'locale', 'en', 'en'),
(46, 2, 'name', 'is_sub', 'en'),
(47, 3, 'media', NULL, 'tr'),
(48, 3, 'gallery', NULL, 'tr'),
(49, 3, 'desc', 'DÜNDEN BUGÜNE', 'tr'),
(50, 3, 'show_menu', 'on', 'tr'),
(51, 3, 'is_sub', NULL, 'tr'),
(52, 3, 'media', NULL, 'en'),
(53, 3, 'gallery', NULL, 'en'),
(54, 3, 'desc', NULL, 'en'),
(55, 3, 'show_menu', 'on', 'en'),
(56, 3, 'is_sub', NULL, 'en'),
(57, 3, 'category_id', NULL, 'tr'),
(58, 3, 'sort_id', '1', 'tr'),
(59, 3, 'is_active', '1', 'tr'),
(60, 3, 'title', 'Projelerimiz', 'tr'),
(61, 3, 'body', NULL, 'tr'),
(62, 3, 'front_view', 'show', 'tr'),
(63, 3, 'front_layout', 'content', 'tr'),
(64, 3, 'back_view', 'page', 'tr'),
(65, 3, 'back_layout', 'content', 'tr'),
(66, 3, 'is_visible', '1', 'tr'),
(67, 3, 'page_id', '3', 'en'),
(68, 3, 'locale', 'en', 'en'),
(69, 3, 'name', 'content', 'en'),
(70, 4, 'media', NULL, 'tr'),
(71, 4, 'gallery', NULL, 'tr'),
(72, 4, 'desc', 'Deneyimliveyetkinekibimizilebüyük günlerinsağlamişlerinigüvenle hayatageçiriyoruz.', 'tr'),
(73, 4, 'show_menu', 'on', 'tr'),
(74, 4, 'is_sub', NULL, 'tr'),
(75, 4, 'media', NULL, 'en'),
(76, 4, 'gallery', NULL, 'en'),
(77, 4, 'desc', NULL, 'en'),
(78, 4, 'show_menu', NULL, 'en'),
(79, 4, 'is_sub', NULL, 'en'),
(80, 4, 'category_id', NULL, 'tr'),
(81, 4, 'sort_id', '1', 'tr'),
(82, 4, 'is_active', '1', 'tr'),
(83, 4, 'title', 'Ekibimiz', 'tr'),
(84, 4, 'body', NULL, 'tr'),
(85, 4, 'front_view', 'show', 'tr'),
(86, 4, 'front_layout', 'content', 'tr'),
(87, 4, 'back_view', 'page', 'tr'),
(88, 4, 'back_layout', 'content', 'tr'),
(89, 4, 'is_visible', '1', 'tr'),
(90, 4, 'page_id', '4', 'en'),
(91, 4, 'locale', 'en', 'en'),
(92, 4, 'name', 'is_sub', 'en'),
(93, 5, 'media', NULL, 'tr'),
(94, 5, 'gallery', NULL, 'tr'),
(95, 5, 'desc', NULL, 'tr'),
(96, 5, 'show_menu', 'on', 'tr'),
(97, 5, 'is_sub', NULL, 'tr'),
(98, 5, 'media', NULL, 'en'),
(99, 5, 'gallery', NULL, 'en'),
(100, 5, 'desc', NULL, 'en'),
(101, 5, 'show_menu', 'on', 'en'),
(102, 5, 'is_sub', NULL, 'en'),
(103, 5, 'category_id', NULL, 'tr'),
(104, 5, 'sort_id', '1', 'tr'),
(105, 5, 'is_active', '1', 'tr'),
(106, 5, 'title', 'İletişim', 'tr'),
(107, 5, 'body', NULL, 'tr'),
(108, 5, 'front_view', 'show', 'tr'),
(109, 5, 'front_layout', 'content', 'tr'),
(110, 5, 'back_view', 'page', 'tr'),
(111, 5, 'back_layout', 'content', 'tr'),
(112, 5, 'is_visible', '1', 'tr'),
(113, 5, 'page_id', '5', 'en'),
(114, 5, 'locale', 'en', 'en'),
(115, 5, 'name', 'is_sub', 'en'),
(116, 1, 'page_id', '1', 'tr'),
(117, 1, 'locale', 'tr', 'tr'),
(118, 1, 'name', 'is_sub', 'tr'),
(119, 2, 'page_id', '2', 'tr'),
(120, 2, 'locale', 'tr', 'tr'),
(121, 2, 'name', 'gallery', 'tr'),
(122, 3, 'page_id', '3', 'tr'),
(123, 3, 'locale', 'tr', 'tr'),
(124, 3, 'name', 'content', 'tr'),
(125, 4, 'page_id', '4', 'tr'),
(126, 4, 'locale', 'tr', 'tr'),
(127, 4, 'name', 'desc', 'tr'),
(128, 5, 'page_id', '5', 'tr'),
(129, 5, 'locale', 'tr', 'tr'),
(130, 5, 'name', 'is_sub', 'tr'),
(131, 6, 'media', NULL, 'tr'),
(132, 6, 'gallery', NULL, 'tr'),
(133, 6, 'desc', 'Biblo Event 2013 yılından bugüne yenilikçi, yaratıcı ve kusursuz etkinlikleri heyecanla planlıyor.', 'tr'),
(134, 6, 'show_menu', 'on', 'tr'),
(135, 6, 'is_sub', NULL, 'tr'),
(136, 6, 'media', NULL, 'en'),
(137, 6, 'gallery', NULL, 'en'),
(138, 6, 'desc', NULL, 'en'),
(139, 6, 'show_menu', NULL, 'en'),
(140, 6, 'is_sub', NULL, 'en'),
(141, 6, 'category_id', '1', 'tr'),
(142, 6, 'sort_id', '1', 'tr'),
(143, 6, 'is_active', '1', 'tr'),
(144, 6, 'title', 'Slider Alanı', 'tr'),
(145, 6, 'body', NULL, 'tr'),
(146, 6, 'front_view', 'show', 'tr'),
(147, 6, 'front_layout', 'content', 'tr'),
(148, 6, 'back_view', 'menu', 'tr'),
(149, 6, 'back_layout', 'content', 'tr'),
(150, 6, 'is_visible', '1', 'tr'),
(151, 6, 'page_id', '6', 'en'),
(152, 6, 'locale', 'en', 'en'),
(153, 6, 'name', 'desc', 'en'),
(154, 7, 'media', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"title\":null,\"alt\":null}}', 'tr'),
(155, 7, 'gallery', NULL, 'tr'),
(156, 7, 'desc', '7. Teknoloji Geliştirme Bölgeleri ve Ar-Ge Merkezleri Ödül Töreni', 'tr'),
(157, 7, 'show_menu', NULL, 'tr'),
(158, 7, 'is_sub', NULL, 'tr'),
(159, 7, 'media', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"title\":null,\"alt\":null}}', 'en'),
(160, 7, 'gallery', NULL, 'en'),
(161, 7, 'desc', NULL, 'en'),
(162, 7, 'show_menu', NULL, 'en'),
(163, 7, 'is_sub', NULL, 'en'),
(164, 7, 'category_id', '6', 'tr'),
(165, 7, 'sort_id', '1', 'tr'),
(166, 7, 'is_active', '1', 'tr'),
(167, 7, 'title', 'T.C Sanayi ve Teknoloji Bakanlığı', 'tr'),
(168, 7, 'body', NULL, 'tr'),
(169, 7, 'front_view', 'show', 'tr'),
(170, 7, 'front_layout', 'content', 'tr'),
(171, 7, 'back_view', 'sliders', 'tr'),
(172, 7, 'back_layout', 'content', 'tr'),
(173, 7, 'is_visible', '1', 'tr'),
(174, 7, 'page_id', '7', 'en'),
(175, 7, 'locale', 'en', 'en'),
(176, 7, 'name', 'desc', 'en'),
(177, 7, 'page_id', '7', 'tr'),
(178, 7, 'locale', 'tr', 'tr'),
(179, 7, 'name', 'desc', 'tr'),
(180, 8, 'media', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"title\":null,\"alt\":null}}', 'tr'),
(181, 8, 'gallery', NULL, 'tr'),
(182, 8, 'desc', 'Aselsan Konya', 'tr'),
(183, 8, 'show_menu', NULL, 'tr'),
(184, 8, 'is_sub', NULL, 'tr'),
(185, 8, 'media', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"title\":null,\"alt\":null}}', 'en'),
(186, 8, 'gallery', NULL, 'en'),
(187, 8, 'desc', NULL, 'en'),
(188, 8, 'show_menu', NULL, 'en'),
(189, 8, 'is_sub', NULL, 'en'),
(190, 8, 'category_id', '6', 'tr'),
(191, 8, 'sort_id', '1', 'tr'),
(192, 8, 'is_active', '1', 'tr'),
(193, 8, 'title', 'Aselsan Konya', 'tr'),
(194, 8, 'body', NULL, 'tr'),
(195, 8, 'front_view', 'show', 'tr'),
(196, 8, 'front_layout', 'content', 'tr'),
(197, 8, 'back_view', 'slider', 'tr'),
(198, 8, 'back_layout', 'content', 'tr'),
(199, 8, 'is_visible', '1', 'tr'),
(200, 8, 'page_id', '8', 'en'),
(201, 8, 'locale', 'en', 'en'),
(202, 8, 'name', 'desc', 'en'),
(203, 8, 'page_id', '8', 'tr'),
(204, 8, 'locale', 'tr', 'tr'),
(205, 8, 'name', 'desc', 'tr'),
(206, 8, 'video', NULL, 'tr'),
(207, 8, 'video', NULL, 'en'),
(208, 7, 'video', '[{\"desktop\":{\"path\":\"https:\\/\\/www.youtube.com\\/watch?v=S8ShXEwjw58&t=1s\",\"image\":\"https:\\/\\/img.youtube.com\\/vi\\/S8ShXEwjw58\\/maxresdefault.jpg\",\"title\":null,\"alt\":null,\"id\":null},\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null,\"id\":null}}]', 'tr'),
(209, 7, 'video', NULL, 'en'),
(210, 6, 'page_id', '6', 'tr'),
(211, 6, 'locale', 'tr', 'tr'),
(212, 6, 'name', 'desc', 'tr'),
(213, 3, 'alt_header', 'Projelerimiz ve Proje Ortaklarımız', 'tr'),
(214, 3, 'content', 'Deneyimli ve yetkin ekibimiz ile büyük günlerin sağlam işlerini güvenle hayata geçiriyoruz.', 'tr'),
(215, 3, 'alt_header', NULL, 'en'),
(216, 3, 'content', NULL, 'en'),
(217, 9, 'media', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/0000_trendyol-7.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/0000_trendyol-7.jpg\",\"title\":null,\"alt\":null}}', 'tr'),
(218, 9, 'gallery', '[{\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/slider_1.jpg\",\"title\":null,\"alt\":null,\"id\":null},\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null,\"id\":null}}]', 'tr'),
(219, 9, 'cover', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/0000_trendyol-7.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/0000_trendyol-7.jpg\",\"title\":null,\"alt\":null}}', 'tr'),
(220, 9, 'desc', 'Biblo Event olarak Trendyol Motivasyon Etkinlikleri’nin bir parçası olmaktan dolayı mutluluk duyduk.', 'tr'),
(221, 9, 'year', '2018', 'tr'),
(222, 9, 'media', NULL, 'en'),
(223, 9, 'gallery', NULL, 'en'),
(224, 9, 'cover', NULL, 'en'),
(225, 9, 'desc', NULL, 'en'),
(226, 9, 'year', NULL, 'en'),
(227, 9, 'category_id', '3', 'tr'),
(228, 9, 'sort_id', '1', 'tr'),
(229, 9, 'is_active', '1', 'tr'),
(230, 9, 'title', 'Trendyol Motivasyon Etkinliği', 'tr'),
(231, 9, 'body', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'tr'),
(232, 9, 'front_view', 'project', 'tr'),
(233, 9, 'front_layout', 'content', 'tr'),
(234, 9, 'back_view', 'project', 'tr'),
(235, 9, 'back_layout', 'content', 'tr'),
(236, 9, 'is_visible', '1', 'tr'),
(237, 9, 'page_id', '9', 'en'),
(238, 9, 'locale', 'tr', 'en'),
(239, 9, 'name', 'year', 'en'),
(240, 1, 'category_id', NULL, 'en'),
(241, 1, 'is_active', '1', 'en'),
(242, 1, 'title', 'Main Page', 'en'),
(243, 1, 'body', NULL, 'en'),
(244, 1, 'is_visible', '1', 'en'),
(245, 2, 'category_id', NULL, 'en'),
(246, 2, 'is_active', '1', 'en'),
(247, 2, 'title', 'Who we are?', 'en'),
(248, 2, 'body', NULL, 'en'),
(249, 2, 'is_visible', '1', 'en'),
(250, 3, 'category_id', NULL, 'en'),
(251, 3, 'is_active', '1', 'en'),
(252, 3, 'title', 'Our Projects', 'en'),
(253, 3, 'body', NULL, 'en'),
(254, 3, 'is_visible', '1', 'en'),
(255, 4, 'category_id', NULL, 'en'),
(256, 4, 'is_active', '1', 'en'),
(257, 4, 'title', 'Team', 'en'),
(258, 4, 'body', NULL, 'en'),
(259, 4, 'is_visible', '1', 'en'),
(260, 5, 'category_id', NULL, 'en'),
(261, 5, 'is_active', '1', 'en'),
(262, 5, 'title', 'Contact', 'en'),
(263, 5, 'body', NULL, 'en'),
(264, 5, 'is_visible', '1', 'en'),
(265, 9, 'page_id', '9', 'tr'),
(266, 9, 'locale', 'tr', 'tr'),
(267, 9, 'name', 'year', 'tr'),
(268, 10, 'media', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/project-thumb.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/project-thumb.jpg\",\"title\":null,\"alt\":null}}', 'tr'),
(269, 10, 'gallery', '[{\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/project-thumb.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/project-thumb.jpg\",\"title\":null,\"alt\":null,\"id\":null},\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null,\"id\":null}},{\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/0000_trendyol-7.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/0000_trendyol-7.jpg\",\"title\":null,\"alt\":null,\"id\":null},\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null,\"id\":null}}]', 'tr'),
(270, 10, 'cover', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/project-thumb.jpg\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/project-thumb.jpg\",\"title\":null,\"alt\":null}}', 'tr'),
(271, 10, 'desc', 'Biblo Event olarak Malatya Expo 2028 sürecinin bir parçası olmaktan dolayı mutluluk duyduk.', 'tr'),
(272, 10, 'year', '2012', 'tr'),
(273, 10, 'media', NULL, 'en'),
(274, 10, 'gallery', NULL, 'en'),
(275, 10, 'cover', NULL, 'en'),
(276, 10, 'desc', NULL, 'en'),
(277, 10, 'year', NULL, 'en'),
(278, 10, 'category_id', '3', 'tr'),
(279, 10, 'sort_id', '1', 'tr'),
(280, 10, 'is_active', '1', 'tr'),
(281, 10, 'title', 'Malatya EXPO 2028 Proje Danışmanlığı', 'tr'),
(282, 10, 'body', '<p>Uluslararası çatı kuruluşu olan AIPH tarafından düzenlenen Dünya Bahçecilik Expo’su 2028 yılında ülkemizin güzide şehirlerinden Malatya’da gerçekleştirilecektir. EXPO hazırlık, adaylık ve etkinlik yönetimi süreçleri gerçekleştirilerek, dünyanın en prestijli uluslararası etkinliklerinden olan Horticulturel Expo’yu Malatya’da yaşayacağız.</p>\r\n\r\n<p>Biblo Event olarak Malatya Expo 2028 sürecinin bir parçası olmaktan dolayı mutluluk duyduk.</p>', 'tr'),
(283, 10, 'front_view', 'project', 'tr'),
(284, 10, 'front_layout', 'content', 'tr'),
(285, 10, 'back_view', 'project', 'tr'),
(286, 10, 'back_layout', 'content', 'tr'),
(287, 10, 'is_visible', '1', 'tr'),
(288, 10, 'page_id', '10', 'en'),
(289, 10, 'locale', 'tr', 'en'),
(290, 10, 'name', 'year', 'en'),
(291, 10, 'page_id', '10', 'tr'),
(292, 10, 'locale', 'tr', 'tr'),
(293, 10, 'name', 'year', 'tr'),
(294, 7, 'category_id', '6', 'en'),
(295, 7, 'is_active', '1', 'en'),
(296, 7, 'title', 'T.C Sanayi ve Teknoloji Bakanlığı', 'en'),
(297, 7, 'body', NULL, 'en'),
(298, 7, 'is_visible', '1', 'en'),
(299, 8, 'category_id', '6', 'en'),
(300, 8, 'is_active', '1', 'en'),
(301, 8, 'title', 'Aselsan Konya', 'en'),
(302, 8, 'body', NULL, 'en'),
(303, 8, 'is_visible', '1', 'en'),
(304, 6, 'category_id', '1', 'en'),
(305, 6, 'is_active', '1', 'en'),
(306, 6, 'title', 'Slider Alanı', 'en'),
(307, 6, 'body', NULL, 'en'),
(308, 6, 'is_visible', '1', 'en'),
(309, 11, 'media', NULL, 'tr'),
(310, 11, 'gallery', NULL, 'tr'),
(311, 11, 'desc', NULL, 'tr'),
(312, 11, 'show_menu', 'on', 'tr'),
(313, 11, 'is_sub', NULL, 'tr'),
(314, 11, 'media', NULL, 'en'),
(315, 11, 'gallery', NULL, 'en'),
(316, 11, 'desc', NULL, 'en'),
(317, 11, 'show_menu', NULL, 'en'),
(318, 11, 'is_sub', NULL, 'en'),
(319, 11, 'category_id', '1', 'tr'),
(320, 11, 'sort_id', '1', 'tr'),
(321, 11, 'is_active', '1', 'tr'),
(322, 11, 'title', 'Referanslar', 'tr'),
(323, 11, 'body', NULL, 'tr'),
(324, 11, 'front_view', 'show', 'tr'),
(325, 11, 'front_layout', 'content', 'tr'),
(326, 11, 'back_view', 'menu', 'tr'),
(327, 11, 'back_layout', 'content', 'tr'),
(328, 11, 'is_visible', '1', 'tr'),
(329, 11, 'page_id', '11', 'en'),
(330, 11, 'locale', 'tr', 'en'),
(331, 11, 'name', 'is_sub', 'en'),
(332, 12, 'category_id', '11', 'tr'),
(333, 12, 'sort_id', '1', 'tr'),
(334, 12, 'is_active', '1', 'tr'),
(335, 12, 'title', 'Deneme', 'tr'),
(336, 12, 'body', NULL, 'tr'),
(337, 12, 'front_view', 'references', 'tr'),
(338, 12, 'front_layout', 'content', 'tr'),
(339, 12, 'back_view', 'reference', 'tr'),
(340, 12, 'back_layout', 'content', 'tr'),
(341, 12, 'is_visible', '1', 'tr'),
(342, 12, 'page_id', '12', 'en'),
(343, 12, 'locale', 'tr', 'en'),
(344, 12, 'name', 'is_visible', 'en'),
(345, 12, 'media', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null}}', 'tr'),
(346, 12, 'media', NULL, 'en'),
(347, 12, 'page_id', '12', 'tr'),
(348, 12, 'locale', 'tr', 'tr'),
(349, 12, 'name', 'media', 'tr'),
(350, 13, 'category_id', '4', 'tr'),
(351, 13, 'sort_id', '1', 'tr'),
(352, 13, 'is_active', '1', 'tr'),
(353, 13, 'title', 'Ali Doğan', 'tr'),
(354, 13, 'body', NULL, 'tr'),
(355, 13, 'front_view', 'team', 'tr'),
(356, 13, 'front_layout', 'content', 'tr'),
(357, 13, 'back_view', 'team', 'tr'),
(358, 13, 'back_layout', 'content', 'tr'),
(359, 13, 'is_visible', '1', 'tr'),
(360, 13, 'page_id', '13', 'en'),
(361, 13, 'locale', 'tr', 'en'),
(362, 13, 'name', 'is_visible', 'en'),
(363, 13, 'job', 'Developer', 'tr'),
(364, 13, 'media', '{\"mobile\":{\"path\":null,\"image\":null,\"title\":null,\"alt\":null},\"desktop\":{\"path\":\"http:\\/\\/biblo.event\\/uploads\\/ekran_resmi_2025-01-28_21-06-02.png\",\"image\":\"http:\\/\\/biblo.event\\/uploads\\/ekran_resmi_2025-01-28_21-06-02.png\",\"title\":null,\"alt\":null}}', 'tr'),
(365, 13, 'title', 'Ali Doğan', 'en'),
(366, 13, 'job', NULL, 'en'),
(367, 13, 'media', NULL, 'en'),
(368, 13, 'page_id', '13', 'tr'),
(369, 13, 'locale', 'tr', 'tr'),
(370, 13, 'name', 'media', 'tr');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `fragments`
--

CREATE TABLE `fragments` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `fragment_translations`
--

CREATE TABLE `fragment_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `fragment_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `is_active`, `is_default`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'tr', 'Türkçe', 1, 1, NULL, NULL, NULL, '2025-01-26 20:20:01', '2025-01-26 20:20:01', NULL),
(2, 'en', 'English', 1, 0, 1, 1, NULL, '2025-01-26 20:52:59', '2025-01-26 20:52:59', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_10_08_073756_create_languages_table', 1),
(5, '2019_10_08_073827_create_settings_table', 1),
(6, '2019_10_08_074620_create_pages_table', 1),
(7, '2019_10_08_075626_create_page_translations_table', 1),
(8, '2019_10_23_083603_create_contents_table', 1),
(9, '2020_01_24_135612_create_newsletters_table', 1),
(10, '2020_08_10_144945_create_fragments_table', 1),
(11, '2021_07_06_095007_create_product_tables_table', 1),
(12, '2021_07_06_095032_create_product_table_translations_table', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `sort_id` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `front_layout` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `front_view` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_layout` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_view` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `pages`
--

INSERT INTO `pages` (`id`, `sort_id`, `is_active`, `category_id`, `front_layout`, `front_view`, `back_layout`, `back_view`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, 'content', 'show', 'content', 'menu', 1, 1, NULL, '2025-01-26 21:12:47', '2025-01-28 13:30:44', NULL),
(2, 2, 1, NULL, 'content', 'about', 'content', 'about', 1, 1, NULL, '2025-01-26 21:13:02', '2025-01-28 20:55:36', NULL),
(3, 3, 1, NULL, 'content', 'projects,project', 'content', 'projects,project', 1, 1, NULL, '2025-01-26 21:13:09', '2025-01-28 13:31:14', NULL),
(4, 4, 1, NULL, 'content', 'teams,team', 'content', 'teams,team', 1, 1, NULL, '2025-01-26 21:13:17', '2025-01-28 21:03:07', NULL),
(5, 5, 1, NULL, 'content', 'show', 'content', 'menu', 1, 1, NULL, '2025-01-26 21:13:23', '2025-01-28 13:31:30', NULL),
(6, 1, 1, 1, 'content', 'sliders,slider', 'content', 'sliders,slider', 1, 1, NULL, '2025-01-26 22:44:13', '2025-01-28 16:13:45', NULL),
(7, 1, 1, 6, 'content', 'slider', 'content', 'slider', 1, 1, NULL, '2025-01-26 22:45:37', '2025-01-28 16:11:57', NULL),
(8, 1, 1, 6, 'content', 'slider', 'content', 'slider', 1, 1, NULL, '2025-01-26 23:00:59', '2025-01-28 16:12:20', NULL),
(9, 1, 1, 3, 'content', 'project', 'content', 'project', 1, 1, NULL, '2025-01-28 00:00:50', '2025-01-28 14:02:14', NULL),
(10, 1, 1, 3, 'content', 'project', 'content', 'project', 1, 1, NULL, '2025-01-28 13:38:02', '2025-01-28 13:55:10', NULL),
(11, 1, 1, 1, 'content', 'references,reference', 'content', 'references,reference', 1, 1, NULL, '2025-01-28 20:57:26', '2025-01-28 20:57:26', NULL),
(12, 1, 1, 11, 'content', 'reference', 'content', 'reference', 1, 1, NULL, '2025-01-28 20:59:46', '2025-01-28 21:00:14', NULL),
(13, 1, 1, 4, 'content', 'team', 'content', 'team', 1, 1, NULL, '2025-01-28 21:06:31', '2025-01-28 21:50:18', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `page_translations`
--

CREATE TABLE `page_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `page_translations`
--

INSERT INTO `page_translations` (`id`, `page_id`, `locale`, `slug`, `is_visible`, `is_menu`, `title`, `body`) VALUES
(1, 1, 'tr', NULL, 1, 1, 'Ana Sayfa', NULL),
(2, 2, 'tr', 'biz-kimiz', 1, 1, 'Biz Kimiz?', '<p>sdasdasdadasdasd</p>'),
(3, 3, 'tr', 'projelerimiz', 1, 1, 'Projelerimiz', NULL),
(4, 4, 'tr', 'ekibimiz', 1, 1, 'Ekibimiz', NULL),
(5, 5, 'tr', 'iletisim', 1, 1, 'İletişim', NULL),
(6, 6, 'tr', 'slider-alani', 1, 1, 'Slider Alanı', NULL),
(7, 7, 'tr', 'slider-alani/tc-sanayi-ve-teknoloji-bakanligi', 1, 1, 'T.C Sanayi ve Teknoloji Bakanlığı', NULL),
(8, 8, 'tr', 'slider-alani/aselsan-konya', 1, 1, 'Aselsan Konya', NULL),
(9, 9, 'tr', 'projelerimiz/trendyol-motivasyon-etkinligi', 1, 1, 'Trendyol Motivasyon Etkinliği', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>'),
(10, 1, 'en', NULL, 1, 1, 'Main Page', NULL),
(11, 2, 'en', 'who-we-are', 1, 1, 'Who we are?', NULL),
(12, 3, 'en', 'our-projects', 1, 1, 'Our Projects', NULL),
(13, 4, 'en', 'team', 1, 1, 'Team', NULL),
(14, 5, 'en', 'contact', 1, 1, 'Contact', NULL),
(15, 10, 'tr', 'projelerimiz/malatya-expo-2028-proje-danismanligi', 1, 1, 'Malatya EXPO 2028 Proje Danışmanlığı', '<p>Uluslararası çatı kuruluşu olan AIPH tarafından düzenlenen Dünya Bahçecilik Expo’su 2028 yılında ülkemizin güzide şehirlerinden Malatya’da gerçekleştirilecektir. EXPO hazırlık, adaylık ve etkinlik yönetimi süreçleri gerçekleştirilerek, dünyanın en prestijli uluslararası etkinliklerinden olan Horticulturel Expo’yu Malatya’da yaşayacağız.</p>\r\n\r\n<p>Biblo Event olarak Malatya Expo 2028 sürecinin bir parçası olmaktan dolayı mutluluk duyduk.</p>'),
(16, 7, 'en', 'slider-alani/tc-sanayi-ve-teknoloji-bakanligi-2', 1, 1, 'T.C Sanayi ve Teknoloji Bakanlığı', NULL),
(17, 8, 'en', 'slider-alani/aselsan-konya-2', 1, 1, 'Aselsan Konya', NULL),
(18, 6, 'en', NULL, 1, 1, 'Slider Alanı', NULL),
(19, 11, 'tr', 'referanslar', 1, 1, 'Referanslar', NULL),
(20, 12, 'tr', NULL, 1, 1, 'Deneme', NULL),
(21, 13, 'tr', NULL, 1, 1, 'Ali Doğan', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_tables`
--

CREATE TABLE `product_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sort_id` int(11) NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_table_translations`
--

CREATE TABLE `product_table_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_table_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attr` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `locale`) VALUES
(1, 'title', 'Biblo Event', 'tr'),
(2, 'description', NULL, 'tr'),
(3, 'keywords', NULL, 'tr'),
(4, 'address', NULL, NULL),
(5, 'email', NULL, NULL),
(6, 'phone', NULL, NULL),
(7, 'fax', NULL, NULL),
(8, 'contactEmail', NULL, NULL),
(9, 'facebook', NULL, NULL),
(10, 'twitter', NULL, NULL),
(11, 'instagram', NULL, NULL),
(12, 'youtube', NULL, NULL),
(13, 'linkedin', NULL, NULL),
(14, 'map', NULL, NULL),
(15, 'maintance', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ali Doğan', 'alidogan2312@gmail.com', 1, NULL, '$2y$10$7Sg/MtTTs4N9/Il9pPPK/uOy0SjNhSrmiof2WXNU.LScp6Yk6UO32', NULL, NULL, NULL, NULL, '2025-01-26 20:20:01', '2025-01-26 20:20:01', NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contents_page_id_name_locale_unique` (`page_id`,`name`,`locale`),
  ADD KEY `contents_name_index` (`name`),
  ADD KEY `contents_locale_index` (`locale`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `fragments`
--
ALTER TABLE `fragments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `fragment_translations`
--
ALTER TABLE `fragment_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fragment_translations_fragment_id_locale_unique` (`fragment_id`,`locale`),
  ADD KEY `fragment_translations_locale_index` (`locale`);

--
-- Tablo için indeksler `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_code_unique` (`code`),
  ADD KEY `languages_created_by_foreign` (`created_by`),
  ADD KEY `languages_updated_by_foreign` (`updated_by`),
  ADD KEY `languages_deleted_by_foreign` (`deleted_by`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletters_email_unique` (`email`);

--
-- Tablo için indeksler `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_category_id_foreign` (`category_id`),
  ADD KEY `pages_created_by_foreign` (`created_by`),
  ADD KEY `pages_updated_by_foreign` (`updated_by`),
  ADD KEY `pages_deleted_by_foreign` (`deleted_by`);

--
-- Tablo için indeksler `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_translations_page_id_locale_unique` (`page_id`,`locale`),
  ADD KEY `page_translations_locale_index` (`locale`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `product_tables`
--
ALTER TABLE `product_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tables_created_by_foreign` (`created_by`),
  ADD KEY `product_tables_updated_by_foreign` (`updated_by`),
  ADD KEY `product_tables_deleted_by_foreign` (`deleted_by`);

--
-- Tablo için indeksler `product_table_translations`
--
ALTER TABLE `product_table_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_table_translations_product_table_id_locale_unique` (`product_table_id`,`locale`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_foreign` (`created_by`),
  ADD KEY `users_updated_by_foreign` (`updated_by`),
  ADD KEY `users_deleted_by_foreign` (`deleted_by`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `fragments`
--
ALTER TABLE `fragments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `fragment_translations`
--
ALTER TABLE `fragment_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `product_tables`
--
ALTER TABLE `product_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `product_table_translations`
--
ALTER TABLE `product_table_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `fragment_translations`
--
ALTER TABLE `fragment_translations`
  ADD CONSTRAINT `fragment_translations_fragment_id_foreign` FOREIGN KEY (`fragment_id`) REFERENCES `fragments` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `languages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `languages_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `languages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pages_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `page_translations`
--
ALTER TABLE `page_translations`
  ADD CONSTRAINT `page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `product_tables`
--
ALTER TABLE `product_tables`
  ADD CONSTRAINT `product_tables_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tables_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tables_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `product_table_translations`
--
ALTER TABLE `product_table_translations`
  ADD CONSTRAINT `product_table_translations_product_table_id_foreign` FOREIGN KEY (`product_table_id`) REFERENCES `product_tables` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
