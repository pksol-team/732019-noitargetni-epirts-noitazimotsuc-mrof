TRUNCATE `assigns`;
TRUNCATE `bids`;
TRUNCATE `bid_mappers`;
TRUNCATE `devices`;
TRUNCATE `disputes`;
TRUNCATE `files`;
TRUNCATE `fines`;
TRUNCATE `forgets`;
TRUNCATE `messages`;
TRUNCATE `order_messages`;
TRUNCATE `payouts`;
TRUNCATE `paypaltxns`;
TRUNCATE `profiles`;
TRUNCATE `promotions`;
TRUNCATE `revisions_messages`;
TRUNCATE `suspensions`;
TRUNCATE `tips`;
TRUNCATE `traits`;
TRUNCATE `users`;
TRUNCATE `orders`;

alter table users AUTO_INCREMENT=85475;
alter table orders AUTO_INCREMENT=35475;
alter table assigns AUTO_INCREMENT=35475;

#alter table for existing members