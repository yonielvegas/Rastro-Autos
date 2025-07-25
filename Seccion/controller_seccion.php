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

    public function generarExcelCompleto($filtros = []) {
        try {
            // Limpiar cualquier salida previa
            if (ob_get_length()) ob_clean();
            
            // Verificar si PhpSpreadsheet está disponible
            if (!class_exists('\PhpOffice\PhpSpreadsheet\Spreadsheet')) {
                throw new Exception("PhpSpreadsheet no está instalado correctamente");
            }

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            
            // Hoja 1: Reporte de Inventario
            $this->generarHojaInventario($spreadsheet, $filtros);
            
            // Hoja 2: Estadísticas
            $this->generarHojaEstadisticas($spreadsheet);
            
            // Generar archivo
            $filename = "reporte_completo_" . date('Y-m-d') . ".xlsx";
            
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

    private function generarHojaInventario($spreadsheet, $filtros) {
        $datos = $this->db->obtenerDatosParaExcel($filtros);
        
        if (empty($datos)) {
            throw new Exception("No hay datos de inventario para generar el reporte");
        }
        
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Inventario');
        
        // Encabezados
        $headers = ['ID', 'Nombre', 'Categoría', 'Marca', 'Modelo', 'Año', 'Stock', 'Precio', 'Vendidas', 'Total Ventas'];
        $sheet->fromArray($headers, null, 'A1');
        
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
        
        // Aplicar estilos y formatos
        $this->aplicarEstilosInventario($sheet, count($datos));
    }

    private function generarHojaEstadisticas($spreadsheet) {
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Estadísticas');
        
        // 1. Ventas por mes
        $ventasPorMes = $this->db->obtenerEstadisticasVentasPorMes();
        $sheet2->fromArray(['VENTAS POR MES'], null, 'A1');
        $sheet2->fromArray(['Mes', 'Categoría', 'Total Ventas', 'Monto Total'], null, 'A2');
        $sheet2->fromArray($ventasPorMes, null, 'A3');
        
        // 2. Partes más vendidas
        $partesMasVendidas = $this->db->obtenerPartesMasVendidas();
        $inicioPartes = count($ventasPorMes) + 5;
        $sheet2->fromArray(['PARTES MÁS VENDIDAS'], null, 'A' . $inicioPartes);
        $sheet2->fromArray(['ID', 'Nombre', 'Categoría', 'Marca', 'Modelo', 'Vendidas', 'Monto'], null, 'A' . ($inicioPartes + 1));
        $sheet2->fromArray($partesMasVendidas, null, 'A' . ($inicioPartes + 2));
        
        // 3. Totales por categoría
        $totalesPorCategoria = $this->db->obtenerTotalesPorCategoria();
        $inicioTotales = $inicioPartes + count($partesMasVendidas) + 5;
        $sheet2->fromArray(['TOTALES POR CATEGORÍA'], null, 'A' . $inicioTotales);
        $sheet2->fromArray(['Categoría', 'Total Ventas', 'Monto Total'], null, 'A' . ($inicioTotales + 1));
        $sheet2->fromArray($totalesPorCategoria, null, 'A' . ($inicioTotales + 2));
        
        // Aplicar estilos
        $this->aplicarEstilosEstadisticas($sheet2, count($ventasPorMes), count($partesMasVendidas), count($totalesPorCategoria));
    }

    private function aplicarEstilosInventario($sheet, $numFilas) {
        // Estilo encabezados
        $headerStyle = $sheet->getStyle('A1:J1');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $headerStyle->getFill()->getStartColor()->setARGB('FFD9D9D9');
        
        // Filtros y congelar
        $sheet->setAutoFilter('A1:J1');
        $sheet->freezePane('A2');
        
        // Formato condicional para stock bajo
        $conditional = new \PhpOffice\PhpSpreadsheet\Style\Conditional();
        $conditional->setConditionType(\PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS)
                ->setOperatorType(\PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_LESSTHAN)
                ->addCondition(5);
        $conditional->getStyle()->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
        
        $sheet->getStyle('G2:G' . ($numFilas + 1))->setConditionalStyles([$conditional]);
        
        // Formato de moneda
        $sheet->getStyle('H2:H' . ($numFilas + 1))
            ->getNumberFormat()
            ->setFormatCode('"$"#,##0.00');
        $sheet->getStyle('J2:J' . ($numFilas + 1))
            ->getNumberFormat()
            ->setFormatCode('"$"#,##0.00');
        
        // Autoajustar columnas
        foreach (range('A', 'J') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }

    private function aplicarEstilosEstadisticas($sheet, $numVentasMes, $numPartes, $numTotales) {
        // Estilo para todos los encabezados
        $styles = [
            'A1', 'A2:D2', 
            'A' . (5 + $numVentasMes), 
            'A' . (6 + $numVentasMes) . ':G' . (6 + $numVentasMes),
            'A' . (7 + $numVentasMes + $numPartes + 2),
            'A' . (8 + $numVentasMes + $numPartes + 2) . ':C' . (8 + $numVentasMes + $numPartes + 2)
        ];
        
        foreach ($styles as $range) {
            $style = $sheet->getStyle($range);
            $style->getFont()->setBold(true);
            $style->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $style->getFill()->getStartColor()->setARGB('FFD9D9D9');
        }
        
        // Formato de moneda
        $sheet->getStyle('D3:D' . (3 + $numVentasMes - 1))
            ->getNumberFormat()
            ->setFormatCode('"$"#,##0.00');
        $sheet->getStyle('G' . (7 + $numVentasMes) . ':G' . (7 + $numVentasMes + $numPartes - 1))
            ->getNumberFormat()
            ->setFormatCode('"$"#,##0.00');
        $sheet->getStyle('C' . (9 + $numVentasMes + $numPartes + 2) . ':C' . (9 + $numVentasMes + $numPartes + $numTotales + 1))
            ->getNumberFormat()
            ->setFormatCode('"$"#,##0.00');
        
        // Autoajustar columnas
        $lastColumn = $sheet->getHighestColumn();
        foreach (range('A', $lastColumn) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
    
}