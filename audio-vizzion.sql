CREATE DATABASE IF NOT EXISTS audio_vizzion;

CREATE TABLE IF NOT EXISTS audio_vizzion.device 
(
deviceCatalogId INT NOT NULL AUTO_INCREMENT,
deviceCatalogName VARCHAR(250) NOT NULL,
deviceDescription VARCHAR(250) NOT NULL,
availabilityStatus VARCHAR(250) NOT NULL,
CONSTRAINT device_pk PRIMARY KEY (deviceCatalogId)
);

ALTER TABLE audio_vizzion.device AUTO_INCREMENT = 100;

CREATE TABLE IF NOT EXISTS audio_vizzion.visual_device 
(
deviceCatalogId INT NOT NULL,
lensFlag BOOLEAN NOT NULL,
lensSerialNb VARCHAR(250) NULL,
lensVisionType VARCHAR(250) NULL,
lensTint VARCHAR(250) NULL,
lensThinnessLevel VARCHAR(250) NULL,
frFlag BOOLEAN NOT NULL,
frBrand VARCHAR(250) NULL,
frModel VARCHAR(250) NULL,
CONSTRAINT visual_device_pk PRIMARY KEY (deviceCatalogId),
CONSTRAINT visual_device_deviceCatalogId_fk FOREIGN KEY (deviceCatalogId) REFERENCES device (deviceCatalogId)
ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT visual_device_ak UNIQUE (lensSerialNb)
);

CREATE TABLE IF NOT EXISTS audio_vizzion.hearing_device 
(
deviceCatalogId INT NOT NULL,
hdMake VARCHAR(250) NOT NULL,
hdModel VARCHAR(250) NOT NULL,
CONSTRAINT hearing_device_pk PRIMARY KEY (deviceCatalogId),
CONSTRAINT hearing_device_deviceCatalogId_fk FOREIGN KEY (deviceCatalogId) REFERENCES device (deviceCatalogId)
ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO device
(deviceCatalogName, deviceDescription, availabilityStatus) 
VALUES 
('Emporio Armani Ultra-Light frame', 'Brand new grey and blue ultra-light frame, latest trend in 2019.', 'In Stock'), 
('Optimo Single Vision Lens', 'Optimal single vision lens, 2020 style, anti-scratch and anti-shock.', 'In Stock'), 
('Phono Titanium Digital Hearing Aid', 'Ultra-sensitive digital hearing aid, adjustable through an App.', 'Currently being ordered');

INSERT INTO hearing_device
(deviceCatalogId, hdMake, hdModel) 
VALUES 
('102', 'Phono Ttanium', 'phono2021');

INSERT INTO visual_device 
(deviceCatalogId, lensFlag, lensSerialNb, lensVisionType, lensTint, lensThinnessLevel, 
frFlag, frBrand, frModel) 
VALUES
('100', '0', NULL, NULL, NULL, NULL, '1', 'Emporio Armani', 'Empo324'), 
('101', '1', 'opto456321987', 'Single vision for short-sightedness', 'clear', 'ultra-thin', '0', NULL, NULL);