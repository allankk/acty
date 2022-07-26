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
