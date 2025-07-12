<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Partes de Autos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../estilos/estiloLista.css">

</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-car-alt"></i> Inventario de Partes de Autos</h1>
            <a href="#" class="btn btn-primary" id="addPart">
                <i class="fas fa-plus"></i> Agregar Parte
            </a>
        </header>
        
        <div class="card">
            <div class="search-filter">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar parte...">
                </div>
                <div class="filter-select">
                    <select>
                        <option value="">Todas las marcas</option>
                        <option value="toyota">Toyota</option>
                        <option value="honda">Honda</option>
                        <option value="ford">Ford</option>
                        <option value="chevrolet">Chevrolet</option>
                    </select>
                </div>
                <div class="filter-select">
                    <select>
                        <option value="">Todos los modelos</option>
                        <option value="corolla">Corolla</option>
                        <option value="civic">Civic</option>
                        <option value="focus">Focus</option>
                        <option value="spark">Spark</option>
                    </select>
                </div>
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Parte</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Código</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Puerta delantera izquierda</td>
                            <td>Toyota</td>
                            <td>Corolla</td>
                            <td>2020</td>
                            <td>PT-2020-001</td>
                            <td>5</td>
                            <td><span class="badge badge-success">Disponible</span></td>
                            <td>15/06/2023</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-delete"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Retrovisor derecho</td>
                            <td>Honda</td>
                            <td>Civic</td>
                            <td>2019</td>
                            <td>RT-2019-002</td>
                            <td>3</td>
                            <td><span class="badge badge-success">Disponible</span></td>
                            <td>10/06/2023</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-delete"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Motor 2.0L</td>
                            <td>Ford</td>
                            <td>Focus</td>
                            <td>2018</td>
                            <td>MN-2018-003</td>
                            <td>2</td>
                            <td><span class="badge badge-warning">Últimas unidades</span></td>
                            <td>05/06/2023</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-delete"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Vidrio frontal</td>
                            <td>Chevrolet</td>
                            <td>Spark</td>
                            <td>2021</td>
                            <td>VD-2021-004</td>
                            <td>0</td>
                            <td><span class="badge badge-danger">Agotado</span></td>
                            <td>20/05/2023</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-delete"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="pagination">
                <a href="#" class="page-link"><i class="fas fa-angle-left"></i></a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <a href="#" class="page-link"><i class="fas fa-angle-right"></i></a>
            </div>
        </div>
    </div>
</body>
</html>