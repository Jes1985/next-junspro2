DROP TABLE IF EXISTS availability_slots;

CREATE TABLE availability_slots (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  start_at TIMESTAMP NOT NULL,
  end_at TIMESTAMP NOT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'available',
  timezone VARCHAR(60) NOT NULL DEFAULT 'Europe/Paris',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  KEY idx_user_id (user_id),
  KEY idx_start_at (start_at),
  CONSTRAINT availability_slots_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
