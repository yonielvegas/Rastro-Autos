<?PHP 
// Esto es útil para manejar imágenes grandes, ajusta si es necesario
ini_set("memory_limit","256M");
ini_set('max_execution_time', '60');

class thumImagenes { 
    Private $ImgRuta;
    Private $ImgTipo;
    Private $EscalaThumb;

    // Constructor o método para inicializar las propiedades
    function introduce_imagen($imgRuta, $imgTipo, $escalaThumb){
        error_log("Thumbnail.php -> introduce_imagen: ImgRuta: " . $imgRuta . ", ImgTipo: " . $imgTipo . ", Escala: " . $escalaThumb);
        $this->ImgRuta = $imgRuta;
        $this->ImgTipo = $imgTipo;
        $this->EscalaThumb = $escalaThumb;
    }

    // Método para crear el thumbnail y DEVOLVER su ruta COMPLETA
    function crear_thumbnail($outputFilePath){ 
        error_log("Thumbnail.php -> crear_thumbnail: Iniciando creación.");
        $img = null;

        // Crea una imagen a partir del tipo de archivo
        switch ($this->ImgTipo){
            case "image/jpeg": 
                $img = @imagecreatefromjpeg($this->ImgRuta);
                if (!$img) error_log("Thumbnail.php -> crear_thumbnail: Fallo al crear JPEG desde: " . $this->ImgRuta);
                break;
            case "image/gif":  
                $img = @imagecreatefromgif($this->ImgRuta);
                if (!$img) error_log("Thumbnail.php -> crear_thumbnail: Fallo al crear GIF desde: " . $this->ImgRuta);
                break;
            case "image/png":  
                $img = @imagecreatefrompng($this->ImgRuta);
                if (!$img) error_log("Thumbnail.php -> crear_thumbnail: Fallo al crear PNG desde: " . $this->ImgRuta);
                break;
            default: 
                error_log("Thumbnail.php -> crear_thumbnail: Tipo de imagen no soportado: " . $this->ImgTipo);
                return false; 
        }
        
        if (!$img) {
            error_log("Thumbnail.php -> crear_thumbnail: La imagen fuente no pudo ser creada.");
            return false; 
        }

        list($width, $height) = getimagesize($this->ImgRuta);
        error_log("Thumbnail.php -> crear_thumbnail: Dimensiones originales: " . $width . "x" . $height);
        $ancho = $width;
        $alto = $height;
        
        $thumAncho = 0;
        $thumAlto = 0;
        
        if ($ancho >= $alto) {
            $thumAncho = $this->EscalaThumb;
            $thumAlto = (int) round(($thumAncho * $alto) / $ancho);
        } else {
            $thumAlto = $this->EscalaThumb;
            $thumAncho = (int) round(($thumAlto * $ancho) / $alto);
        }
        
        $thumAncho = (int) round($thumAncho);
        $thumAlto = (int) round($thumAlto);

        $thumb = imagecreatetruecolor($thumAncho, $thumAlto);
        
        if ($this->ImgTipo == "image/png") {
            imagealphablending($thumb, false);
            imagesavealpha($thumb, true);
            $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
            imagefilledrectangle($thumb, 0, 0, $thumAncho, $thumAlto, $transparent);
        }
        
        imagecopyresampled($thumb, $img, 0, 0, 0, 0, $thumAncho, $thumAlto, $ancho, $alto);
        
        $calidad = 90; 
        error_log("Thumbnail.php -> crear_thumbnail: Intentando guardar thumbnail en: " . $outputFilePath);

        $success = false;
        switch ($this->ImgTipo){
            case "image/jpeg": 
                $success = imagejpeg($thumb, $outputFilePath, $calidad);
                break;
            case "image/gif":  
                $success = imagegif($thumb, $outputFilePath);
                break;
            case "image/png":  
                $success = imagepng($thumb, $outputFilePath, 9);
                break;
        }

        if (!$success) {
            error_log("Thumbnail.php -> crear_thumbnail: Fallo al guardar thumbnail en: " . $outputFilePath);
        } else {
            error_log("Thumbnail.php -> crear_thumbnail: Thumbnail guardado exitosamente.");
        }
        
        imagedestroy($img);
        imagedestroy($thumb);
        
        return $success ? $outputFilePath : false;
    } 
} 
?>