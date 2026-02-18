-- TEDxManaratAlFarouk Speakers Table v2.1
-- Added: published_date for tracking first publish

CREATE TABLE IF NOT EXISTS speakers (
    id INT(11) NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    job_title VARCHAR(150) NOT NULL,
    bio_raw TEXT NOT NULL,
    bio_processed VARCHAR(600) DEFAULT NULL,
    image_path VARCHAR(255) NOT NULL,
    facebook_url VARCHAR(255) DEFAULT NULL,
    linkedin_url VARCHAR(255) DEFAULT NULL,
    instagram_url VARCHAR(255) DEFAULT NULL,
    twitter_url VARCHAR(255) DEFAULT NULL,
    event_year YEAR NOT NULL DEFAULT 2026,
    generation TINYINT NOT NULL DEFAULT 7,
    display_order INT NOT NULL DEFAULT 0,
    status ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'published',
    published_date DATETIME DEFAULT NULL COMMENT 'First time published',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_event_year (event_year),
    INDEX idx_status (status),
    INDEX idx_display_order (display_order),
    INDEX idx_generation (generation),
    INDEX idx_published_date (published_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample data
INSERT INTO speakers (full_name, job_title, bio_raw, bio_processed, image_path, generation, display_order, status) VALUES
('Mystery Speaker', 'To Be Announced', 'We are finalizing our lineup with incredible minds. Stay tuned!', 'We are finalizing our lineup with incredible minds. Stay tuned!', 'images/mistryspeaker.webp', 7, 1, 'published'),
('Mystery Speaker', 'To Be Announced', 'We are finalizing our lineup with incredible minds. Stay tuned!', 'We are finalizing our lineup with incredible minds. Stay tuned!', 'images/mistryspeaker.webp', 7, 2, 'published'),
('Mystery Speaker', 'To Be Announced', 'We are finalizing our lineup with incredible minds. Stay tuned!', 'We are finalizing our lineup with incredible minds. Stay tuned!', 'images/mistryspeaker.webp', 7, 3, 'published');
