-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.21-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para invensorteosuabc
CREATE DATABASE IF NOT EXISTS `invensorteosuabc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;
USE `invensorteosuabc`;

-- Volcando estructura para tabla invensorteosuabc.business_profile
CREATE TABLE IF NOT EXISTS `business_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country_id` int(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `industry` varchar(150) NOT NULL,
  `number_id` varchar(12) NOT NULL,
  `tax` int(2) NOT NULL,
  `currency_id` int(10) NOT NULL,
  `timezone_id` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla invensorteosuabc.business_profile: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `business_profile` DISABLE KEYS */;
INSERT INTO `business_profile` (`id`, `name`, `address`, `city`, `postal_code`, `state`, `country_id`, `phone`, `email`, `industry`, `number_id`, `tax`, `currency_id`, `timezone_id`, `date_added`, `logo_url`) VALUES
	(1, 'IDIOMAS UABC', '12 calle poniente', 'Moncagua', '3301', 'San Miguel', 222, '503 2682-555', 'info@obedalvarado.pw', 'Sistemas InformÃ¡ticos', '666666-7', 13, 1, 114, '2015-11-21 11:00:00', 'img/logo1.png');
/*!40000 ALTER TABLE `business_profile` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.categoria: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `name`, `status`, `date_added`) VALUES
	(1, 'EQUIPO DE COMPUTO', 1, '2021-11-26 19:31:41');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla invensorteosuabc.contacts: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.contacts_supplier
CREATE TABLE IF NOT EXISTS `contacts_supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_client_id_index` (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla invensorteosuabc.contacts_supplier: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contacts_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_supplier` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `capital` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `citizenship` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_sub_unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso_3166_2` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `iso_3166_3` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `region_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sub_region_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `eea` tinyint(1) NOT NULL DEFAULT 0,
  `swap_postal_code` tinyint(1) NOT NULL DEFAULT 0,
  `swap_currency_symbol` tinyint(1) NOT NULL DEFAULT 0,
  `thousand_separator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `decimal_separator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=895 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla invensorteosuabc.countries: ~249 rows (aproximadamente)
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `capital`, `citizenship`, `country_code`, `currency`, `currency_code`, `currency_sub_unit`, `full_name`, `iso_3166_2`, `iso_3166_3`, `name`, `region_code`, `sub_region_code`, `eea`, `swap_postal_code`, `swap_currency_symbol`, `thousand_separator`, `decimal_separator`) VALUES
	(4, 'Kabul', 'Afghan', '004', 'afghani', 'AFN', 'pul', 'Islamic Republic of Afghanistan', 'AF', 'AFG', 'Afghanistan', '142', '034', 0, 0, 0, NULL, NULL),
	(8, 'Tirana', 'Albanian', '008', 'lek', 'ALL', '(qindar (pl. qindarka))', 'Republic of Albania', 'AL', 'ALB', 'Albania', '150', '039', 0, 0, 0, NULL, NULL),
	(10, 'Antartica', 'of Antartica', '010', '', '', '', 'Antarctica', 'AQ', 'ATA', 'Antarctica', '', '', 0, 0, 0, NULL, NULL),
	(12, 'Algiers', 'Algerian', '012', 'Algerian dinar', 'DZD', 'centime', 'People’s Democratic Republic of Algeria', 'DZ', 'DZA', 'Algeria', '002', '015', 0, 0, 0, NULL, NULL),
	(16, 'Pago Pago', 'American Samoan', '016', 'US dollar', 'USD', 'cent', 'Territory of American', 'AS', 'ASM', 'American Samoa', '009', '061', 0, 0, 0, NULL, NULL),
	(20, 'Andorra la Vella', 'Andorran', '020', 'euro', 'EUR', 'cent', 'Principality of Andorra', 'AD', 'AND', 'Andorra', '150', '039', 0, 0, 0, NULL, NULL),
	(24, 'Luanda', 'Angolan', '024', 'kwanza', 'AOA', 'cêntimo', 'Republic of Angola', 'AO', 'AGO', 'Angola', '002', '017', 0, 0, 0, NULL, NULL),
	(28, 'St John’s', 'of Antigua and Barbuda', '028', 'East Caribbean dollar', 'XCD', 'cent', 'Antigua and Barbuda', 'AG', 'ATG', 'Antigua and Barbuda', '019', '029', 0, 0, 0, NULL, NULL),
	(31, 'Baku', 'Azerbaijani', '031', 'Azerbaijani manat', 'AZN', 'kepik (inv.)', 'Republic of Azerbaijan', 'AZ', 'AZE', 'Azerbaijan', '142', '145', 0, 0, 0, NULL, NULL),
	(32, 'Buenos Aires', 'Argentinian', '032', 'Argentine peso', 'ARS', 'centavo', 'Argentine Republic', 'AR', 'ARG', 'Argentina', '019', '005', 0, 1, 0, NULL, NULL),
	(36, 'Canberra', 'Australian', '036', 'Australian dollar', 'AUD', 'cent', 'Commonwealth of Australia', 'AU', 'AUS', 'Australia', '009', '053', 0, 0, 0, NULL, NULL),
	(40, 'Vienna', 'Austrian', '040', 'euro', 'EUR', 'cent', 'Republic of Austria', 'AT', 'AUT', 'Austria', '150', '155', 1, 1, 0, NULL, NULL),
	(44, 'Nassau', 'Bahamian', '044', 'Bahamian dollar', 'BSD', 'cent', 'Commonwealth of the Bahamas', 'BS', 'BHS', 'Bahamas', '019', '029', 0, 0, 0, NULL, NULL),
	(48, 'Manama', 'Bahraini', '048', 'Bahraini dinar', 'BHD', 'fils (inv.)', 'Kingdom of Bahrain', 'BH', 'BHR', 'Bahrain', '142', '145', 0, 0, 0, NULL, NULL),
	(50, 'Dhaka', 'Bangladeshi', '050', 'taka (inv.)', 'BDT', 'poisha (inv.)', 'People’s Republic of Bangladesh', 'BD', 'BGD', 'Bangladesh', '142', '034', 0, 0, 0, NULL, NULL),
	(51, 'Yerevan', 'Armenian', '051', 'dram (inv.)', 'AMD', 'luma', 'Republic of Armenia', 'AM', 'ARM', 'Armenia', '142', '145', 0, 0, 0, NULL, NULL),
	(52, 'Bridgetown', 'Barbadian', '052', 'Barbados dollar', 'BBD', 'cent', 'Barbados', 'BB', 'BRB', 'Barbados', '019', '029', 0, 0, 0, NULL, NULL),
	(56, 'Brussels', 'Belgian', '056', 'euro', 'EUR', 'cent', 'Kingdom of Belgium', 'BE', 'BEL', 'Belgium', '150', '155', 1, 1, 0, NULL, NULL),
	(60, 'Hamilton', 'Bermudian', '060', 'Bermuda dollar', 'BMD', 'cent', 'Bermuda', 'BM', 'BMU', 'Bermuda', '019', '021', 0, 0, 0, NULL, NULL),
	(64, 'Thimphu', 'Bhutanese', '064', 'ngultrum (inv.)', 'BTN', 'chhetrum (inv.)', 'Kingdom of Bhutan', 'BT', 'BTN', 'Bhutan', '142', '034', 0, 0, 0, NULL, NULL),
	(68, 'Sucre (BO1)', 'Bolivian', '068', 'boliviano', 'BOB', 'centavo', 'Plurinational State of Bolivia', 'BO', 'BOL', 'Bolivia, Plurinational State of', '019', '005', 0, 0, 0, NULL, NULL),
	(70, 'Sarajevo', 'of Bosnia and Herzegovina', '070', 'convertible mark', 'BAM', 'fening', 'Bosnia and Herzegovina', 'BA', 'BIH', 'Bosnia and Herzegovina', '150', '039', 0, 0, 0, NULL, NULL),
	(72, 'Gaborone', 'Botswanan', '072', 'pula (inv.)', 'BWP', 'thebe (inv.)', 'Republic of Botswana', 'BW', 'BWA', 'Botswana', '002', '018', 0, 0, 0, NULL, NULL),
	(74, 'Bouvet island', 'of Bouvet island', '074', '', '', '', 'Bouvet Island', 'BV', 'BVT', 'Bouvet Island', '', '', 0, 0, 0, NULL, NULL),
	(76, 'Brasilia', 'Brazilian', '076', 'real (pl. reais)', 'BRL', 'centavo', 'Federative Republic of Brazil', 'BR', 'BRA', 'Brazil', '019', '005', 0, 0, 0, NULL, NULL),
	(84, 'Belmopan', 'Belizean', '084', 'Belize dollar', 'BZD', 'cent', 'Belize', 'BZ', 'BLZ', 'Belize', '019', '013', 0, 0, 0, NULL, NULL),
	(86, 'Diego Garcia', 'Changosian', '086', 'US dollar', 'USD', 'cent', 'British Indian Ocean Territory', 'IO', 'IOT', 'British Indian Ocean Territory', '', '', 0, 0, 0, NULL, NULL),
	(90, 'Honiara', 'Solomon Islander', '090', 'Solomon Islands dollar', 'SBD', 'cent', 'Solomon Islands', 'SB', 'SLB', 'Solomon Islands', '009', '054', 0, 0, 0, NULL, NULL),
	(92, 'Road Town', 'British Virgin Islander;', '092', 'US dollar', 'USD', 'cent', 'British Virgin Islands', 'VG', 'VGB', 'Virgin Islands, British', '019', '029', 0, 0, 0, NULL, NULL),
	(96, 'Bandar Seri Begawan', 'Bruneian', '096', 'Brunei dollar', 'BND', 'sen (inv.)', 'Brunei Darussalam', 'BN', 'BRN', 'Brunei Darussalam', '142', '035', 0, 0, 0, NULL, NULL),
	(100, 'Sofia', 'Bulgarian', '100', 'lev (pl. leva)', 'BGN', 'stotinka', 'Republic of Bulgaria', 'BG', 'BGR', 'Bulgaria', '150', '151', 1, 0, 1, NULL, NULL),
	(104, 'Yangon', 'Burmese', '104', 'kyat', 'MMK', 'pya', 'Union of Myanmar/', 'MM', 'MMR', 'Myanmar', '142', '035', 0, 0, 0, NULL, NULL),
	(108, 'Bujumbura', 'Burundian', '108', 'Burundi franc', 'BIF', 'centime', 'Republic of Burundi', 'BI', 'BDI', 'Burundi', '002', '014', 0, 0, 0, NULL, NULL),
	(112, 'Minsk', 'Belarusian', '112', 'Belarusian rouble', 'BYR', 'kopek', 'Republic of Belarus', 'BY', 'BLR', 'Belarus', '150', '151', 0, 0, 0, NULL, NULL),
	(116, 'Phnom Penh', 'Cambodian', '116', 'riel', 'KHR', 'sen (inv.)', 'Kingdom of Cambodia', 'KH', 'KHM', 'Cambodia', '142', '035', 0, 0, 0, NULL, NULL),
	(120, 'Yaoundé', 'Cameroonian', '120', 'CFA franc (BEAC)', 'XAF', 'centime', 'Republic of Cameroon', 'CM', 'CMR', 'Cameroon', '002', '017', 0, 0, 0, NULL, NULL),
	(124, 'Ottawa', 'Canadian', '124', 'Canadian dollar', 'CAD', 'cent', 'Canada', 'CA', 'CAN', 'Canada', '019', '021', 0, 0, 0, NULL, NULL),
	(132, 'Praia', 'Cape Verdean', '132', 'Cape Verde escudo', 'CVE', 'centavo', 'Republic of Cape Verde', 'CV', 'CPV', 'Cape Verde', '002', '011', 0, 0, 0, NULL, NULL),
	(136, 'George Town', 'Caymanian', '136', 'Cayman Islands dollar', 'KYD', 'cent', 'Cayman Islands', 'KY', 'CYM', 'Cayman Islands', '019', '029', 0, 0, 0, NULL, NULL),
	(140, 'Bangui', 'Central African', '140', 'CFA franc (BEAC)', 'XAF', 'centime', 'Central African Republic', 'CF', 'CAF', 'Central African Republic', '002', '017', 0, 0, 0, NULL, NULL),
	(144, 'Colombo', 'Sri Lankan', '144', 'Sri Lankan rupee', 'LKR', 'cent', 'Democratic Socialist Republic of Sri Lanka', 'LK', 'LKA', 'Sri Lanka', '142', '034', 0, 0, 0, NULL, NULL),
	(148, 'N’Djamena', 'Chadian', '148', 'CFA franc (BEAC)', 'XAF', 'centime', 'Republic of Chad', 'TD', 'TCD', 'Chad', '002', '017', 0, 0, 0, NULL, NULL),
	(152, 'Santiago', 'Chilean', '152', 'Chilean peso', 'CLP', 'centavo', 'Republic of Chile', 'CL', 'CHL', 'Chile', '019', '005', 0, 0, 0, NULL, NULL),
	(156, 'Beijing', 'Chinese', '156', 'renminbi-yuan (inv.)', 'CNY', 'jiao (10)', 'People’s Republic of China', 'CN', 'CHN', 'China', '142', '030', 0, 0, 0, NULL, NULL),
	(158, 'Taipei', 'Taiwanese', '158', 'new Taiwan dollar', 'TWD', 'fen (inv.)', 'Republic of China, Taiwan (TW1)', 'TW', 'TWN', 'Taiwan, Province of China', '142', '030', 0, 0, 0, NULL, NULL),
	(162, 'Flying Fish Cove', 'Christmas Islander', '162', 'Australian dollar', 'AUD', 'cent', 'Christmas Island Territory', 'CX', 'CXR', 'Christmas Island', '', '', 0, 0, 0, NULL, NULL),
	(166, 'Bantam', 'Cocos Islander', '166', 'Australian dollar', 'AUD', 'cent', 'Territory of Cocos (Keeling) Islands', 'CC', 'CCK', 'Cocos (Keeling) Islands', '', '', 0, 0, 0, NULL, NULL),
	(170, 'Santa Fe de Bogotá', 'Colombian', '170', 'Colombian peso', 'COP', 'centavo', 'Republic of Colombia', 'CO', 'COL', 'Colombia', '019', '005', 0, 0, 0, NULL, NULL),
	(174, 'Moroni', 'Comorian', '174', 'Comorian franc', 'KMF', '', 'Union of the Comoros', 'KM', 'COM', 'Comoros', '002', '014', 0, 0, 0, NULL, NULL),
	(175, 'Mamoudzou', 'Mahorais', '175', 'euro', 'EUR', 'cent', 'Departmental Collectivity of Mayotte', 'YT', 'MYT', 'Mayotte', '002', '014', 0, 0, 0, NULL, NULL),
	(178, 'Brazzaville', 'Congolese', '178', 'CFA franc (BEAC)', 'XAF', 'centime', 'Republic of the Congo', 'CG', 'COG', 'Congo', '002', '017', 0, 0, 0, NULL, NULL),
	(180, 'Kinshasa', 'Congolese', '180', 'Congolese franc', 'CDF', 'centime', 'Democratic Republic of the Congo', 'CD', 'COD', 'Congo, the Democratic Republic of the', '002', '017', 0, 0, 0, NULL, NULL),
	(184, 'Avarua', 'Cook Islander', '184', 'New Zealand dollar', 'NZD', 'cent', 'Cook Islands', 'CK', 'COK', 'Cook Islands', '009', '061', 0, 0, 0, NULL, NULL),
	(188, 'San José', 'Costa Rican', '188', 'Costa Rican colón (pl. colones)', 'CRC', 'céntimo', 'Republic of Costa Rica', 'CR', 'CRI', 'Costa Rica', '019', '013', 0, 0, 0, NULL, NULL),
	(191, 'Zagreb', 'Croatian', '191', 'kuna (inv.)', 'HRK', 'lipa (inv.)', 'Republic of Croatia', 'HR', 'HRV', 'Croatia', '150', '039', 1, 0, 1, NULL, NULL),
	(192, 'Havana', 'Cuban', '192', 'Cuban peso', 'CUP', 'centavo', 'Republic of Cuba', 'CU', 'CUB', 'Cuba', '019', '029', 0, 0, 0, NULL, NULL),
	(196, 'Nicosia', 'Cypriot', '196', 'euro', 'EUR', 'cent', 'Republic of Cyprus', 'CY', 'CYP', 'Cyprus', '142', '145', 1, 0, 0, NULL, NULL),
	(203, 'Prague', 'Czech', '203', 'Czech koruna (pl. koruny)', 'CZK', 'halér', 'Czech Republic', 'CZ', 'CZE', 'Czech Republic', '150', '151', 1, 0, 1, NULL, NULL),
	(204, 'Porto Novo (BJ1)', 'Beninese', '204', 'CFA franc (BCEAO)', 'XOF', 'centime', 'Republic of Benin', 'BJ', 'BEN', 'Benin', '002', '011', 0, 0, 0, NULL, NULL),
	(208, 'Copenhagen', 'Danish', '208', 'Danish krone', 'DKK', 'øre (inv.)', 'Kingdom of Denmark', 'DK', 'DNK', 'Denmark', '150', '154', 1, 1, 0, NULL, NULL),
	(212, 'Roseau', 'Dominican', '212', 'East Caribbean dollar', 'XCD', 'cent', 'Commonwealth of Dominica', 'DM', 'DMA', 'Dominica', '019', '029', 0, 0, 0, NULL, NULL),
	(214, 'Santo Domingo', 'Dominican', '214', 'Dominican peso', 'DOP', 'centavo', 'Dominican Republic', 'DO', 'DOM', 'Dominican Republic', '019', '029', 0, 0, 0, NULL, NULL),
	(218, 'Quito', 'Ecuadorian', '218', 'US dollar', 'USD', 'cent', 'Republic of Ecuador', 'EC', 'ECU', 'Ecuador', '019', '005', 0, 0, 0, NULL, NULL),
	(222, 'San Salvador', 'Salvadoran', '222', 'Salvadorian colón (pl. colones)', 'SVC', 'centavo', 'Republic of El Salvador', 'SV', 'SLV', 'El Salvador', '019', '013', 0, 0, 0, NULL, NULL),
	(226, 'Malabo', 'Equatorial Guinean', '226', 'CFA franc (BEAC)', 'XAF', 'centime', 'Republic of Equatorial Guinea', 'GQ', 'GNQ', 'Equatorial Guinea', '002', '017', 0, 0, 0, NULL, NULL),
	(231, 'Addis Ababa', 'Ethiopian', '231', 'birr (inv.)', 'ETB', 'cent', 'Federal Democratic Republic of Ethiopia', 'ET', 'ETH', 'Ethiopia', '002', '014', 0, 0, 0, NULL, NULL),
	(232, 'Asmara', 'Eritrean', '232', 'nakfa', 'ERN', 'cent', 'State of Eritrea', 'ER', 'ERI', 'Eritrea', '002', '014', 0, 0, 0, NULL, NULL),
	(233, 'Tallinn', 'Estonian', '233', 'euro', 'EUR', 'cent', 'Republic of Estonia', 'EE', 'EST', 'Estonia', '150', '154', 1, 0, 1, NULL, NULL),
	(234, 'Tórshavn', 'Faeroese', '234', 'Danish krone', 'DKK', 'øre (inv.)', 'Faeroe Islands', 'FO', 'FRO', 'Faroe Islands', '150', '154', 0, 0, 0, NULL, NULL),
	(238, 'Stanley', 'Falkland Islander', '238', 'Falkland Islands pound', 'FKP', 'new penny', 'Falkland Islands', 'FK', 'FLK', 'Falkland Islands (Malvinas)', '019', '005', 0, 0, 0, NULL, NULL),
	(239, 'King Edward Point (Grytviken)', 'of South Georgia and the South Sandwich Islands', '239', '', '', '', 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', '', '', 0, 0, 0, NULL, NULL),
	(242, 'Suva', 'Fijian', '242', 'Fiji dollar', 'FJD', 'cent', 'Republic of Fiji', 'FJ', 'FJI', 'Fiji', '009', '054', 0, 0, 0, NULL, NULL),
	(246, 'Helsinki', 'Finnish', '246', 'euro', 'EUR', 'cent', 'Republic of Finland', 'FI', 'FIN', 'Finland', '150', '154', 1, 1, 1, NULL, NULL),
	(248, 'Mariehamn', 'Åland Islander', '248', 'euro', 'EUR', 'cent', 'Åland Islands', 'AX', 'ALA', 'Åland Islands', '150', '154', 0, 0, 0, NULL, NULL),
	(250, 'Paris', 'French', '250', 'euro', 'EUR', 'cent', 'French Republic', 'FR', 'FRA', 'France', '150', '155', 1, 1, 1, NULL, NULL),
	(254, 'Cayenne', 'Guianese', '254', 'euro', 'EUR', 'cent', 'French Guiana', 'GF', 'GUF', 'French Guiana', '019', '005', 0, 0, 0, NULL, NULL),
	(258, 'Papeete', 'Polynesian', '258', 'CFP franc', 'XPF', 'centime', 'French Polynesia', 'PF', 'PYF', 'French Polynesia', '009', '061', 0, 0, 0, NULL, NULL),
	(260, 'Port-aux-Francais', 'of French Southern and Antarctic Lands', '260', 'euro', 'EUR', 'cent', 'French Southern and Antarctic Lands', 'TF', 'ATF', 'French Southern Territories', '', '', 0, 0, 0, NULL, NULL),
	(262, 'Djibouti', 'Djiboutian', '262', 'Djibouti franc', 'DJF', '', 'Republic of Djibouti', 'DJ', 'DJI', 'Djibouti', '002', '014', 0, 0, 0, NULL, NULL),
	(266, 'Libreville', 'Gabonese', '266', 'CFA franc (BEAC)', 'XAF', 'centime', 'Gabonese Republic', 'GA', 'GAB', 'Gabon', '002', '017', 0, 0, 0, NULL, NULL),
	(268, 'Tbilisi', 'Georgian', '268', 'lari', 'GEL', 'tetri (inv.)', 'Georgia', 'GE', 'GEO', 'Georgia', '142', '145', 0, 0, 0, NULL, NULL),
	(270, 'Banjul', 'Gambian', '270', 'dalasi (inv.)', 'GMD', 'butut', 'Republic of the Gambia', 'GM', 'GMB', 'Gambia', '002', '011', 0, 0, 0, NULL, NULL),
	(275, NULL, 'Palestinian', '275', NULL, NULL, NULL, NULL, 'PS', 'PSE', 'Palestinian Territory, Occupied', '142', '145', 0, 0, 0, NULL, NULL),
	(276, 'Berlin', 'German', '276', 'euro', 'EUR', 'cent', 'Federal Republic of Germany', 'DE', 'DEU', 'Germany', '150', '155', 1, 1, 1, NULL, NULL),
	(288, 'Accra', 'Ghanaian', '288', 'Ghana cedi', 'GHS', 'pesewa', 'Republic of Ghana', 'GH', 'GHA', 'Ghana', '002', '011', 0, 0, 0, NULL, NULL),
	(292, 'Gibraltar', 'Gibraltarian', '292', 'Gibraltar pound', 'GIP', 'penny', 'Gibraltar', 'GI', 'GIB', 'Gibraltar', '150', '039', 0, 0, 0, NULL, NULL),
	(296, 'Tarawa', 'Kiribatian', '296', 'Australian dollar', 'AUD', 'cent', 'Republic of Kiribati', 'KI', 'KIR', 'Kiribati', '009', '057', 0, 0, 0, NULL, NULL),
	(300, 'Athens', 'Greek', '300', 'euro', 'EUR', 'cent', 'Hellenic Republic', 'GR', 'GRC', 'Greece', '150', '039', 1, 0, 1, NULL, NULL),
	(304, 'Nuuk', 'Greenlander', '304', 'Danish krone', 'DKK', 'øre (inv.)', 'Greenland', 'GL', 'GRL', 'Greenland', '019', '021', 0, 1, 0, NULL, NULL),
	(308, 'St George’s', 'Grenadian', '308', 'East Caribbean dollar', 'XCD', 'cent', 'Grenada', 'GD', 'GRD', 'Grenada', '019', '029', 0, 0, 0, NULL, NULL),
	(312, 'Basse Terre', 'Guadeloupean', '312', 'euro', 'EUR ', 'cent', 'Guadeloupe', 'GP', 'GLP', 'Guadeloupe', '019', '029', 0, 0, 0, NULL, NULL),
	(316, 'Agaña (Hagåtña)', 'Guamanian', '316', 'US dollar', 'USD', 'cent', 'Territory of Guam', 'GU', 'GUM', 'Guam', '009', '057', 0, 0, 0, NULL, NULL),
	(320, 'Guatemala City', 'Guatemalan', '320', 'quetzal (pl. quetzales)', 'GTQ', 'centavo', 'Republic of Guatemala', 'GT', 'GTM', 'Guatemala', '019', '013', 0, 0, 0, NULL, NULL),
	(324, 'Conakry', 'Guinean', '324', 'Guinean franc', 'GNF', '', 'Republic of Guinea', 'GN', 'GIN', 'Guinea', '002', '011', 0, 0, 0, NULL, NULL),
	(328, 'Georgetown', 'Guyanese', '328', 'Guyana dollar', 'GYD', 'cent', 'Cooperative Republic of Guyana', 'GY', 'GUY', 'Guyana', '019', '005', 0, 0, 0, NULL, NULL),
	(332, 'Port-au-Prince', 'Haitian', '332', 'gourde', 'HTG', 'centime', 'Republic of Haiti', 'HT', 'HTI', 'Haiti', '019', '029', 0, 0, 0, NULL, NULL),
	(334, 'Territory of Heard Island and McDonald Islands', 'of Territory of Heard Island and McDonald Islands', '334', '', '', '', 'Territory of Heard Island and McDonald Islands', 'HM', 'HMD', 'Heard Island and McDonald Islands', '', '', 0, 0, 0, NULL, NULL),
	(336, 'Vatican City', 'of the Holy See/of the Vatican', '336', 'euro', 'EUR', 'cent', 'the Holy See/ Vatican City State', 'VA', 'VAT', 'Holy See (Vatican City State)', '150', '039', 0, 0, 0, NULL, NULL),
	(340, 'Tegucigalpa', 'Honduran', '340', 'lempira', 'HNL', 'centavo', 'Republic of Honduras', 'HN', 'HND', 'Honduras', '019', '013', 0, 0, 0, NULL, NULL),
	(344, '(HK3)', 'Hong Kong Chinese', '344', 'Hong Kong dollar', 'HKD', 'cent', 'Hong Kong Special Administrative Region of the People’s Republic of China (HK2)', 'HK', 'HKG', 'Hong Kong', '142', '030', 0, 0, 0, NULL, NULL),
	(348, 'Budapest', 'Hungarian', '348', 'forint (inv.)', 'HUF', '(fillér (inv.))', 'Republic of Hungary', 'HU', 'HUN', 'Hungary', '150', '151', 1, 0, 1, NULL, NULL),
	(352, 'Reykjavik', 'Icelander', '352', 'króna (pl. krónur)', 'ISK', '', 'Republic of Iceland', 'IS', 'ISL', 'Iceland', '150', '154', 1, 1, 1, NULL, NULL),
	(356, 'New Delhi', 'Indian', '356', 'Indian rupee', 'INR', 'paisa', 'Republic of India', 'IN', 'IND', 'India', '142', '034', 0, 0, 0, NULL, NULL),
	(360, 'Jakarta', 'Indonesian', '360', 'Indonesian rupiah (inv.)', 'IDR', 'sen (inv.)', 'Republic of Indonesia', 'ID', 'IDN', 'Indonesia', '142', '035', 0, 0, 0, NULL, NULL),
	(364, 'Tehran', 'Iranian', '364', 'Iranian rial', 'IRR', '(dinar) (IR1)', 'Islamic Republic of Iran', 'IR', 'IRN', 'Iran, Islamic Republic of', '142', '034', 0, 0, 0, NULL, NULL),
	(368, 'Baghdad', 'Iraqi', '368', 'Iraqi dinar', 'IQD', 'fils (inv.)', 'Republic of Iraq', 'IQ', 'IRQ', 'Iraq', '142', '145', 0, 0, 0, NULL, NULL),
	(372, 'Dublin', 'Irish', '372', 'euro', 'EUR', 'cent', 'Ireland (IE1)', 'IE', 'IRL', 'Ireland', '150', '154', 1, 0, 0, ',', '.'),
	(376, '(IL1)', 'Israeli', '376', 'shekel', 'ILS', 'agora', 'State of Israel', 'IL', 'ISR', 'Israel', '142', '145', 0, 1, 0, NULL, NULL),
	(380, 'Rome', 'Italian', '380', 'euro', 'EUR', 'cent', 'Italian Republic', 'IT', 'ITA', 'Italy', '150', '039', 1, 1, 1, NULL, NULL),
	(384, 'Yamoussoukro (CI1)', 'Ivorian', '384', 'CFA franc (BCEAO)', 'XOF', 'centime', 'Republic of Côte d’Ivoire', 'CI', 'CIV', 'Côte d\'Ivoire', '002', '011', 0, 0, 0, NULL, NULL),
	(388, 'Kingston', 'Jamaican', '388', 'Jamaica dollar', 'JMD', 'cent', 'Jamaica', 'JM', 'JAM', 'Jamaica', '019', '029', 0, 0, 0, NULL, NULL),
	(392, 'Tokyo', 'Japanese', '392', 'yen (inv.)', 'JPY', '(sen (inv.)) (JP1)', 'Japan', 'JP', 'JPN', 'Japan', '142', '030', 0, 0, 0, NULL, NULL),
	(398, 'Astana', 'Kazakh', '398', 'tenge (inv.)', 'KZT', 'tiyn', 'Republic of Kazakhstan', 'KZ', 'KAZ', 'Kazakhstan', '142', '143', 0, 0, 0, NULL, NULL),
	(400, 'Amman', 'Jordanian', '400', 'Jordanian dinar', 'JOD', '100 qirsh', 'Hashemite Kingdom of Jordan', 'JO', 'JOR', 'Jordan', '142', '145', 0, 0, 0, NULL, NULL),
	(404, 'Nairobi', 'Kenyan', '404', 'Kenyan shilling', 'KES', 'cent', 'Republic of Kenya', 'KE', 'KEN', 'Kenya', '002', '014', 0, 0, 0, NULL, NULL),
	(408, 'Pyongyang', 'North Korean', '408', 'North Korean won (inv.)', 'KPW', 'chun (inv.)', 'Democratic People’s Republic of Korea', 'KP', 'PRK', 'Korea, Democratic People\'s Republic of', '142', '030', 0, 0, 0, NULL, NULL),
	(410, 'Seoul', 'South Korean', '410', 'South Korean won (inv.)', 'KRW', '(chun (inv.))', 'Republic of Korea', 'KR', 'KOR', 'Korea, Republic of', '142', '030', 0, 0, 0, NULL, NULL),
	(414, 'Kuwait City', 'Kuwaiti', '414', 'Kuwaiti dinar', 'KWD', 'fils (inv.)', 'State of Kuwait', 'KW', 'KWT', 'Kuwait', '142', '145', 0, 0, 0, NULL, NULL),
	(417, 'Bishkek', 'Kyrgyz', '417', 'som', 'KGS', 'tyiyn', 'Kyrgyz Republic', 'KG', 'KGZ', 'Kyrgyzstan', '142', '143', 0, 0, 0, NULL, NULL),
	(418, 'Vientiane', 'Lao', '418', 'kip (inv.)', 'LAK', '(at (inv.))', 'Lao People’s Democratic Republic', 'LA', 'LAO', 'Lao People\'s Democratic Republic', '142', '035', 0, 0, 0, NULL, NULL),
	(422, 'Beirut', 'Lebanese', '422', 'Lebanese pound', 'LBP', '(piastre)', 'Lebanese Republic', 'LB', 'LBN', 'Lebanon', '142', '145', 0, 0, 0, NULL, NULL),
	(426, 'Maseru', 'Basotho', '426', 'loti (pl. maloti)', 'LSL', 'sente', 'Kingdom of Lesotho', 'LS', 'LSO', 'Lesotho', '002', '018', 0, 0, 0, NULL, NULL),
	(428, 'Riga', 'Latvian', '428', 'euro', 'EUR', 'cent', 'Republic of Latvia', 'LV', 'LVA', 'Latvia', '150', '154', 1, 0, 0, NULL, NULL),
	(430, 'Monrovia', 'Liberian', '430', 'Liberian dollar', 'LRD', 'cent', 'Republic of Liberia', 'LR', 'LBR', 'Liberia', '002', '011', 0, 0, 0, NULL, NULL),
	(434, 'Tripoli', 'Libyan', '434', 'Libyan dinar', 'LYD', 'dirham', 'Socialist People’s Libyan Arab Jamahiriya', 'LY', 'LBY', 'Libya', '002', '015', 0, 0, 0, NULL, NULL),
	(438, 'Vaduz', 'Liechtensteiner', '438', 'Swiss franc', 'CHF', 'centime', 'Principality of Liechtenstein', 'LI', 'LIE', 'Liechtenstein', '150', '155', 1, 0, 0, NULL, NULL),
	(440, 'Vilnius', 'Lithuanian', '440', 'euro', 'EUR', 'cent', 'Republic of Lithuania', 'LT', 'LTU', 'Lithuania', '150', '154', 1, 0, 1, NULL, NULL),
	(442, 'Luxembourg', 'Luxembourger', '442', 'euro', 'EUR', 'cent', 'Grand Duchy of Luxembourg', 'LU', 'LUX', 'Luxembourg', '150', '155', 1, 1, 0, NULL, NULL),
	(446, 'Macao (MO3)', 'Macanese', '446', 'pataca', 'MOP', 'avo', 'Macao Special Administrative Region of the People’s Republic of China (MO2)', 'MO', 'MAC', 'Macao', '142', '030', 0, 0, 0, NULL, NULL),
	(450, 'Antananarivo', 'Malagasy', '450', 'ariary', 'MGA', 'iraimbilanja (inv.)', 'Republic of Madagascar', 'MG', 'MDG', 'Madagascar', '002', '014', 0, 0, 0, NULL, NULL),
	(454, 'Lilongwe', 'Malawian', '454', 'Malawian kwacha (inv.)', 'MWK', 'tambala (inv.)', 'Republic of Malawi', 'MW', 'MWI', 'Malawi', '002', '014', 0, 0, 0, NULL, NULL),
	(458, 'Kuala Lumpur (MY1)', 'Malaysian', '458', 'ringgit (inv.)', 'MYR', 'sen (inv.)', 'Malaysia', 'MY', 'MYS', 'Malaysia', '142', '035', 0, 1, 0, NULL, NULL),
	(462, 'Malé', 'Maldivian', '462', 'rufiyaa', 'MVR', 'laari (inv.)', 'Republic of Maldives', 'MV', 'MDV', 'Maldives', '142', '034', 0, 0, 0, NULL, NULL),
	(466, 'Bamako', 'Malian', '466', 'CFA franc (BCEAO)', 'XOF', 'centime', 'Republic of Mali', 'ML', 'MLI', 'Mali', '002', '011', 0, 0, 0, NULL, NULL),
	(470, 'Valletta', 'Maltese', '470', 'euro', 'EUR', 'cent', 'Republic of Malta', 'MT', 'MLT', 'Malta', '150', '039', 1, 0, 0, NULL, NULL),
	(474, 'Fort-de-France', 'Martinican', '474', 'euro', 'EUR', 'cent', 'Martinique', 'MQ', 'MTQ', 'Martinique', '019', '029', 0, 0, 0, NULL, NULL),
	(478, 'Nouakchott', 'Mauritanian', '478', 'ouguiya', 'MRO', 'khoum', 'Islamic Republic of Mauritania', 'MR', 'MRT', 'Mauritania', '002', '011', 0, 0, 0, NULL, NULL),
	(480, 'Port Louis', 'Mauritian', '480', 'Mauritian rupee', 'MUR', 'cent', 'Republic of Mauritius', 'MU', 'MUS', 'Mauritius', '002', '014', 0, 0, 0, NULL, NULL),
	(484, 'Mexico City', 'Mexican', '484', 'Mexican peso', 'MXN', 'centavo', 'United Mexican States', 'MX', 'MEX', 'Mexico', '019', '013', 0, 1, 0, NULL, NULL),
	(492, 'Monaco', 'Monegasque', '492', 'euro', 'EUR', 'cent', 'Principality of Monaco', 'MC', 'MCO', 'Monaco', '150', '155', 0, 0, 0, NULL, NULL),
	(496, 'Ulan Bator', 'Mongolian', '496', 'tugrik', 'MNT', 'möngö (inv.)', 'Mongolia', 'MN', 'MNG', 'Mongolia', '142', '030', 0, 0, 0, NULL, NULL),
	(498, 'Chisinau', 'Moldovan', '498', 'Moldovan leu (pl. lei)', 'MDL', 'ban', 'Republic of Moldova', 'MD', 'MDA', 'Moldova, Republic of', '150', '151', 0, 0, 0, NULL, NULL),
	(499, 'Podgorica', 'Montenegrin', '499', 'euro', 'EUR', 'cent', 'Montenegro', 'ME', 'MNE', 'Montenegro', '150', '039', 0, 0, 0, NULL, NULL),
	(500, 'Plymouth (MS2)', 'Montserratian', '500', 'East Caribbean dollar', 'XCD', 'cent', 'Montserrat', 'MS', 'MSR', 'Montserrat', '019', '029', 0, 0, 0, NULL, NULL),
	(504, 'Rabat', 'Moroccan', '504', 'Moroccan dirham', 'MAD', 'centime', 'Kingdom of Morocco', 'MA', 'MAR', 'Morocco', '002', '015', 0, 0, 0, NULL, NULL),
	(508, 'Maputo', 'Mozambican', '508', 'metical', 'MZN', 'centavo', 'Republic of Mozambique', 'MZ', 'MOZ', 'Mozambique', '002', '014', 0, 0, 0, NULL, NULL),
	(512, 'Muscat', 'Omani', '512', 'Omani rial', 'OMR', 'baiza', 'Sultanate of Oman', 'OM', 'OMN', 'Oman', '142', '145', 0, 0, 0, NULL, NULL),
	(516, 'Windhoek', 'Namibian', '516', 'Namibian dollar', 'NAD', 'cent', 'Republic of Namibia', 'NA', 'NAM', 'Namibia', '002', '018', 0, 0, 0, NULL, NULL),
	(520, 'Yaren', 'Nauruan', '520', 'Australian dollar', 'AUD', 'cent', 'Republic of Nauru', 'NR', 'NRU', 'Nauru', '009', '057', 0, 0, 0, NULL, NULL),
	(524, 'Kathmandu', 'Nepalese', '524', 'Nepalese rupee', 'NPR', 'paisa (inv.)', 'Nepal', 'NP', 'NPL', 'Nepal', '142', '034', 0, 0, 0, NULL, NULL),
	(528, 'Amsterdam (NL2)', 'Dutch', '528', 'euro', 'EUR', 'cent', 'Kingdom of the Netherlands', 'NL', 'NLD', 'Netherlands', '150', '155', 1, 1, 0, NULL, NULL),
	(531, 'Willemstad', 'Curaçaoan', '531', 'Netherlands Antillean guilder (CW1)', 'ANG', 'cent', 'Curaçao', 'CW', 'CUW', 'Curaçao', '019', '029', 0, 0, 0, NULL, NULL),
	(533, 'Oranjestad', 'Aruban', '533', 'Aruban guilder', 'AWG', 'cent', 'Aruba', 'AW', 'ABW', 'Aruba', '019', '029', 0, 0, 0, NULL, NULL),
	(534, 'Philipsburg', 'Sint Maartener', '534', 'Netherlands Antillean guilder (SX1)', 'ANG', 'cent', 'Sint Maarten', 'SX', 'SXM', 'Sint Maarten (Dutch part)', '019', '029', 0, 0, 0, NULL, NULL),
	(535, NULL, 'of Bonaire, Sint Eustatius and Saba', '535', 'US dollar', 'USD', 'cent', NULL, 'BQ', 'BES', 'Bonaire, Sint Eustatius and Saba', '019', '029', 0, 0, 0, NULL, NULL),
	(540, 'Nouméa', 'New Caledonian', '540', 'CFP franc', 'XPF', 'centime', 'New Caledonia', 'NC', 'NCL', 'New Caledonia', '009', '054', 0, 0, 0, NULL, NULL),
	(548, 'Port Vila', 'Vanuatuan', '548', 'vatu (inv.)', 'VUV', '', 'Republic of Vanuatu', 'VU', 'VUT', 'Vanuatu', '009', '054', 0, 0, 0, NULL, NULL),
	(554, 'Wellington', 'New Zealander', '554', 'New Zealand dollar', 'NZD', 'cent', 'New Zealand', 'NZ', 'NZL', 'New Zealand', '009', '053', 0, 0, 0, NULL, NULL),
	(558, 'Managua', 'Nicaraguan', '558', 'córdoba oro', 'NIO', 'centavo', 'Republic of Nicaragua', 'NI', 'NIC', 'Nicaragua', '019', '013', 0, 0, 0, NULL, NULL),
	(562, 'Niamey', 'Nigerien', '562', 'CFA franc (BCEAO)', 'XOF', 'centime', 'Republic of Niger', 'NE', 'NER', 'Niger', '002', '011', 0, 0, 0, NULL, NULL),
	(566, 'Abuja', 'Nigerian', '566', 'naira (inv.)', 'NGN', 'kobo (inv.)', 'Federal Republic of Nigeria', 'NG', 'NGA', 'Nigeria', '002', '011', 0, 0, 0, NULL, NULL),
	(570, 'Alofi', 'Niuean', '570', 'New Zealand dollar', 'NZD', 'cent', 'Niue', 'NU', 'NIU', 'Niue', '009', '061', 0, 0, 0, NULL, NULL),
	(574, 'Kingston', 'Norfolk Islander', '574', 'Australian dollar', 'AUD', 'cent', 'Territory of Norfolk Island', 'NF', 'NFK', 'Norfolk Island', '009', '053', 0, 0, 0, NULL, NULL),
	(578, 'Oslo', 'Norwegian', '578', 'Norwegian krone (pl. kroner)', 'NOK', 'øre (inv.)', 'Kingdom of Norway', 'NO', 'NOR', 'Norway', '150', '154', 1, 0, 0, NULL, NULL),
	(580, 'Saipan', 'Northern Mariana Islander', '580', 'US dollar', 'USD', 'cent', 'Commonwealth of the Northern Mariana Islands', 'MP', 'MNP', 'Northern Mariana Islands', '009', '057', 0, 0, 0, NULL, NULL),
	(581, 'United States Minor Outlying Islands', 'of United States Minor Outlying Islands', '581', 'US dollar', 'USD', 'cent', 'United States Minor Outlying Islands', 'UM', 'UMI', 'United States Minor Outlying Islands', '', '', 0, 0, 0, NULL, NULL),
	(583, 'Palikir', 'Micronesian', '583', 'US dollar', 'USD', 'cent', 'Federated States of Micronesia', 'FM', 'FSM', 'Micronesia, Federated States of', '009', '057', 0, 0, 0, NULL, NULL),
	(584, 'Majuro', 'Marshallese', '584', 'US dollar', 'USD', 'cent', 'Republic of the Marshall Islands', 'MH', 'MHL', 'Marshall Islands', '009', '057', 0, 0, 0, NULL, NULL),
	(585, 'Melekeok', 'Palauan', '585', 'US dollar', 'USD', 'cent', 'Republic of Palau', 'PW', 'PLW', 'Palau', '009', '057', 0, 0, 0, NULL, NULL),
	(586, 'Islamabad', 'Pakistani', '586', 'Pakistani rupee', 'PKR', 'paisa', 'Islamic Republic of Pakistan', 'PK', 'PAK', 'Pakistan', '142', '034', 0, 0, 0, NULL, NULL),
	(591, 'Panama City', 'Panamanian', '591', 'balboa', 'PAB', 'centésimo', 'Republic of Panama', 'PA', 'PAN', 'Panama', '019', '013', 0, 0, 0, NULL, NULL),
	(598, 'Port Moresby', 'Papua New Guinean', '598', 'kina (inv.)', 'PGK', 'toea (inv.)', 'Independent State of Papua New Guinea', 'PG', 'PNG', 'Papua New Guinea', '009', '054', 0, 0, 0, NULL, NULL),
	(600, 'Asunción', 'Paraguayan', '600', 'guaraní', 'PYG', 'céntimo', 'Republic of Paraguay', 'PY', 'PRY', 'Paraguay', '019', '005', 0, 0, 0, NULL, NULL),
	(604, 'Lima', 'Peruvian', '604', 'new sol', 'PEN', 'céntimo', 'Republic of Peru', 'PE', 'PER', 'Peru', '019', '005', 0, 0, 0, NULL, NULL),
	(608, 'Manila', 'Filipino', '608', 'Philippine peso', 'PHP', 'centavo', 'Republic of the Philippines', 'PH', 'PHL', 'Philippines', '142', '035', 0, 0, 0, NULL, NULL),
	(612, 'Adamstown', 'Pitcairner', '612', 'New Zealand dollar', 'NZD', 'cent', 'Pitcairn Islands', 'PN', 'PCN', 'Pitcairn', '009', '061', 0, 0, 0, NULL, NULL),
	(616, 'Warsaw', 'Polish', '616', 'zloty', 'PLN', 'grosz (pl. groszy)', 'Republic of Poland', 'PL', 'POL', 'Poland', '150', '151', 1, 1, 1, NULL, NULL),
	(620, 'Lisbon', 'Portuguese', '620', 'euro', 'EUR', 'cent', 'Portuguese Republic', 'PT', 'PRT', 'Portugal', '150', '039', 1, 1, 1, NULL, NULL),
	(624, 'Bissau', 'Guinea-Bissau national', '624', 'CFA franc (BCEAO)', 'XOF', 'centime', 'Republic of Guinea-Bissau', 'GW', 'GNB', 'Guinea-Bissau', '002', '011', 0, 0, 0, NULL, NULL),
	(626, 'Dili', 'East Timorese', '626', 'US dollar', 'USD', 'cent', 'Democratic Republic of East Timor', 'TL', 'TLS', 'Timor-Leste', '142', '035', 0, 0, 0, NULL, NULL),
	(630, 'San Juan', 'Puerto Rican', '630', 'US dollar', 'USD', 'cent', 'Commonwealth of Puerto Rico', 'PR', 'PRI', 'Puerto Rico', '019', '029', 0, 0, 0, NULL, NULL),
	(634, 'Doha', 'Qatari', '634', 'Qatari riyal', 'QAR', 'dirham', 'State of Qatar', 'QA', 'QAT', 'Qatar', '142', '145', 0, 0, 0, NULL, NULL),
	(638, 'Saint-Denis', 'Reunionese', '638', 'euro', 'EUR', 'cent', 'Réunion', 'RE', 'REU', 'Réunion', '002', '014', 0, 0, 0, NULL, NULL),
	(642, 'Bucharest', 'Romanian', '642', 'Romanian leu (pl. lei)', 'RON', 'ban (pl. bani)', 'Romania', 'RO', 'ROU', 'Romania', '150', '151', 1, 0, 1, NULL, NULL),
	(643, 'Moscow', 'Russian', '643', 'Russian rouble', 'RUB', 'kopek', 'Russian Federation', 'RU', 'RUS', 'Russian Federation', '150', '151', 0, 0, 0, NULL, NULL),
	(646, 'Kigali', 'Rwandan; Rwandese', '646', 'Rwandese franc', 'RWF', 'centime', 'Republic of Rwanda', 'RW', 'RWA', 'Rwanda', '002', '014', 0, 0, 0, NULL, NULL),
	(652, 'Gustavia', 'of Saint Barthélemy', '652', 'euro', 'EUR', 'cent', 'Collectivity of Saint Barthélemy', 'BL', 'BLM', 'Saint Barthélemy', '019', '029', 0, 0, 0, NULL, NULL),
	(654, 'Jamestown', 'Saint Helenian', '654', 'Saint Helena pound', 'SHP', 'penny', 'Saint Helena, Ascension and Tristan da Cunha', 'SH', 'SHN', 'Saint Helena, Ascension and Tristan da Cunha', '002', '011', 0, 0, 0, NULL, NULL),
	(659, 'Basseterre', 'Kittsian; Nevisian', '659', 'East Caribbean dollar', 'XCD', 'cent', 'Federation of Saint Kitts and Nevis', 'KN', 'KNA', 'Saint Kitts and Nevis', '019', '029', 0, 0, 0, NULL, NULL),
	(660, 'The Valley', 'Anguillan', '660', 'East Caribbean dollar', 'XCD', 'cent', 'Anguilla', 'AI', 'AIA', 'Anguilla', '019', '029', 0, 0, 0, NULL, NULL),
	(662, 'Castries', 'Saint Lucian', '662', 'East Caribbean dollar', 'XCD', 'cent', 'Saint Lucia', 'LC', 'LCA', 'Saint Lucia', '019', '029', 0, 0, 0, NULL, NULL),
	(663, 'Marigot', 'of Saint Martin', '663', 'euro', 'EUR', 'cent', 'Collectivity of Saint Martin', 'MF', 'MAF', 'Saint Martin (French part)', '019', '029', 0, 0, 0, NULL, NULL),
	(666, 'Saint-Pierre', 'St-Pierrais; Miquelonnais', '666', 'euro', 'EUR', 'cent', 'Territorial Collectivity of Saint Pierre and Miquelon', 'PM', 'SPM', 'Saint Pierre and Miquelon', '019', '021', 0, 0, 0, NULL, NULL),
	(670, 'Kingstown', 'Vincentian', '670', 'East Caribbean dollar', 'XCD', 'cent', 'Saint Vincent and the Grenadines', 'VC', 'VCT', 'Saint Vincent and the Grenadines', '019', '029', 0, 0, 0, NULL, NULL),
	(674, 'San Marino', 'San Marinese', '674', 'euro', 'EUR ', 'cent', 'Republic of San Marino', 'SM', 'SMR', 'San Marino', '150', '039', 0, 0, 0, NULL, NULL),
	(678, 'São Tomé', 'São Toméan', '678', 'dobra', 'STD', 'centavo', 'Democratic Republic of São Tomé and Príncipe', 'ST', 'STP', 'Sao Tome and Principe', '002', '017', 0, 0, 0, NULL, NULL),
	(682, 'Riyadh', 'Saudi Arabian', '682', 'riyal', 'SAR', 'halala', 'Kingdom of Saudi Arabia', 'SA', 'SAU', 'Saudi Arabia', '142', '145', 0, 0, 0, NULL, NULL),
	(686, 'Dakar', 'Senegalese', '686', 'CFA franc (BCEAO)', 'XOF', 'centime', 'Republic of Senegal', 'SN', 'SEN', 'Senegal', '002', '011', 0, 0, 0, NULL, NULL),
	(688, 'Belgrade', 'Serb', '688', 'Serbian dinar', 'RSD', 'para (inv.)', 'Republic of Serbia', 'RS', 'SRB', 'Serbia', '150', '039', 0, 0, 0, NULL, NULL),
	(690, 'Victoria', 'Seychellois', '690', 'Seychelles rupee', 'SCR', 'cent', 'Republic of Seychelles', 'SC', 'SYC', 'Seychelles', '002', '014', 0, 0, 0, NULL, NULL),
	(694, 'Freetown', 'Sierra Leonean', '694', 'leone', 'SLL', 'cent', 'Republic of Sierra Leone', 'SL', 'SLE', 'Sierra Leone', '002', '011', 0, 0, 0, NULL, NULL),
	(702, 'Singapore', 'Singaporean', '702', 'Singapore dollar', 'SGD', 'cent', 'Republic of Singapore', 'SG', 'SGP', 'Singapore', '142', '035', 0, 0, 0, NULL, NULL),
	(703, 'Bratislava', 'Slovak', '703', 'euro', 'EUR', 'cent', 'Slovak Republic', 'SK', 'SVK', 'Slovakia', '150', '151', 1, 0, 1, NULL, NULL),
	(704, 'Hanoi', 'Vietnamese', '704', 'dong', 'VND', '(10 hào', 'Socialist Republic of Vietnam', 'VN', 'VNM', 'Viet Nam', '142', '035', 0, 0, 0, NULL, NULL),
	(705, 'Ljubljana', 'Slovene', '705', 'euro', 'EUR', 'cent', 'Republic of Slovenia', 'SI', 'SVN', 'Slovenia', '150', '039', 1, 0, 1, NULL, NULL),
	(706, 'Mogadishu', 'Somali', '706', 'Somali shilling', 'SOS', 'cent', 'Somali Republic', 'SO', 'SOM', 'Somalia', '002', '014', 0, 0, 0, NULL, NULL),
	(710, 'Pretoria (ZA1)', 'South African', '710', 'rand', 'ZAR', 'cent', 'Republic of South Africa', 'ZA', 'ZAF', 'South Africa', '002', '018', 0, 0, 0, NULL, NULL),
	(716, 'Harare', 'Zimbabwean', '716', 'Zimbabwe dollar (ZW1)', 'ZWL', 'cent', 'Republic of Zimbabwe', 'ZW', 'ZWE', 'Zimbabwe', '002', '014', 0, 0, 0, NULL, NULL),
	(724, 'Madrid', 'Spaniard', '724', 'euro', 'EUR', 'cent', 'Kingdom of Spain', 'ES', 'ESP', 'Spain', '150', '039', 1, 1, 1, NULL, NULL),
	(728, 'Juba', 'South Sudanese', '728', 'South Sudanese pound', 'SSP', 'piaster', 'Republic of South Sudan', 'SS', 'SSD', 'South Sudan', '002', '015', 0, 0, 0, NULL, NULL),
	(729, 'Khartoum', 'Sudanese', '729', 'Sudanese pound', 'SDG', 'piastre', 'Republic of the Sudan', 'SD', 'SDN', 'Sudan', '002', '015', 0, 0, 0, NULL, NULL),
	(732, 'Al aaiun', 'Sahrawi', '732', 'Moroccan dirham', 'MAD', 'centime', 'Western Sahara', 'EH', 'ESH', 'Western Sahara', '002', '015', 0, 0, 0, NULL, NULL),
	(740, 'Paramaribo', 'Surinamese', '740', 'Surinamese dollar', 'SRD', 'cent', 'Republic of Suriname', 'SR', 'SUR', 'Suriname', '019', '005', 0, 0, 0, NULL, NULL),
	(744, 'Longyearbyen', 'of Svalbard', '744', 'Norwegian krone (pl. kroner)', 'NOK', 'øre (inv.)', 'Svalbard and Jan Mayen', 'SJ', 'SJM', 'Svalbard and Jan Mayen', '150', '154', 0, 0, 0, NULL, NULL),
	(748, 'Mbabane', 'Swazi', '748', 'lilangeni', 'SZL', 'cent', 'Kingdom of Swaziland', 'SZ', 'SWZ', 'Swaziland', '002', '018', 0, 0, 0, NULL, NULL),
	(752, 'Stockholm', 'Swedish', '752', 'krona (pl. kronor)', 'SEK', 'öre (inv.)', 'Kingdom of Sweden', 'SE', 'SWE', 'Sweden', '150', '154', 1, 1, 1, NULL, NULL),
	(756, 'Berne', 'Swiss', '756', 'Swiss franc', 'CHF', 'centime', 'Swiss Confederation', 'CH', 'CHE', 'Switzerland', '150', '155', 1, 1, 0, NULL, NULL),
	(760, 'Damascus', 'Syrian', '760', 'Syrian pound', 'SYP', 'piastre', 'Syrian Arab Republic', 'SY', 'SYR', 'Syrian Arab Republic', '142', '145', 0, 0, 0, NULL, NULL),
	(762, 'Dushanbe', 'Tajik', '762', 'somoni', 'TJS', 'diram', 'Republic of Tajikistan', 'TJ', 'TJK', 'Tajikistan', '142', '143', 0, 0, 0, NULL, NULL),
	(764, 'Bangkok', 'Thai', '764', 'baht (inv.)', 'THB', 'satang (inv.)', 'Kingdom of Thailand', 'TH', 'THA', 'Thailand', '142', '035', 0, 0, 0, NULL, NULL),
	(768, 'Lomé', 'Togolese', '768', 'CFA franc (BCEAO)', 'XOF', 'centime', 'Togolese Republic', 'TG', 'TGO', 'Togo', '002', '011', 0, 0, 0, NULL, NULL),
	(772, '(TK2)', 'Tokelauan', '772', 'New Zealand dollar', 'NZD', 'cent', 'Tokelau', 'TK', 'TKL', 'Tokelau', '009', '061', 0, 0, 0, NULL, NULL),
	(776, 'Nuku’alofa', 'Tongan', '776', 'pa’anga (inv.)', 'TOP', 'seniti (inv.)', 'Kingdom of Tonga', 'TO', 'TON', 'Tonga', '009', '061', 0, 0, 0, NULL, NULL),
	(780, 'Port of Spain', 'Trinidadian; Tobagonian', '780', 'Trinidad and Tobago dollar', 'TTD', 'cent', 'Republic of Trinidad and Tobago', 'TT', 'TTO', 'Trinidad and Tobago', '019', '029', 0, 0, 0, NULL, NULL),
	(784, 'Abu Dhabi', 'Emirian', '784', 'UAE dirham', 'AED', 'fils (inv.)', 'United Arab Emirates', 'AE', 'ARE', 'United Arab Emirates', '142', '145', 0, 0, 0, NULL, NULL),
	(788, 'Tunis', 'Tunisian', '788', 'Tunisian dinar', 'TND', 'millime', 'Republic of Tunisia', 'TN', 'TUN', 'Tunisia', '002', '015', 0, 0, 0, NULL, NULL),
	(792, 'Ankara', 'Turk', '792', 'Turkish lira (inv.)', 'TRY', 'kurus (inv.)', 'Republic of Turkey', 'TR', 'TUR', 'Turkey', '142', '145', 0, 0, 0, NULL, NULL),
	(795, 'Ashgabat', 'Turkmen', '795', 'Turkmen manat (inv.)', 'TMT', 'tenge (inv.)', 'Turkmenistan', 'TM', 'TKM', 'Turkmenistan', '142', '143', 0, 0, 0, NULL, NULL),
	(796, 'Cockburn Town', 'Turks and Caicos Islander', '796', 'US dollar', 'USD', 'cent', 'Turks and Caicos Islands', 'TC', 'TCA', 'Turks and Caicos Islands', '019', '029', 0, 0, 0, NULL, NULL),
	(798, 'Funafuti', 'Tuvaluan', '798', 'Australian dollar', 'AUD', 'cent', 'Tuvalu', 'TV', 'TUV', 'Tuvalu', '009', '061', 0, 0, 0, NULL, NULL),
	(800, 'Kampala', 'Ugandan', '800', 'Uganda shilling', 'UGX', 'cent', 'Republic of Uganda', 'UG', 'UGA', 'Uganda', '002', '014', 0, 0, 0, NULL, NULL),
	(804, 'Kiev', 'Ukrainian', '804', 'hryvnia', 'UAH', 'kopiyka', 'Ukraine', 'UA', 'UKR', 'Ukraine', '150', '151', 0, 0, 0, NULL, NULL),
	(807, 'Skopje', 'of the former Yugoslav Republic of Macedonia', '807', 'denar (pl. denars)', 'MKD', 'deni (inv.)', 'the former Yugoslav Republic of Macedonia', 'MK', 'MKD', 'Macedonia, the former Yugoslav Republic of', '150', '039', 0, 0, 0, NULL, NULL),
	(818, 'Cairo', 'Egyptian', '818', 'Egyptian pound', 'EGP', 'piastre', 'Arab Republic of Egypt', 'EG', 'EGY', 'Egypt', '002', '015', 0, 0, 0, NULL, NULL),
	(826, 'London', 'British', '826', 'pound sterling', 'GBP', 'penny (pl. pence)', 'United Kingdom of Great Britain and Northern Ireland', 'GB', 'GBR', 'United Kingdom', '150', '154', 1, 0, 0, NULL, NULL),
	(831, 'St Peter Port', 'of Guernsey', '831', 'Guernsey pound (GG2)', 'GGP (GG2)', 'penny (pl. pence)', 'Bailiwick of Guernsey', 'GG', 'GGY', 'Guernsey', '150', '154', 0, 0, 0, NULL, NULL),
	(832, 'St Helier', 'of Jersey', '832', 'Jersey pound (JE2)', 'JEP (JE2)', 'penny (pl. pence)', 'Bailiwick of Jersey', 'JE', 'JEY', 'Jersey', '150', '154', 0, 0, 0, NULL, NULL),
	(833, 'Douglas', 'Manxman; Manxwoman', '833', 'Manx pound (IM2)', 'IMP (IM2)', 'penny (pl. pence)', 'Isle of Man', 'IM', 'IMN', 'Isle of Man', '150', '154', 0, 0, 0, NULL, NULL),
	(834, 'Dodoma (TZ1)', 'Tanzanian', '834', 'Tanzanian shilling', 'TZS', 'cent', 'United Republic of Tanzania', 'TZ', 'TZA', 'Tanzania, United Republic of', '002', '014', 0, 0, 0, NULL, NULL),
	(840, 'Washington DC', 'American', '840', 'US dollar', 'USD', 'cent', 'United States of America', 'US', 'USA', 'United States', '019', '021', 0, 0, 0, NULL, NULL),
	(850, 'Charlotte Amalie', 'US Virgin Islander', '850', 'US dollar', 'USD', 'cent', 'United States Virgin Islands', 'VI', 'VIR', 'Virgin Islands, U.S.', '019', '029', 0, 0, 0, NULL, NULL),
	(854, 'Ouagadougou', 'Burkinabe', '854', 'CFA franc (BCEAO)', 'XOF', 'centime', 'Burkina Faso', 'BF', 'BFA', 'Burkina Faso', '002', '011', 0, 0, 0, NULL, NULL),
	(858, 'Montevideo', 'Uruguayan', '858', 'Uruguayan peso', 'UYU', 'centésimo', 'Eastern Republic of Uruguay', 'UY', 'URY', 'Uruguay', '019', '005', 0, 1, 0, NULL, NULL),
	(860, 'Tashkent', 'Uzbek', '860', 'sum (inv.)', 'UZS', 'tiyin (inv.)', 'Republic of Uzbekistan', 'UZ', 'UZB', 'Uzbekistan', '142', '143', 0, 0, 0, NULL, NULL),
	(862, 'Caracas', 'Venezuelan', '862', 'bolívar fuerte (pl. bolívares fuertes)', 'VEF', 'céntimo', 'Bolivarian Republic of Venezuela', 'VE', 'VEN', 'Venezuela, Bolivarian Republic of', '019', '005', 0, 0, 0, NULL, NULL),
	(876, 'Mata-Utu', 'Wallisian; Futunan; Wallis and Futuna Islander', '876', 'CFP franc', 'XPF', 'centime', 'Wallis and Futuna', 'WF', 'WLF', 'Wallis and Futuna', '009', '061', 0, 0, 0, NULL, NULL),
	(882, 'Apia', 'Samoan', '882', 'tala (inv.)', 'WST', 'sene (inv.)', 'Independent State of Samoa', 'WS', 'WSM', 'Samoa', '009', '061', 0, 0, 0, NULL, NULL),
	(887, 'San’a', 'Yemenite', '887', 'Yemeni rial', 'YER', 'fils (inv.)', 'Republic of Yemen', 'YE', 'YEM', 'Yemen', '142', '145', 0, 0, 0, NULL, NULL),
	(894, 'Lusaka', 'Zambian', '894', 'Zambian kwacha (inv.)', 'ZMW', 'ngwee (inv.)', 'Republic of Zambia', 'ZM', 'ZMB', 'Zambia', '002', '014', 0, 0, 0, NULL, NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `precision_currency` int(1) NOT NULL,
  `thousand_separator` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `decimal_separator` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.currencies: ~32 rows (aproximadamente)
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` (`id`, `name`, `symbol`, `precision_currency`, `thousand_separator`, `decimal_separator`, `code`) VALUES
	(1, 'US Dollar', '$', 2, ',', '.', 'USD'),
	(2, 'Peso chileno', '$', 0, '.', ',', 'CLP'),
	(3, 'Euro', 'â‚¬', 2, '.', ',', 'EUR'),
	(4, 'D&oacute;lar Canadiense', '$', 2, '.', ',', 'CAD'),
	(5, 'Quetzal', 'Q', 2, '.', ',', 'GTQ'),
	(6, 'D&oacute;lar Belize', 'B', 2, ',', '.', 'BZD'),
	(7, 'Swedish Krona', 'kr ', 2, '.', ',', 'SEK'),
	(8, 'Kenyan Shilling', 'KSh ', 2, ',', '.', 'KES'),
	(9, 'Canadian Dollar', 'C$', 2, ',', '.', 'CAD'),
	(10, 'Philippine Peso', 'P ', 2, ',', '.', 'PHP'),
	(11, 'Indian Rupee', 'Rs. ', 2, ',', '.', 'INR'),
	(12, 'Australian Dollar', '$', 2, ',', '.', 'AUD'),
	(13, 'Singapore Dollar', 'SGD ', 2, ',', '.', 'SGD'),
	(14, 'Norske Kroner', 'kr ', 2, '.', ',', 'NOK'),
	(15, 'New Zealand Dollar', '$', 2, ',', '.', 'NZD'),
	(16, 'Vietnamese Dong', 'VND ', 0, '.', ',', 'VND'),
	(17, 'Swiss Franc', 'CHF ', 2, '\'', '.', 'CHF'),
	(18, 'Quetzal Guatemalteco', 'Q', 2, ',', '.', 'GTQ'),
	(19, 'Malaysian Ringgit', 'RM', 2, ',', '.', 'MYR'),
	(20, 'Real Brasile&ntilde;o', 'R$', 2, '.', ',', 'BRL'),
	(21, 'Thai Baht', 'THB ', 2, ',', '.', 'THB'),
	(22, 'Nigerian Naira', 'NGN ', 2, ',', '.', 'NGN'),
	(23, 'Peso Argentino', '$', 2, '.', ',', 'ARS'),
	(24, 'Bangladeshi Taka', 'Tk', 2, ',', '.', 'BDT'),
	(25, 'United Arab Emirates Dirham', 'DH ', 2, ',', '.', 'AED'),
	(26, 'Hong Kong Dollar', '$', 2, ',', '.', 'HKD'),
	(27, 'Indonesian Rupiah', 'Rp', 2, ',', '.', 'IDR'),
	(28, 'Peso Mexicano', '$', 2, ',', '.', 'MXN'),
	(29, 'Egyptian Pound', '&pou', 2, ',', '.', 'EGP'),
	(30, 'Peso Colombiano', '$', 2, '.', ',', 'COP'),
	(31, 'West African Franc', 'CFA ', 2, ',', '.', 'XOF'),
	(32, 'Chinese Renminbi', 'RMB ', 2, ',', '.', 'CNY');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `work_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_country_id_foreign` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla invensorteosuabc.customers: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.evidencia
CREATE TABLE IF NOT EXISTS `evidencia` (
  `evidencia_id` int(11) NOT NULL AUTO_INCREMENT,
  `model` int(11) NOT NULL,
  `product_name` int(11) NOT NULL,
  `note` text NOT NULL,
  `status` tinyint(2) DEFAULT 1 COMMENT '0=Inactive,1=Active, 2=Prestamo',
  `manufacturer_id` int(11) NOT NULL,
  `ubicaciones_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `buying_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `profit` varchar(100) NOT NULL,
  `presentation` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `image_path` varchar(300) NOT NULL,
  PRIMARY KEY (`evidencia_id`) USING BTREE,
  KEY `fk_manufacturer_id` (`manufacturer_id`) USING BTREE,
  KEY `fk_ubicacion_id` (`manufacturer_id`) USING BTREE,
  KEY `fk_categoria_id` (`categoria_id`) USING BTREE,
  KEY `fk_ubicaciones_id` (`ubicaciones_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla invensorteosuabc.evidencia: 0 rows
/*!40000 ALTER TABLE `evidencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `evidencia` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.informatica
CREATE TABLE IF NOT EXISTS `informatica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `ubucacion` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `marca` varchar(200) DEFAULT NULL,
  `modelo` varchar(200) DEFAULT NULL,
  `serie` varchar(200) DEFAULT NULL,
  `numero_control` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla invensorteosuabc.informatica: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `informatica` DISABLE KEYS */;
INSERT INTO `informatica` (`id`, `codigo`, `nombre`, `descripcion`, `ubucacion`, `date`, `marca`, `modelo`, `serie`, `numero_control`) VALUES
	(1, '6666', 'RODOLFO', '6666', 'INFFORMATICA', '2022-03-16 12:40:03', '666', '666', '666', '666');
/*!40000 ALTER TABLE `informatica` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.inventario
CREATE TABLE IF NOT EXISTS `inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `ubucacion` varchar(200) NOT NULL,
  `categoria` varchar(200) NOT NULL,
  `ordenCompra` varchar(100) NOT NULL,
  `costo` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `marca` varchar(200) DEFAULT NULL,
  `modelo` varchar(200) DEFAULT NULL,
  `serie` varchar(200) DEFAULT NULL,
  `fecha_adquisicion` date DEFAULT NULL,
  `num_factura` varchar(50) DEFAULT NULL,
  `num_poliza` varchar(50) DEFAULT NULL,
  `numero_control` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla invensorteosuabc.inventario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT INTO `inventario` (`id`, `codigo`, `nombre`, `descripcion`, `ubucacion`, `categoria`, `ordenCompra`, `costo`, `date`, `marca`, `modelo`, `serie`, `fecha_adquisicion`, `num_factura`, `num_poliza`, `numero_control`) VALUES
	(1, '6666', 'RODOLFO', '6666', 'INFFORMATICA', 'EQUIPO DE COMPUTO', '6666', '123', '2022-03-16 12:40:03', '666', '666', '666', '2021-11-07', '666', '666', '666');
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.inventory
CREATE TABLE IF NOT EXISTS `inventory` (
  `inventory_id` int(5) NOT NULL AUTO_INCREMENT,
  `product_id` int(5) NOT NULL,
  `product_quantity` int(5) NOT NULL,
  PRIMARY KEY (`inventory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.inventory: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` (`inventory_id`, `product_id`, `product_quantity`) VALUES
	(1, 1, 22);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.kardex
CREATE TABLE IF NOT EXISTS `kardex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` datetime NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(12,4) NOT NULL,
  `real_price` decimal(12,4) NOT NULL,
  `stock` int(11) NOT NULL,
  `note` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla invensorteosuabc.kardex: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `kardex` DISABLE KEYS */;
INSERT INTO `kardex` (`id`, `date_added`, `product_id`, `qty`, `price`, `real_price`, `stock`, `note`, `type`) VALUES
	(1, '2021-05-23 18:00:07', 1, 22, 22.0000, 22.0000, 22, 'Inventario Inicial', 1),
	(2, '2021-05-26 23:32:15', 1, 22, 12.0000, 12.0000, 22, 'Inventario Inicial', 1);
/*!40000 ALTER TABLE `kardex` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.manufacturers
CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.manufacturers: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` (`id`, `name`, `status`, `date_added`) VALUES
	(1, 'NACHO', 1, '2021-11-26 19:30:35'),
	(2, 'RODOLFO', 1, '2021-11-30 11:35:45');
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.modulos
CREATE TABLE IF NOT EXISTS `modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modulo` varchar(30) NOT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.modulos: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` (`id_modulo`, `nombre_modulo`) VALUES
	(1, 'Inicio'),
	(2, 'Productos'),
	(3, 'BienesB'),
	(4, 'BienesP'),
	(5, 'BienesT'),
	(6, 'BienesNi'),
	(7, 'Empleados'),
	(8, 'Ubicacion'),
	(9, 'Categoria'),
	(10, 'Programa'),
	(11, 'Subcuenta'),
	(12, 'Evidencia'),
	(13, 'Inventarios'),
	(14, 'Reportes'),
	(15, 'Permisos'),
	(16, 'Usuarios'),
	(17, 'Bienes'),
	(18, 'Informacion'),
	(19, 'registro');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(100) NOT NULL,
  `model` int(11) NOT NULL,
  `product_name` int(11) NOT NULL,
  `note` text NOT NULL,
  `status` tinyint(2) DEFAULT 1 COMMENT '0=Inactive,1=Active, 2=Active,3=Active,4=Active',
  `manufacturer_id` int(11) NOT NULL,
  `ubicaciones_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `buying_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `profit` varchar(100) NOT NULL,
  `presentation` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `image_path` varchar(300) NOT NULL,
  `marca` varchar(200) NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `serie` varchar(200) NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `num_factura` varchar(50) NOT NULL,
  `num_poliza` varchar(50) NOT NULL,
  `numero_control` varchar(50) NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_code` (`product_code`),
  KEY `fk_manufacturer_id` (`manufacturer_id`),
  KEY `fk_ubicacion_id` (`manufacturer_id`),
  KEY `fk_categoria_id` (`categoria_id`),
  KEY `fk_ubicaciones_id` (`ubicaciones_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla invensorteosuabc.products: 9 rows
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`product_id`, `product_code`, `model`, `product_name`, `note`, `status`, `manufacturer_id`, `ubicaciones_id`, `categoria_id`, `buying_price`, `selling_price`, `profit`, `presentation`, `created_at`, `image_path`, `marca`, `modelo`, `serie`, `fecha_adquisicion`, `num_factura`, `num_poliza`, `numero_control`) VALUES
	(1, '1111', 1, 1, '11111', 1, 1, 1, 1, 123498, 123498, '0', '11111', '2021-11-30 12:00:32', 'img/productos/1638295230_Captura de Pantalla 2021-11-03 a la(s) 11.48.20 a.m..png', 'HP', 'Pavilion Gaming', 'fdfd25asdg255e', '2021-11-01', '111111', '1111', '11111'),
	(6, '234567', 1, 1, 'SFSSFS', 1, 1, 1, 1, 1223, 1223, '0', '11111', '2022-03-01 18:39:57', 'img/productos/1646181595_Captura de Pantalla 2022-01-25 a la(s) 9.50.07 a.m. (1).png', '1111', '1111', '1111', '2022-03-01', '111111', '1111', '11111'),
	(3, '6666', 1, 1, '6666', 1, 2, 1, 1, 123, 123, '0', '666', '2021-11-30 12:03:07', 'img/productos/1638295385_Captura de Pantalla 2021-11-19 a la(s) 10.01.31 a.m..png', '666', '666', '666', '2021-11-07', '666', '666', '666'),
	(4, '999', 1, 1, '9999', 2, 1, 1, 1, 1223, 1223, '0', '9999', '2021-11-30 12:05:23', 'img/productos/1638295522_Captura de Pantalla 2021-11-19 a la(s) 12.54.12 p.m..png', '999', '999', '999', '2021-11-19', '9999', '999', '999'),
	(5, '888', 1, 1, '88888', 4, 2, 1, 1, 123498, 123498, '0', '888', '2021-11-30 12:08:18', 'img/productos/1638295688_Captura de Pantalla 2021-11-23 a la(s) 1.23.37 p.m..png', '888', '888', '8888', '2021-11-07', '8888', '888', '8888'),
	(7, '1221122211221122', 1, 1, 'vhvhvh', 1, 1, 1, 1, 1223, 1223, '0', '111111', '2022-03-23 17:51:01', 'img/productos/1648079453_module_table_bottom.png', 'dell', '3444', '2dde113', '2022-03-23', '12', '11111', '11111'),
	(8, '1971', 1, 1, 'sfsfsfs', 1, 1, 1, 1, 1223, 1223, '0', '111111', '2022-03-24 13:15:00', 'img/productos/1648149240_banner.jpg', 'dell', '3444', '2dde113', '2022-03-24', '12', '11111', '11111'),
	(9, '1972', 1, 1, 'sfsfsfs', 0, 1, 1, 1, 1223, 1223, '0', '111111', '2022-03-24 13:24:55', 'img/productos/1648149240_banner.jpg', 'dell', '3444', '2dde113', '2022-03-24', '12', '11111', '11111'),
	(10, '99999', 1, 1, 'computadora laptop', 1, 2, 1, 1, 10000, 10000, '0', '9999', '2022-04-17 18:50:10', 'img/productos/product.png', 'asus', 'gft-5556', '23456964', '2022-04-17', '56566', '56565', '6959');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.product_tmp
CREATE TABLE IF NOT EXISTS `product_tmp` (
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(100) NOT NULL,
  `qty` int(5) NOT NULL,
  `unit_price` double NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.product_tmp: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `product_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_tmp` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.programa
CREATE TABLE IF NOT EXISTS `programa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.programa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `programa` DISABLE KEYS */;
INSERT INTO `programa` (`id`, `name`, `status`, `date_added`) VALUES
	(1, '1.1. TOTO', 1, '2021-11-26 19:31:55');
/*!40000 ALTER TABLE `programa` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.purchases
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_number` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_by` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `purchase_date` datetime NOT NULL,
  `tax_value` float(5,2) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  UNIQUE KEY `purchase_order_number` (`purchase_order_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.purchases: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.purchase_product
CREATE TABLE IF NOT EXISTS `purchase_product` (
  `purchase_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(5) NOT NULL,
  `unit_price` double NOT NULL,
  PRIMARY KEY (`purchase_product_id`),
  KEY `fk_product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.purchase_product: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `purchase_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_product` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.sales
CREATE TABLE IF NOT EXISTS `sales` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_number` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sale_by` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `sale_date` datetime NOT NULL,
  `tax_value` float(5,2) NOT NULL,
  PRIMARY KEY (`sale_id`),
  UNIQUE KEY `sale_number` (`sale_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.sales: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.sale_product
CREATE TABLE IF NOT EXISTS `sale_product` (
  `sale_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `qty` int(5) NOT NULL,
  `unit_price` double NOT NULL,
  PRIMARY KEY (`sale_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.sale_product: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `sale_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_product` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.subcuenta
CREATE TABLE IF NOT EXISTS `subcuenta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.subcuenta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `subcuenta` DISABLE KEYS */;
INSERT INTO `subcuenta` (`id`, `name`, `status`, `date_added`) VALUES
	(1, '1.1.1. TOTAL', 1, '2021-11-26 19:32:07');
/*!40000 ALTER TABLE `subcuenta` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `work_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_country_id_foreign` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla invensorteosuabc.suppliers: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.taxes
CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` float(4,2) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla invensorteosuabc.taxes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `taxes` DISABLE KEYS */;
INSERT INTO `taxes` (`id`, `name`, `value`, `status`) VALUES
	(1, 'IVA', 10.00, 1);
/*!40000 ALTER TABLE `taxes` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.templates
CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla invensorteosuabc.templates: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` (`id`, `name`, `file`, `image`, `status`) VALUES
	(1, 'Plantilla por defecto', 'factura.php', '1.png', 0),
	(2, 'Business invoice template', 'business_invoice_template.php', '2.png', 1),
	(3, 'Invoice Template Red', 'invoice_template_red.php', '3.png', 0),
	(4, 'Invoice Template Sea', 'invoice_template_sea.php', '4.png', 0),
	(5, 'Invoice Template Wisteria', 'invoice_template_wisteria.php', '5.png', 0),
	(6, 'Plantilla dodgeroll gold', 'dodgeroll_gold.php', '6.png', 0),
	(7, 'Plantilla Peter River', 'peter_river.php', '7.png', 0),
	(8, 'Plantilla Alizarin', 'alizarin.php', '8.png', 0);
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.timezones
CREATE TABLE IF NOT EXISTS `timezones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla invensorteosuabc.timezones: ~115 rows (aproximadamente)
/*!40000 ALTER TABLE `timezones` DISABLE KEYS */;
INSERT INTO `timezones` (`id`, `name`) VALUES
	(1, 'America/Guatemala'),
	(2, 'US/Samoa'),
	(3, 'US/Hawaii'),
	(4, 'US/Alaska'),
	(5, 'US/Pacific'),
	(6, 'America/Tijuana'),
	(7, 'US/Arizona'),
	(8, 'US/Mountain'),
	(9, 'America/Chihuahua'),
	(10, 'America/Mazatlan'),
	(11, 'America/Mexico_City'),
	(12, 'America/Monterrey'),
	(13, 'Canada/Saskatchewan'),
	(14, 'US/Central'),
	(15, 'US/Eastern'),
	(16, 'US/East-Indiana'),
	(17, 'America/Bogota'),
	(18, 'America/Lima'),
	(19, 'America/Caracas'),
	(20, 'Canada/Atlantic'),
	(21, 'America/La_Paz'),
	(22, 'America/Santiago'),
	(23, 'Canada/Newfoundland'),
	(24, 'America/Buenos_Aires'),
	(25, 'Greenland'),
	(26, 'Atlantic/Stanley'),
	(27, 'Atlantic/Azores'),
	(28, 'Atlantic/Cape_Verde'),
	(29, 'Africa/Casablanca'),
	(30, 'Europe/Dublin'),
	(31, 'Europe/Lisbon'),
	(32, 'Europe/London'),
	(33, 'Africa/Monrovia'),
	(34, 'Europe/Amsterdam'),
	(35, 'Europe/Belgrade'),
	(36, 'Europe/Berlin'),
	(37, 'Europe/Bratislava'),
	(38, 'Europe/Brussels'),
	(39, 'Europe/Budapest'),
	(40, 'Europe/Copenhagen'),
	(41, 'Europe/Ljubljana'),
	(42, 'Europe/Madrid'),
	(43, 'Europe/Paris'),
	(44, 'Europe/Prague'),
	(45, 'Europe/Rome'),
	(46, 'Europe/Sarajevo'),
	(47, 'Europe/Skopje'),
	(48, 'Europe/Stockholm'),
	(49, 'Europe/Vienna'),
	(50, 'Europe/Warsaw'),
	(51, 'Europe/Zagreb'),
	(52, 'Europe/Athens'),
	(53, 'Europe/Bucharest'),
	(54, 'Africa/Cairo'),
	(55, 'Africa/Harare'),
	(56, 'Europe/Helsinki'),
	(57, 'Europe/Istanbul'),
	(58, 'Asia/Jerusalem'),
	(59, 'Europe/Kiev'),
	(60, 'Europe/Minsk'),
	(61, 'Europe/Riga'),
	(62, 'Europe/Sofia'),
	(63, 'Europe/Tallinn'),
	(64, 'Europe/Vilnius'),
	(65, 'Asia/Baghdad'),
	(66, 'Asia/Kuwait'),
	(67, 'Africa/Nairobi'),
	(68, 'Asia/Riyadh'),
	(69, 'Asia/Tehran'),
	(70, 'Europe/Moscow'),
	(71, 'Asia/Baku'),
	(72, 'Europe/Volgograd'),
	(73, 'Asia/Muscat'),
	(74, 'Asia/Tbilisi'),
	(75, 'Asia/Yerevan'),
	(76, 'Asia/Kabul'),
	(77, 'Asia/Karachi'),
	(78, 'Asia/Tashkent'),
	(79, 'Asia/Kolkata'),
	(80, 'Asia/Kathmandu'),
	(81, 'Asia/Yekaterinburg'),
	(82, 'Asia/Almaty'),
	(83, 'Asia/Dhaka'),
	(84, 'Asia/Novosibirsk'),
	(85, 'Asia/Bangkok'),
	(86, 'Asia/Ho_Chi_Minh'),
	(87, 'Asia/Jakarta'),
	(88, 'Asia/Krasnoyarsk'),
	(89, 'Asia/Chongqing'),
	(90, 'Asia/Hong_Kong'),
	(91, 'Asia/Kuala_Lumpur'),
	(92, 'Australia/Perth'),
	(93, 'Asia/Singapore'),
	(94, 'Asia/Taipei'),
	(95, 'Asia/Ulaanbaatar'),
	(96, 'Asia/Urumqi'),
	(97, 'Asia/Irkutsk'),
	(98, 'Asia/Seoul'),
	(99, 'Asia/Tokyo'),
	(100, 'Australia/Adelaide'),
	(101, 'Australia/Darwin'),
	(102, 'Asia/Yakutsk'),
	(103, 'Australia/Brisbane'),
	(104, 'Australia/Canberra'),
	(105, 'Pacific/Guam'),
	(106, 'Australia/Hobart'),
	(107, 'Australia/Melbourne'),
	(108, 'Pacific/Port_Moresby'),
	(109, 'Australia/Sydney'),
	(110, 'Asia/Vladivostok'),
	(111, 'Asia/Magadan'),
	(112, 'Pacific/Auckland'),
	(113, 'Pacific/Fiji'),
	(114, 'America/El_Salvador'),
	(115, 'America/Costa_Rica');
/*!40000 ALTER TABLE `timezones` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.ubicacion
CREATE TABLE IF NOT EXISTS `ubicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.ubicacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ubicacion` DISABLE KEYS */;
INSERT INTO `ubicacion` (`id`, `name`, `status`, `date_added`) VALUES
	(1, 'INFORMATICA', 1, '2021-11-26 19:31:23');
/*!40000 ALTER TABLE `ubicacion` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `fullname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`),
  KEY `fk_user_group_id` (`user_group_id`),
  CONSTRAINT `fk_user_group_id` FOREIGN KEY (`user_group_id`) REFERENCES `user_group` (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

-- Volcando datos para la tabla invensorteosuabc.users: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `fullname`, `user_name`, `user_password_hash`, `user_email`, `date_added`, `user_group_id`, `status`) VALUES
	(1, 'ignacio cruzaley', 'nacho', '$2y$10$bgr.uoOxygk0pma5vm1.2OXP45KEdnpsalr66VTFrAVqsx4MTt0dq', 'cruphi@gmail.com', '2021-05-22 00:09:30', 1, 1),
	(5, 'Mario Obed Ambriz Leon', 'obed', '$2y$10$LUDIt.Ypja0UA/A.LOLOxOGq2z.1G8Ebpo4Xu2dvdLZBYUImF0KFu', 'obekcdr@hotmail.com', '2021-06-10 16:44:15', 5, 1),
	(10, 'Angel Gabriel', 'gabriel', '$2y$10$7xwMxdK.kCpT9dp.NLjZmODoXbT0boxsMXEnTOo/McxSAPhxUEBVq', 'gabriel.gomez@uabc.edu.mx', '2021-11-26 18:48:00', 1, 2),
	(11, 'Glassie Bernardina', 'Glassie', '$2y$10$flUa94nsWWKCv.JGBVpjxe6804SECWtPrvsWSMCmbTWgHWxZCXmda', 'buelnag@uabc.edu.mx', '2021-11-29 15:29:31', 1, 2),
	(12, 'jesus murillo', 'jesus', '$2y$10$az/JK8NCZjatT5PFE02dp.qRzwzqdz8kEu3geX8KvxBrf4L94twgq', 'jesus@gmail.com', '2022-02-23 19:10:47', 1, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla invensorteosuabc.user_group
CREATE TABLE IF NOT EXISTS `user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `permission` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_group_id`),
  KEY `user_group_id` (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invensorteosuabc.user_group: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` (`user_group_id`, `name`, `permission`, `date_added`) VALUES
	(1, 'Administrador', 'Inicio,1,1,1,1;Compras,1,1,1,1;Productos,1,1,1,1;BienesP,1,1,1,1;BienesB,1,1,1,1;BienesT,1,1,1,1;BienesNi,1,1,1,1;Fabricantes,1,1,1,1;Ubicacion,1,1,1,1;Categoria,1,1,1,1;Programa,1,1,1,1;Subcuenta,1,1,1,1;Ventas,1,1,1,1;Reportes,1,1,1,1;Configuracion,1,1,1,1;Usuarios,1,1,1,1;Empleados,1,1,1,1;Permisos,1,1,1,1;Inventario,1,1,1,1;Evidencia,1,1,1,1;Informatica,1,1,1,1;', '2020-02-28 20:00:00'),
	(4, 'personal', 'Inicio,1,1,0,0;Bienes,0,0,0,0;Informacion,0,0,0,0;registro,1,1,0,0;BienesT,0,0,0,0;BienesNi,0,0,0,0;Empleados,0,0,0,0;Ubicacion,0,0,0,0;Categoria,0,0,0,0;Programa,0,0,0,0;Subcuenta,0,0,0,0;Evidencia,0,0,0,0;Inventarios,0,0,0,0;Reportes,0,0,0,0;Permisos,0,0,0,0;Usuarios,0,0,0,0;', '2022-03-16 11:48:28'),
	(5, 'usuario', 'Inicio,1,1,1,1;Productos,1,1,0,0;BienesB,0,0,0,0;BienesP,0,0,0,0;BienesT,0,0,0,0;BienesNi,0,0,0,0;Empleados,0,0,0,0;Ubicacion,0,0,0,0;Categoria,0,0,0,0;Programa,0,0,0,0;Subcuenta,0,0,0,0;Evidencia,1,1,0,0;Inventarios,1,1,0,0;Reportes,0,0,0,0;Permisos,0,0,0,0;Usuarios,0,0,0,0;Bienes,0,0,0,0;Informacion,0,0,0,0;registro,1,1,0,0;', '2022-03-16 12:36:16');
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
