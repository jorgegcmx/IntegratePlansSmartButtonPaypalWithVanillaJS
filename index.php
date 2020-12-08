

<?php 
$Costo_plan_default=1;
$Nombre_plan_default='Plan Basico';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrito de compras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <h2>Descripcion 1</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
                    mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
                    magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <hr>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <h2>Beneficios</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
                    mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
                    magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <h4>Complementos</h4>
                <div class="row" id="cards"></div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Plan</th>
                                <th scope="col"></th>
                                <th scope="col">Total</th>
                                <th scope="col"></th>
                            </tr>
                            <tr>
                                <td>
                                    <h4><?php echo  $Nombre_plan_default; ?></h4>
                                </td>
                                <td></td>
                                <td>$<span><?php echo  $Costo_plan_default; ?></span></td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-id="1">
                                        &#10004;
                                    </button>
                                </td>
                            </tr>
                        </thead>
                        <tbody id="items">
                        </tbody>
                        <tfoot>
                            <tr id="footer">
                                <th colspan="2"></th>
                                <th scope="row">
                                    Total
                                </th>
                                <th>
                                    <span style="font-size: 25px; color: rgb(34, 107, 175);">$</span>
                                    <span id="total" style="font-size: 25px; color: rgb(34, 107, 175);"><?php echo  $Costo_plan_default; ?></span>
                                </th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="2">
                                    <!-- <button class="btn btn-success btn-block" id="pago">
                                        Pagar
                                    </button> -->
                                
                                        <div id="smart-button-container">
                                            <div style="text-align: center;">
                                                <div id="paypal-button-container"></div>
                                            </div>
                                        </div>                                                                      
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
        <hr>
    </div>


    <!-- Cartas -->
    <template id="template-card">
        <div class="col-12 mb-2">
            <div class="card">
                <div class="card-body" style="padding: 1em 2em 0em 2em;">                   
                    <input type="checkbox" class="form-check-input" >
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    <h6>Titulo</h6>
                    <span style="font-size: 25px; color: rgb(34, 107, 175);">$</span>
                    <span class="precio" style="font-size: 25px; color: rgb(34, 107, 175);">precio</span>
                </div>
            </div>
        </div>
    </template>
    <!-- Cartas /-->

    <template id="template-carrito">
        <tr>
            <td>Café</td>
            <td></td>
            <td>$<span>500</span></td>
            <td>
            </td>
        </tr>
    </template>

    <template id="template-footer">
        <td colspan="2"></td>
        <th scope="row">
            Total
        </th>
        <td class="font-weight-bold">
            <h5 style="font-size: 25px; color: rgb(34, 107, 175);">$</span>
                <span id="total" style="font-size: 25px; color: rgb(34, 107, 175);"><?php echo $Costo_plan_default; ?></span>
        </td>
    </template>
    <script src="https://www.paypal.com/sdk/js?client-id=AWpWjA2Jn3e0AI-05l65-p2pAJ-Fi21seloumeQeDfobns-TUUw25pQ6onGAM9R8BZb0Dpe2MWzZW1x5&vault=true" data-sdk-integration-source="button-factory"></script>
    <script src="app.js?n=1"></script>
</body>

</html>