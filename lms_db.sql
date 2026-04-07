-- MySQL dump 10.13  Distrib 9.5.0, for macos26.1 (arm64)
--
-- Host: localhost    Database: lms_db
-- ------------------------------------------------------
-- Server version	8.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id_course` int NOT NULL AUTO_INCREMENT,
  `course_name` varchar(200) NOT NULL,
  `description` text,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `quota` int NOT NULL DEFAULT '0',
  `id_category` int NOT NULL,
  `id_instructor` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_course`),
  KEY `fk_course_category` (`id_category`),
  KEY `fk_course_instructor` (`id_instructor`),
  CONSTRAINT `fk_course_category` FOREIGN KEY (`id_category`) REFERENCES `product_categories` (`id_category`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_course_instructor` FOREIGN KEY (`id_instructor`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'HTML & CSS Mastery','Belajar dasar-dasar HTML5 dan CSS3',150000.00,50,1,1,'2026-03-02 23:14:55'),(2,'JavaScript ES6+ Lengkap','JS modern dari dasar hingga async/await',250000.00,40,1,1,'2026-03-02 23:14:55'),(3,'React JS untuk Pemula','Membangun UI modern dengan React',350000.00,30,1,2,'2026-03-02 23:14:55'),(4,'Python untuk Data Science','Analisis data dengan Python, Pandas, NumPy',450000.00,35,2,2,'2026-03-02 23:14:55'),(5,'Machine Learning A-Z','Supervised & unsupervised learning dari nol',600000.00,20,2,3,'2026-03-02 23:14:55'),(6,'Flutter Mobile Development','Buat aplikasi Android & iOS dengan Flutter',400000.00,25,3,3,'2026-03-02 23:14:55'),(7,'UI/UX Design dengan Figma','Desain wireframe dan prototype di Figma',200000.00,45,4,4,'2026-03-02 23:14:55'),(8,'Ethical Hacking Fundamentals','Dasar-dasar penetration testing',500000.00,15,5,4,'2026-03-02 23:14:55'),(9,'AWS Cloud Practitioner','Persiapan sertifikasi AWS Cloud Practitioner',550000.00,20,6,5,'2026-03-02 23:14:55'),(10,'Docker & Kubernetes','Container orchestration untuk production',480000.00,18,7,5,'2026-03-02 23:14:55'),(11,'MySQL dari Nol hingga Mahir','SQL fundamentals sampai query kompleks',180000.00,60,8,1,'2026-03-02 23:14:55'),(12,'NoSQL dengan MongoDB','Database non-relasional untuk aplikasi modern',220000.00,30,8,2,'2026-03-02 23:14:55'),(13,'SEO & SEM Strategy','Optimalkan website di mesin pencari',120000.00,70,9,3,'2026-03-02 23:14:55'),(14,'Public Speaking Profesional','Teknik presentasi dan komunikasi efektif',75000.00,80,10,4,'2026-03-02 23:14:55'),(15,'Node.js & Express Backend','Bangun REST API dengan Node.js dan Express',380000.00,0,1,5,'2026-03-02 23:14:55');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrollments` (
  `id_enrollment` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_course` int NOT NULL,
  `enrolled_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','completed','dropped') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id_enrollment`),
  UNIQUE KEY `uq_user_course` (`id_user`,`id_course`),
  KEY `fk_enrollment_course` (`id_course`),
  CONSTRAINT `fk_enrollment_course` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_enrollment_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollments`
--

LOCK TABLES `enrollments` WRITE;
/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
INSERT INTO `enrollments` VALUES (1,6,1,'2026-03-02 23:15:12','completed'),(2,6,2,'2026-03-02 23:15:12','active'),(3,7,4,'2026-03-02 23:15:12','active'),(4,7,5,'2026-03-02 23:15:12','active'),(5,8,3,'2026-03-02 23:15:12','completed'),(6,8,6,'2026-03-02 23:15:12','active'),(7,9,7,'2026-03-02 23:15:12','active'),(8,9,8,'2026-03-02 23:15:12','dropped'),(9,10,1,'2026-03-02 23:15:12','completed'),(10,10,11,'2026-03-02 23:15:12','active'),(11,11,9,'2026-03-02 23:15:12','active'),(12,12,13,'2026-03-02 23:15:12','active'),(13,13,14,'2026-03-02 23:15:12','completed'),(14,14,2,'2026-03-02 23:15:12','active'),(15,15,10,'2026-03-02 23:15:12','active');
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id_category`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'Web Development','Kursus pemrograman web frontend & backend'),(2,'Data Science','Kursus analisis data, machine learning, dan AI'),(3,'Mobile Development','Kursus pengembangan aplikasi Android & iOS'),(4,'UI/UX Design','Kursus desain antarmuka dan pengalaman pengguna'),(5,'Cybersecurity','Kursus keamanan jaringan dan ethical hacking'),(6,'Cloud Computing','Kursus AWS, GCP, dan Azure'),(7,'DevOps','Kursus CI/CD, Docker, Kubernetes'),(8,'Database Management','Kursus SQL, NoSQL, dan manajemen database'),(9,'Digital Marketing','Kursus SEO, SEM, dan social media marketing'),(10,'Soft Skills','Kursus komunikasi, kepemimpinan, dan manajemen waktu');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` enum('student','instructor','admin') NOT NULL DEFAULT 'student',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Andi Prasetyo','andi.prasetyo@email.com','instructor','2026-03-02 23:12:57'),(2,'Budi Santoso','budi.santoso@email.com','instructor','2026-03-02 23:12:57'),(3,'Citra Dewi','citra.dewi@email.com','instructor','2026-03-02 23:12:57'),(4,'Dian Rahayu','dian.rahayu@email.com','instructor','2026-03-02 23:12:57'),(5,'Eka Nugroho','eka.nugroho@email.com','instructor','2026-03-02 23:12:57'),(6,'Fajar Maulana','fajar.maulana@email.com','student','2026-03-02 23:12:57'),(7,'Gita Lestari','gita.lestari@email.com','student','2026-03-02 23:12:57'),(8,'Hendra Wijaya','hendra.wijaya@email.com','student','2026-03-02 23:12:57'),(9,'Indah Permata','indah.permata@email.com','student','2026-03-02 23:12:57'),(10,'Joko Susilo','joko.susilo@email.com','student','2026-03-02 23:12:57'),(11,'Karina Putri','karina.putri@email.com','student','2026-03-02 23:12:57'),(12,'Lukman Hakim','lukman.hakim@email.com','student','2026-03-02 23:12:57'),(13,'Maya Sari','maya.sari@email.com','student','2026-03-02 23:12:57'),(14,'Nanda Kurniawan','nanda.kurniawan@email.com','student','2026-03-02 23:12:57'),(15,'Olivia Tan','olivia.tan@email.com','student','2026-03-02 23:12:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-17 15:50:59
