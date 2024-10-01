DROP DATABASE IF EXISTS assets_insight;

-- Maak de 'assets_insight' database aan als deze nog niet bestaat
CREATE DATABASE assets_insight;

-- Gebruik de assets_insight database
USE assets_insight;

-- Maak de 'gebruikers' tabel aan
CREATE TABLE IF NOT EXISTS gebruikers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    rights ENUM('Reader', 'Writer', 'Admin') NOT NULL
);

-- Voeg een admin, testgebruikers en demogebruikers toe aan de 'gebruikers' tabel
INSERT INTO gebruikers (username, password, email, rights) VALUES 
('Admin', 'OGTB$em4vyCgo0H!', 'admin@assetsinsight.com', 'Admin'),
('testgebruiker', 'testwachtwoord', 'testgebruiker@gmail.com', 'Reader'),
('Bas', 'password1', 'bas@example.com', 'Reader'),
('Jantine', 'password2', 'jantine@example.com', 'Writer'),
('Thijs', 'password3', 'thijs@example.com', 'Reader'),
('Sven', 'password4', 'sven@example.com', 'Writer'),
('Merle', 'password5', 'merle@example.com', 'Reader'),
('Sophie', 'password6', 'sophie@example.com', 'Writer'),
('Lars', 'password7', 'lars@example.com', 'Reader'),
('Emma', 'password8', 'emma@example.com', 'Writer'),
('Sem', 'password9', 'sem@example.com', 'Reader'),
('Lisa', 'password10', 'lisa@example.com', 'Writer'),
('Daan', 'password11', 'daan@example.com', 'Reader'),
('Eva', 'password12', 'eva@example.com', 'Writer'),
('Tim', 'password13', 'tim@example.com', 'Reader'),
('Julia', 'password14', 'julia@example.com', 'Writer'),
('Lucas', 'password15', 'lucas@example.com', 'Reader'),
('Anna', 'password16', 'anna@example.com', 'Writer'),
('Max', 'password17', 'max@example.com', 'Reader'),
('Noa', 'password18', 'noa@example.com', 'Writer'),
('Milan', 'password19', 'milan@example.com', 'Reader'),
('Fleur', 'password20', 'fleur@example.com', 'Writer'),
('Thomas', 'password21', 'thomas@example.com', 'Reader'),
('Amber', 'password22', 'amber@example.com', 'Writer'),
('Finn', 'password23', 'finn@example.com', 'Reader'),
('Sanne', 'password24', 'sanne@example.com', 'Writer'),
('Ruben', 'password25', 'ruben@example.com', 'Reader'),
('Laura', 'password26', 'laura@example.com', 'Writer'),
('Robin', 'password27', 'robin@example.com', 'Reader'),
('Marit', 'password28', 'marit@example.com', 'Writer'),
('Luuk', 'password29', 'luuk@example.com', 'Reader'),
('Nina', 'password30', 'nina@example.com', 'Writer');

-- Maak de 'articles' tabel aan
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    writer_id VARCHAR(50) NOT NULL,
    title VARCHAR(100) NOT NULL,
    hero_text TEXT NOT NULL,
    published_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    featured_image_url VARCHAR(1000), -- Verhoogde lengte voor de URL voor lange links
    category ENUM('Crypto', 'Precious metals', 'Property', 'Shares') NOT NULL
);

-- Voeg een voorbeeldartikel toe aan de 'articles' tabel
INSERT INTO articles (writer_id, title, hero_text, featured_image_url, category)
VALUES 
('System', 'Wat zijn activa?', 'Activa zijn economische middelen die een bedrijf bezit en die waarde kunnen genereren in de toekomst.', 'https://cdn.nos.nl/image/2023/12/14/1035186/1536x864a.jpg', 'Crypto'),
('System', 'Soorten activa en hun kenmerken', 'Er zijn verschillende soorten activa, waaronder vaste activa, vlottende activa en immateriële activa. Elk type heeft zijn eigen kenmerken en waarde voor een bedrijf.', 'https://cdn.nos.nl/image/2023/12/14/1035186/1536x864a.jpg', 'Crypto');
