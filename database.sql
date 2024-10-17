
# voici les fonctions pour cree les database, le nom de la base de donnee est 'testtest'  :

#database user:

DROP TABLE IF EXISTS user ;
CREATE TABLE user(
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100),
email VARCHAR(100),
password VARCHAR(255),
media_object VARCHAR(255),
created_at DATETIME NOT null,
last_connection DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);




#database article / post:
DROP TABLE IF EXISTS post ;
CREATE TABLE post (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    media_object VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE
);	





#database tableLike:
DROP TABLE IF EXISTS tableLike;
CREATE TABLE tableLike (
    	post_id INT,
    	user_id INT,
    	FOREIGN KEY (post_id) REFERENCES post(id) ON UPDATE CASCADE ON DELETE CASCADE,
    	FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE
);



#databse commentaire:
DROP TABLE IF EXISTS commentaire;
CREATE TABLE commentaire (
    comment TEXT,
    user_id INT,
    post_id INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES post(id) ON UPDATE CASCADE ON DELETE CASCADE
);
