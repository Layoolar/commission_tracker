# commission_tracker

A commission tracker made for a badly designed pre-existing SQL table

Design a page which shows the following
* Purchaser name (A query of 2 tables - orders[purchaser_id] -> users[first_name].users[last_name] )
* Distributor name( A query of 2 tables and multiple queries - orders[purchaser_id] -> users.id[referral_id] -> users.referred_by[first_name].users.referred_by[last_name] )
* Referred - The number of users the distributor has referred as at when user was referred -- Blank if user is not distributor in user category table (orders[purchaser_id] -> users.id[referral_id] -> user_category[category_id] -> (count users table for users with referred_by as the purchaser with an enroll date < user enroll date) )
* Date - (2 tables - orders[purchased_by] -> user.id[enrolled]
* Percent - Increases by number of referrals, 0 -> 5%, 5-10 -> 10%, 11-20 -> 15%, 21-30 -> 20%, 31 and above -> 30% (Conditional number of referred)
* Commission - ((orders[id] -> quantity * orders[product_id] -> price) * percent )

A Copy of the database is included in the repository



DATABASE TABLE DESIGN

TABLE categories
id | name 

TABLE order_items
order_id | product_id | quantity

TABLE orders
id | invoice_number | purchaser_id | order_date

TABLE products
id | sku | name | price

TABLE user_category
user_id | category_id

TABLE users
id | first_name | last_name | username | referral id | enrolled date 


CREATE TABLE categories (
  id INT(11) NOT NULL,
  name VARCHAR(50),
  PRIMARY KEY (id)
)

CREATE TABLE order_items (
  order_id INT(11),
  product_id INT(11),
  qantity INT(11)
)

CREATE TABLE orders (
  id INT(11),
  invoice_number VARCHAR(255),
  purchaser_id INT(11),
  order_date DATE
)


CREATE TABLE products (
  id INT(11),
  sku VARCHAR(255),
  name VARCHAR(50),
  price DOUBLE
)

CREATE TABLE user_category (
  user_id INT(11),
  category_id INT(11)
)

CREATE TABLE users (
  id INT(11),
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  username VARCHAR(50),
  referred_by INT(11),
  enrolled_date DATE
)

