-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: DietDiary
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.2

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
-- Table structure for table `dummy`
--

DROP TABLE IF EXISTS `dummy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dummy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dummy`
--

LOCK TABLES `dummy` WRITE;
/*!40000 ALTER TABLE `dummy` DISABLE KEYS */;
INSERT INTO `dummy` VALUES (5,12),(6,11),(7,12);
/*!40000 ALTER TABLE `dummy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercise`
--

DROP TABLE IF EXISTS `exercise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exercise` (
  `exercise_id` int NOT NULL AUTO_INCREMENT,
  `exercise_name` char(255) NOT NULL,
  `links` varchar(255) DEFAULT NULL,
  `calories_burnt` float NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`exercise_id`),
  KEY `fk_exercise_users1_idx` (`user_id`),
  CONSTRAINT `fk_exercise_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercise`
--

LOCK TABLES `exercise` WRITE;
/*!40000 ALTER TABLE `exercise` DISABLE KEYS */;
INSERT INTO `exercise` VALUES (1,'Squats','NmDZ-1AQLmw',105,5),(2,'Pushups','zMP3Hzk7F2U',105,5),(3,'Jumping Jacks','-oJK49vILIA',150,6),(4,'Planks','bHOteDDCrLs',53,6),(5,'Tabata','prGRVLZROac',225,5);
/*!40000 ALTER TABLE `exercise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercise_benefits`
--

DROP TABLE IF EXISTS `exercise_benefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exercise_benefits` (
  `benefits` varchar(255) NOT NULL,
  `exercise_id` int NOT NULL,
  PRIMARY KEY (`benefits`,`exercise_id`),
  KEY `fk_exercise_benefits_exercise1_idx` (`exercise_id`),
  CONSTRAINT `fk_exercise_benefits_exercise1` FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`exercise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercise_benefits`
--

LOCK TABLES `exercise_benefits` WRITE;
/*!40000 ALTER TABLE `exercise_benefits` DISABLE KEYS */;
INSERT INTO `exercise_benefits` VALUES ('As squatting engages your hips, knees and ankles at the same time, the load not only helps build muscle, but also improves joint health and joint strength.',1),('Gaining strong core muscles can make everyday movements like turning, bending, and even standing easier.',1),('Squatting improves the flow of body fluids and aids in the removal of waste from the body. It improves the bowel movement and help in keeping it regular.',1),('With squats you strengthen the muscles in your lower body.Hence, you will be able to execute full-body movements with correct form, balance, mobility, and posture.',1),('Increases functional strength via full body activation.',2),('Pushups not only improve your flexibility, which helps prevent injuries, but a well-stretched muscle feature a solid and attractive appearance.',2),('Ultimately, pushups result in an effective cardiovascular exercise, which supports heart health and promotes the reduction of stored body fat.',2),('When push ups are properly executed, the muscles responsible for supporting posture are strengthened and fine-tuned.',2),('Jumping jacks being a cardio exercise, uses oxygen to meet the energy demands thereby stimulating your heart muscles.',3),('The planks and positions of doing the jumping jacks tone up your muscles and makes you fit and firm.',3),('This intensive exercise releases endorphins naturally, which are hormones that keep stress and depression at bay.',3),('Yet another benefit of doing jumping jacks on the regular is that they will over time help you increase your coordination.',3),('Plank improves your flexibility.',4),('Planks are able to improve your posture.',4),('The muscle strength and mass that can be attained through plank pose offers another incredible benefit to go along with those stronger and more defined muscles, a faster metabolism.',4),('The plank doesn’t just inhibit certain types of back pain but enhances the health of the back as a whole.',4),('As Tabata is a high-intensity workout, you have to stay focused and attentive, which helps to enhance your efficiency.',5),('Performing Tabata four times a week can help to improve your anaerobic capacity (amount of energy produced by the body by burning carbs) by 28 percent, and VO2 max (amount of oxygen consumed while exercising) by 15 percent.',5),('Tabata, puts stress on muscle tissues.',5),('This form of workout puts a lot of stress on your body and as a result, you burn more calories in a short period of time.',5);
/*!40000 ALTER TABLE `exercise_benefits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `rating` int DEFAULT '0',
  `user_id` int NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`f_id`),
  KEY `fk_feedback_users1_idx` (`user_id`),
  CONSTRAINT `fk_feedback_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `feedback_chk_1` CHECK ((`rating` between 0 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (6,'good application',4,3,'australia');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_chart`
--

DROP TABLE IF EXISTS `food_chart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `food_chart` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `quantity` float DEFAULT NULL,
  `calories` float NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_name` (`item_name`),
  KEY `fk_food_chart_users1_idx` (`user_id`),
  CONSTRAINT `fk_food_chart_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_chart`
--

LOCK TABLES `food_chart` WRITE;
/*!40000 ALTER TABLE `food_chart` DISABLE KEYS */;
INSERT INTO `food_chart` VALUES (1,'Apple Pie',1,277,5),(2,'Bread & Jam',1,85,6),(3,'Bread & Butter',1,172,6),(4,'Bread & Omelete',1,154,6),(5,'Dosa & Coconut chutney',1,87.2,5),(6,'Dosa & Green chutney',1,65.2,5),(7,'Idly & Mango chutney',1,96,5),(8,'Idly & Peanut chutney',1,104,5),(9,'Rice & Beetroot curry',1,287,6),(10,'Rice & Carrot curry',1,267,6),(11,'Rice & Plaintain curry',1,496,6),(12,'Brown Rice & Dal',1,303,5),(13,'Brown Rice & Tomato curry',1,300,5),(14,'Brown Rice & Chicken curry',1,336,5),(15,'Chapati & Egg Burji',1,339,6),(16,'Parata and Paneer Butter Masala',1,761,6),(17,'Fruit Salad',1,124,5),(18,'Milk Shake',1,119,5),(19,'Oats',1,307,5),(20,'Appam',1,99,5),(21,'Pongal',1,212,5),(22,'Pizza',1,285,6),(23,'Cheesecake',1,257,6),(24,'Veg Spring Roll',1,145,6),(25,'Veg Sandwich',1,266,5),(26,'Veg Biryani',1,241,6),(27,'Tomato Rice',1,266,5),(28,'Lemon Rice',1,253,5),(29,'Bacon',1,44,5),(30,'Jeera Rice',1,246,5);
/*!40000 ALTER TABLE `food_chart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_diary`
--

DROP TABLE IF EXISTS `my_diary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_diary` (
  `diary_id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`diary_id`),
  KEY `fk_my_diary_users_idx` (`user_id`),
  CONSTRAINT `fk_my_diary_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_diary`
--

LOCK TABLES `my_diary` WRITE;
/*!40000 ALTER TABLE `my_diary` DISABLE KEYS */;
INSERT INTO `my_diary` VALUES (20,'2020-11-07',3),(21,'2020-11-08',3),(22,'2020-11-09',3);
/*!40000 ALTER TABLE `my_diary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_diary_activity`
--

DROP TABLE IF EXISTS `my_diary_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_diary_activity` (
  `activity` varchar(15) NOT NULL,
  `diary_id` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `item_id` int DEFAULT NULL,
  `exercise_id` int DEFAULT NULL,
  PRIMARY KEY (`activity`,`diary_id`),
  KEY `diary_id` (`diary_id`),
  KEY `item_id` (`item_id`),
  KEY `exercise_id` (`exercise_id`),
  CONSTRAINT `my_diary_activity_ibfk_1` FOREIGN KEY (`diary_id`) REFERENCES `my_diary` (`diary_id`),
  CONSTRAINT `my_diary_activity_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `food_chart` (`item_id`),
  CONSTRAINT `my_diary_activity_ibfk_3` FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`exercise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_diary_activity`
--

LOCK TABLES `my_diary_activity` WRITE;
/*!40000 ALTER TABLE `my_diary_activity` DISABLE KEYS */;
INSERT INTO `my_diary_activity` VALUES ('Breakfast',20,'08:00:00',NULL,29,NULL),('Breakfast',21,'08:05:00','08:15:00',7,NULL),('Breakfast',22,'08:00:00',NULL,9,NULL),('Dinner',22,'20:30:00','20:50:00',10,NULL),('Exercise',20,'05:30:00','05:45:00',NULL,2),('Lunch',20,'13:00:00',NULL,9,NULL),('Lunch',22,'12:00:00','12:30:00',10,NULL),('Sleep',20,'16:00:00','17:00:00',NULL,NULL),('Sleep',22,'00:34:00','07:34:00',NULL,NULL),('Snacks',22,'06:30:00','06:35:00',1,NULL);
/*!40000 ALTER TABLE `my_diary_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile` (
  `profile_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `user_id` int NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ph_no` float DEFAULT NULL,
  `health_history` varchar(255) DEFAULT NULL,
  `gender` char(6) DEFAULT NULL,
  PRIMARY KEY (`profile_id`),
  KEY `fk_profile_users1_idx` (`user_id`),
  CONSTRAINT `fk_profile_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (4,'Ssdd','Sssss','2020-11-12',44,44,26,'bl.en.um@bl.students.amrita.edu',96897500000,'Hajskwkw','female'),(7,'Tanmayi','Doddapaneni','2002-06-21',5.5,78,27,'srdhardoddapaneni@gmail.com',8008060000,'None','female'),(8,'Jahnavi S S L','Chandaluri','2001-01-10',5.4,56,28,'abc@edu.com',123457000,'','female');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `q_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `questions` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`q_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (44,3,'please add a new item combo in the food chart . Combo name Idli & coconut chutney','2020-11-09 12:44:37');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_benefits`
--

DROP TABLE IF EXISTS `recipe_benefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_benefits` (
  `benefits` char(255) NOT NULL,
  `recipe_id` int NOT NULL,
  PRIMARY KEY (`benefits`,`recipe_id`),
  KEY `fk_recipe_benefits_recipes1_idx` (`recipe_id`),
  CONSTRAINT `fk_recipe_benefits_recipes1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_benefits`
--

LOCK TABLES `recipe_benefits` WRITE;
/*!40000 ALTER TABLE `recipe_benefits` DISABLE KEYS */;
INSERT INTO `recipe_benefits` VALUES ('Green smoothie is a tasty way to get a strong dose of fruits and veggies, which provide vital nutrients like vitamin A, vitamin C, folate and potassium.',1),('Green smoothies are packed with fiber, which lowers cholesterol and glucose levels.',1),('Green smoothies keep you feeling fuller for longer and regulates your body’s cleansing processes.',1),('Leafy green vegetables are full of antioxidants and carotenoids, which boost your brainpower, and help protect your brain.',1),('French toast has large amount of sodium offering 9 percent of daily recommended value in one slice.',2),('French toast is made with bread and eggs which is regarded as the great source of carbohydrates.',2),('French toast offers 1.4 grams of fiber i.e. 6 percent of daily recommended value.',2),('French toast promotes digestive health by adding bulk to the foods which satisfies hunger and also contributes to elimination of removing harmful byproducts of metabolism from the body.',2),('Broccoli is rich in fiber and antioxidants — both of which may support healthy bowel function and digestive health.',3),('Eating broccoli salad may support better blood sugar control in people with diabetes.',3),('Eating cruciferous vegetables like broccoli may protect against certain types of cancer.',3),('One of broccoli salad’s biggest advantages is its nutrient content. It’s loaded with a wide array of vitamins, minerals, fiber and other bioactive compounds.',3),('Red peppers are a good source of vitamin B6 and folate, which help proven anemia and vitamin A, which is important for healthy eyes and regenerating cells and tissues.',4),('Red peppers are a good source of vitamin E, an antioxidant that’s especially good for a healthy immune system.',4),('Red peppers are loaded with free-radical fighting vitamin C, a powerful antioxidant that helps increase our absorption of iron.',4),('Tomatoes are fibre-rich for healthy digestion and a rich source of antioxidants making them a good food for cancer prevention.',4),('Kale chips are a low energy density food, meaning that you can eat a lot of them without adding many calories to your diet.',5),('Kale contains no cholesterol and no unhealthy saturated or trans fats making it a good choice for cardiovascular health.',5),('Kale is one of the best known dietary sources of vitamin K. One cup of kale, which would make a small serving of kale chips, contains 472 micrograms of vitamin K1.',5),('The substantial vitamin A in kale chips helps to promote healthy vision.',5),('Basil serves as a strong anti-inflammatory with enzyme-inhibiting oils.',6),('Calcium found in mozzarella is beneficial to weight loss and protects against breast cancer. In addition, calcium is a player in bone structure and protects tooth enamel.',6),('Like the tomato, the antioxidants in basil are helpful in naturally preventing cancer, specifically skin, liver, oral and lung cancer.',6),('The basil herb contains essential oils, rich in antioxidants, vitamins and magnesium.',6),('Bok choy contains folate. Folate plays a role in the production and repair of DNA, so it might prevent cancer cells from forming due to mutations in the DNA.',7),('Bok choy contains vitamin C, vitamin E, and beta-carotene. These nutrients have powerful antioxidant properties that help protect cells against damage by free radicals.',7),('Bok choy is a rich source of choline that is an anti - inflammatory agent and is linked to enhancing learning abilities and memory power.',7),('Unlike most other fruits and vegetables, bok choy contains the mineral selenium.Selenium prevents inflammation and decreases tumor growth rates.',7),('Quinoa helps you in reducing weight. It is very less in calories and high in nutritional value and hence it is a perfect food choice for those looking for losing weight.',8),('Quinoa is gluten-free, cholesterol-free & non-GMO and is usually grown organically. It is perfect for people who are gluten intolerant.',8),('Quinoa is rich in iron which helps in keeping our red blood cells healthy and is the basis of hemoglobin formation.',8),('Quinoa provides 9 essential amino acids, making it a complete protein.',8);
/*!40000 ALTER TABLE `recipe_benefits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_ingredients`
--

DROP TABLE IF EXISTS `recipe_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_ingredients` (
  `ingredients` varchar(255) NOT NULL,
  `recipe_id` int NOT NULL,
  PRIMARY KEY (`ingredients`,`recipe_id`),
  KEY `fk_recipe_ingredients_recipes1_idx` (`recipe_id`),
  CONSTRAINT `fk_recipe_ingredients_recipes1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_ingredients`
--

LOCK TABLES `recipe_ingredients` WRITE;
/*!40000 ALTER TABLE `recipe_ingredients` DISABLE KEYS */;
INSERT INTO `recipe_ingredients` VALUES ('1 frozen banana',1),('1/4 cup fresh mint,about 10 leaves',1),('1/4 teaspoon good vanilla extract',1),('2 ice cubes',1),('2 tablespoons almond butter',1),('3/4 Almond Breeze Almondmilk Cashewmilk,more as needed',1),('Big handfuls fresh baby spinach,about 2 cups',1),('1 cup almond milk, or any milk',2),('1 teaspoon cinnamon',2),('1/2 cup frozen raspberries, thawed, with their juices',2),('1/4 teaspoon cardamom',2),('2 cups diced strawberries',2),('4 eggs',2),('8 1-inch slices challah bread',2),('Coconut oil, for brushing',2),('Maple syrup, for serving',2),('Pinch of sea salt',2),('Pinches of cane sugar',2),('1 and 1/2 tablespoons apple cider vinegar',3),('1 garlic clove, minced',3),('1 pound broccoli crowns',3),('1 tablespoon tamari',3),('1 teaspoon maple syrup or honey',3),('1/2 cup almonds',3),('1/2 cup pepitas',3),('1/2 teaspoon maple syrup',3),('1/3 cup diced red onions',3),('1/3 cup dried cranberries',3),('1/4 teaspoon sea salt, more to taste',3),('1/4 teaspoon smoked paprika, more to taste',3),('2 teaspoons Dijon mustard',3),('3 tablespoons extra-virgin olive oil',3),('3 tablespoons mayo',3),('1 medium yellow onion, chopped',4),('1 small fennel bulb, coarsely chopped',4),('1 tablespoon fresh thyme leaves',4),('1/2 teaspoon freshly ground black pepper',4),('1/2 teaspoon red pepper flakes, optional',4),('1/2 to 1 teaspoon sea salt',4),('1/4 cup cooked cannellini beans, drained and rinsed',4),('1/4 cup extra-virgin olive oil, divided, plus more for drizzling',4),('2 garlic cloves, chopped',4),('2 tablespoons balsamic vinegar',4),('2 tablespoons tomato paste',4),('3 jarred roasted red bell peppers',4),('3 medium carrots, chopped',4),('4 cups vegetable broth',4),('1 garlic clove',5),('1 teaspoon honey or agave',5),('1/2 cup chopped parsley',5),('1/2 package tempeh, sliced into 1/4\" thick strips',5),('1/4 cup dried cranberries',5),('1/4 cup toasted pine nuts or other nuts',5),('2 tablespoons extra-virgin olive oil',5),('2 tablespoons tahini',5),('2-3 scallions, chopped, white and green parts',5),('2-3 tablespoons lemon juice, plus some zest',5),('A few pinches of red pepper flakes',5),('Drizzle of honey',5),('Extra-virgin olive oil, for drizzling',5),('Grated pecorino or parmesan cheese, reserve some for garnish (omit if vegan, or replace with nutritional yeast)',5),('Large bunch of kale',5),('Sea salt and fresh black pepper',5),('Splash of balsamic',5),('Splash of soy sauce',5),('Water to thin, as needed',5),('1 (8-ounce) ball fresh mozzarella, sliced',6),('3 to 4 medium heirloom tomatoes, sliced',6),('Avocado slices',6),('Dollops of pesto',6),('Drizzle of balsamic vinegar or reduced balsamic',6),('Extra-virgin olive oil, for drizzling',6),('Flaky sea salt and freshly ground black pepper',6),('Fresh basil leaves',6),('Mint leaves',6),('Sliced peaches',6),('Strawberries',6),('1 and 1/2 tablespoons tamari',7),('1 carrot, peeled into thin strips',7),('1 small garlic clove, minced',7),('1 tablespoon sunflower oil (or any high-heat oil)',7),('1 teaspoon fresh lime juice, plus extra lime slices for serving',7),('1/2 cup edamame',7),('1/2 small head broccoli, florets chopped, stems peeled into strips',7),('1/2 teaspoon honey (or maple syrup if vegan)',7),('1/2 teaspoon minced ginger',7),('1/2 teaspoon sesame oil',7),('2 baby bok choy, sliced vertically into quarters',7),('2 scallions, chopped',7),('2 tablespoons rice vinegar',7),('2 teaspoons sesame seeds',7),('4 ounces brown rice pasta',7),('4 ounces shiitake mushrooms, stems removed, sliced',7),('Sambal or sriracha, for serving',7),('1 cup quinoa',8),('1 large spring onion, sliced thinly',8),('1 tsp chilli paste / a pinch of flakes (optional)',8),('1 zucchini / courgette',8),('1/2 cup frozen peas (or fresh if available)',8),('1/2 cup mung bean sprouts (or other sprouts)',8),('1/2 large avocado, sliced',8),('1/2 roasted or raw garlic clove, grated finely',8),('10 green Kalamata olives, pitted and quartered',8),('3 tbsp extra virgin olive oil',8),('3 tbsp lemon or lime juice',8),('A handful of mint and basil leaves, chopped finely',8),('Approx. 100 g / 3.5 oz green salad (baby spinach and lollo rosso)',8),('Salt and pepper, to taste',8),('Small broccoli, divided into florets',8),('Small cucumber, sliced',8),('Small wedge of red cabbage, shredded thinly',8);
/*!40000 ALTER TABLE `recipe_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_procedures`
--

DROP TABLE IF EXISTS `recipe_procedures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_procedures` (
  `procedures` varchar(750) NOT NULL,
  `recipe_id` int NOT NULL,
  PRIMARY KEY (`procedures`,`recipe_id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `recipe_procedures_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_procedures`
--

LOCK TABLES `recipe_procedures` WRITE;
/*!40000 ALTER TABLE `recipe_procedures` DISABLE KEYS */;
INSERT INTO `recipe_procedures` VALUES ('1) In a blender, combine the banana, spinach, mint leaves, almond butter, ice, vanilla and cashew milk.',1),('2) Blend until smooth.',1),('3) Add more cashew milk as needed for desired consistency.',1),('4) Pour into glasses and serve.',1),('1) Make the macerated berries: In a medium bowl, combine the strawberries, raspberries, and a few pinches of sugar. Set aside for 10 minutes for the berries to soften. Stir before serving.',2),('2) Make the french toast: In a large bowl, whisk together the eggs, milk, cinnamon, cardamom, and salt. Dip each slice of bread into the mixture and set the soaked bread aside on a large tray or plate.',2),('3) Heat a non-stick skillet to medium heat and brush with coconut oil. Add the bread slices and cook until golden brown, about 2 minutes per side. Reduce the heat to low as needed to cook thoroughly without burning. Serve with maple syrup and the macerated berries.',2),('1) Preheat the oven to 350°F and line a baking sheet with parchment paper.',3),('2) Chop the broccoli florets into 1/2-inch pieces and any remaining stems into 1/4-inch dice. Peel any woody or course parts from the stem first.',3),('3) In the bottom of a large bowl, whisk together the olive oil, mayo, apple cider vinegar, mustard, maple syrup, garlic, and salt. Add the broccoli, onions, and cranberries and toss to coat.',3),('4) Place the almonds and pepitas on the baking sheet, toss with the tamari, maple syrup, and smoked paprika and spread into a thin layer. Bake 10 to 14 minutes or until golden brown. Remove from the oven and let cool for 5 minutes (they’ll get crispier as they sit).',3),('5) Toss the almonds and pepitas into the salad, reserving a few to sprinkle on top. Season to taste and serve.',3),('1) Heat 2 tablespoons olive oil in a large pot over medium heat. Add the onion and pinches of salt and pepper and cook until translucent, about 5 minutes.',4),('2) Add the garlic, fennel, carrots, and thyme leaves. Stir and cook until the carrots begin to soften, about 10 minutes.',4),('3) Add the balsamic vinegar, red peppers, beans, tomato paste, broth, and 1/2 teaspoon salt. Simmer until the carrots are tender, 15 to 20 minutes.',4),('4) Add the simmered soup to a high-speed blender with the remaining 2 tablespoons olive oil and puree until smooth. Season with more salt and pepper, to taste. If you would like more punch, add a few more drops of balsamic, to taste. If you would like a little heat, add 1/2 teaspoon red pepper flakes.',4),('5) Serve with generous drizzles of olive oil, desired garnishes, and warm baguette.',4),('1) Preheat the oven to 400 degrees.',5),('2) Start the dressing: In a small bowl combine the olive oil, lemon juice, zest, honey, and a few pinches salt and pepper. Give your garlic clove a good smash and drop it in. You’re going to fish it out later, after it sits and infuses garlic flavor into the oil (alternatively, just mince it in). Set aside while you work on the other components.',5),('3) Drizzle the whole kale leaves with olive oil, salt & pepper. Spread into a single layer on a baking sheet (you might need 2). Bake in the oven for 8-12 minutes or until the edges are crispy and the centers are wilted. Remove from the oven and let cool to room temperature. Stack the leaves and chop them, removing the coarser parts of the stems. Set aside.',5),('4) Start the tempeh: Heat oil in a small skillet. When your pan is hot, add the tempeh. Cook on both sides for a few minutes until it starts to brown. Then add a splash of soy sauce and balsamic. Flip around to coat all sides. Add a drizzle of honey and cook a few minutes longer until the sugar and vinegar caramelize a bit on the edges of the tempeh. (This got sticky in my pan, and some of the sugar burned, but that slight char ends up tasting really good). Remove from heat and chop into bite size pieces.',5),('5) Finish the dressing: Fish out the garlic clove (it’s ok if some bits stay in, just try to remove the larger pieces of the skin). Whisk in the tahini, cheese or nutritional yeast, water if necessary to thin it, and a few red pepper flakes. Taste and adjust seasonings to your liking.',5),('6) Toss the kale leaves with some of the dressing, adding as much or little as you like. Add the scallions, cranberries, parsley, and tempeh pieces and toss again. Plate and garnish with pine nuts & more grated cheese.',5),('7) Serve with extra dressing on the side.',5),('1) Arrange the tomatoes, mozzarella, and basil leaves on a platter. Drizzle with olive oil and sprinkle with sea salt and freshly ground black pepper.',6),('2) If desired, add ingredients from the variations list.',6),('1) Make the sauce by stirring together the tamari, rice vinegar, lime juice, honey, ginger, garlic, and sesame oil. Set aside.',7),('2) In a pot of salted boiling water, cook the noodles according to the package directions until al dente. Drain, rinse and set aside (or leave them in cold water or toss with a little oil to prevent clumping).',7),('3) Heat the oil in a large skillet over medium heat. Add the shiitake mushrooms and broccoli, stir to coat then let cook 1 to 2 minutes until the mushrooms begin to soften and the broccoli begins to brown.',7),('4) Give the pan a good shake and stir, then add the scallions, bok choy, and edamame. Cook, stirring occasionally for another 2 minutes, until the bok choy and broccoli are tender but still vibrant.',7),('5) Add the carrots and noodles and toss. Add the sauce, toss again. Add a squeeze of lime. Taste and adjust seasonings. Sprinkle with sesame seeds. Serve with extra lime slices and sambal or sriracha on the side.',7),('1) Rinse quinoa and place it in a small pot that you have a glass lid for. Add a few pinches of salt and 1.5 cups of water (prefect quinoa ratio is 1:1.5), cover with a lid and bring to boil. Once the water boils, decrease the heat to low-medium and let the quinoa simmer until all the water has been absorbed. To check, tilt the pot slightly, keeping the lid firmly on. If you see no water seeping out from under the grain, it means you are good to go. Switch off the heat completely and let quinoa sit on a hot hob (with lid firmly on) for another 5 mins to finish off cooking in its own steam. Once ready, cool it down completely before adding it to the salad as otherwise the salad leaves will wilt.',8),('2) Bring a pot of water to boil. Prepare a bowl of cold water with a few ice cubes and set it next to the stove. Once the water boils, add broccoli florets and frozen peas and cook for about 90 seconds. Once the time is up, drain the vegetables and immediately plunge them into the cold water so that they retain their beautiful colour. Place on a sieve to drain well. Lightly season with salt and pepper before adding to the salad.',8),('3) Prepare zucchini by either turning it into zoodles (use a speed peeler for wide ribbons) or slicing it and grilling it on a grill pan. If grilling, brush each slice with a bit of olive oil, season with salt and pepper and arrange on a hot (that’s important) grill / griddle pan. Once the slices are browned on one side, turn them over and let them brown on the other side.',8),('4) Mix all the dressing ingredients together and set aside.',8),('5) Just before serving, combine all the salad ingredients in a large bowl. Drizzle the dressing over and scatter spring onions, sprouts and herbs on top.',8);
/*!40000 ALTER TABLE `recipe_procedures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipes` (
  `recipe_id` int NOT NULL AUTO_INCREMENT,
  `recipe_name` varchar(255) DEFAULT NULL,
  `user_id` int NOT NULL,
  `category` char(20) DEFAULT NULL,
  `prep_time` int DEFAULT NULL,
  `cook_time` int DEFAULT NULL,
  `serves` varchar(6) DEFAULT NULL,
  `calories` float DEFAULT NULL,
  PRIMARY KEY (`recipe_id`),
  KEY `fk_recipes_users1_idx` (`user_id`),
  CONSTRAINT `fk_recipes_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (1,'Green_Smoothie',5,'breakfast',5,0,'2',136),(2,'Classic_French_Toast',6,'breakfast',6,16,'4',180),(3,'Broccoli_Salad',6,'lunch',10,15,'4 to 6',196),(4,'Roasted_Red_Pepper_Soup',5,'lunch',10,35,'4',320),(5,'Kale_Chips',5,'snack',10,10,'6',58),(6,'Caprese_Salad',5,'snack',10,0,'4 to 6',160),(7,'Bok_Choy_Stir_Fry',6,'dinner',15,15,'2',110),(8,'Quinoa_Superfood_Salad',5,'dinner',15,15,'4',269);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responses`
--

DROP TABLE IF EXISTS `responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `responses` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `responses` varchar(255) DEFAULT NULL,
  `q_id` int NOT NULL,
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `user_id` (`user_id`),
  KEY `q_id` (`q_id`),
  CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`q_id`) REFERENCES `questions` (`q_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responses`
--

LOCK TABLES `responses` WRITE;
/*!40000 ALTER TABLE `responses` DISABLE KEYS */;
INSERT INTO `responses` VALUES (33,5,'Your Request will be processed shortly',44,'2020-11-09 12:50:03');
/*!40000 ALTER TABLE `responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statistics` (
  `date` date NOT NULL,
  `cal_intake` float DEFAULT NULL,
  `cal_burned` float DEFAULT NULL,
  `diary_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`date`,`diary_id`,`user_id`),
  KEY `diary_id` (`diary_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `statists_ibfk_1` FOREIGN KEY (`diary_id`) REFERENCES `my_diary` (`diary_id`),
  CONSTRAINT `statists_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(10) NOT NULL,
  `password` varchar(8) NOT NULL,
  `category` varchar(15) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'user1','abc','user'),(4,'user2','user@123','user'),(5,'admin1','admin@1','admin'),(6,'admin2','admin@2','admin'),(7,'nu1','nu@123','nutritionist'),(26,'Xddd','123Aa','user'),(27,'tanmayi','tanu8008','user'),(28,'angel','jaanu','user');
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

-- Dump completed on 2020-11-10 13:05:42
