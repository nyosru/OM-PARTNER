<?php

use yii\db\Migration;

class m160317_093258_om_partners_add_pages extends Migration
{
    public function up()
    {

        $this->execute("
  	   		CREATE TABLE IF NOT EXISTS `partners_page` (
 				`id` int(11) NOT NULL,
 				`partners_id` int(100) NOT NULL,
  				`type` varchar(100) NOT NULL,
				`name` text NOT NULL,
  				`content` text NOT NULL,
				`tags` text NOT NULL,
				`viewed` int(11) NOT NULL,
  				`active` tinyint(1) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                        
			ALTER TABLE `partners_page` ADD INDEX(`id`);

			ALTER TABLE `partners_page` ADD PRIMARY KEY(`id`);

			ALTER TABLE `partners_page` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

			ALTER TABLE `partners_page` ADD INDEX(`partners_id`);

			ALTER TABLE `partners_page` ADD CONSTRAINT `partners_id` FOREIGN KEY (`partners_id`) REFERENCES `partners`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;


			");
    }

    public function down()
    {
          $this->execute("
            DROP TABLE IF EXISTS `partners_page`
        ");
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
