<?php
namespace Showcase\Database\Migrations {
    use \Showcase\Framework\Database\Config\Table;
    use \Showcase\Framework\Database\Config\Column;

    class Picture extends Table{

        /**
         * Migration details
         * @return array of columns
         */
        function handle(){
            $this->name = 'pictures';
            $this->column(
                Column::factory()->name('id')->autoIncrement()->primary()
            );
            $this->column(
                Column::factory()->name('name')->string()
            );
            $this->column(
                Column::factory()->name('url')->string()
            );
            $this->column(
                Column::factory()->name('category')->string()
            );
            $this->column(
                Column::factory()->name('likes')->int()
            );
            $this->column(
                Column::factory()->name('downloads')->int()
            );
            $this->column(
                Column::factory()->name('views')->int()
            );
            $this->timespan();
        }
    }
}