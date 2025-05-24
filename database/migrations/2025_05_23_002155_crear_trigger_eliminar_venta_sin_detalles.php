<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER eliminar_venta_sin_detalles
            AFTER DELETE ON sale_details
            FOR EACH ROW
            BEGIN
                DECLARE cantidad INT;

                SELECT COUNT(*) INTO cantidad
                FROM sale_details
                WHERE sales_id = OLD.sales_id;

                IF cantidad = 0 THEN
                    DELETE FROM sales WHERE id = OLD.sales_id;
                END IF;
            END
        ");
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS eliminar_venta_sin_detalles');
    }
};
