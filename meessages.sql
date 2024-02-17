CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    chat_id BIGINT,
    from_id BIGINT,
    text TEXT
);