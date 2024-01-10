-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 04:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retroarc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consoles`
--

CREATE TABLE `consoles` (
  `id` int(11) NOT NULL,
  `console` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consoles`
--

INSERT INTO `consoles` (`id`, `console`) VALUES
(1, 'nintendo'),
(2, 'playstation'),
(3, 'sega');

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE `orderproducts` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderproducts`
--

INSERT INTO `orderproducts` (`id`, `orderId`, `productId`, `quantity`) VALUES
(18, 21, 18, 1),
(20, 22, 22, 1),
(22, 23, 30, 1),
(23, 24, 42, 1),
(24, 24, 44, 1),
(25, 25, 1, 2),
(26, 25, 30, 1),
(27, 26, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `orderDate` datetime NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `statusId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `orderDate`, `totalPrice`, `statusId`) VALUES
(21, 3, '2023-12-27 10:21:40', 100.00, 1),
(22, 3, '2023-12-27 10:23:13', 103.00, 1),
(23, 3, '2023-12-27 10:30:08', 50.00, 1),
(24, 3, '2023-12-27 10:35:16', 95.00, 1),
(25, 3, '2024-01-01 13:08:33', 250.00, 1),
(26, 3, '2024-01-01 13:55:50', 1995.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `typeId` int(11) NOT NULL,
  `consoleId` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productImage` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `productName`, `description`, `typeId`, `consoleId`, `price`, `quantity`, `productImage`) VALUES
(1, 'Nintendo DS', 'Experience innovative gaming with the Nintendo DS, a dual-screen handheld console that redefined portable play. With its two bright LCD screens, one of which is a touch-sensitive display, the DS offers an interactive gaming experience like no other. It boasts a built-in microphone for voice recognition, wireless connectivity for multiplayer adventures, and backward compatibility with Game Boy Advance titles. Dive into a vast library of games, from adventure and action to puzzles and RPGs, and enjoy gaming on the go with the Nintendo DS!', 2, 1, 100.00, 15, 'assets/images/consolesNintendo/ds.png'),
(2, 'Nintendo GameCube', 'Rediscover classic gaming with the Nintendo GameCube, known for its distinctive cube-shaped design and robust game library. This console delivers a powerful gaming experience with its impressive graphics and processing capabilities. With a variety of genres including unforgettable titles in action, adventure, sports, and more, the GameCube offers something for everyone. Its unique controller design and four-player multiplayer support make it a favorite for group gaming sessions. Relive the excitement or discover it anew with the Nintendo GameCube!', 2, 1, 200.00, 7, 'assets/images/consolesNintendo/gamecube.png'),
(3, 'Nintendo Wii', 'Step into the world of interactive gaming with the Nintendo Wii. This groundbreaking console introduced motion-controlled gaming to the masses, using the innovative Wii Remote. With a focus on family-friendly fun and a wide range of games, the Wii offers an engaging experience for all ages. Its ability to track player movements brings a new level of immersion to gaming. From sports simulations to adventure games, the Wii\'s diverse library has something to captivate every type of gamer. Get active and get gaming with the Nintendo Wii!', 2, 1, 75.00, 23, 'assets/images/consolesNintendo/wii.png'),
(4, 'Wii U', 'Explore the unique dual-screen experience with the Nintendo Wii U. This innovative console combines a traditional home gaming system with the added bonus of a touchscreen-equipped GamePad controller. The Wii U allows for seamless play on your TV or on the GamePad, providing a flexible gaming experience. Its HD graphics and expansive game library, including many Nintendo classics and new titles alike, ensure hours of entertainment. With features like off-TV play and Miiverse, the Wii U stands out as a versatile and social gaming hub.', 2, 1, 125.00, 14, 'assets/images/consolesNintendo/wiiU.png'),
(5, 'Nintendo 64 (N64)', 'Step back into the golden age of 3D gaming with the Nintendo 64. This legendary console brought some of the most influential games to life with its advanced graphics and innovative analog control stick. Experience groundbreaking titles in genres ranging from action and adventure to racing and platforming. The N64\'s four controller ports make it a perfect choice for multiplayer fun, creating unforgettable gaming moments. Rediscover the charm of the 90s with the Nintendo 64!', 2, 1, 399.00, 7, 'assets/images/consolesNintendo/n64.png'),
(6, 'Game Boy Advance', 'Take your gaming adventures on the road with the Game Boy Advance. This compact handheld console offers a rich gaming experience with a wide array of titles spanning multiple genres. Its horizontal design and comfortable controls provide an optimal gaming experience. Enjoy classics from the NES, SNES, and even original Game Boy titles through backward compatibility. Whether you’re a fan of RPGs, platformers, or puzzle games, the Game Boy Advance is your gateway to handheld gaming excellence.', 2, 1, 237.00, 11, 'assets/images/consolesNintendo/gba.png'),
(7, 'PlayStation 1 (PS1)', 'Embark on a journey back to where it all began with the PlayStation 1. This iconic console revolutionized the gaming world with its advanced 3D graphics and a vast library of games spanning various genres. From groundbreaking RPGs to thrilling action titles, the PS1 set the stage for modern gaming. Its sleek design and user-friendly interface offer a nostalgic yet timeless gaming experience. Rediscover the classics or explore them for the first time with the PlayStation 1, a true pioneer in the gaming industry.', 2, 2, 120.00, 20, 'assets/images/consolesPlaystation/ps1.png'),
(8, 'PlayStation 2 (PS2)', 'Experience gaming history with the PlayStation 2, the best-selling console of its era. Known for its immense game library and backward compatibility with PS1 titles, the PS2 offers endless entertainment. From genre-defining RPGs to captivating action-adventure games, the PS2 has something for every gamer. Its powerful hardware and DVD playback capability make it a versatile addition to any entertainment setup. Dive into the world of PlayStation 2 and enjoy gaming at its finest.', 2, 2, 75.00, 17, 'assets/images/consolesPlaystation/ps2.png'),
(9, 'PlayStation 3 (PS3)', 'Step into the world of high-definition gaming with the PlayStation 3. This powerful console not only offers a top-notch gaming experience with its robust library of games but also serves as a complete media center with Blu-ray playback, streaming capabilities, and more. The PS3 introduced the PlayStation Network, providing online gaming and digital content services. With its cutting-edge graphics and innovative features like the PlayStation Move, the PS3 continues to be a favorite among gamers seeking a rich and immersive experience.', 2, 2, 150.00, 32, 'assets/images/consolesPlaystation/ps3.png'),
(10, 'PlayStation Portable (PSP)', 'Take the power of PlayStation with you wherever you go with the PlayStation Portable. This sleek handheld console offers a high-quality gaming experience with an impressive lineup of games, including many PlayStation classics. Its wide, high-resolution screen delivers vibrant graphics, while the multimedia capabilities allow for music and video playback. The PSP’s Wi-Fi connectivity enables multiplayer gaming and content downloading, making it a versatile device for both gaming and entertainment on the move.', 2, 2, 99.00, 15, 'assets/images/consolesPlaystation/psp.png'),
(11, 'PlayStation Vita (PS Vita)', 'Discover the advanced world of handheld gaming with the PlayStation Vita. Featuring a stunning OLED touchscreen, dual analog sticks, and powerful hardware, the PS Vita brings a near-console-level gaming experience to the palm of your hand. It boasts a diverse game library, remote play with the PS4, and various apps for extra functionality. The PS Vita\'s social connectivity features, including near and Party, enhance your gaming experience, making it a must-have for dedicated gamers on the go.', 2, 2, 400.00, 5, 'assets/images/consolesPlaystation/psVita.png'),
(12, 'Sega Genesis', 'Relive the era of 16-bit gaming with the Sega Genesis, a console that defined a generation of gameplay. Known for its bold graphics and an impressive lineup of arcade-quality games, the Genesis brought home the arcade experience. Its library features iconic titles in action, platforming, sports, and more, including the famed Sonic the Hedgehog series. With its distinctive controller and classic design, the Sega Genesis offers a nostalgic trip down memory lane, making it a must-have for retro gaming enthusiasts.', 2, 3, 299.00, 8, 'assets/images/consolesSega/gen.png'),
(13, 'Sega Saturn', 'Step into the world of 32-bit gaming with the Sega Saturn. This console, known for its advanced graphics and processing power, offered a new level of immersive gameplay. With a strong focus on arcade-style gaming and an impressive array of titles in fighting, racing, and adventure genres, the Saturn provided a unique gaming experience. Its dual-CPU architecture and polygonal capabilities made it a haven for 3D gaming enthusiasts. The Sega Saturn remains a cult favorite, cherished for its rich library and innovative hardware.', 2, 3, 185.00, 7, 'assets/images/consolesSega/sat.png'),
(14, 'Sega Dreamcast', 'Experience the innovative Dreamcast, Sega\'s final and perhaps most forward-thinking console. Known for its groundbreaking graphics and Internet connectivity, the Dreamcast was the first console to include a built-in modem for online play. Its diverse game library features a mix of arcade hits, unique indie titles, and genre-defining games that pushed the boundaries of console gaming. The Dreamcast\'s iconic controller, with its VMU (Visual Memory Unit) for second-screen experiences, adds to its charm. For gamers seeking a blend of classic and innovative, the Dreamcast stands out as a memorable piece of gaming history.', 2, 3, 450.00, 27, 'assets/images/consolesSega/dream.png'),
(15, 'DualShock Controller (PS2)', 'The DualShock Controller revolutionized the PlayStation gaming experience with its advanced vibration feedback and dual analog sticks. Designed for the PlayStation 1, 2, and 3, this controller offers an ergonomic grip, responsive buttons, and precise control, enhancing gameplay in every genre. Its rumble feature brings games to life, providing a more immersive experience. The DualShock is an essential accessory for any PlayStation enthusiast seeking a deeper connection to their games.', 1, 2, 50.00, 15, 'assets/images/accPlaystation/controller.png'),
(16, 'PlayStation Memory Card (PS1)', 'The PlayStation Memory Card is a must-have accessory for saving game progress on the PS1. These compact cards, available in various storage capacities, slot easily into the console, offering a reliable way to store game saves, characters, and levels. Essential for gamers who want to track their progress in long RPGs or complex strategy games, these memory cards are the cornerstone of the PlayStation gaming experience.', 1, 2, 25.00, 20, 'assets/images/accPlaystation/memoryCard.png'),
(17, 'PlayStation Eye', 'The PlayStation 3 Camera, also known as the PlayStation Eye, is an essential accessory for PS3 owners looking to expand their gaming and interactive experiences. This advanced camera features a sophisticated microphone with noise reduction capabilities, ensuring clear voice commands and communication during gameplay. It\'s capable of capturing video at a high frame rate, which is perfect for motion-based games when used in conjunction with the PlayStation Move controller. The camera also facilitates facial recognition and head tracking for certain games, providing an immersive and interactive gaming experience. Its versatility extends beyond gaming, as it can be used for video chatting with friends and family. The PS3 Camera is a gateway to a range of fun and innovative gaming experiences, making it a must-have for any PlayStation 3 enthusiast.', 1, 2, 30.00, 10, 'assets/images/accPlaystation/camera.png'),
(18, 'Wii Balance Board', 'The Wii Balance Board is an innovative accessory for the Nintendo Wii, opening a world of fitness and balance games. With its pressure-sensitive technology, it accurately captures your movements, making games like \'Wii Fit\' not only fun but also a tool for physical activity. It\'s a unique blend of gaming and exercise, perfect for those looking to add a healthy twist to their gaming routine.', 1, 1, 100.00, 10, 'assets/images/accNintendo/board.png'),
(19, 'GameCube Controller', 'The GameCube Controller is celebrated for its comfortable design and versatility. Compatible with the GameCube, Wii, and Wii U consoles, it is particularly famous among \'Super Smash Bros.\' players for its intuitive layout and responsive controls. This controller is a favorite for its durability and the nostalgic gaming experience it provides.', 1, 1, 110.00, 3, 'assets/images/accNintendo/controller.png'),
(20, 'Game Boy Advance Link Cable', 'The Game Boy Advance Link Cable is a simple yet essential accessory for multiplayer gaming. It connects multiple Game Boy Advance systems, allowing players to compete or collaborate in a wide range of games. It can also be used to connect a Game Boy Advance to a GameCube, unlocking special features in certain games.', 1, 1, 15.00, 20, 'assets/images/accNintendo/cable.png'),
(21, 'Sega Genesis 6-Button Controller', 'An upgrade from the original controller, the Sega Genesis 6-Button Controller is ideal for games that require quick reflexes and more complex inputs, like fighting games. Its additional buttons and ergonomic design make it a favorite among gamers for its improved functionality and comfortable gaming sessions.', 1, 3, 145.00, 8, 'assets/images/accSega/controller.png'),
(22, 'Dreamcast VMU (Visual Memory Unit)', 'The VMU for the Dreamcast is not just a memory card; it\'s an innovation. With its built-in screen, it displays game information and can be used to play mini-games. It adds a unique, portable aspect to gaming, allowing players to take a piece of their game with them wherever they go.', 1, 3, 103.00, 9, 'assets/images/accSega/vmu.png'),
(23, 'Dreamcast Broadband Adapter', 'The Dreamcast Broadband Adapter is a rare and sought-after accessory that enables high-speed internet connectivity for the console. This adapter enhances the online gaming experience, allowing for smoother and faster gameplay in online multiplayer games and access to online features.', 1, 3, 65.00, 17, 'assets/images/accSega/adapter.png'),
(24, 'Sonic the Hedgehog', 'Sonic the Hedgehog is an iconic platformer that introduced Sega\'s most famous character, Sonic. Players race at breakneck speeds across various levels, collecting rings and battling the evil Dr. Robotnik. Its fast-paced gameplay, vibrant graphics, and memorable music made it a defining game of the 16-bit era.', 3, 3, 25.00, 5, 'assets/images/gamesSega/sonic.jpg'),
(25, 'Streets of Rage 2', 'Streets of Rage 2 is a beloved beat \'em up game known for its engaging cooperative gameplay and stylish graphics. Players choose from several characters to take on the crime syndicate that\'s taken over the city, using a variety of moves and weapons. Its catchy soundtrack and smooth gameplay make it a standout title on the Genesis.', 3, 3, 30.00, 10, 'assets/images/gamesSega/streets.jpg'),
(26, 'Virtua Fighter 2', 'Virtua Fighter 2 is a groundbreaking 3D fighting game that showcases the Saturn\'s graphical capabilities. With a roster of unique characters, each with their own fighting style, it offers a deep and strategic combat system. Its fluid animation and responsive controls provide a compelling and competitive gaming experience.', 3, 3, 100.00, 2, 'assets/images/gamesSega/virtua.jpg'),
(27, 'Panzer Dragoon', 'Panzer Dragoon is a rail shooter set in a fantastical world with impressive 3D environments. Players control a dragon rider, battling enemies in the air and on the ground. Its cinematic presentation, atmospheric soundtrack, and unique art style create a truly immersive experience.', 3, 3, 65.00, 7, 'assets/images/gamesSega/panzer.jpg'),
(28, 'Shenmue', 'Shenmue is an ambitious action-adventure game known for its detailed open world, deep storytelling, and interactive environments. Players explore the world as Ryo Hazuki, a young man on a quest for revenge. Its blend of RPG elements, brawler combat, and life simulation aspects make it a unique and memorable title', 3, 3, 150.00, 10, 'assets/images/gamesSega/shenmue.jpg'),
(29, 'Soulcalibur', 'Soulcalibur is a critically acclaimed fighting game noted for its fluid combat, stunning graphics, and diverse character roster. Each character wields a unique weapon, adding depth and strategy to the battles. The game\'s balance, accessibility, and detailed stages set a new standard for the fighting genre.', 3, 3, 250.00, 3, 'assets/images/gamesSega/soul.jpg'),
(30, 'Attack on Titan', 'Based on the popular anime and manga series, \'Attack on Titan\' for the PS Vita lets players experience the intense action and drama of battling against the Titans. The game captures the show\'s fast-paced combat and vertical maneuvering, allowing players to strategize and execute aerial attacks. It\'s a thrilling adaptation that immerses fans in the desperate struggle for humanity\'s survival.', 3, 2, 50.00, 14, 'assets/images/gamesPlaystation/Aot.jpg'),
(31, 'Dino Crisis', 'Dino Crisis is a survival horror game from the creators of Resident Evil. Set on a remote island, players must navigate through facilities overrun by dinosaurs, combining action and puzzle-solving elements. Its tense atmosphere and unique setting distinguish it from other horror games of its era, making it a classic on the PS1.', 3, 2, 75.00, 5, 'assets/images/gamesPlaystation/DinoCrisis.jpg'),
(32, 'LittleBigPlanet', 'LittleBigPlanet on the PSP brings the imaginative world of Sackboy to handheld gaming. This platformer allows players to create, play, and share their own levels, utilizing the game\'s robust level editor. Its charming graphics, inventive gameplay, and strong community focus make it a standout title for the PSP.', 3, 2, 40.00, 20, 'assets/images/gamesPlaystation/lbp.png'),
(33, 'Resident Evil 2', 'Resident Evil 2 is a landmark in the survival horror genre. Set in the zombie-infested Raccoon City, players choose between Leon S. Kennedy and Claire Redfield as they uncover the sinister Umbrella Corporation\'s secrets. Its gripping narrative, atmospheric setting, and improved gameplay mechanics over its predecessor make it a beloved classic.', 3, 2, 115.00, 7, 'assets/images/gamesPlaystation/RE2.png'),
(34, 'Resident Evil 3: Nemesis', 'In Resident Evil 3: Nemesis, players return to Raccoon City, this time controlling Jill Valentine as she attempts to escape the zombie outbreak. The game introduces the fearsome Nemesis, a relentless enemy that pursues the player throughout the game, adding a constant sense of danger and urgency to the survival horror experience.', 3, 2, 100.00, 7, 'assets/images/gamesPlaystation/RE3.jpg'),
(35, 'Resident Evil 5', 'Resident Evil 5 brings cooperative gameplay to the series, set in a sun-drenched African setting. Players take on the roles of Chris Redfield and Sheva Alomar as they investigate a biological threat. The game combines action-heavy gameplay with the series\' signature survival horror elements, offering both single-player and co-op modes.', 3, 2, 25.00, 15, 'assets/images/gamesPlaystation/RE5.jpg'),
(36, 'Resident Evil 6', 'Resident Evil 6 presents multiple interwoven storylines, featuring characters like Leon S. Kennedy and Chris Redfield. This installment ramps up the action, offering a blend of horror, exploration, and combat with a cinematic narrative. It\'s known for its diverse play styles and extensive co-op multiplayer options.', 3, 2, 15.00, 6, 'assets/images/gamesPlaystation/RE6.jpg'),
(37, 'Silent Hill 1', 'Silent Hill is a psychological horror game that pioneered the genre. Players explore the eerie town of Silent Hill, unraveling a story filled with twists and turns. Known for its atmospheric fog, unsettling soundtrack, and psychologically deep narrative, Silent Hill offers a profoundly disturbing horror experience.', 3, 2, 110.00, 5, 'assets/images/gamesPlaystation/SH.png'),
(38, 'Silent Hill 2', 'Silent Hill 2 is a masterful exploration of psychological horror. Players delve into the troubled mind of James Sunderland, who is drawn to Silent Hill by a letter from his deceased wife. The game is celebrated for its deep, emotional narrative, haunting environments, and symbolic enemy design, making it a high point in the series.', 3, 2, 225.00, 10, 'assets/images/gamesPlaystation/SH2.jpg'),
(39, 'Silent Hill 3', 'In Silent Hill 3, players follow Heather, a young woman drawn into the terrifying world of Silent Hill. The game builds on its predecessors with more detailed graphics, a chilling soundtrack, and a storyline that ties back to the original game. Its intense, atmospheric gameplay and disturbing visuals continue the series\' legacy as a pinnacle of horror gaming.', 3, 2, 200.00, 14, 'assets/images/gamesPlaystation/SH3.png'),
(40, 'Tekken 5: Dark Resurrection', 'Tekken 5: Dark Resurrection on the PSP brings the celebrated fighting game to handheld devices. This version includes all the content from the original Tekken 5 and adds new characters and stages. Known for its fluid combat, extensive character roster, and stunning visuals, it offers a premier fighting experience on the go.', 3, 2, 60.00, 12, 'assets/images/gamesPlaystation/tekken5.jpg'),
(41, 'Ace Attorney Investigations: Miles Edgeworth', 'Ace Attorney Investigations: Miles Edgeworth puts players in the shoes of the charismatic prosecutor Miles Edgeworth. Unlike the courtroom battles of the main series, this game focuses on crime scene investigations and logic-based puzzles. It combines the series\' trademark witty dialogue and intriguing storytelling with a fresh gameplay style, making it a must-play for fans of the Ace Attorney series.', 3, 1, 25.00, 9, 'assets/images/gamesNintendo/AA.jpg'),
(42, 'Buffy the Vampire Slayer: Chaos Bleeds', 'In \'Buffy the Vampire Slayer: Chaos Bleeds,\' players get to experience the supernatural world of the popular TV series. This action-adventure game lets players control Buffy and other characters from the show, each with unique abilities, as they battle against vampires and demons. With its engaging combat system and faithful recreation of the Buffy universe, this game is a treat for fans of the series.', 3, 1, 45.00, 15, 'assets/images/gamesNintendo/Buffy.png'),
(43, 'Crash Nitro Kart', 'Crash Nitro Kart takes the wacky racing action of the Crash Bandicoot series to the GameCube. Players can choose from a variety of characters from the Crash universe and race across creatively designed tracks, using power-ups to gain an advantage. The game features both a compelling single-player adventure and fun multiplayer modes, making it a great pick for racing fans.', 3, 1, 30.00, 10, 'assets/images/gamesNintendo/Crash.png'),
(44, 'Resident Evil Code: Veronica X', 'This survival horror classic, Resident Evil Code: Veronica X, tells the story of Claire Redfield\'s search for her brother, Chris. Enhanced for the GameCube, it combines traditional Resident Evil gameplay with improved graphics and an extended storyline. Its atmospheric setting, challenging puzzles, and intense action sequences make it a standout title in the series.', 3, 1, 50.00, 18, 'assets/images/gamesNintendo/CVX.png'),
(45, 'Ju-On: The Grudge ', 'Ju-On: The Grudge is a horror game based on the popular Japanese film series. Designed as a haunted house simulator, the game uses the Wii\'s motion controls to navigate through eerie environments filled with frights. It\'s known for its chilling atmosphere and jump scares, making it a thrilling experience for horror enthusiasts.', 3, 1, 10.00, 4, 'assets/images/gamesNintendo/Ju.png'),
(46, 'Mario Kart 64', 'Mario Kart 64 brings the beloved Mario Kart series to life in 3D. This classic racing game features iconic Nintendo characters, imaginative tracks, and a variety of power-ups. With its engaging multiplayer mode and challenging time trials, Mario Kart 64 remains a favorite for competitive racing and casual fun alike.', 3, 1, 300.00, 5, 'assets/images/gamesNintendo/marioKart.jpg'),
(47, 'Pokémon Red', 'Pokémon Red is where the worldwide phenomenon began. Players embark on a journey to become the Pokémon Champion, capturing and training Pokémon to battle other trainers. Its simple yet deep gameplay, combined with the challenge of collecting all the Pokémon, has made it an enduring classic.', 3, 1, 599.00, 1, 'assets/images/gamesNintendo/pokemon.jpg'),
(48, 'Pokémon Pearl', 'Set in the diverse region of Sinnoh, Pokémon Pearl offers a rich Pokémon experience with new species to catch and train. The game introduces new gameplay elements like the Pokémon Contest and the Underground, adding depth to the series. With its captivating world and strategic battles, Pokémon Pearl continues the tradition of engaging Pokémon adventures.', 3, 1, 50.00, 6, 'assets/images/gamesNintendo/pokemonPearl.jpeg'),
(49, 'Resident Evil', 'The Resident Evil 1 Remake for the Wii revitalizes the original Resident Evil game with enhanced graphics, updated controls, and new gameplay elements. This survival horror classic takes players back to the infamous Spencer Mansion, filled with improved puzzles, terrifying enemies, and an atmosphere dripping with suspense.', 3, 1, 25.00, 10, 'assets/images/gamesNintendo/RE1.png'),
(50, 'SpongeBob SquarePants: Drawn to Life', 'This unique game combines the quirky world of SpongeBob SquarePants with creative gameplay. Players can draw their own characters and gadgets, bringing them to life in the game\'s platforming levels. It\'s a fun and imaginative title that allows players to interact with SpongeBob\'s universe in a whole new way.', 3, 1, 15.00, 5, 'assets/images/gamesNintendo/spongebob.jpg'),
(51, 'Super Mario 64', 'Super Mario 64 is a landmark in 3D platforming, bringing Mario into a fully realized 3D world. Players explore diverse and expansive levels, collecting stars and uncovering secrets. Its innovative controls, charming design, and memorable soundtrack have made it one of the most influential games in history.', 3, 1, 299.00, 3, 'assets/images/gamesNintendo/superMario.png'),
(52, 'Yoshi\'s Story', 'Yoshi\'s Story is a charming platformer for the N64 where players guide Yoshi through a series of colorful, storybook-like worlds. The game emphasizes exploration and collecting fruit over traditional platforming challenges. Its unique visual style, cheerful music, and approachable gameplay make it a delightful experience for players of all ages.', 3, 1, 199.00, 5, 'assets/images/gamesNintendo/Yoshi.jpg'),
(53, 'Resident Evil: Dead Aim', 'Resident Evil: Dead Aim blends first-person shooter action with the classic survival horror elements of the Resident Evil series. Set on a cruise ship and a mysterious island, players assume the role of anti-Umbrella agent Bruce McGivern. This unique installment stands out with its combination of first-person shooting during combat and a third-person perspective for exploration. The story, intertwined with the series\' lore, adds depth and intrigue. Dead Aim\'s graphics showcase detailed environments and suspenseful, atmospheric settings. The game\'s control scheme is designed specifically for gunplay, offering a fresh experience for fans and newcomers alike. Its mix of horror, action, and puzzle-solving ensures a diverse and thrilling gameplay experience. Perfect for fans of the series and those who enjoy action-packed survival horror games.', 3, 2, 35.00, 15, 'assets/images/gamesPlaystation/deadAim.jpg'),
(54, 'Resident Evil: Outbreak File #1', 'Resident Evil: Outbreak File #1 offers a unique and immersive experience in the survival horror genre. This game is notable for its multiplayer functionality, allowing players to experience the horror of a zombie outbreak in Raccoon City collaboratively. Set during the same time as the events of Resident Evil 2 and 3, it offers a fresh perspective with new characters and scenarios. The game features five distinct but interlinked scenarios, each offering different challenges and storylines.\r\n\r\nPlayers can choose from a diverse roster of characters, each with unique abilities and inventory items, adding a strategic layer to the gameplay. The sense of urgency is heightened by the innovative virus gauge, which slowly turns your character into a zombie, adding a race-against-time element to the survival aspect. Outbreak File #1 stands out with its attention to detail in the environment, creating a truly eerie and immersive atmosphere. The game\'s puzzle-solving elements, combined with intense action sequences and a cooperative gameplay experience, make it a must-play for fans of the series and the genre.', 3, 2, 75.00, 12, 'assets/images/gamesPlaystation/outbreak.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`id`, `type`) VALUES
(1, 'accessories'),
(2, 'consoles'),
(3, 'games');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `starRate` int(11) NOT NULL,
  `review` text NOT NULL,
  `reviewDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `userId`, `productId`, `starRate`, `review`, `reviewDate`) VALUES
(1, 1, 1, 4, 'I recently got my hands on the Nintendo DS, and I must say, I\'m thoroughly impressed! The dual screens are a game-changer - the bottom touch screen adds a whole new interactive element to gaming. I\'ve found the stylus to be precise and responsive, making games like \'Brain Age\' and \'The Legend of Zelda: Phantom Hourglass\' super engaging. The ability to play my old Game Boy Advance games is a huge plus, giving this device a vast library of classics to enjoy. The DS\'s battery life is also commendable, lasting me through long commutes. The only downside is the graphics, which aren’t as sharp as some newer handhelds, but the innovative gameplay more than makes up for it. Overall, the Nintendo DS stands out as a remarkable and innovative device in the world of handheld gaming. Highly recommend for both casual and serious gamers!', '2023-12-04 12:25:31'),
(2, 2, 1, 2, 'I recently picked up a Nintendo DS, expecting a lot from the hype, but was left seriously disappointed. The dual-screen felt gimmicky and didn’t add much to the gaming experience for me. I found the touch screen unresponsive at times, which was frustrating during gameplay. The graphics are also quite dated, especially when compared to other handheld consoles available today. While it does have backward compatibility with Game Boy Advance games, I didn’t find this feature particularly redeeming. The build quality also felt a bit cheap and not as sturdy as I would have liked. Battery life was decent, but that\'s the only positive I can find. Overall, I just couldn\'t get into it and regret my purchase. There are definitely better options out there for handheld gaming enthusiasts.', '2023-12-21 12:25:31'),
(5, 3, 44, 5, 'Resident Evil - Code: Veronica X is a masterpiece in the survival horror genre, deserving a solid 5-star rating. This game brilliantly continues the Resident Evil series, bringing the classic horror, puzzle-solving, and intense action that fans love. Its gripping storyline, centered around Claire Redfield\'s search for her brother, is both engaging and emotionally resonant, providing a deep narrative experience. The game\'s transition to fully 3D environments, as opposed to the pre-rendered backdrops of its predecessors, marks a significant technical advancement, enhancing the immersion and realism. The graphics are top-notch for its time, with detailed character models and atmospheric lighting that contribute to a genuinely eerie experience. The gameplay mechanics, including combat and inventory management, are well-executed, offering a challenging yet fair experience. Code: Veronica X also excels in its sound design, with a haunting soundtrack and spot-on sound effects that amplify the tension and horror. Overall, it\'s not just a great Resident Evil game; it\'s a remarkable example of the survival horror genre at its best.', '2023-12-27 18:09:16'),
(7, 3, 1, 5, 'The Nintendo DS is a truly revolutionary handheld gaming system. Its dual-screen setup, with a touch-sensitive lower screen, brings a unique and immersive gaming experience. The extensive game library, featuring titles for all ages and tastes, from action-packed adventures to thoughtful puzzles, ensures endless hours of entertainment. The DS\'s durable design and long battery life make it an ideal companion for travel. The introduction of the stylus and touchscreen gameplay was a game-changer in the industry, encouraging innovative game design and interactive storytelling. The DS\'s backward compatibility with Game Boy Advance games adds incredible value, expanding its gaming repertoire significantly. Moreover, its Wi-Fi capabilities for multiplayer gaming and online connectivity were ahead of its time, promoting a sense of community among gamers. In summary, the Nintendo DS stands out as a milestone in handheld gaming, merging innovative technology with a vast, diverse gaming library, making it a must-have for gamers of all ages.', '2024-01-01 11:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Confirmed'),
(4, 'Delivered'),
(5, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE `town` (
  `id` int(11) NOT NULL,
  `townName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `town`
--

INSERT INTO `town` (`id`, `townName`) VALUES
(1, 'Floriana'),
(2, 'Gzira'),
(3, 'Sliema'),
(4, 'St Julians'),
(5, 'Valletta');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `houseNameNum` varchar(20) NOT NULL,
  `street` varchar(50) NOT NULL,
  `townId` int(11) NOT NULL,
  `postCode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userName`, `password`, `email`, `firstName`, `lastName`, `houseNameNum`, `street`, `townId`, `postCode`) VALUES
(1, 'Drago142', 'Max2201', 'maxVella22@gmail.com', 'Max', 'Vella', '22', 'Triq san Guzepp', 2, 'GZR 1111'),
(2, 'LifeLine19', 'Kyle1919', 'kyleMifsud19@yahoo.com', 'Kyle', 'Mifsud', 'Jesus', 'Triq Fjura', 3, 'SLM 1111'),
(3, 'AngelicDrago', '$2y$10$qPp8C2rWFoqMaOhtuCLDT..ExubOCE7JTz0AonwF4RJ9J.rTqCn1O', 'petersheehan21@gmail.com', 'Peter Martin', 'Sheehen', 'Zachary Str', '31, Flat 1', 5, 'VLT1132'),
(4, 'RyanAir22', '$2y$10$hkgC9oOgBRU3Vzt3oxyDy.5fqLHRR29RU.TbzPxhv8PRYY7jYcM4y', 'ryan22@gmail.com', 'Ryan', 'Agius', '109', 'Triq il-pizza', 3, 'SLM 1112'),
(5, 'RyanAir20', '$2y$10$ZdrQu4ltWAgcIDmxcrOp0eoYPqMOVvl2CXnvoQfCpFzZWr/hjHNHi', 'ryan20@gmail.com', 'Ryan', 'Malia', '80', 'Triq Melita', 1, 'FLR 0345'),
(6, 'RyanAir19', '$2y$10$4gUdXwI.N0cu./XLueeNA.eEe/F3bvMb3DSw3ABFx.GrBeuGbpZLm', 'ryan19@yahoo.com', 'Ryan', 'Micallef', '32', 'Triq il-frotta', 5, 'VLT 1356'),
(7, 'Admin', '$2y$10$sL5pBzRTaE9h9qsMPxjB/eg5ic20fTs0gAlRjk8Ij2TOohq8nMJDq', 'admin@retroarc.com', 'Admin', 'admin', '15', 'Triq il kbira', 3, 'SLM 1152');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `consoles`
--
ALTER TABLE `consoles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `statusId` (`statusId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consoleId` (`consoleId`),
  ADD KEY `typeId` (`typeId`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_ibfk_1` (`townId`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `consoles`
--
ALTER TABLE `consoles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD CONSTRAINT `orderproducts_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderproducts_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`consoleId`) REFERENCES `consoles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`typeId`) REFERENCES `producttype` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`townId`) REFERENCES `town` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
