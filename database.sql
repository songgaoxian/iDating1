-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 29, 2015 at 11:30 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `dating_id` int(50) primary key auto_increment,
  `user_id` varchar(50) NOT NULL,
  `mate_id` varchar(50) NOT NULL,
  `dat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` varchar(1000) NOT NULL,
  `location` varchar(100) NOT NULL,
  unique(`user_id`, `dat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`dating_id`, `user_id`, `mate_id`, `dat`, `content`, `location`) VALUES
('', '3', '1', '2015-02-28 16:00:00', '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `user_id1` varchar(50) NOT NULL,
  `user_id2` varchar(50) NOT NULL,
  `state` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`user_id1`, `user_id2`, `state`) VALUES
('c0d00915-df02-bce4-06fc-fc4b2bdac94b', '1', '1'),
('1', 'c0d00915-df02-bce4-06fc-fc4b2bdac94b', '1');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `user_id` varchar(50) NOT NULL,
  `with_id` varchar(50) NOT NULL,
  `dat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `preview` varchar(200) NOT NULL,
  `type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`user_id`, `with_id`, `dat`, `preview`, `type`) VALUES
('1', '3', '2015-03-26 07:52:55', 'Hi, I hope to make friends with you. Please click on commit_friend.php?uid=1 to confirm my request.', '0'),
('3', '1', '2015-03-26 08:16:25', 'localhost:8888/commit_friend.php?uid=1', '0'),
('1c58f526-b859-19d4-4221-8c487f060451', '3', '2015-03-25 09:07:50', '123', '1'),
('3', '99f7c943-e971-e2d5-0ea8-0973f2b12da9', '2015-03-26 03:57:07', '123', '1'),
('99f7c943-e971-e2d5-0ea8-0973f2b12da9', '3', '2015-03-26 03:57:07', '123', '1'),
('1', 'c0d00915-df02-bce4-06fc-fc4b2bdac94b', '2015-03-26 12:13:55', '123', '1'),
('c0d00915-df02-bce4-06fc-fc4b2bdac94b', '1', '2015-03-26 12:13:55', '123', '1'),
('1', 'undefined', '2015-03-26 12:16:29', '123', '1'),
('undefined', '1', '2015-03-26 12:16:29', '123', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mess`
--

CREATE TABLE `mess` (
  `from_id` varchar(50) NOT NULL,
  `to_id` varchar(50) NOT NULL,
  `mess_id` varchar(50) NOT NULL,
  `dat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumtext NOT NULL,
  `photo` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mess`
--

INSERT INTO `mess` (`from_id`, `to_id`, `mess_id`, `dat`, `content`, `photo`, `username`) VALUES
('', '', '', '0000-00-00 00:00:00', '', '', ''),
('1', 'undefined', '03a2c689-a49d-b115-4c5e-eaacbab9eaf6', '2015-03-26 12:16:29', '123', 'a1b97bf7-6642-f62f-442f-22af3866a528.jpg', 'sheepfriend'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', '0590d752-76ee-d443-3', '2015-03-13 15:59:36', '', '', ''),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '1', '060f26e9-f58a-d5cc-12dc-405288899a8c', '2015-03-13 16:39:15', '', '', ''),
('1', '3', '0d506def-cc98-533f-32d0-c530356bd60a', '2015-03-26 06:09:04', 'Hi, I hope to make friends with you. Please click on commit_friend.php?uid=3 to confirm my request.', 'sheepfriend.jpg', 'sheepfriend'),
('1', '3', '11bb8566-a323-1756-4f43-577394efe57c', '2015-03-15 06:46:13', '123', 'sheepfriend.jpg', 'sheepfriend'),
('1c58f526-b859-19d4-4221-8c487f060451', '3', '12de4f28-4f20-606e-ce9d-2f09cfe839a3', '2015-03-15 06:20:42', 'testing', '', ''),
('3', '1c58f526-b859-19d4-4221-8c487f060451', '13b7d477-d0e8-08f0-b8f5-b114490e70af', '2015-03-15 05:45:05', '123', '', ''),
('1c58f526-b859-19d4-4221-8c487f060451', '1', '16b86acd-74e0-bda2-a9b8-18dc998845b5', '2015-03-15 06:16:11', '123', '', ''),
('1c58f526-b859-19d4-4221-8c487f060451', '1', '1788d05b-36ab-e0ea-8035-8096817c1eac', '2015-03-15 05:47:01', '123', '', ''),
('1', '3', '1af04861-0d6c-b36d-c041-addad1df3fcf', '2015-03-15 07:03:51', 'k', 'sheepfriend.jpg', 'sheepfriend'),
('1c58f526-b859-19d4-4221-8c487f060451', '3', '1bd3c5e3-e352-655f-9ba7-3f4f78478e8a', '2015-03-15 06:19:38', '123', '', ''),
('3', '99f7c943-e971-e2d5-0ea8-0973f2b12da9', '1ed305c6-4d8d-3029-58ca-4983e6742c54', '2015-03-26 03:57:07', '123', '0bef76c6-5f23-e107-c0f6-490113986cf2.jpg', 'sheep'),
('3', '1', '228d8725-bdeb-9274-e35d-48e1a9f1e95d', '2015-03-26 08:14:18', '122', '0bef76c6-5f23-e107-c0f6-490113986cf2.jpg', 'sheep'),
('1c58f526-b859-19d4-4221-8c487f060451', '1', '230ef87f-1de6-aa5d-ed98-deaad2708286', '2015-03-15 06:14:00', '123', '', ''),
('3', '1c58f526-b859-19d4-4221-8c487f060451', '283e3bf5-726c-a452-27da-6f1182417ade', '2015-03-25 09:07:50', '123', 'c67b4706-356d-a0d4-ecbb-f53cfd7b2706.png', 'sheep'),
('3', '1', '309f1275-e31d-7ad2-1b91-a29e1e14bd56', '2015-03-26 06:03:52', 'Hi, I hope to make friends with you. Please click on commit_friend.php?uid=1 to confirm my request.', '0bef76c6-5f23-e107-c0f6-490113986cf2.jpg', 'sheep'),
('1c58f526-b859-19d4-4221-8c487f060451', '1', '3280bd64-38a3-e1d5-844d-3d8392d54a25', '2015-03-15 06:20:33', '123', '', ''),
('c0d00915-df02-bce4-06fc-fc4b2bdac94b', '1', '332e74f5-f873-70e4-106f-ec6e12107982', '2015-03-26 12:13:04', 'Hi, I hope to make friends with you. Please click on commit_friend.php?uid=c0d00915-df02-bce4-06fc-fc4b2bdac94b to confirm my request.', '3599b159-f44e-03c8-d621-1715290aee72.', ''),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '1', '352eb9cc-c3e5-ad0b-9', '2015-03-13 16:25:06', '1231fgelksjrgl ekrjhlnwekjhrnclwuehrncqiuw4 qp3iu4hqwglrjhg1231fgelksjrgl ekrjhlnwekjhrnclwuehrncqiuw4 qp3iu4hqwglrjhg1231fgelksjrgl ekrjhlnwekjhrnclwuehrncqiuw4 qp3iu4hqwglrjhg1231fgelksjrgl ekrjhlnwekjhrnclwuehrncqiuw4 qp3iu4hqwglrjhg', '', ''),
('3', '1c58f526-b859-19d4-4221-8c487f060451', '36133473-adb8-fcf5-05f5-abd3b19208b5', '2015-03-15 06:19:00', '123\n', '', ''),
('1', '3', '372bff9e-7e90-b034-d530-b54920dd3569', '2015-03-26 07:52:55', 'Hi, I hope to make friends with you. Please click on commit_friend.php?uid=1 to confirm my request.', 'a1b97bf7-6642-f62f-442f-22af3866a528.jpg', 'sheepfriend'),
('3', '1', '3c9f358c-3276-430b-700b-1767a618ed6a', '2015-03-18 09:33:12', 'ertert', 'bbq.png', 'sheep'),
('3', '1', '3f3b28a1-aaed-6cc9-c932-3d84a0cd377d', '2015-03-15 06:59:51', 'wer', 'bbq.png', 'sheep'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', '4180e932-9603-9f7c-f', '2015-03-13 16:09:00', '123', '', ''),
('1', '3', '441cd1c7-b854-30c8-8c58-35ab2601b173', '2015-03-15 06:59:15', 'qweqw', 'sheepfriend.jpg', 'sheepfriend'),
('1', '3', '45828df7-2edb-f7ea-4dd0-0222a4a1067f', '2015-03-15 06:43:35', '123', 'sheepfriend.jpg', 'sheepfriend'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '1', '593bf23d-a0ca-625a-e2e6-9936e8868c14', '2015-03-13 16:39:08', '', '', ''),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '1', '5e863065-8058-3ce4-f', '2015-03-13 16:15:02', '123', '', ''),
('1', '3', '63b32bc3-628b-d226-2957-f02871473521', '2015-03-26 07:35:50', 'Hi, I hope to make friends with you. Please click on commit_friend.php?uid=1 to confirm my request.', 'a1b97bf7-6642-f62f-442f-22af3866a528.jpg', 'sheepfriend'),
('1c58f526-b859-19d4-4221-8c487f060451', '3', '6af04b68-0d79-c701-3db6-ee51d3edd12f', '2015-03-15 06:40:54', '123', 'c634f273-d5d8-2fc5-f18b-886165165bb1.jpg', '123'),
('1c58f526-b859-19d4-4221-8c487f060451', '3', '6d8112d4-9c6f-8182-336a-71712982ac74', '2015-03-15 06:40:37', '123', 'c634f273-d5d8-2fc5-f18b-886165165bb1.jpg', '123'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', '7279418b-cf6e-bde9-8', '2015-03-13 16:06:46', '123', '', ''),
('3', '1', '739c6362-5130-320c-b14f-1b4837d1beb0', '2015-03-15 05:44:05', '123', '', ''),
('3', '1c58f526-b859-19d4-4221-8c487f060451', '7b858a87-8c79-8f21-34f3-a5bb07c8282b', '2015-03-15 05:45:37', 'iwuer', '', ''),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', '7d670181-42c8-92dc-7', '2015-03-13 15:59:14', '', '', ''),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', '872632fd-2a61-5163-2', '2015-03-13 16:08:50', '123', '', ''),
('1', '3', '8edf8a9a-5df7-9ae5-eef6-d2a28d90593d', '2015-03-26 06:09:28', 'Hi, I hope to make friends with you. Please click on commit_friend.php?uid=3 to confirm my request.', 'sheepfriend.jpg', 'sheepfriend'),
('1c58f526-b859-19d4-4221-8c487f060451', '1', '9c00693e-0f16-ab6f-6631-ec2031a9f404', '2015-03-15 06:14:32', '123', '', ''),
('1c58f526-b859-19d4-4221-8c487f060451', '3', '9f55cbc9-9089-56b7-cd20-9797efc67daf', '2015-03-15 06:42:52', '123wfqer', 'c634f273-d5d8-2fc5-f18b-886165165bb1.jpg', '123'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', 'a0a8f3ac-ed40-25c7-c', '0000-00-00 00:00:00', '', '', ''),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '1', 'a2996c16-0081-e859-d5c4-fdfee113ff6e', '2015-03-13 16:40:12', '34234', '', ''),
('1', '3', 'ae3145b0-f3dd-e597-1607-96ca43ff4f39', '2015-03-26 06:22:37', 'Hi, I hope to make friends with you. Please click on commit_friend.php?uid=3 to confirm my request.', 'sheepfriend.jpg', 'sheepfriend'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', 'ae4459df-4a24-9027-8', '2015-03-13 16:07:00', '123', '', ''),
('1', '3', 'af8b3f7f-26ef-cbfe-b143-b85ff8325a95', '2015-03-15 06:46:49', '12312', 'sheepfriend.jpg', 'sheepfriend'),
('1c58f526-b859-19d4-4221-8c487f060451', '3', 'b0312205-c691-208b-c322-de0477569e89', '2015-03-15 06:42:35', '123', 'c634f273-d5d8-2fc5-f18b-886165165bb1.jpg', '123'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', 'b0fd2e58-1df3-a007-2', '2015-03-13 16:01:20', '', '', ''),
('3', '1', 'b7de2b7c-6cf5-adf2-7563-b12648cb15e8', '2015-03-26 08:16:25', 'localhost:8888/commit_friend.php?uid=1', '0bef76c6-5f23-e107-c0f6-490113986cf2.jpg', 'sheep'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', 'bdbdca1e-535a-abbe-b', '2015-03-13 16:05:40', '', '', ''),
('1', '3', 'c04750b3-4ab0-bd9d-bb87-bde50c7d82b4', '2015-03-15 07:00:35', 'lwejhr', 'sheepfriend.jpg', 'sheepfriend'),
('1', '3', 'c48444f3-24e6-3725-b57a-7b1158855503', '2015-03-26 07:34:43', 'Hi, I hope to make friends with you. Please click on commit_friend.php?uid=1 to confirm my request.', 'a1b97bf7-6642-f62f-442f-22af3866a528.jpg', 'sheepfriend'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', 'c7d23239-f918-3392-b', '2015-03-13 16:08:13', '123', '', ''),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', 'cbdbb92c-6f84-6280-b', '2015-03-13 16:06:28', '', '', ''),
('1', '1c58f526-b859-19d4-4221-8c487f060451', 'cc228f43-0e76-cca9-7523-3ea497005bdd', '2015-03-15 06:43:40', '123', 'sheepfriend.jpg', 'sheepfriend'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', 'cdac1b5b-10b8-55df-c', '2015-03-13 16:04:07', '', '', ''),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '', 'ce1e9fd3-d971-08b2-1', '2015-03-13 16:07:32', '123', '', ''),
('3', '1', 'd1a680db-5928-951f-7fdb-de1ef26efbc1', '2015-03-15 07:00:09', 'weljrhgql\n', 'bbq.png', 'sheep'),
('1c58f526-b859-19d4-4221-8c487f060451', '3', 'd9dff21f-e232-3425-b1bc-a88ee0b02ec1', '2015-03-15 06:42:04', '123', 'qwe@qq', '123'),
('1', 'c0d00915-df02-bce4-06fc-fc4b2bdac94b', 'da75005c-e210-95d5-45e1-7a2087258e71', '2015-03-26 12:13:55', '123', 'a1b97bf7-6642-f62f-442f-22af3866a528.jpg', 'sheepfriend'),
('3', '1', 'e54c2c2d-808c-d8c3-d2fc-df6e0b260038', '2015-03-18 09:33:17', 'wer', 'bbq.png', 'sheep'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '1', 'e73c85e0-aa84-b607-8', '2015-03-13 16:21:25', '123', '', ''),
('3', '1', 'f2e7948d-415f-f48a-b85c-c888c458c403', '2015-03-25 09:02:23', '123', 'c67b4706-356d-a0d4-ecbb-f53cfd7b2706.png', 'sheep'),
('1c58f526-b859-19d4-4221-8c487f060451', '1', 'f31d594a-d5b1-aa4a-2238-d74cf036ca9c', '2015-03-15 06:15:13', '123', '', ''),
('3', '1', 'f4222c50-6266-d883-1757-a1dbbbdb0d9d', '2015-03-25 08:59:33', 'hello~', 'c67b4706-356d-a0d4-ecbb-f53cfd7b2706.png', 'sheep'),
('3', '1', 'fa433130-95dd-5f8c-ee8e-519f617fe71e', '2015-03-18 09:33:15', 'werwer', 'bbq.png', 'sheep'),
('1c58f526-b859-19d4-4221-8c487f060451', '3', 'fa75097a-5df2-14ec-cfeb-ad586d9fb9c8', '2015-03-15 06:40:58', 'saf', 'c634f273-d5d8-2fc5-f18b-886165165bb1.jpg', '123'),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', '1', 'fe5d2b50-6274-4551-6', '2015-03-13 16:09:30', '123', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `moment`
--

CREATE TABLE `moment` (
  `user_id` varchar(50) NOT NULL,
  `pic_id` varchar(50) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `take_date` varchar(20) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moment`
--

INSERT INTO `moment` (`user_id`, `pic_id`, `summary`, `take_date`, `upload_date`) VALUES
('3', '087264bd-4fdc-a829-f937-901a6393bb2b.png', '123', '0000-00-00', '2015-03-10 14:00:04'),
('65165cc3-8bc0-419f-00c8-96e9a7444825', '0e29d120-9e43-05a8-2493-8347c933ccb3.jpg', '123', '0000-00-00', '2015-03-25 08:19:33'),
('3', '10f9c2b0-0a65-1901-1c6e-d4edf6788180.jpg', '234', '0000-00-00', '2015-03-10 13:56:16'),
('65165cc3-8bc0-419f-00c8-96e9a7444825', '163b2164-bfe6-3017-a03e-9600ff8959a0.png', '123', '0000-00-00', '2015-03-25 08:27:35'),
('1', '2bb9e380-8a85-435f-c2dd-8044e49031dc.png', '123', '2015-03-12', '2015-03-29 06:33:01'),
('65165cc3-8bc0-419f-00c8-96e9a7444825', '3faaa92d-23d1-db19-e389-85b49f7fd21e.png', '123124', '2015-03-13', '2015-03-25 08:30:55'),
('3', '493c36b0-79c8-701b-60f4-d196e0d66bcc.jpg', 'testing', '', '2015-03-25 09:51:52'),
('65165cc3-8bc0-419f-00c8-96e9a7444825', '4a3a9169-c844-5100-5caa-95fdfaf5ac2f.jpg', '123', '0000-00-00', '2015-03-25 08:22:45'),
('65165cc3-8bc0-419f-00c8-96e9a7444825', '7f18050d-8245-0f32-b186-f9af46bdf951.png', '123124', '2015-03-13', '2015-03-25 08:30:44'),
('65165cc3-8bc0-419f-00c8-96e9a7444825', '85cd24b1-3162-2f7e-1ca1-1e846385b942.png', '123124', '2015-03-13', '2015-03-25 08:30:57'),
('30ed47bb-d6c2-bfad-ef5f-2f8094b4c52a', '8b9d33f4-11c2-84d5-69b9-f176098550a6.jpg', 'blablabla', '0000-00-00', '2015-03-12 03:17:21'),
('3', '99ed9135-99f4-f858-fff5-63ae925a419a.jpg', '12312', '2015-03-02', '2015-03-25 09:55:31'),
('3', 'a2b82920-26ac-7155-f471-ef75f76f6e2a.png', 'wwr', '0000-00-00', '2015-03-10 14:02:22'),
('1', 'b7bcdd3e-4783-3e4a-6505-43f99d40aff0.jpg', '123', '2015-03-12', '2015-03-29 06:32:22'),
('3', 'c3b0dc82-bb9c-8724-7943-f6c71e52060b.png', '123', '0000-00-00', '2015-03-10 13:59:48'),
('3', 'c5f728e1-9e50-dd4e-fc68-8e43cb238459.png', '123', '0000-00-00', '2015-03-15 05:43:35'),
('65165cc3-8bc0-419f-00c8-96e9a7444825', 'c9c98b7a-8269-1119-a83a-c3262fbdfd06.png', '123', '0000-00-00', '2015-03-25 08:28:14'),
('3', 'd8ceb5f5-9b7e-6cf2-fe06-9b7e61d16514.jpg', 'testing', '', '2015-03-25 09:45:56'),
('3', 'df1fbec5-5d3a-fdcc-92ae-d741ade38346.jpg', 'qwe', '0000-00-00', '2015-03-18 10:13:53'),
('65165cc3-8bc0-419f-00c8-96e9a7444825', 'ec8c0623-6245-ff11-35d7-8f5bda7e047a.png', '123124', '2015-03-13', '2015-03-25 08:31:02'),
('3', 'ffc88275-285a-338f-1f73-4f5c68434757.png', '123', '0000-00-00', '2015-03-10 13:57:03'),
('3', 'pic.jpg', 'blablabla', '2015-03-02', '2015-03-01 04:44:20'),
('3', 'pic1.jpg', 'blabla', '0000-00-00', '2015-03-01 04:44:20'),
('3', 'pic2.jpg', 'wer', '2015-03-02', '2015-03-01 04:44:46'),
('3', 'pic3.jpg', '', '0000-00-00', '2015-03-01 04:45:57'),
('3', 'pic4.jpg', 'wer', '2015-03-03', '2015-03-01 04:45:39'),
('3', 'pic5.jpg', '', '0000-00-00', '2015-03-01 04:45:39'),
('3', 'pic6.jpg', '', '0000-00-00', '2015-03-01 04:45:39'),
('3', 'pic7.jpg', '', '0000-00-00', '2015-03-01 04:45:39'),
('3', 'pic8.jpg', '123', '2015-03-02', '2015-03-01 04:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `user_id` varchar(50) NOT NULL,
  `sid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`user_id`, `sid`) VALUES
('1', '757936f2-e17a-c82a-4b40-29d846cfb187'),
('3', '587f189f-bf3b-a831-eb87-06663924d15a'),
('65165cc3-8bc0-419f-00c8-96e9a7444825', '176eb716-96a9-ff96-43a0-b5a9432e2b9d'),
('94b21c99-ca2c-9cbb-3dee-f3c27266a9b4', '1ec4b9ee-9f1b-0517-f6fa-f8f674285d4c'),
('c0d00915-df02-bce4-06fc-fc4b2bdac94b', 'b4d439f6-a9e0-0499-aaf4-f4ef1d68c212'),
('c1b9d368-eb58-b9b2-4bb2-cb5318bed5aa', '5589306c-9404-8e87-76f7-3f276f1f3fe7'),
('d1bdd8ef-7157-2c81-1ce2-aa4acfe8b169', '4edf1012-bf10-d4ee-769d-cf88207dea11'),
('d2d72b3a-7689-9507-f9f6-2be9ea5f9bde', '9b8bcfc0-0b49-2071-f2ac-e40ab326acf2'),
('e16c6857-d18e-72b7-1a5e-5509fd15583e', '19ff91e4-bc43-2994-9489-f8edf5fc4f16');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `user_id` varchar(50) NOT NULL,
  `movie` varchar(20) NOT NULL,
  `book` varchar(20) NOT NULL,
  `music` varchar(20) NOT NULL,
  `jogging` varchar(20) NOT NULL,
  `cooking` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`user_id`, `movie`, `book`, `music`, `jogging`, `cooking`) VALUES
('1', 'movie', '', '', '', ''),
('3', 'movie', 'book', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `user_id` varchar(50) NOT NULL,
  `tag` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `theme` varchar(20) NOT NULL DEFAULT 'pink',
  `photo` varchar(50) NOT NULL,
  `sex` varchar(11) NOT NULL,
  `hometown` varchar(20) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `job` varchar(20) NOT NULL,
  `income` varchar(11) NOT NULL,
  `self_intro` varchar(300) NOT NULL,
  `height` varchar(11) NOT NULL,
  `education` varchar(20) NOT NULL,
  `age_f` varchar(10) NOT NULL,
  `age_t` varchar(10) NOT NULL,
  `height_f` varchar(10) NOT NULL,
  `height_t` varchar(10) NOT NULL,
  `city_pref` varchar(30) NOT NULL,
  `hometown_pref` varchar(30) NOT NULL,
  `education_pref` varchar(30) NOT NULL,
  `job_pref` varchar(30) NOT NULL,
  `income_pref` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `email`, `password`, `username`, `theme`, `photo`, `sex`, `hometown`, `birthday`, `city`, `job`, `income`, `self_intro`, `height`, `education`, `age_f`, `age_t`, `height_f`, `height_t`, `city_pref`, `hometown_pref`, `education_pref`, `job_pref`, `income_pref`) VALUES
('02d4185e-c63e-9f0a-0f66-f645bf3ec23b', '1231@qq.com', '123', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('1', 'xingyue.kelly@gmail.com', '1', 'sheepfriend', 'blue', 'a1b97bf7-6642-f62f-442f-22af3866a528.jpg', 'female', 'Beijing', '1993-0323', 'Hong Kong', 'Unspecified', '100', 'testing', '160', 'Unspecified', '123', '', '', '', '', '', 'Unlimited', 'Unlimited', ''),
('1c58f526-b859-19d4-4221-8c487f060451', 'qwe@qq', 'qwe', '123', '', 'c634f273-d5d8-2fc5-f18b-886165165bb1.jpg', 'on', '123', '2015-03-04', '123', 'telecommunication', '123123', '23', '', 'unspecified', '', '', '', '', '', '', '', '', ''),
('1c5e773a-af76-e141-6', '', '123', '', '', '', '0', '', '0', '', '', '0', '', '0', '', '', '', '', '', '', '', '', '', ''),
('2', 'orientpsy@hotmail.com', '1155014429', 'Roy', 'blue', 'roy.jpg', '0', 'Jiangsu', '22', 'Hong Kong', 'student', '0', 'testing', '0', '', '', '', '', '', '', '', '', '', ''),
('282324b7-e223-4835-deca-696a5d623658', 'nji@wkej', '123', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('3', 'bbq@gmail.com', '1', 'sheep', 'pink', '33d61354-7693-0dbb-9348-eb8d470fe189.jpg', '1', 'Hong Kong', '12', 'Hong Kong1qm', 'Unspecified', '10000', '234m', '', 'Unspecified', '123', '123', '', '', '', '', 'Unlimited', 'Unlimited', ''),
('30ed47bb-d6c2-bfad-ef5f-2f8094b4c52a', 'qwe@gmail.com', '123', 'kelly1', '', '0f2ef87c-a6ab-c0ee-54a6-b55f2a66207f.jpg', 'on', 'beijing', '2015-03-12', 'beijing', 'unspecified', '0', 'blablabla', '123', 'unspecified', '', '', '', '', '', '', '', '', ''),
('470733ad-2c3e-0a35-084b-abb1eb191776', '12131@qq.com', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('4ec9b9cb-6949-d413-7efd-db8394b917b4', 'qweqwe@q', '1', '', '', 'e00164e4-f468-8157-f2c4-a6e44ccb3931.jpg', 'Female', '', '', '', 'Unspecified', '', '', '', 'Unspecified', '', '', '', '', '', '', '', '', ''),
('5915b21d-9ec3-23d4-ee3b-80bb3acae4fe', '123@132', '1', '', '', '858ea416-cdda-0a26-2f05-848bfe6471a3.', 'on', '', '', '', 'unspecified', '', '', '', 'unspecified', '', '', '', '', '', '', '', '', ''),
('5f380e50-fdf9-0ae8-7', '', '123', '', '', '', '0', '', '0', '', '', '0', '', '0', '', '', '', '', '', '', '', '', '', ''),
('65165cc3-8bc0-419f-00c8-96e9a7444825', 'asd@qq', '1', '', '', '649f3e36-550f-ba30-f803-11b33ad6e5ab.', 'Female', '', '', '', 'Unspecified', '', '', '', 'Unspecified', '123', '', '', '', '', '', 'Unlimited', 'Unlimited', ''),
('6bde6480-f322-1c59-a505-540a57e56f3e', 'wer@q', '1', '', '', '9cd0a717-8b87-6acd-21bf-0ec91d354efc.', 'on', '', '', '', 'unspecified', '', '', '', 'unspecified', '', '', '', '', '', '', '', '', ''),
('75121c74-f126-bf22-9e3f-6feadd601f32', '1213@qq.com', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('7e0c90a3-a612-db21-b473-586d4b196bfa', 'jin@bbq.com', '123', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('805c8be4-1098-0caf-9729-dffb0d0c0606', '123131@qq.com', '2', '', '', 'a529427b-2cb9-5e17-cd95-4d819b151db4.jpg', 'on', '', '', '', 'unspecified', '', '', '', 'unspecified', '', '', '', '', '', '', '', '', ''),
('821fee28-b127-2a45-a1dc-647d9bd843c0', '12311@qq.com', '123', '', '', '22cc92dd-3b37-3006-14e6-1bc89172d01b.jpg', 'on', '', '', '', 'unspecified', '', '', '', 'unspecified', '', '', '', '', '', '', '', '', ''),
('8a8db9e9-2f1f-45e6-4e04-20b6079c72ae', 'werwwe@qq', '123', '', '', 'f4fe20bb-37e2-cace-e127-35296437e277.jpg', 'on', '', '', '', 'unspecified', '', '', '', 'unspecified', '', '', '', '', '', '', '', '', ''),
('92c00635-7728-61ff-20a2-1a639bfc3210', 'qwer@qq.com', '123', '23', '', 'bdde4b7e-eceb-9594-5c74-272120ee1cc3.jpg', 'on', '123', '2015-03-12', '123', 'it', '123', '1231', '23', 'bachelor', '', '', '', '', '', '', '', '', ''),
('94b21c99-ca2c-9cbb-3dee-f3c27266a9b4', 'jin@qq', '1', '123', '', 'e4f74265-fd91-e6e3-9ae7-01eb9fe82134.', 'Female', '123', '', '123', 'Wholesale/Retail', '', '23', '', 'Master', '', '', '', '', '', '', '', '', ''),
('99f7c943-e971-e2d5-0ea8-0973f2b12da9', '123@qq.com', '123', '', '', '', '0', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('9bdbe1d1-d37e-cd3d-956f-511376482fef', '10000@qq.com', '123456', 'Ma Huateng', '', 'fb465b95-5975-c725-22ec-dcb1931eb2af.jpg', 'on', 'Chaozhou, Canton', '2015-03-05', 'Shenzhen, the deep r', 'unspecified', '1000', 'Hey there!', '', 'unspecified', '', '', '', '', '', '', '', '', ''),
('9e1a3bd8-7ce8-ef7d-5e45-93ef3ea7dcf1', '', '123', '', '', '', '0', '', '0', '', '', '0', '', '0', '', '', '', '', '', '', '', '', '', ''),
('b05b19b4-c2e1-3c99-cf4e-c7688cfc7e0e', 'bilibili@qq.com', '111', 'sheepfriend', '', '5431bbf7-de3a-09e6-5d26-2fdbfd85743e.jpg', 'on', 'Hong Kong', '1998-02-12', 'Beijing', 'telecommunication', '123', '123', '', 'high-school', '', '', '', '', '', '', '', '', ''),
('b0ae2676-3e16-74bf-5', '', '', '', '', '', '0', '', '0', '', '', '0', '', '0', '', '', '', '', '', '', '', '', '', ''),
('bf7aa50c-4449-66d1-37bf-15a447b3ca24', '', '123', '', '', '', '0', '', '0', '', '', '0', '', '0', '', '', '', '', '', '', '', '', '', ''),
('c0d00915-df02-bce4-06fc-fc4b2bdac94b', 'nji@qq.com', '123', 'kelly', '', '3a15acd7-0fff-57f6-d929-a0cc56cb8a08.jpg', '', '', '', '23', 'Unspecified', '', '', '123', 'Unspecified', '', '', '', '', '', '', 'Unlimited', 'Unlimited', ''),
('c1b9d368-eb58-b9b2-4bb2-cb5318bed5aa', 'qqq@qq', 'q', '', '', '6288de4f-4d7c-b11a-7031-f258b5d163d0.', '', '', '', '', 'Unspecified', '', '', '', 'Unspecified', '', '', '', '', '', '', 'Unlimited', 'Unlimited', ''),
('c2c1cfaf-7208-a9ab-0f92-ef84ae14f0e8', '123@1', '123', '', '', '4055be31-873e-cb7b-feaf-0166728daf36.jpg', 'on', '', '', '', 'unspecified', '', '', '', 'unspecified', '', '', '', '', '', '', '', '', ''),
('d1bdd8ef-7157-2c81-1ce2-aa4acfe8b169', '123123123', '123', '', '', 'b78280e6-c574-5929-d521-5fd245013485.', '', '', '', '', 'Unspecified', '', '', '', 'Bachelor', '123', '', '', '', '', '', 'Master', 'Unlimited', ''),
('d2d72b3a-7689-9507-f9f6-2be9ea5f9bde', '123123@11', '123', '', '', '0a9f81aa-3119-0ce6-f4b0-6cea3aa8cde9.', '', '', '', '', 'Unspecified', '', '', '', 'Unspecified', '123', '', '', '', '', '', 'High School', 'Unlimited', ''),
('e16c6857-d18e-72b7-1a5e-5509fd15583e', 'qwe@q', 'q', '', '', '51182f77-3ef4-cff4-b4e8-792a954aff71.', 'Female', '', '2015-03-06', '', 'Unspecified', '', '', '', 'Unspecified', '', '', '', '', '', '', 'Unlimited', 'Unlimited', ''),
('f7f0530b-3895-870a-7842-f6662090f9e2', 'xing@q', '123', '123', '', '251fc6d4-198a-42ef-d923-35ea86dfa842.pdf', 'Female', '', '', '', 'Unspecified', '', '', '', 'Unspecified', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--

--
-- Indexes for table `mess`
--
ALTER TABLE `mess`
 ADD PRIMARY KEY (`mess_id`);

--
-- Indexes for table `moment`
--
ALTER TABLE `moment`
 ADD PRIMARY KEY (`pic_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
 ADD PRIMARY KEY (`user_id`,`email`), ADD KEY `password` (`password`), ADD KEY `password_2` (`password`), ADD KEY `username` (`username`), ADD KEY `sex` (`sex`), ADD KEY `hometown` (`hometown`), ADD KEY `age` (`birthday`), ADD KEY `city` (`city`), ADD KEY `job` (`job`), ADD KEY `income` (`income`);
