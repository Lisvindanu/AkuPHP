-- Database: anaphygon_retro
-- Company Profile Database untuk Anaphygon Retro

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anaphygon_retro`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$8ZitzIvizTzKyRskappOR.1yQwdpOoLwQfquHt83bXtWdnc6zLi0m', 'admin@anaphygon.com', 'admin', '2025-06-03 15:00:00'),
(2, 'user1', '$2y$10$eKoz9KgrSLB6TXrTPXFWiOXdEQoKQtyJaucEF4W3XpSjf7wNm4MEu', 'user@example.com', 'user', '2025-06-03 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price_range` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `icon`, `image`, `price_range`, `status`, `created_at`) VALUES
(1, 'Retro Web Design', 'Desain website dengan nuansa retro dan vintage yang unik dan menarik', 'fas fa-paint-brush', 'retro-web.jpg', '5jt - 15jt', 'active', '2025-06-03 15:00:00'),
(2, 'Brand Identity Design', 'Pembuatan identitas brand retro yang memorable dan timeless', 'fas fa-star', 'brand-identity.jpg', '3jt - 10jt', 'active', '2025-06-03 15:00:00'),
(3, 'Retro App Development', 'Pengembangan aplikasi mobile dengan interface retro modern', 'fas fa-mobile-alt', 'retro-app.jpg', '10jt - 25jt', 'active', '2025-06-03 15:00:00'),
(4, 'Vintage Marketing Materials', 'Desain materi marketing dengan gaya vintage dan retro', 'fas fa-bullhorn', 'vintage-marketing.jpg', '2jt - 8jt', 'active', '2025-06-03 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `client_name` varchar(200) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `project_url` varchar(500) DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `completion_date` date DEFAULT NULL,
  `status` enum('completed','in_progress','planning') DEFAULT 'completed',
  `featured` tinyint(1) DEFAULT '0',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `client_name`, `image`, `project_url`, `service_id`, `completion_date`, `status`, `featured`, `created_at`) VALUES
(1, 'RetroTech Startup Website', 'Website company profile untuk startup teknologi dengan konsep retro-futuristic', 'RetroTech Solutions', 'retrotech-project.jpg', 'https://retrotech-demo.com', 1, '2024-12-15', 'completed', 1, '2025-06-03 15:00:00'),
(2, 'Vintage Coffee Shop Branding', 'Complete branding package untuk coffee shop dengan tema vintage', 'Brew & Beans Cafe', 'vintage-coffee.jpg', NULL, 2, '2024-11-20', 'completed', 1, '2025-06-03 15:00:00'),
(3, 'Retro Gaming Mobile App', 'Aplikasi mobile game dengan interface pixel art retro', 'Pixel Games Studio', 'retro-gaming-app.jpg', 'https://play.google.com/retrogame', 3, '2025-01-10', 'completed', 1, '2025-06-03 15:00:00'),
(4, 'Classic Car Dealership Website', 'Website untuk dealer mobil klasik dengan desain retro elegant', 'Classic Auto Gallery', 'classic-cars.jpg', 'https://classicauto-demo.com', 1, '2024-10-30', 'completed', 0, '2025-06-03 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int NOT NULL,
  `client_name` varchar(200) NOT NULL,
  `client_position` varchar(200) DEFAULT NULL,
  `client_company` varchar(200) DEFAULT NULL,
  `testimonial_text` text NOT NULL,
  `client_photo` varchar(255) DEFAULT NULL,
  `rating` int DEFAULT '5',
  `project_id` int DEFAULT NULL,
  `featured` tinyint(1) DEFAULT '0',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_name`, `client_position`, `client_company`, `testimonial_text`, `client_photo`, `rating`, `project_id`, `featured`, `status`, `created_at`) VALUES
(1, 'Sarah Johnson', 'CEO', 'RetroTech Solutions', 'Anaphygon Retro berhasil menciptakan website yang benar-benar mencerminkan visi retro-futuristic kami. Tim yang sangat profesional dan kreatif!', 'sarah-johnson.jpg', 5, 1, 1, 'active', '2025-06-03 15:00:00'),
(2, 'Michael Chen', 'Owner', 'Brew & Beans Cafe', 'Branding yang dibuat oleh Anaphygon Retro sangat membantu cafe kami menciptakan identitas yang unik. Konsep vintage-nya pas banget!', 'michael-chen.jpg', 5, 2, 1, 'active', '2025-06-03 15:00:00'),
(3, 'David Rodriguez', 'Game Director', 'Pixel Games Studio', 'Interface retro yang dibuat untuk game kami mendapat respon luar biasa dari players. Benar-benar nostalgia gaming era 80-90an!', 'david-rodriguez.jpg', 5, 3, 1, 'active', '2025-06-03 15:00:00'),
(4, 'Jennifer Williams', 'Marketing Manager', 'Classic Auto Gallery', 'Website kami sekarang terlihat sangat elegant dan mencerminkan karakter mobil-mobil klasik yang kami jual. Excellent work!', 'jennifer-williams.jpg', 4, 4, 0, 'active', '2025-06-03 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(300) NOT NULL,
  `message` text NOT NULL,
  `service_interest` int DEFAULT NULL,
  `budget_range` varchar(100) DEFAULT NULL,
  `status` enum('new','read','replied','archived') DEFAULT 'new',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `replied_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `service_interest`, `budget_range`, `status`, `created_at`) VALUES
(1, 'Alex Thompson', 'alex@example.com', '+62812345678', 'Inquiry about Retro Web Design', 'Hi, saya tertarik dengan layanan retro web design untuk startup saya. Bisa diskusi lebih lanjut?', 1, '5jt - 15jt', 'new', '2025-06-03 10:00:00'),
(2, 'Maria Gonzalez', 'maria@restaurant.com', '+62876543210', 'Branding for Restaurant', 'Saya membutuhkan complete branding untuk restaurant baru saya dengan konsep vintage. Mohon info lebih lanjut.', 2, '3jt - 10jt', 'read', '2025-06-03 11:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_interest` (`service_interest`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_ibfk_1` FOREIGN KEY (`service_interest`) REFERENCES `services` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;