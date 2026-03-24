-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2026 at 06:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentskillenhancement`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `user_id`, `message`, `timestamp`) VALUES
(9, 1, 'hello everyone', '2025-12-17 19:42:35'),
(10, 4, 'hello', '2025-12-17 19:42:49'),
(11, 1, 'can you completed java course', '2025-12-17 19:45:05'),
(12, 4, 'half is done', '2025-12-17 19:45:16'),
(13, 1, 'ohh till which lecture ?', '2025-12-17 19:45:32'),
(14, 4, '4.5', '2025-12-17 19:45:45'),
(15, 1, 'how are you', '2025-12-17 19:46:38'),
(16, 4, 'fine', '2025-12-17 19:46:43'),
(17, 4, 'what about you', '2025-12-17 19:46:51'),
(18, 1, 'same', '2025-12-17 19:46:57'),
(19, 4, 'hii', '2025-12-18 20:37:40'),
(20, 1, 'hello', '2025-12-18 20:38:55'),
(21, 4, 'bol naaaa', '2025-12-18 20:40:10'),
(22, 6, 'hii', '2025-12-18 20:41:03'),
(23, 5, 'hi', '2026-01-01 14:19:18'),
(24, 1, 'How was the course progress', '2026-01-16 19:39:42'),
(25, 5, 'Fine', '2026-01-16 19:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `course_database`
--

CREATE TABLE `course_database` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `course_type` int(11) NOT NULL,
  `course_owner` int(11) NOT NULL,
  `course_price` int(11) NOT NULL DEFAULT 1,
  `course_date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_database`
--

INSERT INTO `course_database` (`course_id`, `course_name`, `course_type`, `course_owner`, `course_price`, `course_date_created`) VALUES
(1, 'Java Programming', 1, 6, 5, '2025-12-15 07:51:26'),
(2, 'Python Programming', 1, 17, 5, '2025-12-15 08:19:16'),
(3, 'Android Programming', 5, 19, 5, '2025-12-15 08:20:40'),
(4, 'Elements of Electrical Engineering', 2, 16, 5, '2025-12-15 08:33:52'),
(5, 'Thermodynamics', 6, 22, 5, '2025-12-15 09:54:17'),
(6, 'PHP', 1, 17, 5, '2025-12-16 03:50:02'),
(11, 'Javascript', 1, 4, 5, '2026-03-12 17:32:12'),
(12, 'Javascript Fundamentals', 1, 16, 5, '2026-03-12 17:35:03'),
(13, 'Advanced Javascript', 1, 4, 5, '2026-03-12 17:35:03'),
(14, 'HTML Complete Guide', 1, 17, 5, '2026-03-12 17:35:03'),
(15, 'CSS Masterclass', 1, 22, 5, '2026-03-12 17:35:03'),
(16, 'React Development', 1, 6, 5, '2026-03-12 17:35:03'),
(17, 'NodeJS Backend Development', 1, 16, 5, '2026-03-12 17:35:03'),
(18, 'PHP Web Development', 1, 4, 5, '2026-03-12 17:35:03'),
(19, 'Full Stack Web Development', 1, 17, 5, '2026-03-12 17:35:03'),
(20, 'Frontend Engineering', 1, 4, 5, '2026-03-12 17:35:03'),
(21, 'Web Performance Optimization', 1, 4, 5, '2026-03-12 17:35:03'),
(22, 'Python Programming', 2, 4, 5, '2026-03-12 17:35:43'),
(23, 'Java Programming', 2, 6, 5, '2026-03-12 17:35:43'),
(24, 'C Programming', 2, 19, 5, '2026-03-12 17:35:43'),
(25, 'C++ Programming', 2, 6, 5, '2026-03-12 17:35:43'),
(26, 'Data Structures', 2, 19, 5, '2026-03-12 17:35:43'),
(27, 'Algorithms Design', 2, 17, 5, '2026-03-12 17:35:43'),
(28, 'Object Oriented Programming', 2, 17, 5, '2026-03-12 17:35:43'),
(29, 'Software Engineering', 2, 6, 5, '2026-03-12 17:35:43'),
(30, 'Operating Systems', 2, 16, 5, '2026-03-12 17:35:43'),
(31, 'Computer Architecture', 2, 17, 5, '2026-03-12 17:35:43'),
(32, 'Database Fundamentals', 3, 16, 5, '2026-03-12 17:35:55'),
(33, 'MySQL Database', 3, 17, 5, '2026-03-12 17:35:55'),
(34, 'PostgreSQL Administration', 3, 19, 5, '2026-03-12 17:35:55'),
(35, 'MongoDB Development', 3, 16, 5, '2026-03-12 17:35:55'),
(36, 'NoSQL Databases', 3, 22, 5, '2026-03-12 17:35:55'),
(37, 'SQL Optimization', 3, 19, 5, '2026-03-12 17:35:56'),
(38, 'Database Security', 3, 19, 5, '2026-03-12 17:35:56'),
(39, 'Data Warehousing', 3, 17, 5, '2026-03-12 17:35:56'),
(40, 'Big Data Storage', 3, 19, 5, '2026-03-12 17:35:56'),
(41, 'Database Design', 3, 6, 5, '2026-03-12 17:35:56'),
(42, 'Machine Learning Basics', 4, 6, 5, '2026-03-12 17:36:08'),
(43, 'Deep Learning', 4, 4, 5, '2026-03-12 17:36:08'),
(44, 'Artificial Intelligence', 4, 6, 5, '2026-03-12 17:36:08'),
(45, 'Data Science', 4, 16, 5, '2026-03-12 17:36:08'),
(46, 'Natural Language Processing', 4, 22, 5, '2026-03-12 17:36:08'),
(47, 'Computer Vision', 4, 4, 5, '2026-03-12 17:36:08'),
(48, 'Neural Networks', 4, 19, 5, '2026-03-12 17:36:08'),
(49, 'AI Model Deployment', 4, 6, 5, '2026-03-12 17:36:08'),
(50, 'Reinforcement Learning', 4, 17, 5, '2026-03-12 17:36:08'),
(51, 'AI Ethics', 4, 19, 5, '2026-03-12 17:36:08'),
(52, 'Cyber Security Basics', 5, 17, 5, '2026-03-12 17:36:26'),
(53, 'Ethical Hacking', 5, 19, 5, '2026-03-12 17:36:26'),
(54, 'Network Security', 5, 16, 5, '2026-03-12 17:36:26'),
(55, 'Digital Forensics', 5, 19, 5, '2026-03-12 17:36:26'),
(56, 'Penetration Testing', 5, 17, 5, '2026-03-12 17:36:26'),
(57, 'Malware Analysis', 5, 4, 5, '2026-03-12 17:36:26'),
(58, 'Cloud Security', 5, 17, 5, '2026-03-12 17:36:26'),
(59, 'Application Security', 5, 19, 5, '2026-03-12 17:36:26'),
(60, 'Security Operations', 5, 22, 5, '2026-03-12 17:36:26'),
(61, 'Information Security Management', 5, 17, 5, '2026-03-12 17:36:26'),
(62, 'Cloud Computing', 6, 4, 5, '2026-03-12 17:36:51'),
(63, 'AWS Cloud Practitioner', 6, 17, 5, '2026-03-12 17:36:51'),
(64, 'Azure Fundamentals', 6, 4, 5, '2026-03-12 17:36:51'),
(65, 'Google Cloud Platform', 6, 17, 5, '2026-03-12 17:36:51'),
(66, 'Docker Containers', 6, 6, 5, '2026-03-12 17:36:51'),
(67, 'Kubernetes Deployment', 6, 4, 5, '2026-03-12 17:36:51'),
(68, 'DevOps Engineering', 6, 19, 5, '2026-03-12 17:36:51'),
(69, 'CI CD Pipelines', 6, 6, 5, '2026-03-12 17:36:51'),
(70, 'Infrastructure as Code', 6, 19, 5, '2026-03-12 17:36:51'),
(71, 'Site Reliability Engineering', 6, 22, 5, '2026-03-12 17:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `course_quiz`
--

CREATE TABLE `course_quiz` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(300) NOT NULL,
  `option_b` varchar(300) NOT NULL,
  `option_c` varchar(300) NOT NULL,
  `option_d` varchar(300) NOT NULL,
  `correct_option` char(1) NOT NULL COMMENT 'A, B, C or D'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_quiz`
--

INSERT INTO `course_quiz` (`id`, `course_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(1, 11, 'What will be the output?\r\nconsole.log(typeof \"Hello\");', 'string ', 'text ', 'object ', 'char', 'A'),
(2, 1, 'Which keyword is used to create a class in Java?', 'class', 'Class', 'define', 'struct', 'A'),
(3, 1, 'What is the default value of an int variable in Java?', '1', 'null', '0', '-1', 'C'),
(4, 1, 'Which method is the entry point of a Java program?', 'start()', 'main()', 'run()', 'init()', 'B'),
(5, 1, 'Which of these is NOT a Java primitive type?', 'int', 'boolean', 'String', 'char', 'C'),
(6, 1, 'What does JVM stand for?', 'Java Virtual Machine', 'Java Variable Method', 'Java Verified Module', 'Java Visual Manager', 'A'),
(7, 2, 'Which symbol is used for single-line comments in Python?', '//', '#', '--', '**', 'B'),
(8, 2, 'What is the output of print(2 ** 3) in Python?', '6', '8', '9', '5', 'B'),
(9, 2, 'Which function is used to get the length of a list in Python?', 'size()', 'count()', 'len()', 'length()', 'C'),
(10, 2, 'How do you create a function in Python?', 'function myFunc():', 'def myFunc():', 'create myFunc():', 'func myFunc():', 'B'),
(11, 2, 'Which data type is used to store True or False in Python?', 'int', 'string', 'bool', 'bit', 'C'),
(12, 3, 'What language is primarily used for Android development?', 'Swift', 'Kotlin', 'Ruby', 'Perl', 'B'),
(13, 3, 'What file defines the UI layout in Android?', '.java file', 'XML layout file', '.json file', '.html file', 'B'),
(14, 3, 'What is an Activity in Android?', 'A database table', 'A single screen with UI', 'A background service', 'A network call', 'B'),
(15, 3, 'Which file contains app permissions in Android?', 'build.gradle', 'MainActivity.java', 'AndroidManifest.xml', 'strings.xml', 'C'),
(16, 3, 'What is the Android IDE called?', 'Eclipse', 'NetBeans', 'Android Studio', 'IntelliJ CE', 'C'),
(17, 4, 'What is the unit of electric current?', 'Volt', 'Watt', 'Ampere', 'Ohm', 'C'),
(18, 4, 'Ohm\'s Law states that V =', 'I + R', 'I * R', 'I / R', 'R / I', 'B'),
(19, 4, 'What does a resistor do in a circuit?', 'Stores charge', 'Opposes current flow', 'Amplifies voltage', 'Generates current', 'B'),
(20, 4, 'The unit of electrical resistance is?', 'Ampere', 'Volt', 'Ohm', 'Watt', 'C'),
(21, 4, 'What is the unit of electrical power?', 'Joule', 'Watt', 'Volt', 'Ampere', 'B'),
(22, 5, 'What does the First Law of Thermodynamics state?', 'Energy cannot be created or destroyed', 'Heat flows from cold to hot', 'Entropy always decreases', 'Work equals force times distance', 'A'),
(23, 5, 'What is the unit of temperature in SI system?', 'Celsius', 'Fahrenheit', 'Kelvin', 'Rankine', 'C'),
(24, 5, 'Which process occurs at constant pressure?', 'Isochoric', 'Isobaric', 'Isothermal', 'Adiabatic', 'B'),
(25, 5, 'What is entropy a measure of?', 'Temperature', 'Pressure', 'Disorder in a system', 'Volume', 'C'),
(26, 5, 'An adiabatic process has no transfer of?', 'Work', 'Mass', 'Heat', 'Pressure', 'C'),
(27, 6, 'PHP stands for?', 'Personal Home Page', 'PHP Hypertext Preprocessor', 'Private Home Protocol', 'Public HTML Page', 'B'),
(28, 6, 'Which symbol starts a PHP variable?', '#', '@', '$', '&', 'C'),
(29, 6, 'Which function outputs text in PHP?', 'print_text()', 'echo()', 'console.log()', 'write()', 'B'),
(30, 6, 'How do you start a PHP block?', '<php>', '<?php', '<script php>', '<%php', 'B'),
(31, 6, 'Which superglobal holds form POST data?', '$_GET', '$_SESSION', '$_POST', '$_FORM', 'C'),
(32, 11, 'Which keyword declares a variable in modern JavaScript?', 'var', 'let', 'dim', 'int', 'B'),
(33, 11, 'What does DOM stand for?', 'Document Object Model', 'Data Object Method', 'Display Output Mode', 'Document Order Map', 'A'),
(34, 11, 'Which method adds an element to the end of an array?', 'push()', 'pop()', 'shift()', 'add()', 'A'),
(35, 11, 'How do you write a comment in JavaScript?', '<!-- comment -->', '# comment', '// comment', '** comment', 'C'),
(36, 11, 'Which operator checks value AND type equality?', '==', '=', '===', '!=', 'C'),
(37, 12, 'What is the correct way to declare a constant in JavaScript?', 'var', 'let', 'const', 'static', 'C'),
(38, 12, 'What does NaN mean in JavaScript?', 'Not a Node', 'Not a Number', 'Null and None', 'New Array Node', 'B'),
(39, 12, 'Which built-in method converts a string to an integer?', 'toInt()', 'parseInt()', 'intValue()', 'convert()', 'B'),
(40, 12, 'What is the result of typeof \"hello\"?', 'string', 'text', 'char', 'object', 'A'),
(41, 12, 'Which event fires when a button is clicked?', 'onhover', 'onload', 'onclick', 'onpress', 'C'),
(42, 13, 'What is a closure in JavaScript?', 'A loop that closes', 'A function with access to its outer scope', 'A sealed object', 'An error handler', 'B'),
(43, 13, 'What does async/await help with?', 'Styling', 'Synchronous loops', 'Asynchronous code', 'Database queries', 'C'),
(44, 13, 'What is a Promise in JavaScript?', 'A variable declaration', 'An object representing future value', 'A CSS property', 'A loop construct', 'B'),
(45, 13, 'Which method is used to chain Promises?', '.next()', '.then()', '.after()', '.resolve()', 'B'),
(46, 13, 'What does the spread operator (...) do?', 'Multiplies values', 'Expands an iterable', 'Declares a function', 'Closes a loop', 'B'),
(47, 14, 'What does HTML stand for?', 'Hyper Text Markup Language', 'High Tech Modern Language', 'Hyper Transfer Markup Logic', 'Home Tool Markup Language', 'A'),
(48, 14, 'Which tag creates a hyperlink in HTML?', '<link>', '<a>', '<href>', '<url>', 'B'),
(49, 14, 'Which tag is used for the largest heading?', '<h6>', '<heading>', '<h1>', '<head>', 'C'),
(50, 14, 'What attribute specifies the URL of an image?', 'href', 'link', 'src', 'url', 'C'),
(51, 14, 'Which HTML tag creates an unordered list?', '<ol>', '<li>', '<ul>', '<list>', 'C'),
(52, 15, 'What does CSS stand for?', 'Computer Style Sheets', 'Cascading Style Sheets', 'Creative Style System', 'Colorful Style Syntax', 'B'),
(53, 15, 'Which property changes text color in CSS?', 'font-color', 'text-color', 'color', 'foreground', 'C'),
(54, 15, 'Which CSS property controls the space inside an element?', 'margin', 'border', 'padding', 'spacing', 'C'),
(55, 15, 'How do you select an element with id \"header\" in CSS?', '.header', '#header', 'header', '*header', 'B'),
(56, 15, 'Which value of display makes elements sit side by side?', 'block', 'inline', 'flex', 'grid', 'B'),
(57, 16, 'React is a library for building?', 'Databases', 'User Interfaces', 'Servers', 'APIs', 'B'),
(58, 16, 'What is JSX?', 'A database query language', 'JavaScript XML syntax', 'A CSS framework', 'A testing tool', 'B'),
(59, 16, 'Which hook manages state in a functional component?', 'useEffect', 'useRef', 'useState', 'useContext', 'C'),
(60, 16, 'What is a React component?', 'A CSS class', 'A reusable UI piece', 'A database table', 'A server route', 'B'),
(61, 16, 'Which method renders a React component to the DOM?', 'ReactDOM.render()', 'React.show()', 'React.mount()', 'ReactDOM.display()', 'A'),
(62, 17, 'Node.js runs JavaScript on the?', 'Browser', 'Server', 'Database', 'Mobile', 'B'),
(63, 17, 'Which module is used to create an HTTP server in Node.js?', 'fs', 'path', 'http', 'url', 'C'),
(64, 17, 'What is npm?', 'Node Package Manager', 'New Program Method', 'Node Process Monitor', 'Network Protocol Module', 'A'),
(65, 17, 'Which function handles asynchronous operations in Node.js?', 'setTimeout', 'callback', 'async/await', 'All of the above', 'D'),
(66, 17, 'Express.js is used for?', 'Styling web pages', 'Building web servers', 'Managing databases', 'Testing code', 'B'),
(67, 18, 'Which function connects PHP to a MySQL database?', 'mysql_open()', 'mysqli_connect()', 'db_connect()', 'sql_link()', 'B'),
(68, 18, 'Which PHP function sends an HTTP header?', 'send_header()', 'header()', 'http_header()', 'set_header()', 'B'),
(69, 18, 'What does $_SESSION store?', 'File uploads', 'User session data', 'Database results', 'Form files', 'B'),
(70, 18, 'Which PHP function prevents SQL injection?', 'clean_string()', 'sanitize()', 'mysqli_real_escape_string()', 'strip_tags()', 'C'),
(71, 18, 'What is the correct way to include a file in PHP?', 'import file.php', 'require file.php', 'include \"file.php\"', '#include file.php', 'C'),
(72, 19, 'What does \"full stack\" mean?', 'Only frontend', 'Only backend', 'Both frontend and backend', 'Only database', 'C'),
(73, 19, 'Which language is used for frontend styling?', 'PHP', 'Python', 'CSS', 'SQL', 'C'),
(74, 19, 'REST API stands for?', 'Remote Execution State Transfer', 'Representational State Transfer', 'Reliable Server Technology', 'Remote Service Tool', 'B'),
(75, 19, 'Which database is commonly used in full stack apps?', 'Excel', 'MySQL', 'Notepad', 'PowerPoint', 'B'),
(76, 19, 'What is the role of a backend server?', 'Display UI', 'Handle logic and data', 'Style pages', 'Animate elements', 'B'),
(77, 20, 'Which language adds interactivity to web pages?', 'HTML', 'CSS', 'JavaScript', 'XML', 'C'),
(78, 20, 'What is responsive design?', 'Fast loading pages', 'Design that adapts to screen sizes', 'Animated UI', 'Dark mode support', 'B'),
(79, 20, 'Which CSS framework is widely used for responsive design?', 'jQuery', 'Bootstrap', 'Node.js', 'Laravel', 'B'),
(80, 20, 'What does the <meta viewport> tag do?', 'Sets page title', 'Controls layout on mobile', 'Links CSS files', 'Adds icons', 'B'),
(81, 20, 'Which tool is used to inspect HTML/CSS in a browser?', 'Notepad', 'Developer Tools', 'File Explorer', 'Task Manager', 'B'),
(82, 21, 'Which technique reduces image file size?', 'Encryption', 'Compression', 'Duplication', 'Minification', 'B'),
(83, 21, 'What does CDN stand for?', 'Central Data Node', 'Content Delivery Network', 'Core Design Network', 'Cloud Data Node', 'B'),
(84, 21, 'What is lazy loading?', 'Loading all assets at once', 'Loading assets only when needed', 'Caching all pages', 'Preloading fonts', 'B'),
(85, 21, 'Which HTTP method is fastest for repeated requests?', 'POST', 'DELETE', 'GET with caching', 'PUT', 'C'),
(86, 21, 'Minification of JS/CSS means?', 'Encrypting files', 'Removing unnecessary characters', 'Splitting files', 'Compressing images', 'B'),
(87, 22, 'Which Python library is used for data analysis?', 'NumPy', 'Pandas', 'Matplotlib', 'All of the above', 'D'),
(88, 22, 'What is a Python list?', 'An immutable sequence', 'A mutable ordered collection', 'A key-value store', 'A fixed array', 'B'),
(89, 22, 'Which keyword is used for exception handling in Python?', 'catch', 'try', 'handle', 'error', 'B'),
(90, 22, 'What does pip do in Python?', 'Runs scripts', 'Installs packages', 'Compiles code', 'Debugs programs', 'B'),
(91, 22, 'Which Python version is currently recommended?', 'Python 2', 'Python 3', 'Python 1', 'Python 0', 'B'),
(92, 23, 'What is inheritance in Java?', 'Hiding data', 'One class acquiring properties of another', 'Creating objects', 'Overloading methods', 'B'),
(93, 23, 'Which keyword prevents a class from being inherited?', 'static', 'private', 'final', 'abstract', 'C'),
(94, 23, 'What is an interface in Java?', 'A class with all concrete methods', 'A blueprint with abstract methods', 'A variable type', 'A loop construct', 'B'),
(95, 23, 'What does the \"this\" keyword refer to?', 'Parent class', 'Current object', 'Static method', 'Return value', 'B'),
(96, 23, 'Which collection maintains insertion order in Java?', 'HashSet', 'TreeSet', 'ArrayList', 'HashMap', 'C'),
(97, 24, 'Which symbol ends a statement in C?', ':', '.', ';', ',', 'C'),
(98, 24, 'What is the correct way to declare an integer in C?', 'integer x;', 'int x;', 'num x;', 'var x;', 'B'),
(99, 24, 'Which function prints output in C?', 'print()', 'echo()', 'printf()', 'cout()', 'C'),
(100, 24, 'What does a pointer store in C?', 'A value', 'A memory address', 'A string', 'A function', 'B'),
(101, 24, 'Which header file is needed for printf in C?', 'stdlib.h', 'math.h', 'stdio.h', 'string.h', 'C'),
(102, 25, 'C++ is an extension of which language?', 'Java', 'Python', 'C', 'Assembly', 'C'),
(103, 25, 'Which concept allows functions with the same name but different parameters?', 'Inheritance', 'Overloading', 'Polymorphism', 'Encapsulation', 'B'),
(104, 25, 'What is cout used for in C++?', 'Input', 'Output', 'Memory allocation', 'File reading', 'B'),
(105, 25, 'Which keyword is used to create a class in C++?', 'struct', 'class', 'object', 'type', 'B'),
(106, 25, 'What is a destructor in C++?', 'A function that creates objects', 'A function called when object is destroyed', 'A static method', 'A constructor overload', 'B'),
(107, 26, 'Which data structure uses LIFO order?', 'Queue', 'Stack', 'Array', 'Tree', 'B'),
(108, 26, 'Which data structure uses FIFO order?', 'Stack', 'Tree', 'Queue', 'Graph', 'C'),
(109, 26, 'What is the time complexity of binary search?', 'O(n)', 'O(n²)', 'O(log n)', 'O(1)', 'C'),
(110, 26, 'A linked list node contains?', 'Only data', 'Only pointer', 'Data and pointer to next node', 'Key-value pair', 'C'),
(111, 26, 'Which traversal visits root first in a binary tree?', 'Inorder', 'Postorder', 'Preorder', 'Level order', 'C'),
(112, 27, 'What is the time complexity of bubble sort?', 'O(n log n)', 'O(n)', 'O(n²)', 'O(1)', 'C'),
(113, 27, 'Which algorithm technique breaks a problem into subproblems?', 'Greedy', 'Brute Force', 'Divide and Conquer', 'Backtracking', 'C'),
(114, 27, 'What does Big O notation describe?', 'Memory usage only', 'Algorithm performance/complexity', 'Code readability', 'Variable types', 'B'),
(115, 27, 'Which sorting algorithm is fastest on average?', 'Bubble Sort', 'Selection Sort', 'Quick Sort', 'Insertion Sort', 'C'),
(116, 27, 'Dynamic programming solves problems by?', 'Random guessing', 'Storing results of subproblems', 'Brute force', 'Recursion only', 'B'),
(117, 28, 'What are the four pillars of OOP?', 'Loop, Array, Function, Class', 'Encapsulation, Inheritance, Polymorphism, Abstraction', 'Input, Output, Process, Store', 'Variable, Method, Object, Type', 'B'),
(118, 28, 'What is encapsulation?', 'Hiding implementation details', 'Creating multiple objects', 'Inheriting from a class', 'Overriding methods', 'A'),
(119, 28, 'What is polymorphism?', 'One interface, many implementations', 'Creating a class', 'Storing data', 'Looping through arrays', 'A'),
(120, 28, 'What is an object in OOP?', 'A function', 'An instance of a class', 'A variable', 'A loop', 'B'),
(121, 28, 'What is abstraction in OOP?', 'Showing all details', 'Hiding complex details, showing essentials', 'Creating subclasses', 'Overloading operators', 'B'),
(122, 29, 'What is SDLC?', 'Software Data Language Cycle', 'Software Development Life Cycle', 'System Design Logic Concept', 'Software Debugging Loop Cycle', 'B'),
(123, 29, 'Which model follows a sequential design process?', 'Agile', 'Scrum', 'Waterfall', 'Kanban', 'C'),
(124, 29, 'What is a software requirement?', 'A bug report', 'A description of what the system should do', 'A test case', 'A deployment script', 'B'),
(125, 29, 'What does version control help with?', 'Styling code', 'Tracking code changes', 'Running tests', 'Deploying apps', 'B'),
(126, 29, 'Which tool is commonly used for version control?', 'Photoshop', 'Excel', 'Git', 'Notepad', 'C'),
(127, 30, 'What is the main function of an OS?', 'Browse the internet', 'Manage hardware and software resources', 'Write programs', 'Store files only', 'B'),
(128, 30, 'What is a process in an OS?', 'A stored file', 'A program in execution', 'A hardware component', 'A network packet', 'B'),
(129, 30, 'What is deadlock in OS?', 'A crashed program', 'Processes waiting for each other indefinitely', 'A slow CPU', 'A memory leak', 'B'),
(130, 30, 'Which scheduling algorithm gives CPU to the shortest job first?', 'FCFS', 'Round Robin', 'SJF', 'Priority', 'C'),
(131, 30, 'What is virtual memory?', 'Extra RAM', 'Using disk space as extended RAM', 'A type of cache', 'A CPU register', 'B'),
(132, 31, 'What does CPU stand for?', 'Central Processing Unit', 'Core Program Utility', 'Computer Power Unit', 'Central Program Updater', 'A'),
(133, 31, 'What is the function of the ALU?', 'Store data', 'Perform arithmetic and logic operations', 'Manage memory', 'Control input/output', 'B'),
(134, 31, 'What is cache memory?', 'Slow permanent storage', 'Fast temporary storage near CPU', 'External hard drive', 'RAM module', 'B'),
(135, 31, 'What is the fetch-decode-execute cycle?', 'A sorting algorithm', 'The basic CPU operation cycle', 'A memory management technique', 'A network protocol', 'B'),
(136, 31, 'What does RAM stand for?', 'Random Access Memory', 'Read All Memory', 'Rapid Access Module', 'Remote Access Memory', 'A'),
(137, 32, 'What is a database?', 'A programming language', 'An organized collection of data', 'A web server', 'A network protocol', 'B'),
(138, 32, 'What does SQL stand for?', 'Structured Query Language', 'Simple Question Logic', 'System Query Layer', 'Stored Query List', 'A'),
(139, 32, 'What is a primary key?', 'A duplicate record', 'A unique identifier for a table row', 'A foreign table', 'An index column', 'B'),
(140, 32, 'Which SQL command retrieves data?', 'INSERT', 'UPDATE', 'SELECT', 'DELETE', 'C'),
(141, 32, 'What is a foreign key?', 'A key from another country', 'A field linking two tables', 'A duplicate primary key', 'An encrypted key', 'B'),
(142, 33, 'Which command creates a new table in MySQL?', 'NEW TABLE', 'ADD TABLE', 'CREATE TABLE', 'MAKE TABLE', 'C'),
(143, 33, 'Which clause filters rows in a SELECT query?', 'ORDER BY', 'GROUP BY', 'WHERE', 'HAVING', 'C'),
(144, 33, 'What does AUTO_INCREMENT do in MySQL?', 'Deletes records automatically', 'Automatically increases a column value', 'Sorts data', 'Creates indexes', 'B'),
(145, 33, 'Which JOIN returns all rows from both tables?', 'INNER JOIN', 'LEFT JOIN', 'RIGHT JOIN', 'FULL OUTER JOIN', 'D'),
(146, 33, 'Which MySQL command removes all rows from a table?', 'DELETE', 'DROP', 'TRUNCATE', 'REMOVE', 'C'),
(147, 34, 'PostgreSQL is what type of database?', 'NoSQL', 'Relational', 'Graph', 'Key-Value', 'B'),
(148, 34, 'Which command lists all databases in PostgreSQL?', 'list', 'db', 'l', 'show', 'C'),
(149, 34, 'What is a schema in PostgreSQL?', 'A table row', 'A namespace containing database objects', 'A stored procedure', 'An index', 'B'),
(150, 34, 'Which data type stores large text in PostgreSQL?', 'VARCHAR(10)', 'TEXT', 'CHAR', 'BLOB', 'B'),
(151, 34, 'What is pg_dump used for?', 'Creating tables', 'Backing up a database', 'Running queries', 'Managing users', 'B'),
(152, 35, 'MongoDB stores data in what format?', 'Tables', 'XML', 'JSON-like documents', 'CSV', 'C'),
(153, 35, 'What is a collection in MongoDB?', 'A row', 'A group of documents', 'A column', 'A database', 'B'),
(154, 35, 'Which command inserts a document in MongoDB?', 'db.insert()', 'db.collection.insertOne()', 'db.add()', 'db.push()', 'B'),
(155, 35, 'MongoDB is what type of database?', 'Relational', 'NoSQL', 'Graph', 'Columnar', 'B'),
(156, 35, 'What is the default port for MongoDB?', '3306', '5432', '27017', '8080', 'C'),
(157, 36, 'NoSQL databases are best for?', 'Fixed schema data', 'Flexible and unstructured data', 'Only numeric data', 'Only text data', 'B'),
(158, 36, 'Which is a key-value NoSQL database?', 'MongoDB', 'Redis', 'Cassandra', 'Neo4j', 'B'),
(159, 36, 'What does BASE stand for in NoSQL?', 'Basic Available Soft-state Eventually consistent', 'Binary Access Secure Engine', 'Batch Async Sync Engine', 'Base Array Store Engine', 'A'),
(160, 36, 'Which NoSQL type is best for social networks?', 'Key-Value', 'Document', 'Graph', 'Columnar', 'C'),
(161, 36, 'CAP theorem stands for?', 'Consistency, Availability, Partition tolerance', 'Cache, Access, Performance', 'Copy, Archive, Protect', 'Compute, Analyze, Process', 'A'),
(162, 37, 'What is an index in SQL?', 'A backup copy', 'A data structure to speed up queries', 'A foreign key', 'A stored procedure', 'B'),
(163, 37, 'Which clause is used to sort results in SQL?', 'GROUP BY', 'WHERE', 'ORDER BY', 'HAVING', 'C'),
(164, 37, 'What is query execution plan?', 'A backup plan', 'How the database executes a query', 'A table design', 'A user permission', 'B'),
(165, 37, 'Which type of join is fastest for large tables?', 'CROSS JOIN', 'INNER JOIN with index', 'FULL OUTER JOIN', 'SELF JOIN', 'B'),
(166, 37, 'What does EXPLAIN do in SQL?', 'Deletes a table', 'Shows query execution plan', 'Creates an index', 'Drops a database', 'B'),
(167, 38, 'What is SQL injection?', 'A backup method', 'Inserting malicious SQL into queries', 'A database optimization', 'A join technique', 'B'),
(168, 38, 'Which technique prevents SQL injection?', 'Using SELECT *', 'Prepared statements', 'Disabling indexes', 'Using plain text passwords', 'B'),
(169, 38, 'What is database encryption used for?', 'Speeding up queries', 'Protecting data from unauthorized access', 'Creating backups', 'Sorting records', 'B'),
(170, 38, 'What is the principle of least privilege?', 'Give all users admin access', 'Give users only the access they need', 'Encrypt all data', 'Disable all logins', 'B'),
(171, 38, 'What does hashing a password do?', 'Stores it in plain text', 'Converts it to a fixed-length irreversible string', 'Encrypts it with a key', 'Compresses it', 'B'),
(172, 39, 'What is a data warehouse?', 'A physical storage room', 'A central repository for integrated data', 'A NoSQL database', 'A web server', 'B'),
(173, 39, 'What is ETL?', 'Extract, Transform, Load', 'Edit, Test, Launch', 'Encrypt, Transfer, Log', 'Execute, Track, List', 'A'),
(174, 39, 'What is a fact table in a data warehouse?', 'A table with descriptive data', 'A table with measurable business data', 'A backup table', 'A user table', 'B'),
(175, 39, 'What is OLAP?', 'Online Analytical Processing', 'Online Application Protocol', 'Object Linked Access Point', 'Open Layer API', 'A'),
(176, 39, 'What is a dimension table?', 'A table with numeric facts', 'A table with descriptive attributes', 'A temporary table', 'A log table', 'B'),
(177, 40, 'What is Hadoop used for?', 'Web development', 'Processing large datasets', 'Mobile apps', 'Game development', 'B'),
(178, 40, 'What does HDFS stand for?', 'Hadoop Distributed File System', 'High Definition File Storage', 'Hybrid Data Format System', 'Hadoop Data Flow Service', 'A'),
(179, 40, 'What is Apache Spark?', 'A web framework', 'A fast data processing engine', 'A database', 'A cloud service', 'B'),
(180, 40, 'Big Data is characterized by?', 'Volume, Velocity, Variety', 'Speed, Size, Shape', 'Input, Output, Process', 'Read, Write, Execute', 'A'),
(181, 40, 'What is MapReduce?', 'A CSS framework', 'A programming model for large data processing', 'A database query', 'A network protocol', 'B'),
(182, 41, 'What is normalization in databases?', 'Encrypting data', 'Organizing data to reduce redundancy', 'Backing up data', 'Indexing tables', 'B'),
(183, 41, 'What is 1NF (First Normal Form)?', 'No duplicate rows, atomic values', 'No foreign keys', 'All columns indexed', 'No NULL values', 'A'),
(184, 41, 'What is an ER diagram?', 'An error report', 'Entity-Relationship diagram showing data model', 'An execution report', 'An encryption diagram', 'B'),
(185, 41, 'What is a composite key?', 'A key made of multiple columns', 'A foreign key', 'An auto-increment key', 'A unique index', 'A'),
(186, 41, 'What does denormalization do?', 'Removes all indexes', 'Adds redundancy to improve read performance', 'Deletes duplicate rows', 'Encrypts columns', 'B'),
(187, 42, 'What is machine learning?', 'Programming robots', 'Teaching computers to learn from data', 'Designing hardware', 'Writing operating systems', 'B'),
(188, 42, 'What is supervised learning?', 'Learning without labels', 'Learning with labeled training data', 'Learning by rewards', 'Learning from clusters', 'B'),
(189, 42, 'What is a training dataset?', 'Data used to test a model', 'Data used to train a model', 'Data used for deployment', 'Data used for visualization', 'B'),
(190, 42, 'What is overfitting?', 'Model performs well on all data', 'Model memorizes training data but fails on new data', 'Model is too simple', 'Model has no errors', 'B'),
(191, 42, 'Which algorithm is used for classification?', 'Linear Regression', 'K-Means', 'Decision Tree', 'PCA', 'C'),
(192, 43, 'What is a neural network?', 'A computer network', 'A system of interconnected nodes inspired by the brain', 'A database structure', 'A sorting algorithm', 'B'),
(193, 43, 'What is a layer in a neural network?', 'A database table', 'A group of neurons processing data', 'A CSS class', 'A file directory', 'B'),
(194, 43, 'What is backpropagation?', 'Moving data backwards', 'Algorithm to update weights by calculating gradients', 'A type of loop', 'A memory technique', 'B'),
(195, 43, 'What is an activation function?', 'A startup function', 'A function deciding neuron output', 'A sorting method', 'A data type', 'B'),
(196, 43, 'Which framework is popular for deep learning?', 'Bootstrap', 'TensorFlow', 'Laravel', 'jQuery', 'B'),
(197, 44, 'What is Artificial Intelligence?', 'Making computers faster', 'Simulating human intelligence in machines', 'Building robots only', 'Writing faster code', 'B'),
(198, 44, 'What is a chatbot?', 'A hardware device', 'An AI program that simulates conversation', 'A database tool', 'A web server', 'B'),
(199, 44, 'What is the Turing Test?', 'A speed test', 'A test to determine if a machine can think like a human', 'A hardware benchmark', 'A network test', 'B'),
(200, 44, 'Which search algorithm is used in AI?', 'Bubble Sort', 'A* Search', 'Binary Search', 'Quick Sort', 'B'),
(201, 44, 'What is natural language processing?', 'Processing images', 'Enabling computers to understand human language', 'Sorting text files', 'Compressing audio', 'B'),
(202, 45, 'What is data science?', 'Only database management', 'Extracting insights from data using statistics and ML', 'Web development', 'Network administration', 'B'),
(203, 45, 'Which Python library is used for data visualization?', 'NumPy', 'Pandas', 'Matplotlib', 'Scikit-learn', 'C'),
(204, 45, 'What is a data frame in Pandas?', 'A picture frame', 'A 2D labeled data structure', 'A loop structure', 'A network frame', 'B'),
(205, 45, 'What is exploratory data analysis?', 'Deleting bad data', 'Analyzing data to summarize characteristics', 'Training ML models', 'Deploying applications', 'B'),
(206, 45, 'What is feature engineering?', 'Building hardware features', 'Creating new input variables for ML models', 'Designing UI features', 'Writing API endpoints', 'B'),
(207, 46, 'What is tokenization in NLP?', 'Encrypting text', 'Splitting text into words or sentences', 'Translating text', 'Compressing text', 'B'),
(208, 46, 'What is sentiment analysis?', 'Analyzing images', 'Determining emotional tone of text', 'Translating languages', 'Counting words', 'B'),
(209, 46, 'What is a stop word in NLP?', 'A programming keyword', 'A common word removed during processing (e.g. \"the\")', 'A punctuation mark', 'A sentence ending', 'B'),
(210, 46, 'What does TF-IDF measure?', 'Text formatting', 'Importance of a word in a document', 'Translation frequency', 'Token file depth', 'B'),
(211, 46, 'Which library is popular for NLP in Python?', 'NumPy', 'NLTK', 'Matplotlib', 'Flask', 'B'),
(212, 47, 'What is computer vision?', 'Designing monitors', 'Enabling computers to interpret visual data', 'Writing graphics drivers', 'Building cameras', 'B'),
(213, 47, 'What is image classification?', 'Sorting files by size', 'Assigning a label to an image', 'Compressing images', 'Editing photos', 'B'),
(214, 47, 'What is object detection?', 'Finding bugs in code', 'Identifying and locating objects in an image', 'Deleting duplicate images', 'Resizing images', 'B'),
(215, 47, 'Which library is used for computer vision in Python?', 'Pandas', 'OpenCV', 'Flask', 'Django', 'B'),
(216, 47, 'What is a convolutional neural network (CNN) used for?', 'Text processing', 'Image recognition', 'Audio compression', 'Database queries', 'B'),
(217, 48, 'What is a perceptron?', 'A type of database', 'The simplest neural network unit', 'A sorting algorithm', 'A web component', 'B'),
(218, 48, 'What is the purpose of weights in a neural network?', 'Store data', 'Determine the strength of connections', 'Define layers', 'Set learning rate', 'B'),
(219, 48, 'What is gradient descent?', 'A downhill skiing technique', 'An optimization algorithm to minimize loss', 'A data sorting method', 'A network protocol', 'B'),
(220, 48, 'What is a loss function?', 'A function that loses data', 'A measure of how wrong the model predictions are', 'A memory function', 'A display function', 'B'),
(221, 48, 'What is dropout in neural networks?', 'Removing the network', 'Randomly disabling neurons to prevent overfitting', 'Reducing learning rate', 'Deleting training data', 'B'),
(222, 49, 'What is model deployment?', 'Training a model', 'Making a trained model available for use', 'Deleting a model', 'Testing a model', 'B'),
(223, 49, 'What is an API in the context of AI deployment?', 'A database', 'An interface to interact with the model', 'A training dataset', 'A neural network layer', 'B'),
(224, 49, 'What is Docker used for in deployment?', 'Training models', 'Containerizing applications', 'Storing datasets', 'Writing code', 'B'),
(225, 49, 'What is model versioning?', 'Deleting old models', 'Tracking different versions of a model', 'Encrypting models', 'Compressing models', 'B'),
(226, 49, 'What is a REST API endpoint?', 'A database table', 'A URL that accepts requests to interact with a service', 'A CSS selector', 'A JavaScript function', 'B'),
(227, 50, 'What is reinforcement learning?', 'Learning from labeled data', 'Learning by receiving rewards and penalties', 'Learning from clusters', 'Learning from images', 'B'),
(228, 50, 'What is an agent in reinforcement learning?', 'A database', 'The learner that takes actions in an environment', 'A training dataset', 'A neural network', 'B'),
(229, 50, 'What is a reward in reinforcement learning?', 'A penalty', 'Feedback signal for good actions', 'A training label', 'A loss function', 'B'),
(230, 50, 'What is the environment in RL?', 'The training data', 'The world the agent interacts with', 'The neural network', 'The reward function', 'B'),
(231, 50, 'What is Q-learning?', 'A query language', 'A model-free RL algorithm', 'A clustering method', 'A sorting algorithm', 'B'),
(232, 51, 'What is AI bias?', 'A fast AI model', 'Unfair outcomes due to biased training data', 'An AI optimization', 'A type of neural network', 'B'),
(233, 51, 'What is explainability in AI?', 'Making AI faster', 'Ability to understand and explain AI decisions', 'Encrypting AI models', 'Reducing AI cost', 'B'),
(234, 51, 'What is data privacy in AI?', 'Storing more data', 'Protecting personal data used in AI systems', 'Speeding up training', 'Reducing model size', 'B'),
(235, 51, 'What is the purpose of AI regulation?', 'To slow down AI', 'To ensure AI is used safely and fairly', 'To ban AI', 'To make AI free', 'B'),
(236, 51, 'What is algorithmic fairness?', 'Making algorithms faster', 'Ensuring AI treats all groups equitably', 'Reducing algorithm complexity', 'Encrypting algorithms', 'B'),
(237, 52, 'What is cybersecurity?', 'Building websites', 'Protecting systems from digital attacks', 'Writing software', 'Managing databases', 'B'),
(238, 52, 'What is a firewall?', 'A physical wall', 'A security system that monitors network traffic', 'A type of virus', 'A backup system', 'B'),
(239, 52, 'What is phishing?', 'A fishing sport', 'A trick to steal sensitive information via fake messages', 'A network protocol', 'A type of encryption', 'B'),
(240, 52, 'What is two-factor authentication?', 'Using two passwords', 'Verifying identity with two different methods', 'Logging in twice', 'Using two browsers', 'B'),
(241, 52, 'What is malware?', 'Good software', 'Malicious software designed to harm systems', 'A network cable', 'A database tool', 'B'),
(242, 53, 'What is ethical hacking?', 'Illegal hacking', 'Authorized testing of systems to find vulnerabilities', 'Hacking for money', 'Breaking into systems', 'B'),
(243, 53, 'What is a penetration test?', 'A medical test', 'A simulated attack to find security weaknesses', 'A speed test', 'A database test', 'B'),
(244, 53, 'What is a vulnerability?', 'A strong security feature', 'A weakness that can be exploited', 'A type of firewall', 'A network protocol', 'B'),
(245, 53, 'What does CEH stand for?', 'Certified Ethical Hacker', 'Computer Engineering Hardware', 'Cyber Encryption Handler', 'Central Exploit Hub', 'A'),
(246, 53, 'What is social engineering in hacking?', 'Building social networks', 'Manipulating people to reveal confidential info', 'Engineering social apps', 'Hacking social media', 'B'),
(247, 54, 'What is a VPN?', 'Virtual Private Network', 'Very Protected Node', 'Virtual Public Network', 'Verified Private Node', 'A'),
(248, 54, 'What is encryption?', 'Deleting data', 'Converting data into unreadable format', 'Compressing files', 'Backing up data', 'B'),
(249, 54, 'What is a DDoS attack?', 'A data deletion attack', 'Overwhelming a server with traffic to make it unavailable', 'A phishing attack', 'A password attack', 'B'),
(250, 54, 'What is SSL/TLS used for?', 'Speeding up websites', 'Encrypting data in transit', 'Storing passwords', 'Managing databases', 'B'),
(251, 54, 'What is an intrusion detection system?', 'A login system', 'A system that monitors for suspicious activity', 'A backup system', 'A firewall type', 'B'),
(252, 55, 'What is digital forensics?', 'Designing digital art', 'Investigating digital devices for evidence', 'Building digital systems', 'Managing digital files', 'B'),
(253, 55, 'What is a chain of custody?', 'A blockchain', 'Documentation tracking evidence handling', 'A network chain', 'A data pipeline', 'B'),
(254, 55, 'What is metadata?', 'The main data', 'Data about data', 'Encrypted data', 'Deleted data', 'B'),
(255, 55, 'What is disk imaging in forensics?', 'Taking a photo of a disk', 'Creating an exact copy of a storage device', 'Formatting a disk', 'Encrypting a disk', 'B'),
(256, 55, 'What is steganography?', 'A writing style', 'Hiding data within other data', 'A network protocol', 'A type of malware', 'B'),
(257, 56, 'What is the first phase of penetration testing?', 'Exploitation', 'Reporting', 'Reconnaissance', 'Scanning', 'C'),
(258, 56, 'What tool is commonly used for network scanning?', 'Photoshop', 'Nmap', 'Excel', 'Notepad', 'B'),
(259, 56, 'What is a payload in penetration testing?', 'A network packet', 'Code executed on a target system', 'A test report', 'A firewall rule', 'B'),
(260, 56, 'What is Metasploit?', 'A web framework', 'A penetration testing framework', 'A database tool', 'A CSS library', 'B'),
(261, 56, 'What is privilege escalation?', 'Giving users more storage', 'Gaining higher access rights than intended', 'Upgrading software', 'Increasing bandwidth', 'B'),
(262, 57, 'What is a virus in computing?', 'A helpful program', 'Malicious code that replicates itself', 'A network protocol', 'A database error', 'B'),
(263, 57, 'What is a Trojan horse malware?', 'A fast program', 'Malware disguised as legitimate software', 'A network scanner', 'A firewall', 'B'),
(264, 57, 'What is ransomware?', 'Free software', 'Malware that encrypts files and demands payment', 'A backup tool', 'A network monitor', 'B'),
(265, 57, 'What is static malware analysis?', 'Running malware to observe behavior', 'Analyzing malware without executing it', 'Deleting malware', 'Encrypting malware', 'B'),
(266, 57, 'What is a sandbox in malware analysis?', 'A children\'s playground', 'An isolated environment to safely run malware', 'A network zone', 'A database', 'B'),
(267, 58, 'What is the shared responsibility model in cloud?', 'Only the provider is responsible', 'Security responsibilities are shared between provider and customer', 'Only the customer is responsible', 'No one is responsible', 'B'),
(268, 58, 'What is IAM in cloud security?', 'Internet Access Management', 'Identity and Access Management', 'Internal Application Module', 'Integrated API Manager', 'B'),
(269, 58, 'What is data encryption at rest?', 'Encrypting data during transfer', 'Encrypting stored data', 'Deleting old data', 'Compressing data', 'B'),
(270, 58, 'What is a security group in cloud?', 'A team of security experts', 'A virtual firewall controlling traffic', 'A user group', 'A database cluster', 'B'),
(271, 58, 'What is multi-factor authentication?', 'Using multiple passwords', 'Requiring multiple verification methods to login', 'Logging in from multiple devices', 'Using multiple accounts', 'B'),
(272, 59, 'What is OWASP?', 'A web framework', 'Open Web Application Security Project', 'A cloud provider', 'A database tool', 'B'),
(273, 59, 'What is XSS (Cross-Site Scripting)?', 'A CSS technique', 'Injecting malicious scripts into web pages', 'A server error', 'A database attack', 'B'),
(274, 59, 'What is CSRF?', 'Cross-Site Request Forgery', 'CSS Resource File', 'Client-Side Rendering Framework', 'Core Security Response Filter', 'A'),
(275, 59, 'What is input validation?', 'Checking user interface design', 'Verifying user input is safe and expected', 'Validating HTML tags', 'Checking server speed', 'B'),
(276, 59, 'What is a security audit?', 'A financial audit', 'A systematic review of security measures', 'A performance test', 'A code review only', 'B'),
(277, 60, 'What is a SOC?', 'A type of network', 'Security Operations Center', 'System Operations Console', 'Secure Output Channel', 'B'),
(278, 60, 'What is SIEM?', 'Security Information and Event Management', 'System Integration Engine Module', 'Secure Internet Email Manager', 'Software Integration Event Monitor', 'A'),
(279, 60, 'What is an incident response plan?', 'A marketing plan', 'A procedure for handling security breaches', 'A backup plan', 'A hiring plan', 'B'),
(280, 60, 'What is threat intelligence?', 'AI-powered threats', 'Information about current and potential threats', 'A type of firewall', 'A network scanner', 'B'),
(281, 60, 'What is log analysis in security?', 'Writing logs', 'Reviewing system logs to detect suspicious activity', 'Deleting old logs', 'Compressing log files', 'B'),
(282, 61, 'What is ISO 27001?', 'A programming language', 'An international standard for information security management', 'A network protocol', 'A database standard', 'B'),
(283, 61, 'What is a risk assessment?', 'A financial assessment', 'Identifying and evaluating security risks', 'A performance review', 'A code review', 'B'),
(284, 61, 'What is a security policy?', 'A government law', 'A set of rules governing security practices', 'A firewall configuration', 'A network diagram', 'B'),
(285, 61, 'What is business continuity planning?', 'Planning business growth', 'Ensuring operations continue during/after a disaster', 'Planning marketing campaigns', 'Planning software releases', 'B'),
(286, 61, 'What is data classification?', 'Sorting files alphabetically', 'Categorizing data based on sensitivity', 'Encrypting all data', 'Backing up data', 'B'),
(287, 62, 'What is cloud computing?', 'Computing using weather data', 'Delivering computing services over the internet', 'A type of hardware', 'A programming language', 'B'),
(288, 62, 'What is SaaS?', 'Software as a Service', 'Storage as a System', 'Server as a Solution', 'Security as a Service', 'A'),
(289, 62, 'What is IaaS?', 'Internet as a Service', 'Infrastructure as a Service', 'Integration as a System', 'Input as a Service', 'B'),
(290, 62, 'What is PaaS?', 'Platform as a Service', 'Program as a System', 'Process as a Service', 'Protocol as a Standard', 'A'),
(291, 62, 'What is cloud scalability?', 'Making cloud cheaper', 'Ability to increase or decrease resources as needed', 'Securing cloud data', 'Backing up cloud data', 'B'),
(292, 63, 'What does AWS stand for?', 'Advanced Web Services', 'Amazon Web Services', 'Automated Web System', 'Application Web Server', 'B'),
(293, 63, 'What is Amazon S3?', 'A compute service', 'A simple storage service', 'A database service', 'A networking service', 'B'),
(294, 63, 'What is EC2 in AWS?', 'Elastic Compute Cloud', 'Extended Cloud Computing', 'Enterprise Cloud Control', 'Elastic Content Cache', 'A'),
(295, 63, 'What is the AWS Free Tier?', 'A paid plan', 'Limited free usage of AWS services', 'A premium plan', 'A student discount', 'B'),
(296, 63, 'What is a region in AWS?', 'A country', 'A geographic area with AWS data centers', 'A user group', 'A billing zone', 'B'),
(297, 64, 'Azure is a cloud platform by?', 'Google', 'Amazon', 'Microsoft', 'IBM', 'C'),
(298, 64, 'What is Azure Blob Storage?', 'A compute service', 'Object storage for unstructured data', 'A database service', 'A networking tool', 'B'),
(299, 64, 'What is Azure Active Directory?', 'A file directory', 'Identity and access management service', 'A storage service', 'A compute service', 'B'),
(300, 64, 'What is an Azure subscription?', 'A newsletter', 'A billing and access container for Azure resources', 'A user account', 'A virtual machine', 'B'),
(301, 64, 'What is Azure Virtual Machine?', 'A physical server', 'An on-demand scalable computing resource', 'A storage bucket', 'A network switch', 'B'),
(302, 65, 'GCP stands for?', 'Global Computing Platform', 'Google Cloud Platform', 'General Cloud Protocol', 'Google Core Processing', 'B'),
(303, 65, 'What is Google Cloud Storage?', 'A compute service', 'Object storage service', 'A database', 'A networking tool', 'B'),
(304, 65, 'What is BigQuery?', 'A search engine', 'A serverless data warehouse for analytics', 'A machine learning tool', 'A storage bucket', 'B'),
(305, 65, 'What is Google Kubernetes Engine?', 'A storage service', 'A managed Kubernetes container service', 'A database service', 'A networking tool', 'B'),
(306, 65, 'What is Cloud Run?', 'A running app', 'A serverless platform to run containers', 'A database service', 'A storage service', 'B'),
(307, 66, 'What is Docker?', 'A programming language', 'A platform for containerizing applications', 'A database tool', 'A web framework', 'B'),
(308, 66, 'What is a Docker image?', 'A photo', 'A read-only template to create containers', 'A running container', 'A network config', 'B'),
(309, 66, 'What is a Docker container?', 'A storage box', 'A running instance of a Docker image', 'A virtual machine', 'A network', 'B'),
(310, 66, 'What is a Dockerfile?', 'A documentation file', 'A script with instructions to build a Docker image', 'A config file', 'A log file', 'B'),
(311, 66, 'What is Docker Hub?', 'A hardware device', 'A registry for sharing Docker images', 'A container runtime', 'A network hub', 'B'),
(312, 67, 'What is Kubernetes?', 'A programming language', 'A container orchestration system', 'A database', 'A web server', 'B'),
(313, 67, 'What is a Pod in Kubernetes?', 'A storage unit', 'The smallest deployable unit containing containers', 'A network node', 'A service', 'B'),
(314, 67, 'What is a Kubernetes Service?', 'A background job', 'An abstraction exposing pods as a network service', 'A storage volume', 'A config map', 'B'),
(315, 67, 'What is kubectl?', 'A programming language', 'A command-line tool to manage Kubernetes', 'A container runtime', 'A monitoring tool', 'B'),
(316, 67, 'What is a Kubernetes Deployment?', 'A release process', 'A resource managing pod replicas and updates', 'A network policy', 'A storage class', 'B'),
(317, 68, 'What is DevOps?', 'A programming language', 'A culture combining development and operations', 'A database tool', 'A cloud service', 'B'),
(318, 68, 'What is continuous integration?', 'Integrating hardware', 'Automatically building and testing code on every commit', 'Deploying to production', 'Writing documentation', 'B'),
(319, 68, 'What is infrastructure as code?', 'Writing code for apps', 'Managing infrastructure using code and configuration files', 'A programming paradigm', 'A testing method', 'B'),
(320, 68, 'What is a deployment pipeline?', 'A water pipe', 'An automated process to build, test, and deploy code', 'A network cable', 'A database connection', 'B'),
(321, 68, 'What is monitoring in DevOps?', 'Watching TV', 'Tracking system performance and health', 'Writing tests', 'Managing databases', 'B'),
(322, 69, 'What does CI/CD stand for?', 'Code Integration / Code Deployment', 'Continuous Integration / Continuous Delivery', 'Central Integration / Central Deployment', 'Compiled Integration / Compiled Deployment', 'B'),
(323, 69, 'What is the purpose of a CI pipeline?', 'Deploy to production', 'Automatically build and test code changes', 'Monitor servers', 'Manage databases', 'B'),
(324, 69, 'Which tool is popular for CI/CD?', 'Photoshop', 'Jenkins', 'Excel', 'Notepad', 'B'),
(325, 69, 'What is a build artifact?', 'A bug', 'The output file produced by a build process', 'A test report', 'A log file', 'B'),
(326, 69, 'What is blue-green deployment?', 'Deploying to colored servers', 'Running two identical environments to reduce downtime', 'A testing strategy', 'A rollback method', 'B'),
(327, 70, 'What is Terraform?', 'A gardening tool', 'An IaC tool to provision cloud infrastructure', 'A database tool', 'A web framework', 'B'),
(328, 70, 'What is Ansible?', 'A programming language', 'An automation tool for configuration management', 'A cloud provider', 'A container tool', 'B'),
(329, 70, 'What is a Terraform state file?', 'A log file', 'A file tracking the current state of infrastructure', 'A config template', 'A backup file', 'B'),
(330, 70, 'What is idempotency in IaC?', 'Running code once', 'Applying the same config multiple times gives the same result', 'Encrypting configs', 'Versioning configs', 'B'),
(331, 70, 'What is a Terraform module?', 'A Python module', 'A reusable group of Terraform resources', 'A cloud region', 'A network config', 'B'),
(332, 71, 'What is SRE?', 'Software Release Engineering', 'Site Reliability Engineering', 'System Resource Evaluation', 'Secure Runtime Environment', 'B'),
(333, 71, 'What is SLO?', 'Service Level Objective', 'System Load Output', 'Software Launch Order', 'Secure Login Option', 'A'),
(334, 71, 'What is an error budget in SRE?', 'Money for fixing bugs', 'Allowed amount of downtime/errors before action is needed', 'A testing budget', 'A deployment limit', 'B'),
(335, 71, 'What is toil in SRE?', 'Hard work', 'Manual repetitive operational work that should be automated', 'A deployment process', 'A monitoring alert', 'B'),
(336, 71, 'What is observability in SRE?', 'Watching users', 'Ability to understand system state from its outputs', 'A security practice', 'A deployment strategy', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `course_type`
--

CREATE TABLE `course_type` (
  `course_type_id` int(11) NOT NULL,
  `course_type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_type`
--

INSERT INTO `course_type` (`course_type_id`, `course_type_name`) VALUES
(1, 'Computer Engineering'),
(2, 'Electrical Engineering'),
(3, 'Civil Engineering'),
(4, 'Electronics Engineering'),
(5, 'Information Technology'),
(6, 'Mechanical Enginnering');

-- --------------------------------------------------------

--
-- Table structure for table `course_videos`
--

CREATE TABLE `course_videos` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `Thumbnail` varchar(500) NOT NULL,
  `VideoTitle` varchar(100) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `video` varchar(200) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_videos`
--

INSERT INTO `course_videos` (`id`, `course_id`, `Thumbnail`, `VideoTitle`, `Description`, `video`, `Status`) VALUES
(2, 1, '../thumbnail/Java1.jpeg', '\nIntroduction to Java + Installing Java JDK and IntelliJ IDEA for Java', 'Installing Java JDK: This Java tutorial for beginners will teach you java programming from scratch. This complete java course will help you master all the concepts you need to learn in Java. We will install java, JDK and IntelliJ IDEA IDE for Java', '../course_videos/Introduction to Java Installing Java JDK and IntelliJ IDEA for Java.mp4', 1),
(3, 1, '../thumbnail/Java2.jpeg', '\nBasic Structure of a Java Program: Understanding our First Java Hello World Program', 'Understanding Java hello world Program: This Java tutorial for beginners will teach you java programming from scratch. This complete java course will help you master all the concepts you need to learn in Java. We will understand basic structure of a java program in this video!', '../course_videos/Basic Structure of a Java Program Understanding our First Java Hello World Program.mp4', 1),
(5, 1, '../thumbnail/Java3.jpeg', 'Java Tutorial Variables and Data Types in Java Programming', 'Java Tutorial (Variables and Data Types): This Java tutorial for beginners will teach you about primitive and non primitive data types in java programming from scratch. This complete java course will help you master all the concepts you need to learn in Java.', '../course_videos/Java Tutorial Variables and Data Types in Java Programming.mp4', 1),
(6, 1, '../thumbnail/Java4.jpeg', 'Java Tutorial Literals in Java', 'Java Programming tutorial (Literals in Java Programming) - This Java Complete Course video will teach you how to use literals in java in Hindi.\nTopics Discussed includes: Literals in Java, String, Character, Integer, Floating-point, Double and Boolean literals in Java and how to use them with variab', '../course_videos/Java Tutorial Literals in Java.mp4', 1),
(9, 2, '../thumbnail/Python.jpeg', 'Introduction to Programming & Python  Python Tutorial - Day1', 'Python is one of the most demanded programming languages in the job market. Surprisingly, it is equally easy to learn and master  Python. This Python tutorial for absolute beginners in Hindi series will focus on teaching you Python concepts from the ground up.', '../course_videos/Introduction to Programming & Python  Python Tutorial - Day1.mp4', 1),
(10, 2, '../thumbnail/Python.jpeg', 'Some Amazing Python Programs - The Power of Python  Python Tutorial - Day2', 'Python is one of the most demanded programming languages in the job market. Surprisingly, it is equally easy to learn and master  Python. This python tutorial for absolute beginners in Hindi series will focus on teaching you python concepts from the ground up. Today we will see some of the mindblowi', '../course_videos/Some Amazing Python Programs - The Power of Python  Python Tutorial - Day2.mp4', 1),
(12, 3, '../thumbnail/Android1.png', 'Installing Android Studio & Setup  Android Tutorials in Hindi', 'In this video, we will understand Android Application development basics by installing Android Studio and setting up an emulator device.', '../course_videos/Installing Android Studio & Setup  Android Tutorials in Hindi.mp4', 1),
(13, 3, '../thumbnail/Android2.png', 'Creating Our First Android App (with APK)  Android Tutorials in Hindi', 'In this video, we will see how to create a basic application in android along with APK to install the application to our phone.', '../course_videos/Creating Our First Android App (with APK)  Android Tutorials in Hindi.mp4', 1),
(14, 4, '../thumbnail/EEC1.png', 'EEC Lecture 1st For MSBTE Diploma 2nd Sem  Free Notes  Question Bank  Best Coaching For Diploma', 'After a lots o request we are now serving our qualitative content for diploma 2nd semester also. We have started a complete new playlist for EEC ( elements of electrical engineering ) subject for 2nd semester computer and electrical department .', '../course_videos/EEC Lecture 1st For MSBTE Diploma 2nd Sem  Free Notes  Question Bank  Best Coaching For Diploma.mp4', 1),
(15, 4, '../thumbnail/EEC2.png', 'EEC Lecture 2nd For MSBTE Diploma 2nd Sem  Free Notes  Question Bank  Best Coaching For Diploma', 'After a lots o request we are now serving our qualitative content for diploma 2nd semester also. We have started a complete new playlist for EEC ( elements of electrical engineering ) subject for 2nd semester computer and electrical department . ', '../course_videos/EEC Lecture 2nd For MSBTE Diploma 2nd Sem  Free Notes  Question Bank  Best Coaching For Diploma.mp4', 1),
(16, 5, '../thumbnail/Thermodynamics1.png', 'Thermodynamics 01 Introduction Thermal Equilibrium n Zeroth Law of Thermodynamics', 'Live Classes, Video Lectures, Test Series, Lecturewise notes, topicwise DPP, dynamic Exercise and much more on Physicswallah App.', '../course_videos/Thermodynamics 01 Introduction Thermal Equilibrium n Zeroth Law of Thermodynamics.mp4', 0),
(17, 5, '../thumbnail/Thermodynamics2.png', 'Thermodynamics 02 (Physics )  Internal Energy  Degree of Freedom Law Of Equipartition Of Energy', 'Live Classes, Video Lectures, Test Series, Lecturewise notes, topicwise DPP, dynamic Exercise and much more on Physicswallah App.', '../course_videos/Thermodynamics 02 (Physics )  Internal Energy  Degree of Freedom Law Of Equipartition Of Energy.mp4', 0),
(19, 6, '../thumbnail/PHP1.png', 'Installing XAMPP VS Code Environment Setup', 'PHP Tutorials in Hindi', '../course_videos/Installing XAMPP VS Code Environment Setup.mp4', 1),
(20, 6, '../thumbnail/PHP2.png', 'Creating Our First PHP Website', 'PHP Tutorials in Hindi', '../course_videos/Creating Our First PHP Website.mp4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `notes_id` int(11) NOT NULL,
  `notes_owner_id` int(11) NOT NULL,
  `notes_name` varchar(200) NOT NULL,
  `notes_price` int(11) NOT NULL,
  `notes_pdf_link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`notes_id`, `notes_owner_id`, `notes_name`, `notes_price`, `notes_pdf_link`) VALUES
(4, 1, 'Android Programming', 1, '../notes/1774349237_Unit-01-Android OS and Programming-S.pdf'),
(5, 5, 'Design and Analysis of Algorithms', 2, '../notes/1774356224_Mam Notes DAA Chapter 1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(200) NOT NULL,
  `project_language` varchar(200) NOT NULL,
  `project_price` int(11) NOT NULL,
  `project_link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_language`, `project_price`, `project_link`) VALUES
(3, 'Kaun Banega Corepati', 'Python', 5, '../projects/1774359106_kaun-banega-crorepati-main.zip'),
(4, 'Quarantine Project', 'Python', 10, '../projects/1774359260_Python-Quarantine-Projects-master.zip'),
(5, 'Self Driving Car', 'Python', 4000, '../projects/1774359312_SelfDriving-Car_Deep-Learning-master.zip');

-- --------------------------------------------------------

--
-- Table structure for table `studentcourseregistered`
--

CREATE TABLE `studentcourseregistered` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentcourseregistered`
--

INSERT INTO `studentcourseregistered` (`id`, `course_id`, `user_id`) VALUES
(2, 1, 5),
(4, 4, 26),
(15, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `studentnotesregistered`
--

CREATE TABLE `studentnotesregistered` (
  `id` int(11) NOT NULL,
  `notes_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentnotesregistered`
--

INSERT INTO `studentnotesregistered` (`id`, `notes_id`, `student_id`) VALUES
(4, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `studentprojectregistered`
--

CREATE TABLE `studentprojectregistered` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_quiz_pass`
--

CREATE TABLE `student_quiz_pass` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `passed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_quiz_pass`
--

INSERT INTO `student_quiz_pass` (`id`, `student_id`, `course_id`, `passed_at`) VALUES
(1, 5, 11, '2026-03-24 22:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(200) NOT NULL,
  `project_owner_name` varchar(200) NOT NULL,
  `project_owner_email` varchar(200) NOT NULL,
  `project_owner_contact_no` varchar(200) NOT NULL,
  `project_owner_address` varchar(200) NOT NULL,
  `project_ra` varchar(200) NOT NULL,
  `project_login_d` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`project_id`, `project_name`, `project_owner_name`, `project_owner_email`, `project_owner_contact_no`, `project_owner_address`, `project_ra`, `project_login_d`) VALUES
(1, 'Student Skill Enhancement', 'Kshirsagar Ishwari Dattatraya', 'ishwarikshirsagar1234@gmail.com', '+919209547440', 'Dharashiv', '🚫 Admin Restricted Login Access', 'Login is currently disabled by administrator.');

-- --------------------------------------------------------

--
-- Table structure for table `users_database`
--

CREATE TABLE `users_database` (
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` int(11) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `linkedin` text NOT NULL,
  `twitter` text NOT NULL,
  `github` text NOT NULL,
  `profile_information` text NOT NULL,
  `recent_activities` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_database`
--

INSERT INTO `users_database` (`user_id`, `name`, `email`, `password`, `user_type`, `phone_number`, `address`, `facebook`, `instagram`, `linkedin`, `twitter`, `github`, `profile_information`, `recent_activities`, `created_on`) VALUES
(1, 'Kshirsagar Ishwari Dattatraya', 'ishwarikshirsagar1234@gmail.com', 'ishwarikshirsagar1234@gmail.com', 1, '+919209547440', 'Dharashiv', 'https://www.facebook.com/share/1H2yUrdsxF/', 'https://www.instagram.com/yogeshkshirsagar_0001/', 'https://www.linkedin.com/in/yogesh-kshirsagar-838a2428b/', 'https://x.com/YogeshK11389', 'https://github.com/YoKshirsagar', 'Hello! I am Kshirsagar Yogesh Dattatraya, an enthusiastic developer and the admin of this Event Management System. With a keen interest in web development and programming, I am always eager to learn new technologies and improve my skills.Feel free to connect with me through my social media links. Let\'s collaborate and make great things happen!', 'Recently, I had the privilege of securing the 2nd place (Runner-up) in the Technical Event 2023 at Terna College of Engineering, Dharashiv, which was an incredible experience competing with talented peers and gaining valuable insights. Additionally, I completed a 6-session workshop on \"Essential Principles of Meaningful Life\" organized by the Personality Development Club at Government College of Engineering Chh. Sambhajinagar.', '2025-01-10 12:12:25'),
(4, 'Amruta Patil', 'patilamruta0000@gmail.com', 'patilamruta0000@gmail.com', 2, '+918669164306', 'Dharashiv', '', '', '', '', '', 'Hello! I am Om Shingare, an enthusiastic developer and one of the Organizer of this Event Management System.', '', '2025-01-10 14:54:49'),
(5, 'Ashwashradha Pawar', 'ashwashradhapawar@gmail.com', 'ashwashradhapawar@gmail.com', 3, '+919359777316', 'Jalgaon', '', '', '', '', '', '', '', '2025-01-10 14:56:17'),
(6, 'Ashwsandhya Pawar', 'ashwsandhyapawar@gmail.com', 'ashwsandhyapawar@gmail.com', 2, '+919529250152', 'Dharashiv', '', '', '', '', '', '', '', '2025-01-10 14:57:45'),
(16, 'Shlok Javheri', 'shlokjavheri@gmail.com', 'shlokjavheri@gmail.com', 2, '+918888888888', 'Dharashiv', '', '', '', '', '', '', '', '2025-01-12 14:16:51'),
(17, 'Vinod Kumar', 'vinodkumar@gmail.com', 'vinodkumar@gmail.com', 2, '+919999999999', 'Latur', '', '', '', '', '', '', '', '2025-01-12 14:21:47'),
(19, 'Tushar Gawande', 'tushargawande@gmail.com', 'tushargawande@gmail.com', 2, '+919022361966', 'Chhatrapati Sambhajinagar', '', '', '', '', '', '', '', '2025-02-20 14:08:06'),
(22, 'Kajal Patil', 'kajalpatil@gmail.com', 'kajalpatil@gmail.com', 2, '+916666666666', 'Mumbai', '', '', '', '', '', '', '', '2025-12-15 15:23:05'),
(26, 'Rupa', 'rupasharma@gmail.com', 'rupasharma@gmail.com', 3, '+918292829282', 'Solapur', '', '', '', '', '', '', '', '2025-12-19 22:37:42'),
(28, 'Yogesh Kshirsagar', 'yogeshkshirsagar393@gmail.com', 'yogeshkshirsagar393@gmail.com', 3, '7499665641', 'Dharashiv', '', '', '', '', '', '', '', '2026-02-15 17:13:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_database`
--
ALTER TABLE `course_database`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `course_type` (`course_type`),
  ADD KEY `course_owner` (`course_owner`);

--
-- Indexes for table `course_quiz`
--
ALTER TABLE `course_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course_type`
--
ALTER TABLE `course_type`
  ADD PRIMARY KEY (`course_type_id`);

--
-- Indexes for table `course_videos`
--
ALTER TABLE `course_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_course_videos_course` (`course_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`notes_id`),
  ADD KEY `fk_notes_owner` (`notes_owner_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `studentcourseregistered`
--
ALTER TABLE `studentcourseregistered`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `studentnotesregistered`
--
ALTER TABLE `studentnotesregistered`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_id` (`notes_id`),
  ADD KEY `idx_student_id` (`student_id`);

--
-- Indexes for table `studentprojectregistered`
--
ALTER TABLE `studentprojectregistered`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `student_quiz_pass`
--
ALTER TABLE `student_quiz_pass`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_course` (`student_id`,`course_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `users_database`
--
ALTER TABLE `users_database`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `course_database`
--
ALTER TABLE `course_database`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `course_quiz`
--
ALTER TABLE `course_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT for table `course_type`
--
ALTER TABLE `course_type`
  MODIFY `course_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_videos`
--
ALTER TABLE `course_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `notes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `studentcourseregistered`
--
ALTER TABLE `studentcourseregistered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `studentnotesregistered`
--
ALTER TABLE `studentnotesregistered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `studentprojectregistered`
--
ALTER TABLE `studentprojectregistered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_quiz_pass`
--
ALTER TABLE `student_quiz_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_database`
--
ALTER TABLE `users_database`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_database` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `course_database`
--
ALTER TABLE `course_database`
  ADD CONSTRAINT `course_owner` FOREIGN KEY (`course_owner`) REFERENCES `users_database` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_type` FOREIGN KEY (`course_type`) REFERENCES `course_type` (`course_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_videos`
--
ALTER TABLE `course_videos`
  ADD CONSTRAINT `fk_course_videos_course` FOREIGN KEY (`course_id`) REFERENCES `course_database` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `fk_notes_owner` FOREIGN KEY (`notes_owner_id`) REFERENCES `users_database` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentcourseregistered`
--
ALTER TABLE `studentcourseregistered`
  ADD CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `course_database` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users_database` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentnotesregistered`
--
ALTER TABLE `studentnotesregistered`
  ADD CONSTRAINT `fk_studentnotes_student` FOREIGN KEY (`student_id`) REFERENCES `users_database` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notes_id` FOREIGN KEY (`notes_id`) REFERENCES `notes` (`notes_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentprojectregistered`
--
ALTER TABLE `studentprojectregistered`
  ADD CONSTRAINT `project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `users_database` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
