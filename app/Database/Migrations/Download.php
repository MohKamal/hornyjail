<?php
namespace Showcase\Database\Migrations {
    use \Showcase\Framework\Database\Config\Table;
    use \Showcase\Framework\Database\Config\Column;

    class Download extends Table{

        /**
         * Migration details
         * @return array of columns
         */
        function handle(){
            $this->name = 'downloads';
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