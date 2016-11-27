-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2016 at 07:04 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
create database drawandguess;

use drawandguess;
--

-- --------------------------------------------------------

--
-- Table structure for table `gamequestions`
--

CREATE TABLE `gamequestions` (
  `QuestionID` char(5) NOT NULL,
  `QuestionContent` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gamequestions`
--

INSERT INTO `gamequestions` (`QuestionID`, `QuestionContent`) VALUES
('0', 'aardvark'),
('1', 'aardwolf'),
('10', 'addax'),
('100', 'angelfish'),
('101', 'anglerfish'),
('102', 'Angora'),
('103', 'angwantibo'),
('104', 'anhinga'),
('105', 'animated'),
('106', 'ankole'),
('107', 'ankole-Watusi'),
('108', 'annas hummingbird'),
('109', 'annelida'),
('11', 'adder'),
('110', 'annelid'),
('111', 'anole'),
('112', 'anopheles'),
('113', 'Antarctic fur seal'),
('114', 'Antarctic giant petrel'),
('115', 'anteater'),
('116', 'antelope'),
('117', 'antelope ground squirrel'),
('118', 'antipodes Green parakeet'),
('119', 'ant'),
('12', 'adelie penguin'),
('120', 'ant bear'),
('121', 'ant lion'),
('122', 'anura'),
('123', 'aoudad'),
('124', 'apatosaur'),
('125', 'ape'),
('126', 'aphid'),
('127', 'apis dorsata laboriosa'),
('128', 'aplomado falcon'),
('129', 'aquatic leech'),
('13', 'admiral'),
('130', 'Arabian horse'),
('131', 'Arabian oryx'),
('132', 'Arabian wild cat'),
('133', 'aracari'),
('134', 'arachnid'),
('135', 'arawana'),
('136', 'archaeocete'),
('137', 'archaeopteryx'),
('138', 'archer fish'),
('139', 'Arctic Fox'),
('14', 'admiral butterfly'),
('140', 'Arctic hare'),
('141', 'Arctic Wolf'),
('142', 'argali'),
('143', 'Argentine horned frog'),
('144', 'Argentine ruddy duck'),
('145', 'Argus fish'),
('146', 'Ariel toucan'),
('147', 'Arizona alligator lizard'),
('148', 'Ark shell'),
('149', 'armadillo'),
('15', 'adouri'),
('150', 'armed crab'),
('151', 'armed nylon shrimp'),
('152', 'army ant'),
('153', 'arrow crab'),
('154', 'arrow worm'),
('155', 'arrowana'),
('156', 'arthropods'),
('157', 'aruanas'),
('158', 'Asian Constable butterfly'),
('159', 'Asian damselfly'),
('16', 'African augur buzzard'),
('160', 'Asian elephant'),
('161', 'Asian lion'),
('162', 'Asian porcupine'),
('163', 'Asian Small-clawed otter'),
('164', 'Asian trumpetfish'),
('165', 'Asian water Buffalo'),
('166', 'Asiatic greater freshwater clam'),
('167', 'Asiatic lesser freshwater clam'),
('168', 'Asiatic mouflon'),
('169', 'Asiatic wild ass'),
('17', 'African Bush viper'),
('170', 'asp'),
('171', 'ass'),
('172', 'assassin bug'),
('173', 'Astarte'),
('174', 'astrangia coral'),
('175', 'Atlantic Black goby'),
('176', 'Atlantic blue tang'),
('177', 'Atlantic ridley turtle'),
('178', 'Atlantic sharpnose puffer'),
('179', 'Atlantic spadefish'),
('18', 'African civet'),
('180', 'Atlas moth'),
('181', 'auk'),
('182', 'auklet'),
('183', 'aurochs'),
('184', 'Australian curlew'),
('185', 'Australian freshwater crocodile'),
('186', 'Australian fur seal'),
('187', 'Australian kestrel'),
('188', 'Australian shelduck'),
('189', 'Australian silky terrier'),
('19', 'African clawed frog'),
('190', 'avocet'),
('191', 'axis deer'),
('192', 'axolotl'),
('193', 'aye-aye'),
('194', 'Aztec ant'),
('195', 'azure-winged magpie'),
('196', 'azure vase'),
('197', 'babirusa'),
('198', 'baboon'),
('199', 'bactrian'),
('2', 'abalone'),
('20', 'African elephant'),
('200', 'badger'),
('201', 'bagworm'),
('202', 'baiji'),
('203', 'bald eagle'),
('204', 'baleen whale'),
('205', 'balloonfish'),
('206', 'bandicoot'),
('207', 'banteng'),
('208', 'barasinga'),
('209', 'barasingha'),
('21', 'African fish eagle'),
('210', 'barb'),
('211', 'barbet'),
('212', 'barnacle'),
('213', 'barracuda'),
('214', 'basilisk'),
('215', 'Bass'),
('216', 'basset hound'),
('217', 'bat'),
('218', 'beagle'),
('219', 'bear'),
('22', 'African Golden cat'),
('220', 'bearded dragon'),
('221', 'beaver'),
('222', 'bee'),
('223', 'beetle'),
('224', 'Bell frog'),
('225', 'beluga whale'),
('226', 'bettong'),
('227', 'big-horned sheep'),
('228', 'bighorn'),
('229', 'bilby'),
('23', 'African ground hornbill'),
('230', 'binturong'),
('231', 'Bird'),
('232', 'Bird of Paradise'),
('233', 'bison'),
('234', 'bittern'),
('235', 'Black bear'),
('236', 'Black fly'),
('237', 'Black panther'),
('238', 'Black rhino'),
('239', 'Black widow spider'),
('24', 'African harrier hawk'),
('240', 'blackbird'),
('241', 'blackbuck'),
('242', 'blesbok'),
('243', 'blowfish'),
('244', 'blue Jay'),
('245', 'blue whale'),
('246', 'bluebird'),
('247', 'bluebottle'),
('248', 'bluefish'),
('249', 'boa'),
('25', 'African hornbill'),
('250', 'boa constrictor'),
('251', 'boar'),
('252', 'bobcat'),
('253', 'bobolink'),
('254', 'bobwhite'),
('255', 'bongo'),
('256', 'booby'),
('257', 'boto'),
('258', 'boubou'),
('259', 'boutu'),
('26', 'African jacana'),
('260', 'bovine'),
('261', 'Brahman bull'),
('262', 'Brahman cow'),
('263', 'Brant'),
('264', 'bream'),
('265', 'brocket deer'),
('266', 'bronco'),
('267', 'brontosaurus'),
('268', 'Brown bear'),
('269', 'bubblefish'),
('27', 'African mole Snake'),
('270', 'Buck'),
('271', 'budgie'),
('272', 'bufeo'),
('273', 'Buffalo'),
('274', 'bufflehead'),
('275', 'bug'),
('276', 'bull mastiff'),
('277', 'bullfrog'),
('278', 'bumblebee'),
('279', 'bunny'),
('28', 'African Paradise flycatcher'),
('280', 'bunting'),
('281', 'burro'),
('282', 'Bush baby'),
('283', 'Bush squeaker'),
('284', 'bustard'),
('285', 'butterfly'),
('286', 'buzzard'),
('287', 'caecilian'),
('288', 'caiman'),
('289', 'caiman lizard'),
('29', 'African pied kingfisher'),
('290', 'calf'),
('291', 'Camel'),
('292', 'canary'),
('293', 'canine'),
('294', 'canvasback'),
('295', 'cape ghost frog'),
('296', 'capybara'),
('297', 'caracal'),
('298', 'cardinal'),
('299', 'caribou'),
('3', 'Abyssinian cat'),
('30', 'African porcupine'),
('300', 'carp'),
('301', 'cassowary'),
('302', 'cat'),
('303', 'catbird'),
('304', 'Caterpillar'),
('305', 'catfish'),
('306', 'cattle'),
('307', 'caudata'),
('308', 'cavy'),
('309', 'centipede'),
('31', 'African Rock Python'),
('310', 'chafer'),
('311', 'chameleon'),
('312', 'chamois'),
('313', 'cheetah'),
('314', 'chevrotain'),
('315', 'chick'),
('316', 'chickadee'),
('317', 'chicken'),
('318', 'Chihuahua'),
('319', 'chimney Swift'),
('32', 'African wild cat'),
('320', 'chimpanzee'),
('321', 'chinchilla'),
('322', 'Chinese crocodile lizard'),
('323', 'chipmunk'),
('324', 'chital'),
('325', 'chrysomelid'),
('326', 'chuckwalla'),
('327', 'chupacabra'),
('328', 'cicada'),
('329', 'cirriped'),
('33', 'African wild dog'),
('330', 'civet'),
('331', 'clam'),
('332', 'cleaner wrasse'),
('333', 'clown anemone fish'),
('334', 'clumber'),
('335', 'coati'),
('336', 'cob'),
('337', 'cobra'),
('338', 'cockatiel'),
('339', 'cockatoo'),
('34', 'agama'),
('340', 'cocker spaniel'),
('341', 'cockroach'),
('342', 'cod'),
('343', 'coelacanth'),
('344', 'collard lizard'),
('345', 'Colt'),
('346', 'comet'),
('347', 'conch'),
('348', 'condor'),
('349', 'coney'),
('35', 'agouta'),
('350', 'conure'),
('351', 'coot'),
('352', 'cooter'),
('353', 'copepod'),
('354', 'copperhead'),
('355', 'coqui'),
('356', 'coral'),
('357', 'cormorant'),
('358', 'corn Snake'),
('359', 'corydoras catfish'),
('36', 'agouti'),
('360', 'cottonmouth'),
('361', 'cottontail'),
('362', 'cougar'),
('363', 'cow'),
('364', 'cowbird'),
('365', 'cowrie'),
('366', 'coyote'),
('367', 'coypu'),
('368', 'crab'),
('369', 'Crane'),
('37', 'Airedale'),
('370', 'crayfish'),
('371', 'cricket'),
('372', 'crocodile'),
('373', 'crocodile skink'),
('374', 'crossbill'),
('375', 'crow'),
('376', 'crown-of-thorns starfish'),
('377', 'crustacean'),
('378', 'cub'),
('379', 'cuckoo'),
('38', 'aisan pied starling'),
('380', 'curassow'),
('381', 'curlew'),
('382', 'cuscus'),
('383', 'cusimanse'),
('384', 'cuttlefish'),
('385', 'dog'),
('386', 'dolphin'),
('387', 'duck'),
('388', 'bald eagle'),
('389', 'Golden eagle'),
('39', 'Akita inu'),
('390', 'egret'),
('391', 'eidolon'),
('392', 'common eland'),
('393', 'giant eland'),
('394', 'African elephant'),
('395', 'Asian elephant'),
('396', 'scrawled filefish'),
('397', 'peregrine falcon'),
('398', 'carribean flamingo'),
('399', 'Chilean flamingo'),
('4', 'Abyssinian ground hornbill'),
('40', 'Alabama map turtle'),
('400', 'lesser flamingo'),
('401', 'Malaysian flying Fox'),
('402', 'Arctic Fox'),
('403', 'fennec Fox'),
('404', 'Cuban tree Fox'),
('405', 'South American ornate horned Fox'),
('406', 'tawny frogmouth'),
('407', 'frog'),
('408', 'mantella frog'),
('409', 'poison arrow frog'),
('41', 'Alaska jingle'),
('410', 'purple gallinule'),
('411', 'gars'),
('412', 'addra gazelle'),
('413', 'Dorcas gazelle'),
('414', 'slender-horned gazelle'),
('415', 'leopard gecko'),
('416', 'Solomon island gecko'),
('417', 'Tokay gecko'),
('418', 'gharial'),
('419', 'White-cheeked Gibbon'),
('42', 'Alaskan husky'),
('420', 'gibbons'),
('421', 'Gila monster'),
('422', 'giraffe'),
('423', 'domestic goat'),
('424', 'Abyssinian blue-winged goose'),
('425', 'African Pygmy goose'),
('426', 'bar-headed goose'),
('427', 'cape barren goose'),
('428', 'magpie goose'),
('429', 'Western lowland gorilla'),
('43', 'Alaskan malamute'),
('430', 'groupers'),
('431', 'bluestriped grunt'),
('432', 'French grunt'),
('433', 'helmeted guineafowl'),
('434', 'vulturine guineafowl'),
('435', 'gulls'),
('436', 'hackee'),
('437', 'haddock'),
('438', 'hadrosaurus'),
('439', 'hag-fish'),
('44', 'albacore tuna'),
('440', 'hairstreak'),
('441', 'hake'),
('442', 'halcyon'),
('443', 'halibut'),
('444', 'halicore'),
('445', 'hamadryad'),
('446', 'hamadryas'),
('447', 'hammerhead Bird'),
('448', 'hammerhead shark'),
('449', 'hammerkop'),
('45', 'albatross'),
('450', 'hamster'),
('451', 'hanuman-monkey'),
('452', 'hapuka'),
('453', 'hapuku'),
('454', 'harbor-porpoise'),
('455', 'harbor-seal'),
('456', 'hare'),
('457', 'harp-seal'),
('458', 'harpy-eagle'),
('459', 'harrier'),
('46', 'albertosaurus'),
('460', 'harrier hawk'),
('461', 'Hart'),
('462', 'hartebeest'),
('463', 'harvest mouse'),
('464', 'harvestmen'),
('465', 'hatchet-fish'),
('466', 'Hawaiian-Monk seal'),
('467', 'hawk'),
('468', 'hedgehog'),
('469', 'heifer'),
('47', 'albino'),
('470', 'hellbender'),
('471', 'hen'),
('472', 'herald'),
('473', 'Hercules-beetle'),
('474', 'hermit crab'),
('475', 'heron'),
('476', 'Herring'),
('477', 'heterodontosaurus'),
('478', 'hind'),
('479', 'hippo'),
('48', 'aldabra tortoise'),
('480', 'hippopotamus'),
('481', 'hoatzin'),
('482', 'hog'),
('483', 'hogget'),
('484', 'hoiho'),
('485', 'hoki'),
('486', 'homalocephale'),
('487', 'honey-badger'),
('488', 'honeybee'),
('489', 'honey-creeper'),
('49', 'alligator'),
('490', 'honeyeater'),
('491', 'hoopoe'),
('492', 'Horn-shark'),
('493', 'horned-toad'),
('494', 'horned-viper'),
('495', 'hornbill'),
('496', 'hornet'),
('497', 'horse'),
('498', 'horsefly'),
('499', 'horseshoe bat'),
('5', 'acacia rat'),
('50', 'alligator gar'),
('500', 'horseshoe crab'),
('501', 'hound'),
('502', 'House-mouse'),
('503', 'housefly'),
('504', 'howler-monkey'),
('505', 'huemul (deer)'),
('506', 'huia'),
('507', 'hummingbird'),
('508', 'humpback whale'),
('509', 'husky'),
('51', 'alligator snapping turtle'),
('510', 'hydatid-tapeworm'),
('511', 'Hydra'),
('512', 'hyena'),
('513', 'hylaeosaurus'),
('514', 'hypacrosaurus'),
('515', 'hypsilophodon'),
('516', 'hyracotherium'),
('517', 'hyrax'),
('518', 'sacred ibis'),
('519', 'scarlet ibis'),
('52', 'allosaurus'),
('520', 'ibises'),
('521', 'Cuban iguana'),
('522', 'Green iguana'),
('523', 'rhinoceros iguana'),
('524', 'impala'),
('525', 'jabiru'),
('526', 'jackal'),
('527', 'jackrabbit'),
('528', 'jaeger'),
('529', 'Jaguar'),
('53', 'alpaca'),
('530', 'jaguarundi'),
('531', 'janenschia'),
('532', 'Jay'),
('533', 'jellyfish'),
('534', 'Jenny'),
('535', 'jerboa'),
('536', 'Joey'),
('537', 'John dory'),
('538', 'junco'),
('539', 'June bug'),
('54', 'Alpine Black swallowtail butterfly'),
('540', 'Western Gray kangaroo'),
('541', 'White-collared kingfisher'),
('542', 'koala'),
('543', 'Ugandan kob'),
('544', 'komodo dragon'),
('545', 'laughing kookaburra'),
('546', 'greater kudu'),
('547', 'leafy sea dragon'),
('548', 'Black & White ruffed lemur'),
('549', 'Red ruffed lemur'),
('55', 'Alpine goat'),
('550', 'ring-tailed lemur'),
('551', 'lemurs'),
('552', 'leopard'),
('553', 'African lion'),
('554', 'lionfish - scorpionfish - stonefish'),
('555', 'Mexican beaded lizard'),
('556', 'lizards'),
('557', 'llama'),
('558', 'lookdown'),
('559', 'blue-streaked lory'),
('56', 'Alpine road guide tiger beetle'),
('560', 'chattering lory'),
('561', 'dusky lory'),
('562', 'Green-naped lory'),
('563', 'southeastern lubber'),
('564', 'blue & gold macaw'),
('565', 'blue-throated macaw'),
('566', 'Green-winged macaw'),
('567', 'hyacinth macaw'),
('568', 'Mexican military macaw'),
('569', 'macaws'),
('57', 'Altiplano chinchilla mouse'),
('570', 'manatees'),
('571', 'common marmoset'),
('572', 'slender-tailed meerkat'),
('573', 'hooded merganser'),
('574', 'Honduran milksnake'),
('575', 'crocodile monitor'),
('576', 'Malayan water monitor'),
('577', 'White-throated monitor'),
('578', 'common moorhen'),
('579', 'morays'),
('58', 'Amazon dolphin'),
('580', 'Indian muntjac'),
('581', 'Golden-crested mynah'),
('582', 'nabarlek'),
('583', 'nag'),
('584', 'naga'),
('585', 'nagapies'),
('586', 'naked mole rat'),
('587', 'nandine'),
('588', 'nandoo'),
('589', 'nandu'),
('59', 'Amazon parrot'),
('590', 'narwhal'),
('591', 'narwhale'),
('592', 'natterjack toad'),
('593', 'nauplius'),
('594', 'Nautilus'),
('595', 'needle fish'),
('596', 'needletail'),
('597', 'nematode'),
('598', 'nene'),
('599', 'neon blue guppy'),
('6', 'acorn barnacle'),
('60', 'Amazon tree boa'),
('600', 'neon blue hermit crab'),
('601', 'neon dwarf gourami'),
('602', 'neon rainbow fish'),
('603', 'neon Red guppy'),
('604', 'neon tetra'),
('605', 'nerka'),
('606', 'nettlefish'),
('607', 'Newfoundland dog'),
('608', 'newt'),
('609', 'newt nutria'),
('61', 'Amber pen shell'),
('610', 'night crawler'),
('611', 'night heron'),
('612', 'nighthawk'),
('613', 'Nightingale'),
('614', 'nightjar'),
('615', 'nilgai'),
('616', 'nine banded armadillo'),
('617', 'noctilio'),
('618', 'noctule'),
('619', 'noddy'),
('62', 'American alligator'),
('620', 'noolbenger'),
('621', 'northern cardinals'),
('622', 'northern elephant seal'),
('623', 'northern flying squirrel'),
('624', 'northern fur seal'),
('625', 'northern hairy-nosed wombat'),
('626', 'northern Pike'),
('627', 'northern sea horse'),
('628', 'northern spotted owl'),
('629', 'Norway lobster'),
('63', 'American avocet'),
('630', 'Norway rat'),
('631', 'Nubian goat'),
('632', 'nudibranch'),
('633', 'numbat'),
('634', 'nurse shark'),
('635', 'nutcracker'),
('636', 'nuthatch'),
('637', 'nutria'),
('638', 'nyala'),
('639', 'nymph'),
('64', 'American badger'),
('640', 'Virginia opossum'),
('641', 'bornean orangutan'),
('642', 'scimitar-horned oryx'),
('643', 'ostrich'),
('644', 'Asian Small-clawed otter'),
('645', 'Congo clawless otter'),
('646', 'giant river otter'),
('647', 'sea otter'),
('648', 'barn owl'),
('649', 'great horned owl'),
('65', 'American bittern'),
('650', 'Florida panther'),
('651', 'derbyan parakeet'),
('652', 'African Gray parrot'),
('653', 'Brazilian hawk-headed parrot'),
('654', 'grand eclectus parrot'),
('655', 'parrotfish'),
('656', 'Queen parrotfish'),
('657', 'parrots'),
('658', 'Indian peafowl'),
('659', 'peccaries'),
('66', 'American Black vulture'),
('660', 'Brown pelican'),
('661', 'Adélie penguin'),
('662', 'chinstrap penguin'),
('663', 'gentoo penguin'),
('664', 'penguins'),
('665', 'Golden pheasant'),
('666', 'pot-bellied pig'),
('667', 'lesser Bahama pintail'),
('668', 'piranhas'),
('669', 'Atlantic porkfish'),
('67', 'American cicada'),
('670', 'primates'),
('671', 'pufferfish'),
('672', 'porcupinefish'),
('673', 'tufted puffin'),
('674', 'puffins'),
('675', 'Burmese Python'),
('676', 'carpet Python'),
('677', 'Green tree Python'),
('678', 'Royal Python'),
('679', 'quagga - extinct zebra'),
('68', 'American crayfish'),
('680', 'quahog - type of clam'),
('681', 'quail - type of ground Bird'),
('682', 'Queen Snake'),
('683', 'Queen ant'),
('684', 'Queen bee'),
('685', 'quetzal - colorful Bird of S. America'),
('686', 'quokka'),
('687', 'quoll'),
('688', 'old world rabbit'),
('689', 'raccoons'),
('69', 'American crocodile'),
('690', 'light-footed clapper rail'),
('691', 'canebrake rattlesnake'),
('692', 'dusky Pygmy rattlesnake'),
('693', 'Eastern diamondback rattlesnake'),
('694', 'spotted eagle Ray'),
('695', 'rays'),
('696', 'electric rays'),
('697', 'Black rhinoceros'),
('698', 'White rhinoceros'),
('699', 'tiger salamander'),
('7', 'acorn weevil'),
('70', 'American crow'),
('700', 'sawfishes'),
('701', 'emperor scorpion'),
('702', 'California sea lion'),
('703', 'seahorses'),
('704', 'crabeater seal'),
('705', 'harbor seal'),
('706', 'hooded seal'),
('707', 'leopard seal'),
('708', 'Ross seal'),
('709', 'Weddell seal'),
('71', 'American goldfinch'),
('710', 'Monk seals'),
('711', 'sergeant Major'),
('712', 'serval'),
('713', 'bonnethead shark'),
('714', 'epaulette shark'),
('715', 'great White shark'),
('716', 'leopard shark'),
('717', 'nurse shark'),
('718', 'Pacific blacktip reef shark'),
('719', 'whale shark'),
('72', 'American kestrel'),
('720', 'sharks'),
('721', 'Barbary sheep'),
('722', 'domestic sheep'),
('723', 'Australian shelduck'),
('724', 'cape shelduck'),
('725', 'Argentine Red shoveler'),
('726', 'Australian shoveler'),
('727', 'common shoveler'),
('728', 'Eastern blue-tongued skink'),
('729', 'Black rat Snake'),
('73', 'American lobster'),
('730', 'Eastern corn Snake'),
('731', 'Eastern indigo Snake'),
('732', 'Eastern King Snake'),
('733', 'Florida cottonmouth Snake'),
('734', 'Florida King Snake'),
('735', 'Florida pine Snake'),
('736', 'Gray rat Snake'),
('737', 'scarlet King Snake'),
('738', 'yellow rat Snake'),
('739', 'snakes'),
('74', 'American marten'),
('740', 'sea snakes'),
('741', 'Atlantic spadefish'),
('742', 'spiders'),
('743', 'Golden-breasted starling'),
('744', 'Black-necked stilt'),
('745', 'marabou stork'),
('746', 'sugar glider'),
('747', 'sunbittern'),
('748', 'Black swan'),
('749', 'Black-necked swan'),
('75', 'American ratsnake'),
('750', 'coscoroba swan'),
('751', 'Beryl-spangled tanager'),
('752', 'blue & Black tanager'),
('753', 'blue tang'),
('754', 'tapirs'),
('755', 'Western tarsier'),
('756', 'American Green wing teal'),
('757', 'Baikal teal'),
('758', 'cape teal'),
('759', 'cinnamon teal'),
('76', 'American Red squirrel'),
('760', 'garganey teal'),
('761', 'Hottentot teal'),
('762', 'marbled teal'),
('763', 'Madagascar tenrec'),
('764', 'Bengal tiger'),
('765', 'Marine toad'),
('766', 'Oriental fire-bellied toad'),
('767', 'tomistoma'),
('768', 'African spurred tortoise'),
('769', 'aldabra tortoise'),
('77', 'American river otter'),
('770', 'yellow-footed tortoise'),
('771', 'keel-billed toucan'),
('772', 'toco toucan'),
('773', 'Gray-winged trumpeter'),
('774', 'Grey turaco'),
('775', 'Guinea turaco'),
('776', 'Red-crested turaco'),
('777', 'White-cheeked turaco'),
('778', 'sea turtles'),
('779', 'uakari'),
('78', 'American Robin'),
('780', 'Uganda kob'),
('781', 'uinta ground squirrel'),
('782', 'umbrella Bird'),
('783', 'umbrette'),
('784', 'unau'),
('785', 'ungulate'),
('786', 'unicorn'),
('787', 'upupa'),
('788', 'urchin'),
('789', 'urial'),
('79', 'American toad'),
('790', 'uromastyx maliensis'),
('791', 'uromastyx spinipes'),
('792', 'urson'),
('793', 'urubu'),
('794', 'urus'),
('795', 'urutu'),
('796', 'urva'),
('797', 'Utah prairie dog'),
('798', 'vaquita'),
('799', 'Black vulture'),
('8', 'acorn woodpecker'),
('80', 'American wigeon'),
('800', 'King vulture'),
('801', 'lappet-faced vulture'),
('802', 'vultures'),
('803', 'old world vultures'),
('804', 'vampire bat'),
('805', 'vaquita'),
('806', 'veery'),
('807', 'velociraptor'),
('808', 'velvet crab'),
('809', 'velvet worm'),
('81', 'amethyst gem clam'),
('810', 'venomous Snake'),
('811', 'verdin'),
('812', 'vervet'),
('813', 'vicuna'),
('814', 'viper'),
('815', 'viper squid'),
('816', 'viperfish'),
('817', 'vireo'),
('818', 'Virginia opossum'),
('819', 'vixen'),
('82', 'amethyst sunbird'),
('820', 'vole'),
('821', 'volvox'),
('822', 'vulpes velox'),
('823', 'vulpes vulpes'),
('824', 'walrus'),
('825', 'warthog'),
('826', 'defassa waterbuck'),
('827', 'beluga whale'),
('828', 'blue whale'),
('829', 'false killer whale'),
('83', 'amethystine Python'),
('830', 'Gray whale'),
('831', 'killer whale'),
('832', 'Short-finned pilot whale'),
('833', 'sperm whale'),
('834', 'whales'),
('835', 'endangered whales'),
('836', 'American wigeon'),
('837', 'chiloe wigeon'),
('838', 'Eastern White-bearded (gnu) wildebeest'),
('839', 'Gray Wolf'),
('84', 'ammonite'),
('840', 'maned Wolf'),
('841', 'X-Ray fish'),
('842', 'X-Ray tetra'),
('843', 'xanclomys'),
('844', 'xanthareel'),
('845', 'xantus'),
('846', 'xantus murrelet'),
('847', 'xeme'),
('848', 'xenarthra'),
('849', 'xenoposeidon'),
('85', 'amoeba'),
('850', 'xenops'),
('851', 'xenopterygii'),
('852', 'xenopus'),
('853', 'xenotarsosaurus'),
('854', 'xenurine'),
('855', 'xenurus unicinctus'),
('856', 'xerus'),
('857', 'xiaosaurus'),
('858', 'xinjiangovenator'),
('859', 'xiphias'),
('86', 'amphibian'),
('860', 'xiphias gladius'),
('861', 'xiphosuran'),
('862', 'xoloitzcuintli'),
('863', 'xoni'),
('864', 'xuanhanosaurus'),
('865', 'xuanhuaceratops'),
('866', 'xuanhuasaurus'),
('867', 'yaffle'),
('868', 'yak'),
('869', 'yapok'),
('87', 'amphiuma'),
('870', 'yard ant'),
('871', 'yearling'),
('872', 'yellow bellied marmot'),
('873', 'yellow belly lizard'),
('874', 'yellowhammer'),
('875', 'yellowjacket'),
('876', 'yellowlegs'),
('877', 'yellowthroat'),
('878', 'yeti'),
('879', 'ynambu'),
('88', 'Amur minnow'),
('880', 'Yorkshire terrier'),
('881', 'Yosemite toad'),
('882', 'yucker'),
('883', 'zander'),
('884', 'Zanzibar Day gecko'),
('885', 'zebra'),
('886', 'zebra dove'),
('887', 'zebra Finch'),
('888', 'zebra-tailed lizard'),
('889', 'zebrafish'),
('89', 'Amur ratsnake'),
('890', 'zebu'),
('891', 'zenaida'),
('892', 'zeren'),
('893', 'zethus spinipes'),
('894', 'zethus Wasp'),
('895', 'zigzag salamander'),
('896', 'zone-tailed pigeon'),
('897', 'zooplankton'),
('898', 'zopilote'),
('899', 'zorilla'),
('9', 'acouchi'),
('90', 'Amur starfish'),
('91', 'anaconda'),
('92', 'anchovy'),
('93', 'Andean cat'),
('94', 'Andean cock-of-the-Rock'),
('95', 'Andean condor'),
('96', 'anemone'),
('97', 'anemone crab'),
('98', 'anemone shrimp'),
('99', 'Angel wing mussel');

-- --------------------------------------------------------

--
-- Table structure for table `gameroom`
--

CREATE TABLE `gameroom` (
  `roomId` varchar(13) NOT NULL,
  `roomName` varchar(30) NOT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'F',
  `currentUserId` int(11) NOT NULL DEFAULT '0',
  `questionId` char(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gameroom`
--

INSERT INTO `gameroom` (`roomId`, `roomName`, `status`, `currentUserId`, `questionId`) VALUES
('58395298ab434', 'firstgame', 'F', 4, '0'),
('58395c271578e', 'secondgame', 'F', 4, '0');

-- --------------------------------------------------------

--
-- Table structure for table `gameuser`
--

CREATE TABLE `gameuser` (
  `roomId` varchar(13) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'F',
  `win` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `lose` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `numOfLike` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `numOfDislike` int(9) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gameuser`
--

INSERT INTO `gameuser` (`roomId`, `userId`, `status`, `win`, `lose`, `numOfLike`, `numOfDislike`) VALUES
('58395298ab434', 4, 'F', 0, 0, 0, 0),
('58395298ab434', 5, 'F', 0, 0, 0, 0),
('58395298ab434', 8, 'F', 0, 0, 0, 0),
('58395298ab434', 9, 'F', 0, 0, 0, 0),
('58395c271578e', 4, 'F', 0, 0, 0, 0),
('58395c271578e', 7, 'F', 0, 0, 0, 0),
('58395c271578e', 8, 'F', 0, 0, 0, 0),
('58395c271578e', 9, 'F', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE `relationship` (
  `user_one_id` int(11) NOT NULL,
  `user_two_id` int(11) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `action_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`user_one_id`, `user_two_id`, `status`, `action_user_id`) VALUES
(4, 5, 0, 4),
(4, 6, 1, 4),
(4, 7, 0, 4),
(4, 8, 0, 4),
(4, 9, 0, 9),
(5, 6, 1, 5),
(5, 7, 2, 5),
(5, 8, 1, 5),
(6, 9, 1, 6),
(7, 8, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `roomquestion`
--

CREATE TABLE `roomquestion` (
  `roomId` varchar(13) NOT NULL,
  `questionId` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `win` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `lose` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `numOfLike` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `numOfDislike` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('T','F') NOT NULL DEFAULT 'F'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `win`, `lose`, `numOfLike`, `numOfDislike`, `status`) VALUES
(4, 'admin', '123@123.com', '99339952e306c2a88c91219862dba50e605ed5ac4bf548855dfda7fcad983898', 0, 0, 0, 0, 'F'),
(5, 'Raymond', 'raymond@123.com', 'd26ee1d41b9d13643847de90ee2384eb61d1a1f1ba82fc09cda4c6ade68d7d0e', 0, 0, 0, 0, 'F'),
(6, 'Spark', 'spark@123.com', '03587d3a7482ee565de65b99c0c0448f95b9253ad76c96ca5d0d198ad5e563a2', 0, 0, 0, 0, 'F'),
(7, 'Raymond', 'raymond@456.com', 'd26ee1d41b9d13643847de90ee2384eb61d1a1f1ba82fc09cda4c6ade68d7d0e', 0, 0, 0, 0, 'F'),
(8, 'Raymond', 'raymond@789.com', 'd26ee1d41b9d13643847de90ee2384eb61d1a1f1ba82fc09cda4c6ade68d7d0e', 0, 0, 0, 0, 'F'),
(9, 'joshua', 'joshua@123.com', '436151b226229ee20c5b58bcf3d94fe7679ab11b1a50f5a21cfee1bd36971b87', 0, 0, 0, 0, 'F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gamequestions`
--
ALTER TABLE `gamequestions`
  ADD PRIMARY KEY (`QuestionID`);

--
-- Indexes for table `gameroom`
--
ALTER TABLE `gameroom`
  ADD PRIMARY KEY (`roomId`),
  ADD KEY `currentUserId` (`currentUserId`);

--
-- Indexes for table `gameuser`
--
ALTER TABLE `gameuser`
  ADD UNIQUE KEY `unique_user` (`roomId`,`userId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
  ADD UNIQUE KEY `unique_users_id` (`user_one_id`,`user_two_id`),
  ADD KEY `user_two_id` (`user_two_id`),
  ADD KEY `action_user_id` (`action_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `gameroom`
--

--
-- Constraints for table `gameuser`
--
ALTER TABLE `gameuser`
  ADD CONSTRAINT `gameuser_ibfk_1` FOREIGN KEY (`roomId`) REFERENCES `gameroom` (`roomId`),
  ADD CONSTRAINT `gameuser_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `relationship`
--
ALTER TABLE `relationship`
  ADD CONSTRAINT `relationship_ibfk_1` FOREIGN KEY (`user_one_id`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `relationship_ibfk_2` FOREIGN KEY (`user_two_id`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `relationship_ibfk_3` FOREIGN KEY (`action_user_id`) REFERENCES `users` (`userId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
