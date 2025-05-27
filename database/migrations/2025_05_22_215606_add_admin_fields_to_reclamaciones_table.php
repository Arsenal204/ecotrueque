
   <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up(): void
        {
            Schema::table('reclamaciones', function (Blueprint $table) {
                $table->text('resolucion_admin')->nullable()->after('descripcion');
                $table->date('fecha_resolucion')->nullable()->after('fecha_reclamacion');
                $table->string('archivos_admin')->nullable()->after('estado_reclamacion');
            });
        }

        public function down(): void
        {
            Schema::table('reclamaciones', function (Blueprint $table) {
                $table->dropColumn(['resolucion_admin', 'fecha_resolucion', 'archivos_admin']);
            });
        }
    };
