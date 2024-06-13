-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-06-13 10:13:47
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `akua`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `dat` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `mai` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `furi` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `prefecture` varchar(100) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `dat`, `time`, `mai`, `name`, `furi`, `phone`, `gender`, `birthday`, `prefecture`, `flag`) VALUES
(7, '', '', '', '福田', 'フクダ', '020-256-7894', '女', '2009-12-14', '千葉県', 0),
(8, '7月15日', '9：00～10：00', '4枚', '林', 'ハヤシ', '023-456-8957', '女', '2012-12-24', '石川県', 1),
(9, '7月15日', '18：00～19：00', '4枚', '石川', 'イシカワ', '023-8958-8945', '女', '1977-10-09', '神奈川県', 1),
(10, '', '', '', '浅田', 'アサダ', '412-8956-7856', '', '1979-06-26', '北海道', 1),
(11, '7月13日', '9：00～10：00', '1枚', '佐藤', 'サトウ', '465-789-5666', '女', '1978-03-01', '長野県', 0),
(15, '7月13日', '9：00～10：00', '4枚', '真弓', 'マユミ', '0235-7849-854', '男', '2010-01-19', '長野県', 1),
(20, '7月15日', '11：00～12：00', '1枚', '佐々木', 'ササキ', '122146', '女', '2010-01-01', '岐阜県', 1),
(21, '7月14日', '19：00～20：00', '2枚', '山田', 'ヤマダ', '023-4569-7854', '女', '2005-05-15', '神奈川県', 1),
(24, '7月15日', '9：00～10：00', '2枚', '堀', 'ホリ', '014-5236-7859', '女', '1971-08-28', '東京都', 1),
(25, '7月14日', '12：00～13：00', '1枚', '永見', 'ナガミ', '1255-7845-8845', '女', '2000-11-20', '群馬県', 1),
(26, '', '', '', '', '', '', '', '2010-01-01', '北海道', 1),
(27, '', '', '', '', '', '', '', '2010-01-01', '北海道', 1),
(28, '', '', '', '', '', '', '', '2010-01-01', '北海道', 1),
(29, '', '', '', '', '', '', '', '2010-01-01', '北海道', 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
