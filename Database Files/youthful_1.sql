-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2017 at 07:21 AM
-- Server version: 5.5.52-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `youthful_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `category_slug` text,
  `category_color` varchar(7) NOT NULL,
  `category_description` text,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `category_name`, `category_slug`, `category_color`, `category_description`) VALUES
(16, 'Sports', 'sports', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(27, 'Fashion', 'fashion', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(18, 'Lifestyle', 'lifestyle', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(19, 'Business', 'business', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(20, 'Education', 'education', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(21, 'Politics', 'politics', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(22, 'Entertainment', 'entertainment', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(23, 'New Startups', 'newstartups', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(24, 'Talents', 'talents', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(25, 'Rising Stars', 'risingstars', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(26, 'Opportunities', 'opportunities', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(28, 'Technology', 'technology', '', 'Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.'),
(29, 'Challenge', 'challenge', '', 'Official Ingenius Challenge Category');

-- --------------------------------------------------------

--
-- Table structure for table `categories_posts`
--

CREATE TABLE IF NOT EXISTS `categories_posts` (
  `post_id` bigint(20) unsigned NOT NULL,
  `id_category` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories_posts`
--

INSERT INTO `categories_posts` (`post_id`, `id_category`) VALUES
(560, 21),
(561, 18),
(562, 17),
(563, 16),
(564, 21),
(565, 18),
(566, 17),
(567, 18),
(568, 20),
(569, 18),
(570, 19),
(571, 21),
(572, 25),
(573, 18),
(574, 25),
(575, 16),
(576, 25),
(577, 29);

-- --------------------------------------------------------

--
-- Table structure for table `comments_votes`
--

CREATE TABLE IF NOT EXISTS `comments_votes` (
  `com_voteid` int(11) NOT NULL AUTO_INCREMENT,
  `com_commentid` int(11) NOT NULL,
  `com_userid` int(11) NOT NULL,
  `com_up` int(3) NOT NULL DEFAULT '0',
  `com_down` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`com_voteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data for table `comments_votes`
--

INSERT INTO `comments_votes` (`com_voteid`, `com_commentid`, `com_userid`, `com_up`, `com_down`) VALUES
(131, 1, 685, 1, 0),
(132, 1, 684, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE IF NOT EXISTS `favourites` (
  `user_id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`user_id`, `posts_id`) VALUES
(684, 572);

-- --------------------------------------------------------

--
-- Table structure for table `feed_source`
--

CREATE TABLE IF NOT EXISTS `feed_source` (
  `id_feed` int(11) NOT NULL AUTO_INCREMENT,
  `url_feed` text NOT NULL,
  `desc_feed` text,
  `active` int(1) NOT NULL DEFAULT '1',
  `numposts` int(3) DEFAULT NULL,
  `categorydefault` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_feed`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE IF NOT EXISTS `follows` (
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`user_id`, `follow_id`) VALUES
(684, 1),
(685, 1),
(700, 1),
(684, 685);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `firstname`, `lastname`, `email`) VALUES
(2, 'Anukam', 'Victor', 'anukamvictor@gmail.com'),
(3, 'Samson', 'Adeniranye', 'talldreamdesigns@gmail.com'),
(4, 'Rosemary', 'Ojeah', 'ojeahroseifeyinwa@gmail.com'),
(5, 'Tobi', 'Ibidapo', 'tobiibidapo@yahoo.com'),
(6, 'Adeniyi', 'ADEYEMO', 'impactsworld01@gmail.com'),
(7, 'Tobi', 'Ampitan', 'freakstoluv@yahoo.com'),
(8, 'Abisola', 'Aboaba', 'aboabaabisola@ymail.com'),
(9, 'jide', 'oyewunmi', 'jamesododo@termii.com'),
(10, 'EMEM', 'AKPAN', 'aemem10@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(20) NOT NULL,
  `option_value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_name`, `option_value`) VALUES
(1, 'appname', '.: Ingenius'),
(2, 'appdescription', 'Idea. Development'),
(4, 'appusernophoto', 'https://cdn4.iconfinder.com/data/icons/linecon/512/photo-128.png'),
(5, 'appmailserver_url', 'mail.ingenius.ng'),
(6, 'appmailserver_login', 'support@ingenius.ng'),
(7, 'appmailserver_pass', 'i2016!!!'),
(8, 'appmailserver_port', '25'),
(9, 'appgoogleanalytics', 'UA-58179354-1'),
(10, 'appstoryapproval', '0'),
(11, 'appadv', '1'),
(12, 'appadvimgurl', 'http://labs.psilva.pt/sharen/images/pub.png'),
(13, 'appadvtitle', 'Ingenius'),
(14, 'appadvsubtitle', 'Email Marketing'),
(15, 'appadvlink', '#'),
(16, 'appcarousel', '1'),
(17, 'applayout', '3'),
(18, 'applogo', '1473011885_ing.png'),
(19, 'applogoretina', '1473011888_ing.png'),
(20, 'appgads', '2'),
(21, 'appgadscode', 'ca-pub-7923110857512188'),
(22, 'appgadslot', '4139835821'),
(23, 'appgadswidth', '728px'),
(24, 'appgadsheight', '90px'),
(25, 'appcolorbgheader', '#FFFFFF'),
(26, 'appcolorbodytext', '#888888'),
(27, 'appcolortitlescolor', '#ce1417'),
(28, 'appcolornewstitles', '#1a1d23'),
(29, 'appcolorbgfooter', '#1a1d23'),
(30, 'appcolorfootertitles', '#ce1417'),
(31, 'appcolorfootertext', '#7b8b8e'),
(32, 'appcolorfooterlinks', '#7b8b8e'),
(33, 'appcolorbuttonsbg', '#ce1417'),
(34, 'appcolorbuttonstext', '#FFFFFF'),
(35, 'appcolorbuttonsbghov', '#ce1417'),
(36, 'appcolorbuttonstexth', '#FFFFFF'),
(37, 'appfacebookurl', 'https://www.facebook.com/ingeniusyouth'),
(38, 'apptwitterurl', 'https://twitter.com/ingeniusyouthng'),
(39, 'appyoutubeurl', 'https://www.youtube.com/channel/UC-ldPKKh8BHHp5M3JHPDr5A'),
(40, 'appvimeourl', ''),
(41, 'appinstagramurl', ''),
(42, 'apptitleleftcolumn', 'InGenius | Proffering Practical Solutions'),
(43, 'appleftcontent', '<p>Ingenius is Nigeria’s biggest talent based youth platform. Future leaders, aspiring entrepreneurs and intelligent minds meet here to solve practical issues.</p>'),
(44, 'appfootercopy', 'Copyright © 2016'),
(45, 'appfavicon', 'favicon.png'),
(46, 'appadvarea1', '<div style="background-color:#292d41;">\n                    <div style="width:100%;min-height:70px;padding-top:12px;text-align:center;color:#FFF;">\n                        Advertising area<br />\n                        <small style="color:#67b9b5;">Use html code, image, adsense, etc.</small>\n                    </div>    \n\n                </div>'),
(47, 'appauthor', NULL),
(48, 'appkeywords', NULL),
(49, 'appadmiddlepost', '2'),
(50, 'appslidertype', 'Recent'),
(51, 'appslideruser', NULL),
(52, 'appsliderlimit', '1'),
(53, 'apppostauthor', '0'),
(54, 'appadscode', ''),
(55, 'appadsidebar', '0'),
(56, 'appfbcommentsenable', '1'),
(57, 'appuserrank', '1'),
(58, 'appuserranklike', '1'),
(59, 'appadscodehome', '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\n<!-- Inegnius -->\n<ins class="adsbygoogle"\n     style="display:inline-block;width:400px;height:101px"\n     data-ad-client="ca-pub-7923110857512188"\n     data-ad-slot="4139835821"></ins>\n<script>\n(adsbygoogle = window.adsbygoogle || []).push({});\n</script>'),
(60, 'externalarticle', 'blank'),
(61, 'appnewsletter', ''),
(62, 'mailchimpurl', ''),
(63, 'appvoteadd', '1'),
(64, 'apppostanon', '0'),
(65, 'apppostanonuser', '');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id_page` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(30) NOT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` text NOT NULL,
  `title_slug` text NOT NULL,
  PRIMARY KEY (`id_page`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id_page`, `area`, `title`, `content`, `link`, `title_slug`) VALUES
(1, 'footer', 'Rss Feeds', 'RSS Feeds', 'http://labs.psilva.pt/sharen/feed', 'rss-feeds'),
(3, 'footer', 'Contact', 'Ibadan, Nigeria<br />\r\nsupport@ingenius.ng<br />', '', 'contact');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`poll_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`poll_id`, `created`, `closed`) VALUES
(13, '2016-09-04 07:30:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `polls_options`
--

CREATE TABLE IF NOT EXISTS `polls_options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `polls_options`
--

INSERT INTO `polls_options` (`option_id`, `poll_id`, `title`) VALUES
(37, 13, 'True'),
(38, 13, 'False');

-- --------------------------------------------------------

--
-- Table structure for table `polls_votes`
--

CREATE TABLE IF NOT EXISTS `polls_votes` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` int(10) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `polls_votes`
--

INSERT INTO `polls_votes` (`vote_id`, `option_id`, `user_id`, `timestamp`, `ip`) VALUES
(1, 37, 687, 0, '80.248.3.155'),
(2, 38, 687, 0, '80.248.3.155');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(8) NOT NULL AUTO_INCREMENT,
  `post_type` varchar(20) NOT NULL,
  `post_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `post_domain` varchar(255) NOT NULL,
  `post_url` varchar(255) DEFAULT NULL,
  `post_upvote` int(11) NOT NULL DEFAULT '0',
  `post_image` varchar(255) DEFAULT NULL,
  `post_date` datetime NOT NULL,
  `post_by` int(8) NOT NULL,
  `approved` int(1) NOT NULL DEFAULT '1',
  `post_slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `post_poll_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=578 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_type`, `post_subject`, `post_text`, `post_domain`, `post_url`, `post_upvote`, `post_image`, `post_date`, `post_by`, `approved`, `post_slug`, `post_poll_id`) VALUES
(560, 'text', 'General Buhari: President-Elect of Nigeria', '<p>General Buhari won the Presidential election that took place on the 28th of March 2015…. He would be sworn-in on 29th May, 2015. Congratulations to the General</p>', '', '', 0, '1473009297.png', '2016-09-04 19:14:58', 1, 1, 'general-buhari-president-elect-of-nigeria', NULL),
(561, 'text', 'IN’GENIUS POETRY! – Nigeria-born, America-raised native of Cross River State, Bassey Ikpi', '<p [removed]="color: rgb(51, 51, 51); font-family: Muli;">Having a heart for television programming and content before she discovered poetry, Ikpi returned to Nigeria in 2013 to begin work for television, having seen the opportunities in Nigeria for reinvention. She has a production company, Basseyworld Productions which she is working through to also create a platform for spoken word poetry to grow in Nigeria.</p><p [removed]="color: rgb(51, 51, 51); font-family: Muli;">The Siwe Project was birthed soon birthed, as she works to help people and their loved ones deal with mental illness, especially in a country which is in dire need of mental health awareness. She is working to bring the organization’s yearly initiative, <em>No Shame Day, </em>to Nigeria. Of her vision, she says, “I want to use what little bit of notoriety I have to help people live. I’ve been fortunate to have so much help and so many people conspiring to save my life, the only thing I can do is give back. I have no choice.”</p><p [removed] rgb(51, 51, 51); font-family: Muli;">She explains that, although she struggles daily, the fact that she is still alive is a triumph and a success. She says to herself, “If I can just get to morning, I’ll be fine. And I think, ‘I made it, it’s morning.’ That’s success to me. This life is success.”</p>', '', NULL, 0, '1473009763.png', '2016-09-04 19:22:43', 1, 1, 'ingenius-poetry-nigeria-born-america-raised-native-of-cross-river-state-bassey-ikpi', NULL),
(562, 'text', 'Praiz Launching Album Soon', '<div>Top Nigerian artist Praiz is launching his album on December 14th, 2014 and its going to feature a lot of other top Nigerian artists too….Go grab your copy and enjoy good music..</div><div><br></div>', '', NULL, 0, '1473009884.png', '2016-09-04 19:24:44', 1, 1, 'praiz-launching-album-soon', NULL),
(563, 'text', 'Lionel Messi – the Living Legend', 'Lionel Messi is a player many believe is from another planet…. One can say that it is a great privilege to witness watching him play football… He is a mentor to millions of aspiring football players and a great joy to watch for many soccer lovers….', '', NULL, 0, '1473010085.png', '2016-09-04 19:28:06', 1, 1, 'lionel-messi-the-living-legend', NULL),
(564, 'poll', 'Senator Godswill Akpabio Did well as a Governor (True or False)', 'According to some Godswill Akpabio performed on a very wide scale and was arguably one of the best performing Governors in Nigeria… What do you think... Is this true or false. You can also add your comments below.', '', NULL, 0, '1473010228_Godswill-Akpabio-e1435999950220.jpg', '2016-09-04 19:30:43', 1, 1, 'senator-godswill-akpabio-did-well-as-a-governor-true-or-false', 13),
(565, 'text', 'African Fashion and Design Week 2015 is Here', '<div>African Fashion and Design Week kicked off yesterday. Works of designers from 13 different African countries will be featured in the next 4 days. Starting today we will have works of Christabel Isreal (Nigeria), Reuben Nkeruka (Nigeria), Isoma Umaoma(Nigeria), Pink Lady (Nigeria), Wuman (Nigeria), Stylish Desire (Nigeria), Akyeeba (Nigeria), and Raaah (Zimbabwe) showcased.</div><div><br></div><div>Before the end of the AFDW, the city of Port Harcourt will be wowed once more by other designs from Oma Montana (Nigeria), Symdey Couture (Nigeria), Blessing Genuis(Nigeria), Gretta Luce (Benin Republic), Ana Loyd (Angola), Afriken by Nana(Ghana), Abrantie (Ghana), Mo’Creations & Couture (Zambia), Duaba Serwa(Ghana), Akpos Okudu (Nigeria), Sunny Rose (Nigeria), Alleen’s by Alain Niava(Cote d’Ivoire), Sa4a (Ghana), Angie H Couture (Liberia/ USA), Kinabuti (Nigeria), Iconic Invanity (Nigeria), Mafi’s (Ethiopia), Kiko Romeo (Kenya), Grace Wallace (Togo/Paris), Rosbinna (Nigeria), Kaveke (Kenya), Zizi Cardow (Nigeria), Lanre Da Silva Ajayi (Nigeria), Mustafa Hassanali (Tanzania), Gavin Rajah (South Africa).</div><div><br></div><div> African Fashion and Design Week – Our Heritage, Our Pride</div>', '', NULL, 0, '1473010652.png', '2016-09-04 19:37:32', 1, 1, 'african-fashion-and-design-week-2015-is-here', NULL),
(566, 'text', 'Yemi Alade is Awesome', 'She is gorgeous, her swag is on point, she can dance very well, her voice catches your attention… She is YEMI ALADE.. Its really good to see women doing amazing exploits in the Entertainment Industry.. Keep doing well Boss Alade….', '', NULL, 0, '1473010819.png', '2016-09-04 19:40:20', 1, 1, 'yemi-alade-is-awesome', NULL),
(567, 'text', '$3.4 million Lykan Hypersport', 'This is a solid machine. The Lykan Hypersport is a limited production sports car by W Motors, a Lebanese company founded in 2012. It was featured in the Fast and Furious 7 movie and it costs a whooping $3.4 million. It wasn’t designed to be a spectator on the road but a Dominator on any road. When your thinking of a Super Car, think Lykan….', '', NULL, 0, '1473013052.png', '2016-09-04 20:17:32', 1, 1, '34-million-lykan-hypersport', NULL),
(568, 'text', 'FROM CIA TO NOVELIST – Adaobi Tricia Nwaubani', '<div>From her childhood dreams of being a CIA agent, Adaobi Tricia Nwaubani has found recognition and accolade on the global literature stage. Her debut novel, I Do Not Come To You By Chance, published in 2009, earned her notable awards and she became the first contemporary African writer to have gotten an international book deal while still living in her home country of Nigeria.</div><div><br></div><div>Born and raised in Enugu, Nwaubani went to secondary school in Imo State and went on to study Psychology at the University of Ibadan. Her first book gained widespread popularity because of its innovation in capturing the scope of the ‘419 email scams’, giving the much anticipated Nigerian version of the global phenomenon. While having no formal writing training, she has found her niche and passion in writing and, in 2012, was selected as one of the 15 emerging leaders in West Africa by the African Leadership Institute. What is it that they say? “Use what you have to get what you want.”</div>', '', NULL, 0, '1473013329.png', '2016-09-04 20:22:10', 1, 1, 'from-cia-to-novelist-adaobi-tricia-nwaubani', NULL),
(569, 'text', 'ONE SHOT MILLIONAIRE – Kelechi Amadi-Obi one of Nigeria’s prominent photographers.', '<div>Known for his sharp photography and versatile work than spans architecture & places, fashion, people and adverts, Kelechi Amadi-Obi is one of Nigeria’s prominent photographers.</div><div><br></div><div>However, a project he embarked on in 2013 set his bar even higher than his peers in the industry. In the last quarter of the year, Amadi-Obi toured Nigeria, visiting the western ancient city of Abeokuta, the tropical forests of Osun, the colonial kingdoms of Kano and Kaduna, Zuma Rock of Niger State, among several other cities and sites in the country. Of course, being a photographer, he took pictures every step of his journey, but instead of being clad with his digital camera, Amadi-Obi took breathtaking pictures with a Nokia Lumia phone. In September 2013, he presented the pictures and his journey at the TEDx Lagos conference.</div><div><br></div><div>What Amadi-Obi did through his month-long project was to bring his audience to a new appreciation of Nigeria and to recreate a desire to see the nation’s rich cultural heritage. Even more importantly, Amadi-Obi proved to young photography aspirants and creatives that you can use what you have in hand to create beautiful art; you don’t need the fancy stuff.</div>', '', NULL, 0, '1473013494.png', '2016-09-04 20:24:55', 1, 1, 'one-shot-millionaire-kelechi-amadi-obi-one-of-nigerias-prominent-photographers', NULL),
(570, 'text', 'Mega Structures - Burj Khalifa, Dubai [National Geographic] in English - YouTube', '', 'youtu.be', 'https://youtu.be/yyaEIf2ok6I', 0, '1473013931.png', '2016-09-04 20:32:11', 1, 1, 'mega-structures-burj-khalifa-dubai-national-geographic-in-english-youtube', NULL),
(571, 'text', 'LEKKI-IKOYI LINK BRIDGE, LAGOS STATE', 'The Lagos State Government built the Lekki-Ikoyi Link Bridge and is a 1.36km cable-stayed bridge linking the fast-growing Lekki axis of the city of Lagos, Nigeria with Ikoyi, the rich and affluent part of the city. The bridge was built by construction giant Julius Berger Nigeria and was commissioned on the 29th of May 2013 by the Governor of Lagos State, Babatunde Fashola.', '', NULL, 0, '1473014044.png', '2016-09-04 20:34:06', 1, 1, 'lekki-ikoyi-link-bridge-lagos-state', NULL),
(572, 'text', 'The Unique Genius', '<p>Becoming a Genius is an endless journey that requires consistency in improving specific areas that develop the talents of an individual. InGenius is a unique platform that is dedicated to celebrating talents in various fields across Nigeria and diaspora. The advancement of any nation lies in the brainpower of the youths. The InGenius Team is ready to showcase talents and celebrate ingenuity in any field/industry. Don''t be afraid to let the World know what your good at, join the InGenius family to feature Rising Stars, advertise trending startups, solve specific national challenges, showcase individual genuine contributions and a whole lot more. </p><p>What are you waiting for? Create an account today and network with other genius minds</p><p>Project Head</p><p><span [removed] 1.5;">InGenius Nigeria</span></p><p>Oreoluwa Ogundipe</p>', '', NULL, 0, '1475027065.png', '2016-09-27 18:44:25', 685, 1, 'the-unique-genius', NULL),
(573, 'text', 'Woman Crush of the Week', 'Tara Fela-Durotoye is the pioneer of the bridal makeup profession in Nigeria. She is the founder and current C.E.O House of Tara International. She launched the first bridal directory in Nigeria in 1999, promoted the first-ever series of bridal seminars in 2000 and set up the first makeup studio in Nigeria in 2004. Tara also established the country’s first makeup school in 2005, launched the Tara Product Line- Tara Orekelewa beauty range and hosted Nigeria’s first Make-Up Conference in 2014.&nbsp;<br>Well done Tara for being an inspiration to young women across Africa.', '', NULL, 0, '1484077190.png', '2017-01-10 11:39:50', 1, 1, 'woman-crush-of-the-week', NULL),
(574, 'text', 'The Beautiful Nancy Isime', 'Nancy Isime is a Nigerian actress, a model and also TV presenter. An indigene of Edo State, Isime in 2009 won the Miss Valentine International Beauty Pageant&nbsp;<span [removed]="" new="" roman","serif""="">and finished second in the Miss Telecoms Nigeria beauty contest. As a model, she has worked for renowned Nigerian-international designers in the likes of House of Marie, Ade Bakere, Adebayo Jones, Zizi Cardow, Shakara Couture, Konga Online.  In 2011, she began a career as an actress in the TV series Echoes. Since then, it has been a record of growth for Nancy as she has appeared in several films and is known as a television presenter for the gossip show The Squeeze and Technology show What’s Hot, and backstage segment of MTN Project Fame season 7. In 2016, Nancy became the presenter of the popular show Trending on HipTV. Nancy is bold, beautiful with strong determination in pursuit of her dreams. You are an inspiration to youths in Nigeria and Africa as a whole.</span>', '', NULL, 0, '1484137757.png', '2017-01-11 04:29:17', 1, 1, 'the-beautiful-nancy-isime', NULL),
(575, 'text', 'CRISTIANO RONALDO (CR7). The New Legend of Football', 'Every football lover knows the name Cristiano Ronaldo is one reckoned with in the world of football. Very recently, CR7, fondly called by his loyal fans, did them proud by winning the Ballon D’Or Award for the fourth time in his career, following a historic year in which he helped claim the European Championship and Champions League titles for Portugal and Real Madrid respectively. Ronaldo is now one short of his La Liga rival Lionel Messi''s record tally of five. He is a sure mentor to future football players.', '', NULL, 0, '1484141597.png', '2017-01-11 05:33:17', 1, 1, 'cristiano-ronaldo-cr7-the-new-legend-of-football', NULL),
(576, 'text', 'Influential Young Nigerian', '<p class="MsoNormal">Zuriel Elise Oduwole is a 12yr old Nigerian girl, born in\r\nLos Angeles, U.S to a Nigerian father and a Mauritian mother. Her commitment is\r\nto rebrand Africa by showing the positive things in and about the continent,\r\nmaking the case for education of the Girl Child in Africa. She has made history\r\nas the youngest person to be interviewed by the global iconic magazine, Forbes,\r\nfeatured in the 2013 August edition of Forbes Africa.<o:p></o:p></p><p class="MsoNormal">Zuriel is an education advocate and film maker best known\r\nfor her works on the advocacy for the education of girls in Africa. In 2013,\r\nshe was listed in the New African Magazine’s list of “100 Most Influential\r\nPeople in Africa.”<o:p></o:p></p><p>\r\n\r\n\r\n\r\n</p><p class="MsoNormal">At age 12, in November 2014, Zuriel became the world''s\r\nyoungest filmmaker to have a self-produced and self-edited work after her film\r\nshowed in two movie chains and screened in Ghana, South Africa, Japan and\r\nEngland. She has met with 23 Presidents and Prime Ministers. These include\r\nleaders of Jamaica, Nigeria, Kenya, Tanzania, Malawi, Liberia, South Sudan, Malta,\r\nSt. Vincent & the Grenadines, Guyana and Namibia. She has also appeared in\r\npopular television stations including CNBC, Bloomberg TV, BBC and CNN. In 2013,\r\nOduwole was listed in the New African Magazine''s list of "100 Most Influential\r\nPeople in Africa”.  She has interviewed,\r\nin her pursuit of more knowledge, leading African businessmen such as Aliko\r\nDangote - Africa’s richest person, eight current African Presidents, and sports\r\npersonalities and Tennis super stars – Venus and Serena Williams.<o:p></o:p></p>', '', NULL, 0, '1484300199.png', '2017-01-13 01:36:39', 1, 1, 'influential-young-nigerian', NULL),
(577, 'text', 'Brain Teaser', '<div>What is greater than God,</div><div>more evil than the devil,</div><div>the poor have it,</div><div>the rich need it,</div><div>and if you eat it, you''ll die?</div>', '', NULL, 0, '1484307610.png', '2017-01-13 03:40:10', 1, 1, 'brain-teaser', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE IF NOT EXISTS `posts_tags` (
  `postid` int(11) NOT NULL,
  `tagid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`postid`, `tagid`) VALUES
(560, 463),
(560, 464),
(560, 465),
(560, 466),
(560, 467),
(560, 468),
(561, 469),
(561, 470),
(561, 471),
(561, 472),
(562, 473),
(562, 474),
(562, 475),
(563, 476),
(563, 477),
(563, 478),
(563, 479),
(565, 480),
(565, 481),
(565, 482),
(566, 483),
(566, 484),
(566, 485),
(567, 486),
(567, 487),
(567, 488),
(568, 489),
(568, 490),
(568, 491),
(568, 492),
(569, 493),
(569, 494),
(569, 495),
(569, 496),
(570, 497),
(570, 498),
(570, 499),
(570, 500),
(570, 497),
(570, 498),
(570, 499),
(570, 500),
(570, 497),
(570, 498),
(570, 499),
(570, 500),
(570, 497),
(570, 498),
(570, 499),
(570, 500),
(571, 501),
(571, 502),
(571, 503),
(571, 469),
(572, 504),
(573, 505),
(573, 505),
(573, 505),
(573, 505),
(573, 505),
(573, 505),
(573, 505),
(574, 506),
(574, 506),
(575, 507),
(575, 507),
(575, 507),
(575, 507),
(575, 507),
(576, 508),
(577, 509),
(577, 509),
(577, 509),
(577, 509),
(577, 509);

-- --------------------------------------------------------

--
-- Table structure for table `posts_views`
--

CREATE TABLE IF NOT EXISTS `posts_views` (
  `view_id` int(11) NOT NULL AUTO_INCREMENT,
  `view_postid` int(11) NOT NULL,
  `view_userid` int(11) NOT NULL,
  PRIMARY KEY (`view_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=887 ;

--
-- Dumping data for table `posts_views`
--

INSERT INTO `posts_views` (`view_id`, `view_postid`, `view_userid`) VALUES
(848, 560, 1),
(849, 570, 1),
(850, 571, 1),
(851, 564, 1),
(852, 567, 1),
(853, 565, 1),
(854, 570, 684),
(855, 566, 684),
(856, 571, 685),
(857, 569, 1),
(858, 569, 687),
(859, 568, 1),
(860, 572, 685),
(861, 572, 688),
(862, 560, 688),
(863, 562, 688),
(864, 572, 689),
(865, 563, 690),
(866, 569, 691),
(867, 572, 691),
(868, 566, 692),
(869, 572, 695),
(870, 571, 695),
(871, 569, 695),
(872, 568, 695),
(873, 567, 695),
(874, 560, 695),
(875, 561, 700),
(876, 572, 700),
(877, 572, 686),
(878, 572, 684),
(879, 572, 1),
(880, 573, 1),
(881, 566, 1),
(882, 563, 1),
(883, 574, 1),
(884, 575, 1),
(885, 576, 1),
(886, 577, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts_votes`
--

CREATE TABLE IF NOT EXISTS `posts_votes` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_postid` int(11) NOT NULL,
  `vote_userid` int(11) NOT NULL,
  `vote_datetime` datetime NOT NULL,
  `upvote` int(11) DEFAULT '0',
  `downvote` int(11) DEFAULT '0',
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=580 ;

--
-- Dumping data for table `posts_votes`
--

INSERT INTO `posts_votes` (`vote_id`, `vote_postid`, `vote_userid`, `vote_datetime`, `upvote`, `downvote`) VALUES
(567, 570, 1, '2016-09-04 23:15:29', 1, 0),
(568, 560, 1, '2016-09-08 05:41:08', 1, 0),
(569, 566, 684, '2016-09-08 22:53:40', 1, 0),
(571, 572, 700, '2016-09-29 12:21:17', 1, 0),
(573, 566, 700, '2016-09-29 12:22:11', 1, 0),
(575, 570, 702, '2017-01-11 09:43:20', 1, 0),
(577, 572, 702, '2017-01-11 09:43:29', 1, 0),
(579, 571, 702, '2017-01-11 09:43:35', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE IF NOT EXISTS `post_comments` (
  `comment_id` int(12) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(11) DEFAULT NULL,
  `posts_id` int(12) NOT NULL,
  `users_id` int(12) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id_report` int(11) NOT NULL AUTO_INCREMENT,
  `posts_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `desc` text NOT NULL,
  `date` datetime NOT NULL,
  `read` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_report`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tag_slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=510 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id_tag`, `tag_name`, `tag_slug`) VALUES
(463, 'Buhari', 'buhari'),
(464, 'politics', 'politics'),
(465, 'president', 'president'),
(466, ' nigeria', 'nigeria'),
(467, 'apc', 'apc'),
(468, 'general', 'general'),
(469, 'ingenius', 'ingenius'),
(470, 'american', 'american'),
(471, 'cross river', 'cross-river'),
(472, 'bassey', 'bassey'),
(473, 'praiz', 'praiz'),
(474, 'music', 'music'),
(475, 'nigeria', 'nigeria'),
(476, 'messi', 'messi'),
(477, 'legend', 'legend'),
(478, 'barcelona', 'barcelona'),
(479, 'millions', 'millions'),
(480, 'African', 'african'),
(481, 'lifestyle', 'lifestyle'),
(482, 'fashion', 'fashion'),
(483, 'yemi', 'yemi'),
(484, 'alade', 'alade'),
(485, 'industry', 'industry'),
(486, 'cars', 'cars'),
(487, 'sports', 'sports'),
(488, 'lykan', 'lykan'),
(489, 'Adaobi', 'adaobi'),
(490, 'novelist', 'novelist'),
(491, 'cia', 'cia'),
(492, 'africa', 'africa'),
(493, 'kelechi', 'kelechi'),
(494, 'millionaire', 'millionaire'),
(495, 'photographers', 'photographers'),
(496, 'obi', 'obi'),
(497, 'mega', 'mega'),
(498, ' structures', 'structures'),
(499, 'Burj Khalifa', 'burj-khalifa'),
(500, 'dubai', 'dubai'),
(501, 'lekki', 'lekki'),
(502, 'ikoyi', 'ikoyi'),
(503, 'bridge', 'bridge'),
(504, 'New Startups', 'new-startups'),
(505, 'Tara Fela- Durotoye', 'tara-fela-durotoye'),
(506, 'Nancy is amazing', 'nancy-is-amazing'),
(507, '#CR7', 'cr7'),
(508, 'zuriel oduwole', 'zuriel-oduwole'),
(509, 'brain teasers', 'brain-teasers');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_facebookid` text,
  `user_twitterid` text,
  `user_twittername` text,
  `user_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_lastname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_website` text,
  `user_twitter` text,
  `user_gplus` text,
  `user_fb` text,
  `user_instagram` text,
  `user_pinterest` text,
  `user_pass` char(64) NOT NULL,
  `user_salt` char(16) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_passrecover` varchar(12) DEFAULT NULL,
  `user_date` datetime NOT NULL,
  `user_level` int(8) NOT NULL DEFAULT '0',
  `user_avatar` varchar(50) DEFAULT NULL,
  `shortbio` text,
  `user_slug` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=703 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_facebookid`, `user_twitterid`, `user_twittername`, `user_name`, `user_lastname`, `user_website`, `user_twitter`, `user_gplus`, `user_fb`, `user_instagram`, `user_pinterest`, `user_pass`, `user_salt`, `user_email`, `user_passrecover`, `user_date`, `user_level`, `user_avatar`, `shortbio`, `user_slug`) VALUES
(1, NULL, NULL, NULL, 'Termii', 'Support', 'http://localhost/ingenius/', 'test1', 'test2', 'test3', 'test4', 'test5', 'b570192a75981f5a9679661090af2895181fb5c5787745b09cea4406b3ef6441', '4ac590667ee884d3', 'support@termii.com', '5plyWkimoNwL', '2016-09-04 18:57:50', 1, '1473008209_termii', 'Termii is a pan-African web-technology company focused at helping businesses increase their earning power by leveraging on modern Web Technologies', 'termii'),
(683, NULL, NULL, NULL, 'Gbolade', 'Emmanuel', NULL, NULL, NULL, NULL, NULL, NULL, '97c2c78a2d0e1da13f55906b87727351a82eb61d4523005eca5f4d13cc3d6bfb', '53d241fe604e4d51', 'gbolademmanuel@gmail.com', 'tzqn4Tf1Kp5r', '2016-09-04 18:41:40', 1, NULL, NULL, 'gbolade'),
(684, '10208911446536628', NULL, NULL, 'Gbolade Emmanuel Tolulope', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'fienz_e@yahoo.com', NULL, '2016-09-07 13:22:01', 0, NULL, NULL, '1ec4934cf8811a6b8fafd61b42b199db0a3d664d'),
(685, NULL, NULL, NULL, 'Oreoluwa', 'Ogundipe', '', '', '', '', '', '', '88e5d9b585f2f10770aeb9c9790222fa2460e6bb3872119a7f02060fb62ce054', '1d7425772c8201d0', 'litwit2012@gmail.com', '', '2016-09-29 16:34:20', 1, '1475192060_ore_ogundipe', '', 'ore_ogundipe'),
(686, NULL, NULL, NULL, 'David', 'Amobi', NULL, NULL, NULL, NULL, NULL, NULL, 'dc7461aa6af5610e6a15df68aec48896289a476cb5d8e87c0eb4f3f94652d8a4', '34ce5a003622a087', 'gbolademmanuel@goldinwoodevents.com', NULL, '2016-09-27 05:53:42', 0, NULL, NULL, 'amobi'),
(687, NULL, NULL, NULL, 'Opemipo', 'Leyimu', NULL, NULL, NULL, NULL, NULL, NULL, '9c6d4ffa67881f6b3f878302959a8b5fbb3044679f0618470f3caab95d0a27f4', '1fdc469c7ebcb609', 'leyimu.el@gmail.com', NULL, '2016-09-27 07:26:30', 0, NULL, NULL, 'leyimuelgmailcom'),
(688, NULL, NULL, NULL, 'Folarin', 'Ajayi', NULL, NULL, NULL, NULL, NULL, NULL, '545a77d33bb51e0ad9782ba83de4ee3f636e22ca7266bcfdbaa79142dbd3d51f', '6a661a41e03812f', 'folarinajayi@yahoo.com', NULL, '2016-09-27 19:16:58', 0, NULL, NULL, 'folarin_a'),
(689, NULL, NULL, NULL, 'Anukam', 'Victor', NULL, NULL, NULL, NULL, NULL, NULL, '36aa97d13899af9aff8b631e5691e68486070cffaaf27b629bdd2f61bddb2a9c', '37be33716a5aa1a5', 'anukamvictor@gmail.com', NULL, '2016-09-28 00:37:32', 0, NULL, NULL, 'anukamvictor'),
(690, NULL, NULL, NULL, 'Samson', 'Adeniranye', NULL, NULL, NULL, NULL, NULL, NULL, '8311ab8978cff90aa86a228514a3b87294dfcc35c47731b6283f4127cb698314', '5a9c587639eee021', 'talldreamdesigns@gmail.com', NULL, '2016-09-28 01:41:47', 0, NULL, NULL, 'talldreamdesigns'),
(691, NULL, NULL, NULL, 'Peace', 'Ezenwafor', NULL, NULL, NULL, NULL, NULL, NULL, '7eaaf4c2e5b6edfe85364ccb014f23a368ae5de3e4da3ec20367d577cb4e586e', '3db020623bffa750', 'pezenwafor@gmail.com', NULL, '2016-09-28 02:51:50', 0, NULL, NULL, 'scholarpeace'),
(692, NULL, NULL, NULL, 'Olushola', 'Tash', NULL, NULL, NULL, NULL, NULL, NULL, 'c7789b56ae91a0d85d3c24103fd208bc1683b7edf6659bbea5c612456357c0d0', '7c3ddb1ddeb9dee', 'talabiolusholasulaimon@yahoo.com', NULL, '2016-09-28 03:33:47', 0, NULL, NULL, 'tash'),
(693, NULL, NULL, NULL, 'Steve', 'Dubs', NULL, NULL, NULL, NULL, NULL, NULL, '0bbf400e8e1b062e70abb1151b3a77bc6f4725ccdaeada0370376c547f4bd512', '13a26ff846cd200b', 'stevedubs@live.com', NULL, '2016-09-28 06:17:26', 0, NULL, NULL, 'stevedubs'),
(694, NULL, NULL, NULL, 'Rosemary', 'Ojeah', NULL, NULL, NULL, NULL, NULL, NULL, '2a8087778f8d8503024c799c0d52b05fee0677e8de4358efbb755918c737d8ec', '7413006b49bc082c', 'ojeahroseifeyinwa@gmail.com', NULL, '2016-09-28 08:44:42', 0, NULL, NULL, 'ojeahroseifeyinwagmailcom'),
(695, NULL, NULL, NULL, 'Tobi', 'Ibidapo', NULL, NULL, NULL, NULL, NULL, NULL, 'a8a6bfcd0b126e5d00fedcb626887c982e87abd3eaeefa56e7bf8adfda355b89', '3cffe937342ab6ff', 'tobiibidapo@yahoo.com', NULL, '2016-09-28 22:23:49', 0, NULL, NULL, 'tobs16'),
(696, NULL, NULL, NULL, 'Ifeoluwadayo', 'Adepoju', NULL, NULL, NULL, NULL, NULL, NULL, 'ca4a4b552fe3ace181826af6d5b56076f99cf6c16f8c062fe746ec98ce534aa8', 'c7199af6bb58fc4', 'olorunlobaa@gmail.com', NULL, '2016-09-29 00:24:53', 0, NULL, NULL, 'engr-ife'),
(697, NULL, NULL, NULL, 'Adeniyi', 'ADEYEMO', NULL, NULL, NULL, NULL, NULL, NULL, '9a554f57fb3adb42c172f9f52bfd3e847723b15ce317709feeb197592b7c7f3b', '19f376bb20d780f7', 'impactsworld01@gmail.com', NULL, '2016-09-29 00:31:30', 0, NULL, NULL, 'deniyiimpacted'),
(698, NULL, NULL, NULL, 'Isaac', 'Oni', NULL, NULL, NULL, NULL, NULL, NULL, '75ee18343ee64fab5e01a7038d5fa4f7c9c9f4ef109367e01020133ecc2e76ed', '3faee795249108b1', 'oniisaac@gmail.com', NULL, '2016-09-29 00:41:21', 0, NULL, NULL, 'oniisaac'),
(699, NULL, NULL, NULL, 'Tobi', 'Ampitan', NULL, NULL, NULL, NULL, NULL, NULL, '7df54384f59609f5b2428caa2a320fac1aa25e020189964d14fc907de98ffb86', '37c889162fed41f5', 'freakstoluv@yahoo.com', NULL, '2016-09-29 03:59:40', 0, NULL, NULL, 'tobisage'),
(700, NULL, NULL, NULL, 'Abisola', 'Aboaba', NULL, NULL, NULL, NULL, NULL, NULL, '8637a376d295484ac4ccd48d34a1aa77c9c664e30ed1aa3c2729c736b5467f4b', '16fb6b4227fcbe07', 'aboabaabisola@ymail.com', NULL, '2016-09-29 12:20:40', 0, NULL, NULL, 'abisola'),
(701, NULL, NULL, NULL, 'jide', 'oyewunmi', NULL, NULL, NULL, NULL, NULL, NULL, '17101274544bc6b3483934939242663ff15e2013a78c60588d907276a4a1693e', '3a56f6f541b7fe4', 'jamesododo@termii.com', NULL, '2016-12-13 15:50:59', 0, NULL, NULL, 'jide'),
(702, NULL, NULL, NULL, 'EMEM', 'AKPAN', NULL, NULL, NULL, NULL, NULL, NULL, '7af867a61d501e047de484f8e51d827e245838a9096ca56d91a2ba25480c406f', '1830b8076cf9ffde', 'aemem10@gmail.com', NULL, '2017-01-11 09:43:04', 0, NULL, NULL, 'aemem10gmailcom');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
