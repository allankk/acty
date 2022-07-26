-- Create the organizations table
CREATE TABLE organizations (
    _id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    org_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (_id)
);

-- Create the relations table
CREATE TABLE relations (
    _id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    child_name VARCHAR(50) NOT NULL,
    parent_name VARCHAR(50) DEFAULT NULL,
    PRIMARY KEY (_id),
    FOREIGN KEY (child_name) REFERENCES organizations(org_name)
);

-- Populate the relations table
INSERT INTO relations (child_name, parent_name) 
    VALUES  ('Paradise Island', '-'),
            ('Banana tree', 'Paradise Island'),
            ('Yellow Banana', 'Banana tree'),
            ('Brown Banana', 'Banana tree'),
            ('Black Banana', 'Banana tree'),
            ('Big banana tree', 'Paradise Island'),
            ('Yellow Banana', 'Big banana tree'),
            ('Brown Banana', 'Big banana tree'),
            ('Green Banana', 'Big banana tree'),
            ('Black Banana', 'Big banana tree'),
            ('Phoneutria Spider', 'Black banana');

-- Populate the organizations table
INSERT INTO organizations (org_name) 
    VALUES  ('Paradise Island'),
            ('Banana tree'),
            ('Yellow Banana'),
            ('Brown Banana'),
            ('Black Banana'),
            ('Big banana tree'),
            ('Green Banana'),
            ('Phoneutria Spider');
