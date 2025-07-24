<?php
require_once __DIR__ . '/../clases/conexion.php';
require_once __DIR__ . '/../clases/logger.php';

class SeccionController {
    private $db;
    private $id_seccion;    

    public function __construct($id_seccion) {
        $this->db = new mod_db();
        $this->id_seccion = $id_seccion;
    }

    public function getSecciones() {
        return $this->db->obtenerSeccion($this->id_seccion);
    }

    public function getMarcasPorSeccion($seccionId) {
        return $this->db->select("marcas", "*", "id_seccion = $seccionId");
    }

    public function getSeccion(){
        return $this->db->select("categoria", "categoria", "id_cat = " . $this->id_seccion);
    }

    public function generarReporteExcel($filtros = []) {
        try {
            // Limpiar cualquier salida previa
            if (ob_get_length()) ob_clean();
            
            // Verificar si PhpSpreadsheet está disponible
            if (!class_exists('\PhpOffice\PhpSpreadsheet\Spreadsheet')) {
                throw new Exception("PhpSpreadsheet no está instalado correctamente");
            }

            $datos = $this->db->obtenerDatosParaExcel($filtros);
            
            if (empty($datos)) {
                throw new Exception("No hay datos para generar el reporte");
            }
            
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            // Encabezados con estilo
            $headers = ['ID', 'Nombre', 'Categoría', 'Marca', 'Modelo', 'Año', 'Stock', 'Precio', 'Vendidas', 'Total Ventas'];
            $sheet->fromArray($headers, null, 'A1');
            
            // Estilo para encabezados
            $sheet->getStyle('A1:J1')->getFont()->setBold(true);
            
            // Datos
            $rowData = [];
            foreach ($datos as $item) {
                $rowData[] = [
                    $item['id_parte'],
                    $item['nombre'],
                    $item['categoria'],
                    $item['marca'],
                    $item['modelo'],
                    $item['anio'],
                    $item['cantidad_stock'],
                    $item['precio'],
                    $item['cantidad_vendida'],
                    $item['total_ventas']
                ];
            }
            $sheet->fromArray($rowData, null, 'A2');
            
            // Autoajustar columnas
            foreach (range('A', 'J') as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }
            
            // Generar archivo
            $filename = "reporte_inventario_" . date('Y-m-d') . ".xlsx";
            
            // Configurar headers
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            header('Pragma: no-cache');
            header('Expires: 0');
            
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;
            
        } catch (Exception $e) {
            error_log("Error al generar reporte Excel: " . $e->getMessage());
            throw new Exception("Error al generar el reporte: " . $e->getMessage());
        }
    }

    public function generarEstadisticasExcel() {
        try {
            // Limpiar buffers de salida
            while (ob_get_level()) {
                ob_end_clean();
            }

            // Verificar si PhpSpreadsheet está disponible
            if (!class_exists('\PhpOffice\PhpSpreadsheet\Spreadsheet')) {
                throw new Exception("PhpSpreadsheet no está instalado correctamente");
            }

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            
            // Hoja 1: Ventas por mes
            $ventasPorMes = $this->db->obtenerEstadisticasVentasPorMes();  // Punto y coma añadido
            
            $sheet1 = $spreadsheet->getActiveSheet();
            $sheet1->setTitle('Ventas por Mes');
            $sheet1->fromArray(
                ['Mes', 'Categoría', 'Total Ventas', 'Monto Total'], 
                null, 
                'A1'
            );
            $sheet1->fromArray($ventasPorMes, null, 'A2');
            
            // Estilo para encabezados
            $sheet1->getStyle('A1:D1')->getFont()->setBold(true);
            
            // Hoja 2: Partes más vendidas
            $partesMasVendidas = $this->db->obtenerPartesMasVendidas();
            $sheet2 = $spreadsheet->createSheet();
            $sheet2->setTitle('Partes Más Vendidas');
            $sheet2->fromArray(
                ['ID', 'Nombre', 'Categoría', 'Marca', 'Modelo', 'Vendidas', 'Monto'], 
                null, 
                'A1'
            );
            $sheet2->fromArray($partesMasVendidas, null, 'A2');
            
            // Estilo para encabezados
            $sheet2->getStyle('A1:G1')->getFont()->setBold(true);
            
            // Autoajustar columnas
            foreach ($spreadsheet->getAllSheets() as $sheet) {
                foreach (range('A', 'G') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            }
            
            // Generar archivo
            $filename = "estadisticas_ventas_" . date('Y-m-d') . ".xlsx";
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            header('Pragma: no-cache');
            header('Expires: 0');
            
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;
            
        } catch (Exception $e) {
            error_log("Error al generar estadísticas Excel: " . $e->getMessage());
            throw new Exception("Error al generar las estadísticas: " . $e->getMessage());
        }
    }
    
}