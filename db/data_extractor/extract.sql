/*
Author : Srinivas
Description: This script is used to extract data from the tables in .csv format for visualization
*/

/*
select GROUP_CONCAT(CONCAT("'",COLUMN_NAME,"'"))
from INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = 'stats_taxes'
AND TABLE_SCHEMA = 'clientopolyidx'
order BY ORDINAL_POSITION
*/



/*
Extract data from stats_acres
*/
SELECT 'id','stats_geo_id','zip','city','county','state','average','lowest','highest','timestamp','on_market'
UNION ALL
SELECT id,stats_geo_id,zip,city,county,state,average,lowest,highest,timestamp,on_market
    FROM stats_acres
    INTO OUTFILE 'C:\\wamp\\www\\cs\\dat\\stats_acres.csv'
    FIELDS ENCLOSED BY '' 
    TERMINATED BY ',' 
    ESCAPED BY '"' LINES 
    TERMINATED BY '\r\n';
    
/*
Extract data from stats_bath
*/

SELECT 'id','stats_geo_id','zip','city','county','state','bath_count','average','lowest','highest','timestamp','on_market'
UNION ALL
SELECT id,stats_geo_id,zip,city,county,state,bath_count,average,lowest,highest,timestamp,on_market
    FROM stats_bath
    INTO OUTFILE 'C:\\wamp\\www\\cs\\dat\\stats_bath.csv'
    FIELDS ENCLOSED BY '' 
    TERMINATED BY ',' 
    ESCAPED BY '"' LINES 
    TERMINATED BY '\r\n';
    
    
/*
Extract data from stats_bed
*/

SELECT 'id','stats_geo_id','zip','city','county','state','bed_count','average','lowest','highest','timestamp','on_market'
UNION ALL
SELECT id,stats_geo_id,zip,city,county,state,bed_count,average,lowest,highest,timestamp,on_market
    FROM stats_bed
    INTO OUTFILE 'C:\\wamp\\www\\cs\\dat\\stats_bed.csv'
    FIELDS ENCLOSED BY '' 
    TERMINATED BY ',' 
    ESCAPED BY '"' LINES 
    TERMINATED BY '\r\n';
    
    
    
/*
Extract data from stats_garage
*/

SELECT 'id','stats_geo_id','zip','city','county','state','garage_count','average','lowest','highest','timestamp','on_market'
UNION ALL
SELECT id,stats_geo_id,zip,city,county,state,garage_count,average,lowest,highest,timestamp,on_market
    FROM stats_garage
    INTO OUTFILE 'C:\\wamp\\www\\cs\\dat\\stats_garage.csv'
    FIELDS ENCLOSED BY '' 
    TERMINATED BY ',' 
    ESCAPED BY '"' LINES 
    TERMINATED BY '\r\n';
    
    
/*
Extract data from stats_geo
*/

SELECT 'id','zip','city','county','state','date_started'
UNION ALL
SELECT id,zip,city,county,state,date_started
    FROM stats_geo
    INTO OUTFILE 'C:\\wamp\\www\\cs\\dat\\stats_geo.csv'
    FIELDS ENCLOSED BY '' 
    TERMINATED BY ',' 
    ESCAPED BY '"' LINES 
    TERMINATED BY '\r\n';
    
    
    
/*
Extract data from stats_list
*/

SELECT 'id','listtype','proptype','total','total_new','total_off_market','timestamp','on_market'
UNION ALL
SELECT id,listtype,proptype,total,total_new,total_off_market,timestamp,on_market
    FROM stats_list
    INTO OUTFILE 'C:\\wamp\\www\\cs\\dat\\stats_list.csv'
    FIELDS ENCLOSED BY '' 
    TERMINATED BY ',' 
    ESCAPED BY '"' LINES 
    TERMINATED BY '\r\n';
    
    
    
/*
Extract data from stats_listings
*/

SELECT 'id','stats_geo_id','zip','city','county','state','listing_count','average','lowest','highest','timestamp','on_market','mean'
UNION ALL
SELECT id,stats_geo_id,zip,city,county,state,listing_count,average,lowest,highest,timestamp,on_market,mean
    FROM stats_listings
    INTO OUTFILE 'C:\\wamp\\www\\cs\\dat\\stats_listings.csv'
    FIELDS ENCLOSED BY '' 
    TERMINATED BY ',' 
    ESCAPED BY '"' LINES 
    TERMINATED BY '\r\n';
    
    
/*
Extract data from stats_taxes
*/

SELECT 'id','stats_geo_id','zip','city','county','state','average','lowest','highest','timestamp','on_market'
UNION ALL
SELECT id,stats_geo_id,zip,city,county,state,average,lowest,highest,timestamp,on_market
    FROM stats_taxes
    INTO OUTFILE 'C:\\wamp\\www\\cs\\dat\\stats_taxes.csv'
    FIELDS ENCLOSED BY '' 
    TERMINATED BY ',' 
    ESCAPED BY '"' LINES 
    TERMINATED BY '\r\n';