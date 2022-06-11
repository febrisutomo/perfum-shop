-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2022 at 02:03 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Sed Saepe', 'sed-saepe', 'Est et consequatur aliquid est sequi rerum odio. Aut voluptatum voluptas temporibus laborum. Recusandae ut neque maxime.', 1, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(2, 'Aut Earum', 'aut-earum', 'Est aspernatur enim quos laudantium. Voluptas iste provident voluptatem sit sint magni modi. Quisquam aut fuga pariatur delectus debitis culpa.', 1, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(3, 'Suscipit Nihil', 'suscipit-nihil', 'Inventore ut ut facere voluptatem. Nihil quae ad sapiente repellendus ullam id animi. Deserunt repellendus impedit rem consequatur doloribus.', 1, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(4, 'Sit Iste', 'sit-iste', 'Aut ut mollitia suscipit animi ipsum voluptas sit. Eum eos culpa quas aut iusto dolorem. Ullam alias autem illo.', 1, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(5, 'Ipsam Consequatur', 'ipsam-consequatur', 'Et ab magni quis ut non qui corrupti. Veniam ducimus ut omnis dolorum sequi quas. Modi provident itaque aliquid vitae delectus deserunt tenetur.', 1, '2022-06-06 05:29:15', '2022-06-06 05:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `parent_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'For Men', 'for-men', NULL, NULL, 1, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(2, 'For Women', 'for-women', NULL, NULL, 1, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(3, 'For Unisex', 'for-unisex', NULL, NULL, 1, '2022-06-06 05:29:15', '2022-06-06 05:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` json DEFAULT NULL,
  `cost_price` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '10',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `brand_id`, `category_id`, `name`, `slug`, `summary`, `description`, `ingredients`, `images`, `cost_price`, `price`, `stock`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'Laborum Ut Voluptatem Molestias.', 'laborum-ut-voluptatem-molestias', 'Vel et id occaecati harum et. Ullam rerum deserunt porro voluptates. Culpa sit est est rem qui. Temporibus accusantium maxime omnis.', '<p>Ipsam quod sit porro nisi iusto non natus. Sint natus rerum cumque. Nulla vel sint sunt suscipit veritatis in asperiores. Et enim officia occaecati. Eveniet incidunt earum corrupti neque. In expedita tempora eius veniam labore ut tempore. Ducimus quia eum assumenda ut doloremque modi. Nulla neque rerum tempore rerum corrupti ea. Cumque veniam asperiores aut nesciunt necessitatibus accusantium consequatur exercitationem. Voluptate eveniet eos possimus voluptatum dolorem. Ab error quae alias reiciendis. Nostrum et non adipisci qui. Quo dolorum et nulla id. Ullam eligendi ea ratione est. Harum ratione sunt iure ut mollitia. Nesciunt eos at quis eveniet illo. Perferendis minus ullam nulla aliquam fugit ullam vero autem. Eligendi aut atque beatae autem et assumenda voluptates. Molestias non qui voluptatibus sit consequatur et blanditiis a. Exercitationem ut officiis sint aperiam hic sed voluptatum.</p>', '<p>Iusto sit quo sed est esse. Et ex doloribus commodi. Nemo recusandae nemo est dignissimos deserunt vel et. Ipsa est eveniet itaque omnis quia. Tempora eos repudiandae illum quia. In consequatur magnam dolore quis dolorem. Harum itaque qui qui neque. Ea dolorem non laudantium.</p>', '[{\"path\": \"uu7l8Ut7p4eRT9KzoLQ9DPsOPYdNAxOMf0iNHBUj.jpg\", \"uuid\": \"c208de02-f869-4426-b83b-2f78860e34fd\"}, {\"path\": \"pyfupSd6GhYCi1Rcy4cIu21eWeFcU1VUzgowdcEY.jpg\", \"uuid\": \"98f565f4-46b2-4e01-ac57-b7b30bee353d\"}]', 50000, 52500, 68, 1, NULL, '2022-06-06 05:29:15', '2022-06-10 11:08:36'),
(2, 1, 3, 'Necessitatibus Tempore Rem Placeat Minus.', 'necessitatibus-tempore-rem-placeat-minus', 'Ab consequuntur facere officiis aperiam quia nisi esse. Dolores unde quas id non totam quia enim pariatur. Consequatur nihil similique delectus.', '<p>Harum modi unde minus. Et corrupti officiis voluptatibus. Autem dolorum vel voluptas qui nesciunt dolorem veritatis. Reprehenderit nobis possimus id. Est eum aperiam sint doloribus expedita. Iure laudantium vitae debitis quo. In cumque adipisci ut aut est mollitia et. Quam qui sequi perferendis. Est iure odio debitis nemo. Et dolor rerum exercitationem ipsam. Neque fugiat ducimus dolor et libero illum excepturi. Dolores ducimus nostrum veniam laudantium dolorum magni sequi debitis. Sapiente in doloribus adipisci ut et non. Alias dolores recusandae eum tempore consequuntur dolor voluptatem laudantium. Laboriosam et rerum labore quo. Ex praesentium dolore ea beatae iure blanditiis. Quia dolorem voluptatum cum veritatis non et. Saepe harum voluptatibus ipsum quaerat aliquid. Dolores non iusto dolorum ipsa. Repellat enim totam qui quis. Minima rem labore fuga porro nulla sit delectus. Sed tempore eos nihil officiis molestias deleniti nisi.</p>', '<p>Quo omnis placeat illo. Qui non porro amet et at. Cumque iusto laudantium quam mollitia aliquid quia. Et et nihil et. Voluptas cumque quaerat quidem ipsa qui omnis ut. Est libero sit consequatur nihil debitis doloribus sint. Debitis id aut aperiam vero consequatur vitae. Vel laborum pariatur suscipit tempora rerum in adipisci.</p>', '[{\"path\": \"sB2WwAWl0qccpBf58pO2K8HZPRBMp4WvJRiTSpQk.jpg\", \"uuid\": \"63455efc-a135-4f6e-ac09-1eedd36bf792\"}]', 30000, 31500, 26, 1, NULL, '2022-06-06 05:29:15', '2022-06-10 11:08:48'),
(3, 1, 1, 'Distinctio Ipsum Iste Earum.', 'distinctio-ipsum-iste-earum', 'Odio culpa eos eum deleniti in odio error. Delectus ut aut ipsa vel hic atque. Porro aliquam facere minus error.', '<p>Sequi blanditiis ipsa itaque omnis ut voluptatibus qui. Enim quas explicabo quibusdam odit porro incidunt quibusdam. Aperiam assumenda dignissimos sit laboriosam delectus cum sint. Occaecati fugit voluptatem nihil. Dignissimos voluptas qui occaecati cum dolorum. Et est quae odit architecto doloremque quasi ratione. Et earum sed et placeat et ullam. Debitis ab id in eos beatae nihil et. Aut consequatur fuga quis non. Omnis reprehenderit omnis architecto consectetur natus accusantium. Vitae provident consequuntur mollitia omnis. Fugit nulla nisi architecto commodi sed et. Aut beatae ducimus eos tenetur architecto. Ex rerum id at. Alias aliquam eveniet assumenda quaerat rem. Nesciunt qui reiciendis minima libero totam dolor. Quisquam sapiente iure et modi aut omnis. Placeat optio enim maiores quia. Repudiandae dolor nemo voluptatibus eius. Deleniti hic doloribus et maxime qui.</p>', '<p>Quis mollitia distinctio veniam tenetur qui exercitationem velit. Iure ab voluptas nam praesentium quibusdam. Ex facere impedit ut. Rem asperiores rerum consequatur beatae. Ut corporis aut laudantium ipsum. Et aut tempore aut accusantium non quia. Et autem id minus laboriosam. Modi quia et dolore recusandae. Quasi a dolorum placeat repellendus.</p>', '[{\"path\": \"GHtDYslZvRnVvvOTIOm4k5vZNfYvIHOimBaqclOo.jpg\", \"uuid\": \"e36c6999-9f43-45d8-baf8-36af1eaeb2c6\"}]', 50000, 52500, 9, 1, NULL, '2022-06-06 05:29:15', '2022-06-10 11:09:00'),
(4, 5, 2, 'Quam Quia Et.', 'quam-quia-et', 'Eius unde sint non nisi sequi repellat. Quia reiciendis laudantium aliquid maiores aut. Laudantium vel soluta magni. Delectus et quia sit nam et.', '<p>Eius error ullam error laborum. Sit et quo voluptatem cupiditate quisquam. Voluptas quo aspernatur ut aut. Qui architecto voluptatem velit et. Ipsam cupiditate sed ut corrupti. Ut dolores dignissimos deleniti vero magnam. Voluptate minima officiis vero quidem sed distinctio. Qui omnis dolor architecto sed ad adipisci magni. Exercitationem nulla voluptatum nihil explicabo. Ut sint unde voluptatem quisquam dolore aut sed. Libero voluptas nihil sequi quidem necessitatibus. Et nam expedita voluptatem sit accusantium itaque reiciendis. Qui aut eos porro ipsa quia beatae. Velit dolorem nihil officiis. Totam ab earum cupiditate. Modi nemo quia aliquid reiciendis sit quas recusandae. Et ipsam id exercitationem dolores alias quis nam quaerat. Iure asperiores voluptates sed vitae dolores et. Id officiis iusto sint. Natus ullam laborum molestiae facere quia omnis. Aut facere placeat consequatur fugit asperiores sit. Corporis porro reiciendis recusandae at.</p>', '<p>Nemo laborum unde harum nobis nobis omnis. Voluptatum et mollitia veritatis odit aliquid necessitatibus. Iste illo et qui minima. Qui culpa consectetur corrupti ut rerum sit dolorem aspernatur. Autem qui temporibus inventore in ad. Totam laboriosam quisquam hic eveniet. Aliquid possimus delectus maxime optio. Et ipsum quidem est consequatur ut libero voluptas.</p>', '[{\"path\": \"BNkuhmZm5mEbhen3czIJ8uWIYt5Kh01UgxchlYRE.jpg\", \"uuid\": \"80fd2c1d-c133-44b8-a097-075331ed20b4\"}]', 70000, 73500, 94, 1, NULL, '2022-06-06 05:29:15', '2022-06-10 11:09:13'),
(5, 2, 1, 'Incidunt Reprehenderit Molestiae Non.', 'incidunt-reprehenderit-molestiae-non', 'Et nesciunt veritatis magni quis non. Nulla sint ipsam maxime. Magni quo rerum nam sapiente. Officiis odio architecto temporibus.', '<p>Nemo beatae molestiae aut amet qui numquam assumenda. Omnis excepturi aperiam exercitationem officia commodi sunt. Eum dolor debitis ullam vel harum magni consequatur. Est inventore doloremque et id velit maxime cum. Possimus pariatur ipsam nisi. Eum earum modi voluptatem voluptatibus voluptatem et molestiae. Porro ipsum provident iste eveniet illo et eum sunt. Corporis sint aut quia labore. Non temporibus occaecati non id aliquam nemo. Ut maxime sed et vitae placeat. Qui sequi repellendus sed fugit consequatur harum voluptatem. Excepturi minus perspiciatis cum sunt eligendi possimus ea. Voluptatem vel modi natus voluptatibus magni. Quis optio eaque nobis corporis. Iste quia voluptatibus sunt labore suscipit aliquid saepe accusamus. Amet molestiae qui repudiandae repellat commodi recusandae ab. Laudantium tenetur aut tenetur aut rerum. Odio aperiam est sunt laboriosam veniam nam.</p>', '<p>At blanditiis et ut est quis et sapiente autem. Ut nihil recusandae et sint eius est in. Nemo officiis veritatis expedita velit. Ab omnis minus sapiente eveniet reiciendis necessitatibus recusandae accusantium. Sed at excepturi est qui qui maxime. Est aspernatur aut omnis non qui quasi rerum nisi. Et dolorem sint molestiae mollitia recusandae. Sit iusto ea accusantium dolore ut omnis.</p>', '[{\"path\": \"LE3iooYKIiyzIOHhGGt8fLgmH0CVdpB1gFDcdoHR.jpg\", \"uuid\": \"6c715a3e-f081-4cf6-9b65-7ebe6f3132f7\"}]', 40000, 42000, 83, 1, NULL, '2022-06-06 05:29:15', '2022-06-10 11:53:46'),
(6, 4, 2, 'Aspernatur Sit Autem Molestias.', 'aspernatur-sit-autem-molestias', 'Tempora voluptate ex porro sed odit. Qui minus est reiciendis nihil vel labore. Laborum mollitia eligendi dolor voluptas qui illo.', 'Aut qui ratione earum nobis est natus perferendis. Magnam consequatur vero accusamus earum distinctio. Magni sint eius ut repellendus. Cupiditate qui harum ullam et. Repudiandae atque commodi saepe nam libero quam voluptate. Corrupti sed odio labore recusandae. Sit qui non assumenda eos dolor porro veniam quas. Accusamus voluptatem aut qui dignissimos dolor. Saepe dolores sed suscipit soluta sint et eveniet. Molestiae non vel perferendis deleniti optio tempore qui. Est delectus quo esse at animi. Est sed architecto quam quis natus provident. Est exercitationem beatae consequatur doloremque veniam. Excepturi consequatur atque voluptatem quia et. Qui repudiandae molestiae vel sint quis et eum beatae. Eum inventore est dolorem atque non. Maiores vitae et aliquam commodi in cupiditate assumenda esse. Accusantium odio voluptas ut rem distinctio in. Repudiandae dolores quia aut dolor. Aliquid soluta praesentium debitis occaecati incidunt pariatur.', 'Sint repudiandae magnam at animi et ut. Totam molestiae aut deleniti et maxime. Eum sequi incidunt dolorem in atque. Pariatur et dicta id assumenda iure unde. Ut quia iure impedit veniam dolorum dolorem. Quia voluptates et dignissimos et omnis nihil nisi. Cupiditate veritatis praesentium enim ipsa nihil blanditiis est consequatur.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 80000, 84000, 4, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(7, 2, 1, 'Et Ipsam Aliquid.', 'et-ipsam-aliquid', 'Voluptas in qui enim ad ipsa nobis voluptates. Qui eveniet nam autem quasi quia. Esse cum voluptatem porro neque quas.', 'Placeat voluptate in nulla voluptas voluptate. Et nihil qui consequuntur id porro. Dolorem adipisci dolorum et rem adipisci voluptatem eius. At exercitationem accusamus vitae quo molestiae facere. Ea deserunt aliquid qui officia repudiandae laboriosam. Facere dolor aliquid ut eligendi odio aliquam. Praesentium fugit voluptatem a quo. Harum laudantium amet et voluptates quidem sunt eaque. Quia iste ad voluptas dolor ut. Corporis voluptas minus voluptas impedit pariatur ut eos. Ut sed sapiente et tempore est accusantium amet. Autem nobis quo consequatur harum. Voluptatem nihil est rerum laborum aliquam quos. Eum est rerum vel nesciunt eaque sapiente est hic. Voluptatem unde sapiente reprehenderit optio. Odit excepturi incidunt rem cum quasi. Dolorem impedit rerum facilis nihil maiores. Aperiam at fugit itaque deleniti autem delectus rerum molestiae.', 'Asperiores minima ea consequatur explicabo voluptas nulla esse. Iusto sed laboriosam nam dicta. Eaque tempora tenetur quaerat accusantium laudantium. Iure maiores exercitationem itaque expedita veniam est ad nam. Molestiae corrupti perspiciatis aut quis nemo. Nihil quaerat voluptatem enim tempore ex eos beatae.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 20000, 21000, 2, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(8, 1, 2, 'Assumenda Reiciendis In Debitis.', 'assumenda-reiciendis-in-debitis', 'Accusamus officiis a ut impedit dignissimos aperiam. Magnam voluptatem quia sit aspernatur. Dolorem laudantium saepe laudantium ipsam quidem.', 'Aut aperiam consectetur est. Corrupti est id debitis quia magnam quia. Rerum sunt alias exercitationem ullam. In quo rerum molestiae vel et. Similique laudantium quia sint quisquam. Libero velit consequuntur reprehenderit error nihil culpa quae. Consectetur ea nihil eius debitis consectetur. Quo at doloribus iure vel est. Quia qui dolores et dolores nulla non repellat. Officia in dolore adipisci ut non. Itaque corporis ad nemo sed ab asperiores. At sunt voluptas ut amet rerum dolorem delectus. Id similique et vel eum quas voluptatem nisi iure. Et sequi molestiae provident a dolor dolorem. Quo minus est consequatur non est asperiores maiores quod. Reiciendis ducimus et dicta amet dignissimos. Fugit consequuntur dolores laboriosam placeat at. Ut sit et libero voluptatem. Et eos a eum rerum tempora molestiae. Unde ducimus fuga explicabo eos minus illo aliquid vel. A molestiae consequuntur est velit.', 'Dolores debitis ut non dicta. Tenetur aut odit reiciendis occaecati dolores. Ut sunt totam repudiandae praesentium. Suscipit fuga ut nam porro enim molestias. Temporibus atque nostrum ab nesciunt excepturi expedita ab. Quisquam blanditiis voluptatem ad libero. Autem excepturi veniam placeat fugit quis. Ut nobis perspiciatis expedita ut.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 80000, 84000, 92, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(9, 5, 1, 'Aut Est Culpa.', 'aut-est-culpa', 'Suscipit vero enim provident laboriosam. Facilis voluptas voluptatem in iure qui provident sed. Quasi possimus reprehenderit ea qui.', 'Optio reprehenderit sit ipsa fugit. Deserunt sint vitae rerum. Sequi est laboriosam eveniet. A dignissimos sunt rem nostrum eveniet. Adipisci animi laborum iste. Magnam numquam praesentium possimus accusantium omnis. Officiis sed sit voluptatem odit sit omnis culpa. Porro magni dolores iure voluptatem. Voluptatem voluptas quia architecto possimus expedita quae eligendi. Quibusdam nobis consectetur quia cumque in nam sed nihil. Ipsam et tenetur ipsam facilis consequuntur perferendis hic. Aut qui dolores consequuntur id et sit sint. Labore necessitatibus omnis facere iusto ducimus est. Optio autem reprehenderit consequatur quas et molestiae est. Quia hic quas aut iure facilis asperiores. Eligendi beatae omnis cupiditate ipsam voluptatem. Ipsum ut molestiae iure maxime qui amet. Aliquam optio est et odio quod facere. Odio assumenda sed suscipit quos sit ut. Itaque sapiente voluptas enim vero nostrum pariatur sit.', 'Omnis vero quas architecto maiores. Dolor molestiae tempore id. Et accusantium quod harum neque accusantium quibusdam est. Similique veritatis et incidunt ut modi quibusdam. Impedit et illum natus sequi commodi eaque excepturi odio. Nihil et vitae saepe ut voluptates dolores.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 30000, 31500, 74, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(10, 1, 2, 'Ipsam Sed.', 'ipsam-sed', 'Quam molestiae cum id nesciunt quia recusandae. Occaecati minus rerum voluptas laboriosam eligendi ut quasi. Mollitia impedit ut voluptates.', 'Omnis a rerum explicabo dolorem expedita ex laudantium. Voluptates odio enim vitae. Vitae incidunt repudiandae praesentium distinctio repellat. Voluptatem porro distinctio ex omnis placeat. Illum distinctio delectus culpa est odio molestiae. Aut pariatur eligendi ut deserunt mollitia aut nesciunt. Perferendis dolorem cum eveniet cumque. Sint impedit incidunt saepe temporibus quas eveniet repellendus. Ullam nulla sint possimus. Repudiandae vel delectus suscipit. Ut fugiat itaque dolore eveniet assumenda velit quod. Sit dolores consequatur cum suscipit exercitationem suscipit. Iure placeat repellendus sint voluptate quos. Ipsam natus aspernatur et minima aut. Dolores nihil assumenda ratione adipisci rerum dolorem quia. Rerum omnis fugit earum sint omnis. Non provident impedit debitis. Porro minima atque dicta quia reiciendis cumque aliquid doloremque.', 'Id tempore perspiciatis ipsa ea dignissimos. Optio eum in deleniti est ut. Veritatis voluptates totam dolores cupiditate non exercitationem temporibus. Placeat incidunt nihil quasi quo. Cum aut sapiente dolores officia animi est. Impedit animi debitis autem velit consequatur consequatur praesentium sit. Unde quo soluta quaerat nostrum quia rem et.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 40000, 42000, 89, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(11, 1, 3, 'Suscipit Voluptate Est.', 'suscipit-voluptate-est', 'Tempore nemo at nostrum. Ratione nobis accusantium quia quis est excepturi qui. Hic amet accusantium omnis consequatur voluptatem aliquid alias.', 'Suscipit ut perspiciatis ducimus distinctio nisi qui aperiam. Dolor dolorem qui et. Perferendis corrupti ea dolor aut consequatur. Est dolorem et in est exercitationem. Maxime sit facilis est cum provident et nam. Cum reiciendis aut et vel amet. In unde in sint sunt harum omnis ipsum cupiditate. Voluptatibus suscipit atque eum aliquam. Eos ad ut consectetur praesentium recusandae in qui. Blanditiis in cumque maiores sed quia. Eaque minus aspernatur maiores at iste velit. Excepturi repellendus autem explicabo velit pariatur dolorem qui. Eum accusamus occaecati vero non. Sed temporibus sint dolorem est voluptatem voluptates ut. Dicta in laborum maxime adipisci non. Distinctio quis vel fugiat aliquam repellendus non ut. Natus in occaecati aut sit. Voluptas omnis dolorum et necessitatibus. Ullam omnis rerum ut ratione. Nulla molestiae eum qui vero ut. Sunt porro et incidunt sit et. Aliquid non ea nemo at nobis. Rerum saepe quia qui. Fuga quos quaerat dolore non ut mollitia ea.', 'Enim dolor distinctio sed omnis consequatur. Repellendus adipisci ex et. Ut molestiae eveniet distinctio praesentium dolor. Libero tempora sit iure reiciendis eos. Saepe eum maiores aliquam exercitationem. Tenetur qui est reprehenderit assumenda animi. Est earum reprehenderit ipsum fugiat dolor vel vitae. Rerum atque corporis porro blanditiis. Tenetur autem ut ipsum illo.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 90000, 94500, 91, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(12, 2, 3, 'Quam Aut Omnis.', 'quam-aut-omnis', 'Expedita ipsam omnis voluptatem vel. Quia aliquid id fugiat laudantium quidem et.', 'Rerum sint velit reiciendis aut impedit. Labore dolores odit consequuntur eum praesentium. Dolor omnis blanditiis saepe qui autem quia. Earum in iusto qui consequatur sit. Quis iusto et occaecati perferendis rem vero reprehenderit. Quia occaecati quo voluptatum et sit. Placeat corporis repellendus tenetur in dolor. Eius incidunt vero ut molestias et consequatur. Ea tempore quam totam. Dolore est et eaque non similique eos aut. Iusto est qui autem aperiam vel itaque. Dicta nobis deserunt magnam adipisci optio placeat. Culpa repellat id sed perferendis nisi. Sit voluptas quo voluptatibus ut quo voluptatibus. Explicabo nesciunt corrupti velit incidunt laboriosam et distinctio voluptatem. Illo consectetur veritatis quia minus. Dolorum quam optio tempora aut voluptatem optio. Voluptatem est unde pariatur provident officiis. Veritatis perspiciatis nam impedit.', 'Est culpa exercitationem mollitia illo voluptas. Incidunt amet consectetur ducimus et. Iure porro sint quasi sed animi. Dicta aspernatur perspiciatis vero deserunt impedit ut quisquam. Quia reiciendis earum voluptas non. Aspernatur odio doloribus expedita consectetur delectus sed modi consequatur. Eos tempora nam alias libero sunt nam voluptatem. Fuga cum unde ipsam sunt placeat.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 20000, 21000, 32, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(13, 3, 1, 'Dolores Repellendus Pariatur Magnam.', 'dolores-repellendus-pariatur-magnam', 'Velit molestiae enim facilis. Asperiores alias aliquid consequatur expedita accusantium. Voluptatem soluta et dicta placeat quas.', 'Soluta debitis reiciendis eos qui. Consequuntur non harum aliquam eveniet placeat cupiditate quo. Animi inventore placeat omnis qui et autem et et. Ipsum enim labore ipsum provident velit. Velit autem explicabo hic dignissimos et. Autem ut error omnis at ipsum. Doloribus eos quia nobis ea quia. Facilis earum non in quis cupiditate aut vel. Ut delectus quae non sit sequi. Possimus molestias officiis et. Et aut et officia sint aliquam laboriosam perspiciatis. Tenetur accusamus cum enim incidunt explicabo. Quo et voluptatum ab. Quod et cum asperiores accusamus amet esse. Possimus corporis occaecati earum tempora facilis inventore reiciendis voluptatibus. Sit quo et fugit modi ratione et enim. Ipsum occaecati aut quia illo voluptatem iste. Minima sapiente quos vitae harum dolorem. Quae error corporis velit veritatis incidunt perspiciatis. Laborum aliquam quis vero maxime. Facilis quo debitis et reprehenderit possimus.', 'Quae et voluptatem placeat debitis ut corrupti repudiandae quasi. Beatae sint temporibus qui consequuntur consequatur. Recusandae laborum odit porro recusandae. Doloribus dignissimos sit alias officiis. Alias est dolorem officiis illum similique amet ipsum maxime. Numquam perferendis sit consequatur est ullam maiores. Voluptas rerum voluptas nemo commodi omnis numquam.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 50000, 52500, 21, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(14, 2, 2, 'Non Doloribus Placeat Consectetur.', 'non-doloribus-placeat-consectetur', 'Ab quidem dignissimos occaecati ea deserunt incidunt. Fugiat est veniam iusto illum dolores quidem. Sit ipsa dolore quo placeat sapiente.', 'Consectetur voluptas tenetur occaecati quo enim placeat. Rerum harum exercitationem et veritatis. Recusandae ad atque quam iusto. Ea fugiat quam voluptate et natus et. Voluptas vel eligendi odio sapiente. Accusamus earum quo ut consequuntur aut minima. Eum provident veniam quia illum libero. Ut nemo animi excepturi. Itaque dolor soluta et quas libero sint. Voluptates voluptates ut est. Eos nihil delectus architecto quo placeat maxime et quo. Sunt sit cupiditate hic dignissimos. Consequatur magnam vero porro et. Et optio voluptatem eum perspiciatis explicabo dolorum. Officia ducimus quos repellat excepturi qui tempora blanditiis. Temporibus eos nesciunt in. A accusantium ipsa nihil nulla commodi nesciunt. Quia earum voluptate beatae et dolor et ut. Animi consequatur hic magnam enim voluptatem non corporis. Culpa delectus iure eos numquam quis placeat. Sit in blanditiis et voluptas iste. Qui sit quia ullam nesciunt. Sapiente sit cupiditate ut distinctio ut voluptate nihil minus.', 'Porro ex ad est excepturi dignissimos. Iure velit aspernatur officia aut vel quibusdam. Aliquid cupiditate et quo vitae iste eos. Et aut dicta ut odit est. Excepturi non aut reprehenderit voluptatem minima quo.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 30000, 31500, 85, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(15, 3, 3, 'Culpa Modi.', 'culpa-modi', 'Non dolor ducimus quia ad voluptate. Eos tempore non magnam. Quod iure eaque dolores et et.', 'Quo omnis laborum et est et. Qui doloremque nobis labore id quo qui omnis. Quam magni saepe assumenda sed. Magnam debitis consequatur quod asperiores veniam. Aspernatur voluptatem in incidunt deserunt fuga nemo atque eligendi. Ut temporibus nihil sit velit. Est id cupiditate officia molestiae. Alias temporibus accusantium culpa ut. Doloribus est ut nihil debitis tempore molestias consectetur fuga. Ut saepe exercitationem illo iusto. Quo quo labore quo amet. Corrupti accusantium similique temporibus autem repellendus officiis. Fugit dolores alias velit. Voluptates ipsam qui illo sed aliquam consequatur. Veniam tempora totam autem rerum numquam. Officia voluptatibus voluptatibus reprehenderit eum. Assumenda accusamus quia est et non. Est at quae labore consequuntur in. Velit occaecati itaque est ut tempora facere laborum. Suscipit voluptatum aut pariatur est. Facere deleniti amet quo. Suscipit numquam veritatis voluptatem qui sed praesentium.', 'Consectetur quis exercitationem accusantium ipsum et vel. Alias perspiciatis doloremque dolorem vitae quis omnis. Dolorem et reiciendis suscipit corrupti voluptas reiciendis. Ducimus laboriosam aut ut est qui ut. Tempore velit nihil quia et. Culpa qui deleniti sapiente rerum.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 10000, 10500, 2, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(16, 3, 3, 'Iste Dolorem Soluta.', 'iste-dolorem-soluta', 'Dolorum unde voluptatem non est quia. Animi fugit quibusdam voluptatum ut eaque eligendi et. Facilis enim nobis officiis facilis placeat aut.', 'Repellendus est unde vel autem. Et omnis architecto deleniti non dolores aut. Voluptatem explicabo repudiandae est amet mollitia. Hic eligendi repellendus velit expedita quae voluptatem voluptatem. In quis perferendis similique minus laboriosam. Vel nesciunt itaque labore aut incidunt voluptatem. Beatae exercitationem minus est voluptatibus qui. Libero ut earum cupiditate placeat. Et ducimus est quas officia quia. Ratione minima qui aut temporibus ut cum animi. Neque quia omnis dolore exercitationem quia accusantium earum. Laudantium necessitatibus porro eveniet temporibus molestiae non. Voluptatibus rem laboriosam dolores labore. Voluptatem quia dolor deleniti provident voluptatem ut rerum. Nam aut magnam nulla dignissimos saepe dicta suscipit. Consequuntur blanditiis nihil id repellendus nostrum magni. Qui quisquam in unde est. Beatae animi dolorum totam a hic totam officiis. Temporibus ipsam quos quasi ipsam quos eius quia. Et est voluptas est ut cumque et eveniet.', 'Et eum deleniti a vel debitis repudiandae inventore. Recusandae aut reprehenderit totam aut quia. Quibusdam qui quo inventore ex nihil. Alias molestiae similique iure voluptatibus voluptas expedita velit. Et delectus numquam harum ab aliquid et quae. Non odio voluptatibus ut fuga.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 10000, 10500, 33, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(17, 1, 3, 'Natus Alias.', 'natus-alias', 'Aut sit molestiae aliquam dolor. Libero nihil non distinctio quaerat dolorem. Eum deserunt at quia quis aperiam culpa.', 'Est incidunt nemo amet doloribus reiciendis. Saepe et ut rerum et. Dicta vel vero porro placeat aut. Modi odit qui modi. Doloribus quae et ab explicabo qui. Iure velit sit et necessitatibus dignissimos. Consequatur atque incidunt nihil praesentium. Molestias error repudiandae culpa. Recusandae aut esse ut consequatur molestias optio. Ipsa omnis itaque asperiores vero ad sequi. Et et et neque omnis aut soluta id esse. Et dolorem reiciendis illo perspiciatis unde non. Ipsa distinctio nisi veritatis commodi ipsa facilis quaerat. Error occaecati optio pariatur. Quibusdam cum debitis accusamus nemo unde. Omnis repellat quidem sit laudantium natus est occaecati. Iste ut at voluptas et. Aut suscipit autem dolore officiis molestiae quia natus. Minus autem dolorum delectus in qui cumque hic. Ipsum quasi vel consequatur sunt nihil consequuntur qui voluptatem. Ratione quis aut animi et dolorum.', 'Quo consequatur consequatur autem voluptas deserunt. Non deserunt ut rerum ad id reprehenderit cum. Amet asperiores quas consectetur molestiae et sequi. Nam optio fugit nulla maiores nesciunt. Magni reprehenderit soluta itaque non qui atque voluptatem. Necessitatibus blanditiis voluptatem quidem qui. Sint qui officia id vitae eligendi voluptatibus. Quia voluptate nobis iusto ipsum in soluta.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 70000, 73500, 41, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(18, 5, 1, 'Sapiente Ad Quia.', 'sapiente-ad-quia', 'Hic odio eos facilis qui reprehenderit. Ut voluptatem laboriosam officia eum veniam nam. Accusantium voluptatum unde similique qui accusamus.', 'Natus est distinctio accusantium. Et ullam id repellendus voluptatem. Officiis quidem magni nisi voluptas. Id non porro at culpa. Est earum culpa placeat ut ipsa. Earum perspiciatis accusamus ipsum. Nihil vel doloremque fugit beatae aut. Nesciunt omnis porro officia aliquam temporibus quos harum illum. Molestiae nihil vel aliquam. Aut quibusdam vel tempore tempore voluptas at. Aut id consequatur modi assumenda sed. Voluptas ea quia non praesentium. Eligendi cupiditate minima voluptatem quasi quia facilis et. Aperiam et cum sed laborum laborum ut consequatur. Molestiae hic vel praesentium consectetur minima culpa. Numquam veritatis aperiam dolore est inventore id modi voluptates. Reprehenderit ipsa aspernatur itaque aut maiores est ea quo. Aperiam doloribus distinctio et recusandae. Ea dolor quidem ut velit laboriosam voluptatum neque. Expedita tenetur nulla ab suscipit quis quisquam quidem consequatur. Dolor magni fuga et tempore quibusdam et qui natus. Autem et fugit eos.', 'Quo optio officia minus aut debitis porro qui. Autem commodi quae et quis. Sequi aut eos facere quae quia. Ullam quia voluptatem tempora distinctio esse earum. Odio sequi cupiditate enim quia aliquam. Repellendus ex error reprehenderit libero illo. Architecto quo impedit architecto voluptatibus nihil facilis soluta.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 10000, 10500, 69, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(19, 1, 1, 'Saepe Debitis.', 'saepe-debitis', 'Ullam sint sed sit. Quaerat sit animi unde recusandae velit ut et. Voluptas voluptas quos quia sapiente ea.', 'Reprehenderit omnis fugit voluptas. Et est qui libero debitis nihil. Autem voluptatibus doloremque necessitatibus enim quos officiis. Quibusdam occaecati qui qui ipsa nihil neque quos. Accusantium neque velit consequatur repellat similique commodi non. Eum alias fuga et nobis modi aut. Molestiae assumenda ex excepturi praesentium neque. Atque accusamus eius ut dolor aut animi aliquid. Eaque qui voluptas iure quia. Officiis doloribus ut consequatur qui quae qui. Labore ex temporibus laudantium et quisquam. Eos et vel sit repellendus voluptas quibusdam. Quam similique iusto velit dolorem repellat sit. Dolorem voluptate repudiandae consequatur laborum. Ipsam vel non laborum voluptatum. Eaque illo quibusdam ea cum delectus vel. Molestias quia et et. Sit laudantium velit voluptatem consectetur. Inventore et modi exercitationem ratione qui occaecati. Totam illo sapiente voluptate consequuntur est quia. Natus odit rem harum. Qui temporibus et aut.', 'Reiciendis voluptatum hic architecto maiores. Quis veniam praesentium et consequuntur voluptatem tempora dolorum fugit. Quasi est recusandae hic ullam minus est iste. Nihil officiis excepturi hic perspiciatis consequatur ut facere. Doloremque ipsa reprehenderit impedit ipsa possimus. Odio sit sunt omnis. Voluptatum et eaque est. Temporibus eligendi id ab culpa ut.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 90000, 94500, 89, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15'),
(20, 3, 1, 'Magni Nostrum Debitis Labore Ut.', 'magni-nostrum-debitis-labore-ut', 'Ratione velit quia itaque qui enim quod id. Molestias nisi mollitia recusandae magni. Dolorum suscipit voluptatem consequatur nobis illum nam.', 'Et suscipit numquam qui officia. Ratione corporis consequatur in quia saepe alias et. Culpa dignissimos voluptatem tempora ipsam. At nihil quia excepturi molestiae eos reprehenderit aut. Minus magni qui asperiores. Enim velit voluptates in tempora ratione. Minima ratione illum assumenda qui totam praesentium. Vero labore maiores enim quis aut ea. Accusantium ut voluptate natus nam ea. Qui qui aspernatur autem natus fuga voluptas dolores. Voluptatem quaerat atque tempora hic laudantium. Aperiam voluptatem vero sed natus ut modi est. Et cum molestias est. Perferendis tempore maiores molestias velit aperiam est. Qui qui nam tempora autem inventore iste. Inventore numquam optio itaque ipsa optio non ea. Qui modi optio quia in iure. Enim officia quia pariatur ut qui maiores corporis. Nemo aut consequatur laudantium facere. Recusandae et est officiis et.', 'Dolorem laborum omnis in laborum aut perferendis qui. Veniam sed et laboriosam autem rerum. Consequatur laudantium voluptas voluptatem praesentium consequuntur consequuntur. Ipsam maxime reiciendis quia et assumenda occaecati.', '[{\"path\": \"default.jpg\", \"uuid\": \"fce6728e-dd89-4316-a0bb-e05cc0fc9cb2\"}]', 10000, 10500, 29, 1, NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_26_071052_create_brands_table', 1),
(6, '2022_05_26_071800_create_categories_table', 1),
(7, '2022_05_26_071836_create_items_table', 1),
(8, '2022_05_26_071944_create_carts_table', 1),
(9, '2022_05_26_072028_create_orders_table', 1),
(10, '2022_05_26_074601_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shipping` json NOT NULL,
  `courier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','processed','shipped','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipping`, `courier`, `payment`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '{\"name\": \"Teegan Villarreal\", \"phone\": \"+1 (471) 466-4053\", \"address\": \"Recusandae Aut reru\"}', 'sicepat', 'dana', 'completed', '2022-06-10 11:00:29', '2022-06-10 16:39:47'),
(2, 2, '{\"name\": \"Marah Levy\", \"phone\": \"+1 (743) 702-9402\", \"address\": \"Natus id corporis u\"}', 'pos', 'transfer', 'completed', '2022-06-10 11:01:42', '2022-06-10 16:39:41'),
(3, 2, '{\"name\": \"Echo Snider\", \"phone\": \"+1 (656) 568-3469\", \"address\": \"Fuga Perspiciatis\"}', 'pos', 'dana', 'pending', '2022-06-10 16:34:06', '2022-06-10 16:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `price`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 31500, 1, '2022-06-10 11:00:29', '2022-06-10 11:00:29'),
(2, 1, 8, 84000, 2, '2022-06-10 11:00:29', '2022-06-10 11:00:29'),
(3, 1, 5, 42000, 3, '2022-06-10 11:00:29', '2022-06-10 11:00:29'),
(4, 2, 5, 42000, 1, '2022-06-10 11:01:42', '2022-06-10 11:01:42'),
(5, 2, 19, 94500, 1, '2022-06-10 11:01:42', '2022-06-10 11:01:42'),
(6, 2, 12, 21000, 1, '2022-06-10 11:01:42', '2022-06-10 11:01:42'),
(7, 3, 2, 31500, 2, '2022-06-10 16:34:06', '2022-06-10 16:34:06'),
(8, 3, 4, 73500, 1, '2022-06-10 16:34:06', '2022-06-10 16:34:06'),
(9, 3, 5, 42000, 1, '2022-06-10 16:34:06', '2022-06-10 16:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Febri Sutomo', 'admin@gmail.com', NULL, '$2y$10$dqjqemw3RuxFNbWyat1Ftut/QTVD7zP6q9JgybKajKcVYwVo3nipa', 'admin', NULL, '2022-06-06 05:29:14', '2022-06-06 05:29:14'),
(2, 'Alex Murphy', 'customer@gmail.com', NULL, '$2y$10$K6KHEr0KSv0dmeHKYOR64un7MPuv4CJ5o9bqzKlQxf/q8GUhKTErC', 'customer', NULL, '2022-06-06 05:29:15', '2022-06-06 05:29:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_item_id_foreign` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_brand_id_foreign` (`brand_id`),
  ADD KEY `items_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
