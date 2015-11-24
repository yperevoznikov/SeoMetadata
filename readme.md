# Metadata - seo data for web pages

## Run tests
  copy file `phpunit.xml.dist` to `phpunit.xml` and run in command line from module root:  
  ```
  php bin/phpunit.phar
  ```

## Installation
For MySql driver
```
CREATE TABLE YPSeoMetadata_items (  
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
    identity VARCHAR(128) DEFAULT NULL,  
    type VARCHAR(128) DEFAULT NULL,  
    seo_text TEXT,  
    title VARCHAR(255) DEFAULT NULL,  
    description VARCHAR(255) DEFAULT NULL  
);  
CREATE INDEX identity_type_index ON YPSeoMetadata_items (identity, type);  
```