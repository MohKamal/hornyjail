<?php
namespace Showcase\Database\Migrations {
    use \Showcase\Framework\Database\Config\Table;
    use \Showcase\Framework\Database\Config\Column;

    class Likes extends Table{

        /**
         * Migration details
         * @return array of columns
         */
        function handle(){
            $this->name = 'likes';
            $this->column(
                Column::factory()->name('id')->autoIncrement()->primary()
            );
            $this->column(
                Column::factory()->name('picture_id')->int()
            );
            $this->column(
                Column::factory()->name('ipaddress')->string()
            );
            $this->timespan();
        }
    }
}