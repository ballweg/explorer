-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2013 at 05:02 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `explorer`
--
CREATE DATABASE `explorer` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `explorer`;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `banner` char(50) DEFAULT '/assets/img/header.jpg',
  `splash` char(50) DEFAULT '/assets/img/exp_splash.svg',
  `welcome` char(128) DEFAULT NULL,
  `game_title` char(30) DEFAULT NULL,
  `root_url` char(50) DEFAULT NULL,
  `reg_start` datetime DEFAULT NULL,
  `play_start` datetime DEFAULT NULL,
  `play_stop` datetime DEFAULT NULL,
  `reg_stop` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `banner`, `splash`, `welcome`, `game_title`, `root_url`, `reg_start`, `play_start`, `play_stop`, `reg_stop`) VALUES
(1, '/assets/img/header.jpg', '/assets/img/exp_splash.svg', 'Welcome to CDU Open Day', 'CDU Explorer', NULL, '2013-08-25 00:00:00', '2013-08-23 09:00:00', '2013-08-25 14:10:00', '2013-08-25 14:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) DEFAULT NULL,
  `org` varchar(50) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `contact_email` varchar(50) DEFAULT NULL,
  `image` varchar(200) DEFAULT '',
  `heading` varchar(50) DEFAULT NULL,
  `text` text,
  `link` varchar(200) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lon` float(10,6) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `q1` varchar(200) DEFAULT NULL,
  `a1` varchar(30) DEFAULT NULL,
  `q2` varchar(200) DEFAULT NULL,
  `a2` varchar(30) DEFAULT NULL,
  `q3` varchar(200) DEFAULT NULL,
  `a3` varchar(30) DEFAULT NULL,
  `visits` int(11) DEFAULT NULL,
  `completed` int(11) DEFAULT NULL,
  `users_viewed` text,
  `users_completed` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `quest_id`, `org`, `contact`, `contact_email`, `image`, `heading`, `text`, `link`, `lat`, `lon`, `location`, `q1`, `a1`, `q2`, `a2`, `q3`, `a3`, `visits`, `completed`, `users_viewed`, `users_completed`) VALUES
(1, 1, 'Centre for Renewable Energy', 'Julie Ballweg', 'julie.ballweg@cdu.edu.au', '/assets/img/content/content_images/solar.jpg', 'Centre for Renewable Energy', 'Check out the parts of a home photovoltaic power generation system, and learn about Australia''s huge potential for cheap, clean solar power.', 'http://riel.cdu.edu.au/programs/centre-renewable-energy', -12.372179, 130.868454, 'Red 2 Basketball Court - Stand 9', '2.5 million Australians use what form of renewable power in their home?', 'solar', '', '', '', '', 0, 1, '', '[1]'),
(2, 5, 'Plumbing', 'Trisha Mellow', 'trisha.mellow@cdu.edu.au', '/assets/img/content/content_images/plumbing.jpg', 'Plumbing', 'Find out about the many careers involved in plumbing; water, gas, septic, air, air-conditioning units, drainage and much more.  Learn how to change a tap washer, try your hand at silver soldering using an oxy welder.', 'http://www.cdu.edu.au/cdu-vet/trades/plumbing', -12.371676, 130.868896, 'Strand - Marquee 1', 'What type of soldering are they doing?', 'silver', 'There are 2 types of Gas used to Silver Solder, on cylinder is Marone, what is the other colour? ', 'black', NULL, NULL, NULL, 0, NULL, NULL),
(3, 5, 'Marine Industry', 'Trisha Mellow', 'trisha.mellow@cdu.edu.au', '/assets/img/content/content_images/marine.jpg', 'Marine Industry', 'Check out the safety craft and recreational boat. Learn how to tie a sea-worthy knot, and try your hand at driving the watercraft simulator.', 'http://www.cdu.edu.au/cdu-vet/trades/metal-trades-maritime', -12.371599, 130.869034, 'Strand - Marquee 2', 'How many people can the life raft hold?   ', '8', 'What is the brand of the CDU Boat?   ', 'Black Arrow', 'How many outboard motors are on the CDU Boat?', '2', NULL, 0, NULL, NULL),
(4, 5, 'Auto & Light Vehicle', 'Trisha Mellow', 'trisha.mellow@cdu.edu.au', '/assets/img/content/content_images/auto.jpg', 'Auto & Light Vehicle', 'See what happens to wiring when an electrical short is present, see the simulated vehicle wiring boards, working motors, cross sectional cut outs, CDU''s electric cars and the Beat the Heat vehicle.', 'http://www.cdu.edu.au/cdu-vet/trades/auto-civil', -12.371463, 130.868927, 'Strand - Marquee 3', 'What brand is the Beat the Heat race car?', 'holden', ' What animal is on the Beat the Heat vehicle? ', 'Pig', 'What brand of vehicle is Beat the Heat?', 'Holden', NULL, 0, NULL, NULL),
(5, 5, 'Oil & Gas', 'Trisha Mellow', 'trisha.mellow@cdu.edu.au', '/assets/img/content/content_images/oilgas.jpg', 'Oil & Gas', 'Find out about the Certificate II in Oil & Gas course offered through CDU, what it takes to get a job in supporting the industry.  Check out the Oil & Gas pipe leak detection demonstration and learn how to detect if it is leaking.', 'http://www.cdu.edu.au/cdu-vet/trades/metal-trades-maritime', -12.371545, 130.869034, 'Strand - Marquee 2', 'What machine are they pressurising the cylinder with?', 'air compressor', 'What are they putting in the cylinder to pressurise it?', 'Air', NULL, NULL, NULL, 0, NULL, NULL),
(6, 5, 'Industry Skills', 'Trisha Mellow', 'trisha.mellow@cdu.edu.au', '/assets/img/content/content_images/indskills.jpg', 'Construction, Drafting and Industry Skills', 'Be taken through the OH&S requirements and learn about the various operators, licenses and tickets related to this industry. Under direction, you can try operating a cherry picker and participate in Guess the load activity.', 'http://www.cdu.edu.au/cdu-vet/trades/construction-drafting-industry', -12.371624, 130.868774, 'Strand - Marquee 4', 'How many kgs can the cherry picker basket lift?', '215', 'What type of protective equipment are the machine operator wearing on their head?', 'Hard Hat', 'Is the Machine Operator wearing a High Visy clothing?', 'yes', NULL, 0, NULL, NULL),
(7, 4, 'Library', 'Barbara Coat', 'Barbara.Coat@cdu.edu.au', '/assets/img/content/content_images/library.jpg', 'How can we help?', 'The Office of Library Services provides assistance and resources to support staff and to prepare VET and Higher Education students to be creative and independent learners.', 'http://www.cdu.edu.au/library', -12.371511, 130.869385, 'Red 8 - Library', 'Today''s Library word is?', 'awesome', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(8, 2, 'Nursing', 'Bernie Glab', 'Bernadette.glab@cdu.edu.au', '/assets/img/content/content_images/nursing.jpg', 'Nursing', 'Visit the nursing display and learn about nursing at CDU. Have your blood pressure checked and challenge your knowledge of anatomy and physiology with our interactive torso. There are prizes to be won if you can put the torso back together in under 3 minutes.', 'http://www.cdu.edu.au/health/undergraduate-nursing', -12.372284, 130.868546, 'Red 2 Basketball Court - Stand 15', 'Where might you find nurses?', 'hospital', NULL, NULL, NULL, NULL, NULL, 1, NULL, '[1]'),
(9, 1, 'Horticulture', 'Scott McDonald', 'scott.mcdonald@cdu.edu.au', '/assets/img/content/content_images/hort.jpg', 'Training the Territory to Grow', 'The Horticulture Team at CDU are responsible for the delivery of VET horticulture programs to trainees, industry, and anyone wanting to learn how to grow and maintain plants and landscape areas. Our facility has a strong focus on sustainable systems and practices, including eco-certification of our plant nursery, award winning water re-use system, and grid connect solar. We also have the University''s first vertical garden installation currently under development.', 'http://www.cdu.edu.au/cdu-vet/primary-industries/horticulture-aquaculture-topend', -12.371991, 130.869415, 'Boab Court - Stand 7', 'Enter code:', 'mango', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(10, 1, 'Tropical Aquaculture', 'Scott McDonald', 'scott.mcdonald@cdu.edu.au', '/assets/img/content/content_images/aqua.jpg', 'Tropical Aquaculture', 'The Aquaculture Team at CDU is responsible for the delivery of VET Aquaculture training across the Top End of Australia. With a focus on commercial species such as Barramundi and Red Claw, the Team is also actively involved in sustainable aquaculture projects on remote coastal communities. Home to some large hungry barramundi, the aquaculture facility also works with Aus Turtle, the Arc Vet Hospital, and Marine Wild Watch to care for turtles that have been rescued from our coastal waters, helping them to get back into full health before being released back into the environment.', 'http://www.cdu.edu.au/cdu-vet/primary-industries/horticulture-aquaculture-topend', -12.371629, 130.865372, 'Pink 3A - Maturation Shed', 'How many turtles are being cared for?', '2', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(11, 1, 'Environmental Research', 'Matt Northwood', 'matthew.northwood@cdu.edu.au', '/assets/img/content/content_images/fieldresearch.jpg', 'Environmental Fieldwork', 'Studying environmental sciences at CDU takes student learning far beyond the classroom. Speak with staff about exciting study and research opportunities in the field of environmental sustainability. View the equipment researchers use in the field including the Fast Greenhouse Gas Analyser that measures CO<sub>2</sub> in real time.', 'http://riel.cdu.edu.au/', -12.372123, 130.868423, 'Red 2 Basketball Court - Stand 8', 'Enter code:', 'airboat', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(12, 2, 'Health Science', 'Robyn Willams', 'robyn.williams@cdu.edu.au', '/assets/img/content/content_images/healthsci.jpg', 'Health Science', ' If you enjoy working with people and making a difference in their lives and in the community, the Health Science booth will hold plenty of interest. Learn how you can be part of a dynamic area and gain a degree that leads to many rewarding careers. These include health promotion, community health development, health services management, Indigenous health and occupational therapy.\rStaff from the Chronic Disease Network and local health promotion programs will be on hand as well to discuss their work in this area.', 'http://www.cdu.edu.au/health/health-science', -12.372330, 130.868561, 'Red 2 Basketball Court - Stand 14', 'Is a Bachelor of Health Science the same as a Bachelor of Nursing?', 'no', NULL, NULL, NULL, NULL, NULL, 1, NULL, '[1]'),
(13, 2, 'Psychology', 'Kate Moore', 'kate.moore@cdu.edu.au', '/assets/img/content/content_images/psych.jpg', 'Psychology', ' Confound your brain! Test your cognitive skills with a variety of games and tests (mirror drawing, "what''s that smell?", test your perceptual abilities).', 'http://www.cdu.edu.au/pcs/psychology', -12.372301, 130.868530, 'Red 2 Basketball Court - Stand 23', 'Who is the father of Psychoanalysis?', 'freud', NULL, NULL, NULL, NULL, NULL, 1, NULL, '[1]'),
(14, 2, 'The Gym@CDU', 'Natasha McCrae', 'Natasha.McCrae@cdu.edu.au', '/assets/img/content/content_images/gym.jpg', 'The Gym@CDU', 'Find out how much fun fitness is by visiting the team at The Gym@CDU stall. Learn just how simple it is to increase your health and longevity with just a little bit of exercise.', 'http://www.cdu.edu.au/thegym', -12.371992, 130.869308, 'Boab Court - Stand 3', 'Enter code:', 'lift', NULL, NULL, NULL, NULL, NULL, 1, NULL, '[1]'),
(15, 4, 'Northern Editions', 'Chris Miezes', 'Chris.Miezis@cdu.edu.au', '/assets/img/content/content_images/prints.jpg', 'Broncos Birds & Boulders', 'The Northern Editions gallery is showing a lovely exhibition by artists from Bindi, Mwerre Anthurre Artist located in Alice Springs. These artists worked in conjunction with the Northern Editions printmakers to produce a collection of drypoints and etchings.', 'http://northerneditions.com.au/', -12.373720, 130.869492, 'Orange 9 - Northern Editions Gallery', 'Enter code:', 'sunday', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(16, 4, 'CDU Art Gallery', 'Anita Angel', 'Anita.Angel@cdu.edu.au', '/assets/img/content/content_images/gallery.jpg', 'CDU Art Gallery', 'Drawn from the Wesfarmers Collection, <i>Luminous World</i> features 57 significant paintings, objects and photographs by 44 leading Australian and New Zealand artists, many of whom have never before exhibited in the Northern Territory. From a range of perspectives, the exhibition reveals the imaginative and creative ways that artists have explored or utilised the phenomenon of light – its presence and absence – and the role it plays in defining and transforming our world. Curated by Helen Carroll and developed in association with the Art Gallery of WA, <i>Luminous World</i> brings Wesfarmers’ contemporary art collection to regional and national audiences for the first time. The exhibition commences its national tour at Charles Darwin University Art Gallery as part of the 2013 Darwin Festival.', 'http://www.cdu.edu.au/artgallery', -12.374199, 130.869766, 'Orange 12 - CDU Art Gallery', 'What bird is featured in Brook Andrew''s photo?', 'owl', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(17, 3, 'Innovative Media', 'Alison Lockley', 'alison.lockley@cdu.edu.au', '/assets/img/content/content_images/imps.jpg', 'Innovative Media Production Studio', 'The Innovative Media Production Studio (IMPS) has been established to create high quality interactive content for higher education and vocational teaching units. Using 3D animation, gamification, web development and other techniques, we create engaging content and innovative solutions for contemporary learning. <br>Check out our stand to see a 3D printer, learn how the Open Day Explorer game works and see 3D animation in action.', NULL, -12.372293, 130.868698, 'Red 2 Basketball Court - Stand 43', 'Enter code:', 'virtual', NULL, NULL, NULL, NULL, NULL, 1, NULL, '[1]'),
(18, 3, 'Learnline', 'Bill Searle', 'bill.searle@cdu.edu.au', '/assets/img/content/content_images/learnline.jpg', 'Learnline', 'The Office of Learning and Teaching will showcase its free CDU Mobile application that allows you to access your Learnline units on a variety of mobile devices. This app is best used for reading announcements, checking grades, interacting with discussion boards and blogs, and accessing attached documents and content items. Check out the new features including an events calendar and CDU News. Learn how these apps can keep you up to date while studying at CDU.', 'http://m.cdu.edu.au/index/index/?f=smart', -12.372222, 130.868469, 'Red 2 Basketball Court - Stand 17', 'Enter code:', 'mobile', NULL, NULL, NULL, NULL, NULL, 1, NULL, '[1]'),
(19, 3, 'Engineering and IT', 'Asma Rehman Khan', 'Asma.RehmanKhan@cdu.edu.au', '/assets/img/content/content_images/iteng.jpg', 'Engineering and Information Technology', 'Join in some great activities at this booth. Check out the student-built robotic arm that responds to motion sensors and see the Daihatsu Mira, which has been fitted with a student-built electric engine, transforming it into an energy efficient electric car. See if you can outsmart the computerised talking head or participate in the student-designed interactive mobile phone applications. These applications showcase some of the great work being done on mobile development programming in Information Technology at CDU. Also see if you can use your android phones to control Lego robots.', 'http://www.cdu.edu.au/engit', -12.372250, 130.868271, 'Red 2 Basketball Court - Stands 41 & 42', 'Enter code:', 'robot', NULL, NULL, NULL, NULL, NULL, 1, NULL, '[1]'),
(20, 3, 'ITMS', NULL, NULL, '/assets/img/content/content_images/itms.jpg', 'I.T. Kiosk', '<p>The Office of Information Technology Management and Support, or ITMS, is a part of Corporate Services at Charles Darwin University (CDU) and is responsible for a range of information, network and communication technologies.</p><p>We can assist you with email, internet, phone and voicemail access, software and hardware purchasing, training, and student computer lab access and information.</p>\n', 'http://www.cdu.edu.au/itms', -12.372170, 130.868774, 'Red 3 - ITMS Kiosk', 'Enter code:', 'wifi', NULL, NULL, NULL, NULL, NULL, 1, NULL, '[1]');

-- --------------------------------------------------------

--
-- Table structure for table `quest`
--

DROP TABLE IF EXISTS `quest`;
CREATE TABLE `quest` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `tasks` varchar(100) DEFAULT NULL,
  `reward_id` int(11) DEFAULT NULL,
  `users_viewed` text,
  `users_completed` text,
  `icon_url` varchar(200) DEFAULT NULL,
  `short_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `quest`
--

INSERT INTO `quest` (`id`, `name`, `tasks`, `reward_id`, `users_viewed`, `users_completed`, `icon_url`, `short_name`) VALUES
(1, 'Science & Environment', '[1,9,10,11]', 1, NULL, NULL, '/assets/img/content/quest_icons/160/sci.png', 'science'),
(2, 'Health', '[8,12,13,14]', 2, NULL, NULL, '/assets/img/content/quest_icons/160/health.png', 'health'),
(3, 'Technology', '[17,18,19,20]', 3, NULL, NULL, '/assets/img/content/quest_icons/160/tech.png', 'tech'),
(4, 'Arts & Literature', '[7,16,15]', 4, NULL, NULL, '/assets/img/content/quest_icons/160/artlit.png', 'arts'),
(5, 'Trades', '[2,3,4,5,6]', 2, NULL, NULL, '/assets/img/content/quest_icons/160/trades.png', 'trades');

-- --------------------------------------------------------

--
-- Table structure for table `quest.old`
--

DROP TABLE IF EXISTS `quest.old`;
CREATE TABLE `quest.old` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `tasks` varchar(100) DEFAULT NULL,
  `reward_id` int(11) DEFAULT NULL,
  `users_viewed` text,
  `users_completed` text,
  `icon_url` varchar(200) DEFAULT NULL,
  `short_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `quest.old`
--

INSERT INTO `quest.old` (`id`, `name`, `tasks`, `reward_id`, `users_viewed`, `users_completed`, `icon_url`, `short_name`) VALUES
(1, 'Science & Environment', NULL, NULL, NULL, NULL, '/assets/img/content/quest_icons/160/sci.png', 'science'),
(2, 'Health', NULL, NULL, NULL, NULL, '/assets/img/content/quest_icons/160/health.png', 'health'),
(3, 'Technology', NULL, NULL, NULL, NULL, '/assets/img/content/quest_icons/160/tech.png', 'tech'),
(4, 'Arts & Literature', NULL, NULL, NULL, NULL, '/assets/img/content/quest_icons/160/artlit.png', 'arts'),
(5, 'Trades', NULL, NULL, NULL, NULL, '/assets/img/content/quest_icons/160/trades.png', 'trades');

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

DROP TABLE IF EXISTS `reward`;
CREATE TABLE `reward` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image_url` varchar(200) DEFAULT '',
  `type` varchar(20) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `text` text,
  `users_completed` text,
  `criteria` text,
  `completed` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`id`, `image_url`, `type`, `value`, `name`, `text`, `users_completed`, `criteria`, `completed`) VALUES
(1, '/assets/img/content/badges_a/env.png', 'quest', 1000, 'Scientist', 'Charles Darwin University is a great place to study environmental sciences. Our unique environment and location makes CDU one of only a few English speaking tropical universities in the world.', NULL, '[1,9,10,11]', 0),
(2, '/assets/img/content/badges_a/trades.png', 'quest', 500, 'Tradesman', 'Trades are in high demand worldwide! Whether you''re thinking of a second career, up-skilling from your current job, or starting fresh, CDU offers state of the art training in many important industries.', NULL, '[2,3,4,5,6]', 0),
(3, '/assets/img/content/badges_a/complete.png', 'complete', 1000, 'Completed', 'You have completed every quest within the game! You are now eligible to win the grand prize - a MacBook Pro, Hurley Backpack and urBeats headphones. Thanks for playing! Drawing will be on Monday, at 2pm. Head over to the Innovative Media Production studio stand between the IT Kiosk and the basketball courts. We''ve got something special for you!', NULL, '[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]', 0),
(4, '/assets/img/content/badges_a/health.png', 'quest', 1000, 'Health', 'In a CDU health program, you''ll gain skills that are in high demand and be ready for a rewarding career caring for people. You can make a real difference in people''s lives and build your community. ', '[1]', '[8,12,13,14]', 1),
(5, '/assets/img/content/badges_a/art.png', 'quest', 1000, 'Artist', 'Art, music, a good read. You enjoy the finer things in life. Leonardo Da Vinci would give you a high five. Programs at CDU will allow you to explore your inner artist while gaining valuable skills.', NULL, '[7,16,15]', 0),
(6, '/assets/img/content/badges_a/tech.png', 'quest', 1000, 'Tech-Head', 'View it, code it, jam-unlock it, surf it, scroll it, pause it, click it. You know tech, don''t you? CDU offers programs in a variety of tech fields, as well as a huge range of online learning resources to help you along your journey in any field.', '[1]', '[17,18,19,20]', 1),
(7, '/assets/img/content/badges_a/explorer.png', 'misc', 500, 'Explorer', 'You have reached the two furthest points in Open Day. You are a true CDU explorer!', NULL, '[16,10]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reward.old1`
--

DROP TABLE IF EXISTS `reward.old1`;
CREATE TABLE `reward.old1` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image_url` varchar(200) DEFAULT '',
  `type` varchar(20) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `text` text,
  `users_completed` text,
  `criteria` text,
  `completed` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `reward.old1`
--

INSERT INTO `reward.old1` (`id`, `image_url`, `type`, `value`, `name`, `text`, `users_completed`, `criteria`, `completed`) VALUES
(1, '/assets/img/content/quest_icons/160/sci.png', 'quest', 1000, 'Scientist', 'Forget the labcoat, at CDU scientists wear thongs.', NULL, '[1,9,10]', 24),
(2, '/assets/img/content/quest_icons/160/trades.png', 'quest', 500, 'Tradie', 'Blah blah bla about trades', '[1]', '[2,3]', 22),
(3, 'http://upload.wikimedia.org/wikipedia/commons/a/a9/High_voltage_warning.svg', 'badge', 1000, 'Sparky', 'Someone has to keep the lights on and the phones charged! Will the future belong to renwables or is oil and gas here to stay? Both industries are waiting for you to lead the way.', '[1]', '[1,5]', 24),
(4, '/assets/img/content/quest_icons/160/complete.png', 'complete', 1000, 'Completed', 'You have completed every quest within the game! You are now eligable to win the grand prize - a MacBook Pro, Hurley Backpack and urBeats headphones. Thanks for playing! Drawing will be on Monday, at 2pm.', '[1]', '[1,2,3,4,5,6,7,8]', 7),
(5, 'http://placehold.it/640x200&text=Congratulations!', 'quest', 1000, 'Medicine', 'You know just what people need, when they need it. Expand your skills and help your community with CDU health programmes.', '[1]', '[8]', 11),
(6, 'http://placehold.it/640x200&text=Congratulations!', 'quest', 1000, 'Artist', 'Art, music, a good read. You enjoy the finer things in life. Leonardo Da Vinci would give you a high five.', '[1]', '[7]', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `interest` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `signup` datetime DEFAULT NULL,
  `first_logon` datetime DEFAULT NULL,
  `last_active` datetime DEFAULT NULL,
  `points` int(10) DEFAULT '0',
  `level` int(1) DEFAULT '0',
  `earned_rewards` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `completed` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `viewed` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `eligible` tinyint(1) DEFAULT NULL,
  `complete` tinyint(1) DEFAULT NULL,
  `complete_time` datetime DEFAULT NULL,
  `terms_accepted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `interest`, `signup`, `first_logon`, `last_active`, `points`, `level`, `earned_rewards`, `completed`, `viewed`, `eligible`, `complete`, `complete_time`, `terms_accepted`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Jeff Ballweg', 'jeff.ballweg@cdu.edu.au', 'computers', NULL, NULL, NULL, 0, NULL, '[4,6]', '[12,13,8,14,1,17,18,19,20]', NULL, 0, 0, NULL, NULL),
(27, 'jeff', '098f6bcd4621d373cade4e832627b4f6', 'Jeff Ballweg', 'jeffballweg@gmail.com', 'computer stuff.', '2013-08-16 09:56:07', NULL, '2013-08-16 09:56:07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(28, 'tablet', '098f6bcd4621d373cade4e832627b4f6', 'Sony S Test User', 'jeffballweg+test@gmail.com', 'tablets', '2013-08-16 11:36:41', NULL, '2013-08-16 11:36:41', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(29, 'Jeff2', '098f6bcd4621d373cade4e832627b4f6', 'Jeff Ballweg', 'Jeffballweg+jeff2@gmail.com', '', '2013-08-19 12:06:58', NULL, '2013-08-19 12:06:58', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(30, 'erin', '81dc9bdb52d04dc20036dbd8313ed055', 'Erin Lawson', 'a@b.com', ':)', '2013-08-21 13:01:02', NULL, '2013-08-21 13:01:02', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(31, 'mhilse', 'ff0d813dd5d2f64dd372c6c4b6aed086', 'Monica Hilse', 'monica.hilse@cdu.edu.au', 'MOOCs', '2013-08-21 13:01:54', NULL, '2013-08-21 13:01:54', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(32, 'Paula', '5f4dcc3b5aa765d61d8327deb882cf99', 'Wilson', 'Paula.wilson@cdu.edu.au', '', '2013-08-21 13:08:02', NULL, '2013-08-21 13:08:02', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(33, 'Emmett', '904ed18929009cadd04caf1487b3bea0', 'Emmett Ballweg', 'Julie.rodenberg@gmail.com', 'Environmental sciences', '2013-08-21 13:13:14', NULL, '2013-08-21 13:13:14', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(34, 'Bucket', '48348203d9ff6190cb3eb03f4afc7e75', 'Dan', 'dan.hartney@cdu.edu.au', 'Animation', '2013-08-21 13:36:06', NULL, '2013-08-21 13:36:06', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(35, 'firefox', '098f6bcd4621d373cade4e832627b4f6', 'Firefox test user', 'jeffballweg+firefox@gmail.com', 'test', '2013-08-21 13:39:10', NULL, '2013-08-21 13:39:10', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(36, 'iPad', '098f6bcd4621d373cade4e832627b4f6', 'iPad test user', 'Jeffballweg+ipad@gmail.com', 'Apples', '2013-08-21 13:45:46', NULL, '2013-08-21 13:45:46', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(37, 'Vader', '48348203d9ff6190cb3eb03f4afc7e75', 'Dan', 'danhartney@gmail.com', 'Google', '2013-08-21 14:21:04', NULL, '2013-08-21 14:21:04', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(38, 'Helen', '7a2eb41a38a8f4e39c1586649da21e5f', 'Helen Rysavy', 'Helen.rysavy@cdu.edu.su', 'Drinking', '2013-08-22 08:23:52', NULL, '2013-08-22 08:23:52', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(39, 'Alicat', '24eb05d18318ac2db8b2b959315d10f2', 'Alison Lockley ', 'alison.lockley@cdu.edu.au', 'IMPS - innovative educatona re', '2013-08-22 13:11:05', NULL, '2013-08-22 13:11:05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(40, '111', '5f4dcc3b5aa765d61d8327deb882cf99', 'Hdjxjxjskxkx', '1111@cdu.edu.au', '', '2013-08-22 13:15:10', NULL, '2013-08-22 13:15:10', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(41, 'Monica', 'ff0d813dd5d2f64dd372c6c4b6aed086', '', 'hilsemonica@gmail.com', '', '2013-08-22 13:16:15', NULL, '2013-08-22 13:16:15', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(42, 'Iphone3', '098f6bcd4621d373cade4e832627b4f6', 'Test iPhone 3GS', 'jeffballweg+3gstest@gmail.com', 'Vintage smart phones ', '2013-08-22 15:39:19', NULL, '2013-08-22 15:39:19', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(43, '5safari', '098f6bcd4621d373cade4e832627b4f6', 'iPhone 5 safari test ', 'jeffballweg+testsafari@gmail.com', 'Safari', '2013-08-22 15:49:06', NULL, '2013-08-22 15:49:06', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1);
