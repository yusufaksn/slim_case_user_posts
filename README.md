# slim_case_user_posts
# Kurulum
##  Backend
   1-) docker-compose build
   2-) docker-compose up -d
###  Veritabanına erişim sağladıktan sonra aşağıdaki tablolar oluşturulmalı.
    CREATE TABLE users (
        id INT PRIMARY KEY,
        name VARCHAR(100),
        username VARCHAR(100),
        email VARCHAR(100),
        street VARCHAR(100),
        suite VARCHAR(100),
        city VARCHAR(100),
        zipcode VARCHAR(20),
        lat DECIMAL(10, 7),
        lng DECIMAL(10, 7),
        phone VARCHAR(50),
        website VARCHAR(100),
        company_name VARCHAR(100),
        company_catchphrase VARCHAR(255),
        company_bs VARCHAR(255)
    );
    CREATE TABLE user_posts (
       id INT PRIMARY KEY,
        userId INT,
        title VARCHAR(255),
        body TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT NULL,
        deleted_at TIMESTAMP NULL DEFAULT NULL,
        FOREIGN KEY (userId) REFERENCES users(id)
    );

 3-) Adresine "http://localhost:8006/api/bulk-user-insert" get isteği atarak kullanıcalar eklenmeli.
 4-) Adresine "http://localhost:8006/api/bulk-post-insert" get isteği atarak kullanıcılara ait postlar eklenmektedir.
 http://localhost:8006/api/api/user-post get isteği atıldığında user ve postlar gelmektedir.
 http://localhost:8006/api/api/user-post/{id} delete isteği atıldığında ilgili post silinmektedir.

## Frontend
cd ./front_end
npm install
npm start
